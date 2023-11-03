<?php
class Bidder
{
    // class fields
    public $bidderid;
    public $lastname;
    public $firstname;
    public $address;
    public $phone;

    /**
     * Constructor method.
     *
     * @param [type] $bidderid
     * @param [type] $lname
     * @param [type] $fname
     * @param [type] $address
     * @param [type] $phone
     */
    function __construct($bidderid, $lname, $fname, $address, $phone)
    {

        $this->bidderid = $bidderid;
        $this->lastname = $lname;
        $this->firstname = $fname;
        $this->address = $address;
        $this->phone = $phone;
    }

    /**
     * toString method.
     *
     * @return string
     */
    function __toString()
    {
        $output = "<h2>Bidder Number: $this->bidderid</h2> \n" .
            "<h2>$this->lastname, $this->firstname</h2>\n" .
            "<h2>$this->address</h2>\n" .
            "<h2>$this->phone</h2>\n";

        return $output;
    }

    /**
     * Inserts a bidder into the bidders table.
     *
     * @return void
     */
    function saveBidder()
    {
        $db = new mysqli("localhost", "ah_user", "AuctionHelper", 'auction'); //init db connection
        $query = "INSERT INTO bidders VALUES (?,?,?,?,?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("issss", $this->bidderid, $this->lastname, $this->firstname, $this->address, $this->phone);
        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    /**
     * Updates an existing bidder.
     *
     * @return void
     */
    function updateBidder()
    {
        $db = new mysqli("localhost", "ah_user", "AuctionHelper", 'auction'); //init db connection
        $query = "UPDATE bidders SET bidderid = ?, lastname = ?, firstname = ?, address = ?, phone = ? WHERE bidderid =  $this->bidderid";
        $stmt = $db->prepare($query);
        $stmt->bind_param("issss", $this->bidderid, $this->lastname, $this->firstname, $this->address, $this->phone);
        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    /**
     * Removes a bidder from the bidders table.
     *
     * @return void
     */
    function removeBidder()
    {
        $db = new mysqli("localhost", "ah_user", "AuctionHelper", 'auction'); //init db connection
        $query = "DELETE FROM bidders WHERE bidderid = $this->bidderid";
        $result = $db->query($query);
        $db->close();
        return $result;
    }

    
    static function getBidders()
    {
    }

    static function findBidder($bidderid)
    {
    }
}
