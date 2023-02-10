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

    // static functions

    //TODO fill in the static function

    static function getItems(){
        $db = new mysqli("localhost","ah_user","AuctionHelper", "auction"); //DB Conection
        $query = "SELECT * FROM items";
        $result = $db->query($query);
        if(mysqli_num_rows($result) > 0 ){
            $items = array();

            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $item = new item($row['itemid'], $row['name'], $row['description'], $row['resaleprice'], $row['winbidder'], $row['winprice']);
                array_push( $itemsc, $item);

            }
            $db->close();
            return $items;
        }

        else{
            $db->close();
            return NULL;
        }


    }

    static function getItemsByBidder($bidderid){
        $db = new mysqli("localhost","ah_user","AuctionHelper", "auction"); //DB Conection
        $query = "SELECT * FROM items WHERE winbidder = $bidderid";
        $result = $db->query($query);
        if(mysqli_num_rows($result) > 0 ){
            $items = array();

            while($row = $result->fetch_array(MYSQLI_ASSOC)){
                $item = new item($row['itemid'], $row['name'], $row['description'], $row['resaleprice'], $row['winbidder'], $row['winprice']);
                array_push( $itemsc, $item);

            }
            $db->close();
            return $items;
        }

        else{
            $db->close();
            return NULL;
        }


    }

    static function findItem($itemid){
        $db = new mysqli("localhost","ah_user","AuctionHelper", "auction"); //DB Conection
        $query = "SELECT * FROM items WHERE itemid = $itemid";
        $result = $db->query($query);
        if(mysqli_num_rows($result) > 0 ){
            $row = $result->fetch_array(MYSQLI_ASSOC);
            $item = new item($row['itemid'], $row['name'], $row['description'], $row['resaleprice'], $row['winbidder'], $row['winprice']);
            $db->close();
            return $item;
        }

        else{
            $db->close();
            return NULL;
        }


    }

}
