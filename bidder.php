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

    function saveBidder(){
        
    }

}
