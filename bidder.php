<?php
class Bidder {
    public $bidderid;
    public $lastname;
    public $firstname;
    public $address;
    public $phone;


    function __construct($bidderid, $fname, $lname, $address, $phone)
    {
        $this->bidderid = $bidderid;
        $this->lastname = $lname;
        $this->firstname = $fname;
        $this->address = $address;
        $this->phone = $phone;
        
    }

    function __toString()
    {
        $output = "<h2>Bidder Nymber: $this->bidderid</h2> \n" . 
        "<h2> $this->lastname, $this->firstname</h2> \n" .
        "<h2> $this->address</h2> \n" . 
        "<h2> $this->phone</h2> \n";
        return $output;
        
    }

    //save bidder to database
    function saveBidder(){
        //refactor later to be a include, just following book for now
        $db = new mysqli("localhost","ah_user","AuctionHelper", "auction"); //DB Conection
        $query = "INSERT INTO bidders VALUES(?,?,?,?,?)"; // SQL
        $stmt = $db->prepare($query);
        $stmt->bind_param("issss", $this->bidderid, $this->lastname, $this->firstname, $this->address, $this->phone);
        $result = $stmt->execute();
        $db->close();
        return $result;
    }
    // update existing bidder based on a bidderid
    function updateBidder(){
        $db = new mysqli("localhost","ah_user","AuctionHelper", "auction"); //DB Conection
        $query = "UPDATE bidders SET bidderid = ?, lastname = ?, firstname = ?, address = ?, phone = ? WHERE bidderid = $this->bidderid"; // SQL
        $stmt = $db->prepare($query);
        $stmt->bind_param("issss", $this->bidderid, $this->lastname, $this->firstname, $this->address, $this->phone);
        $result = $stmt->execute();
        $db->close();
        return $result;

    }

    function removeBidder(){
        $db = new mysqli("localhost","ah_user","AuctionHelper", "auction"); //DB Conection
        $query = "DELETE FROM bidders WHERE bidderid = $this->bidderid"; // SQL
        $result = $db->query($query);
        $db->close();
        return $result;

    }

    //static functions to be called at anytime
    
    static function getBidders(){
        $db = new mysqli("localhost","ah_user","AuctionHelper", "auction"); //DB Conection
        $query = "SELECT * FROM bidders";
        $result = $db->query($query);
        if(mysqli_num_rows($result) > 0 ){
            $bidders = array();
            while($row = $result->fetch_array(MYSQLI_ASSOC)){

                $bidder = new Bidder($row['bidderid'], $row['lastname'], $row['firstname'], $row['address'], $row['phone']);
                array_push($bidders, $bidder);
                unset($bidder);                

            }
            $db->close();
            return $bidders;
        }

        else{
            $db->close();
            return NULL;
        }

    }

    static function findBidder($bidderid){ 

        $db = new mysqli("localhost","ah_user","AuctionHelper", "auction"); //DB Conection
        $query = "SELECT * FROM  bidders WHERE bidderid = bidderid"; // SQL
        $result = $db->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if($row){

            $bidder = new Bidder($row['bidderid'], $row['lastname'], $row['firstname'], $row['address'], $row['phone']);
            $db->close();
            return $bidder;

        }

        else{
            $db->close();
            return NULL;
        }
        

    }

}

?>
