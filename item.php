<?php
class Item
{
    //class fields
    public $itemid;
    public $name;
    public $description;
    public $resaleprice;
    public $winbidder;
    public $winprice;

    function __construct(
        $itemid,
        $name,
        $description,
        $resaleprice,
        $winbidder,
        $winprice
    ) {
        $this->itemid = $itemid;
        $this->name = $name;
        $this->description = $description;
        $this->resaleprice = $resaleprice;
        $this->winbidder = $winbidder;
        $this->winprice = $winprice;
    }

    function __toString()
    {
        $output = "<h2>Item : $this->itemid</h2>" .
            "<h2>Name: $this->name</h2>\n";
        "<h2>Description: $this->description</h2>\n";
        "<h2>Resale Price: $this->resaleprice</h2>\n";
        "<h2>Winning bid: $this->winbidder at $this->winprice</h2>\n";
        return $output;
    }
}
