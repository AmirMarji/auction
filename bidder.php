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


    /**
     * Gets all bidders (if any) and returns an PHP array of them.
     *
     * @return void
     */
    static function getBidders()
    {

        $db = new mysqli("localhost", "ah_user", "AuctionHelper", 'auction'); //init db connection

        // Define a SQL query to select all records from the 'bidders' table.
        $query = "SELECT * FROM bidders";

        // Execute the SQL query and store the result in the 'result' variable.
        $result = $db->query($query);

        // Check if there are any rows in the result set.
        if (mysqli_num_rows($result) > 0) {
            // Create an empty array to store Bidder objects.
            $bidders = array();

            // Loop through the result set and create Bidder objects for each row.
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                // Create a Bidder object with data from the current row.
                $bidder = new Bidder(
                    $row['bidderid'],
                    $row['lastname'],
                    $row['firstname'],
                    $row['address'],
                    $row['phone']
                );

                // Add the Bidder object to the 'bidders' array.
                array_push($bidders, $bidder);

                // Unset the 'bidder' variable to release the reference to the last Bidder object.
                unset($bidder);
            }

            //close the database conection and return the array.
            $db->close();
            return $bidders;
        } else {
            // If there are no rows in the result set, close the database connection and return NULL.
            $db->close();
            return NULL;
        }
    }

    /**
     * Return a specific bidder.
     *
     * @param [type] $bidderid
     * @return void
     */
    static function findBidder($bidderid)
    {
        // Create a new MySQLi database connection to the 'auction' database on the local server.
        $db = new mysqli("localhost", "ah_user", "AuctionHelper", 'auction'); //init db connection

        // Define a SQL query to select a specific bidder based on the given 'bidderid'.
        $query = "SELECT * FROM bidders WHERE bidderid = $bidderid";

        // Execute the SQL query and store the result in the 'result' variable.
        $result = $db->query($query);

        // Fetch the first row of the result as an associative array.
        $row = $result->fetch_array(MYSQLI_ASSOC);

        // Check if a row with the given 'bidderid' exists.
        if ($row) {
            // Create a Bidder object with data from the fetched row.
            $bidder = new Bidder(
                $row['bidderid'],
                $row['lastname'],
                $row['firstname'],
                $row['address'],
                $row['phone']
            );

            // Close the database connection.
            $db->close();

            // Return the Bidder object.
            return $bidder;
        } else {
            // If no matching row is found, close the database connection and return NULL.
            $db->close();
            return NULL;
        }
    }
}
