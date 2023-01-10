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

    

}
