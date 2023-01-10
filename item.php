<?php
class item {
    public $itemid;
    public $name;
    public $description;
    public $resaleprice;
    public $winbidder;
    public $winprice;

    function __construct($itemid, $name, $description, $resaleprice, $winbidder, $winprice){
        $this->itemid = $itemid;
        $this->name = $name;
        $this->description = $description;
        $this->resaleprice = $resaleprice;
        $this->winbidder = $winbidder;
        $this->winprice = $winprice;
    }

    function __toString() {

        $output = " <h2>Item: $this->itemid</h2>" .
        " <h2>Name: $this->name</h2> \n" .
        " <h2>Description: $this->description</h2> \n" . 
        " <h2>Resale Price: $this->resaleprice</h2> \n" .
        " <h2>Winning Bid: $this->winbidder at  $this->winprice</h2> \n";
        return $output;
    }

    function saveItem(){
        $db = new mysqli("localhost","ah_user","AuctionHelper", "auction"); //DB Conection
        $query = "INSERT INTO items VALUES(?,?,?,?,?,?)"; // SQL
        $stmt = $db->prepare($query);
        $stmt->bind_param("isssii", $this->itemid, $this->name, $this->description, $this->resaleprice, $this->winbidder, $this->winprice);
        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    function updateItem(){
        $db = new mysqli("localhost","ah_user","AuctionHelper", "auction"); //DB Conection
        $query = "UPDATE items SET itemid = ?, name = ?, description = ?, resaleprice = ?, winbidder = ?, winprice = ? WHERE itemid = $this->itemid"; // SQL
        $stmt = $db->prepare($query);
        $stmt->bind_param("isssii", $this->itemid, $this->name, $this->description, $this->resaleprice, $this->winbidder, $this->winprice);
        $result = $stmt->execute();
        $db->close();
        return $result;

    }

    function removeItem(){
        $db = new mysqli("localhost","ah_user","AuctionHelper", "auction"); //DB Conection
        $query = "DELETE FROM items WHERE itemid = $this->itemid"; // SQL
        $result = $db->query($query);
        $db->close();
        return $result;
    }

    // static function to get all items

    static function getItems(){
        
    }

}



?>