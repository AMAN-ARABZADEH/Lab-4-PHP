<?php
declare(strict_types=1); // Check for type cast problems
error_reporting(E_ALL); // Report and exit for all errors
/**
 *  Sources: 
 *  Source s https://www.w3schools.com/php/php_mysql_prepared_statements.asp
 * https://www.tutorialspoint.com/mysqli/mysqli_connection.htm
 * https://stackoverflow.com/questions/67641789/is-destruct-in-php-needed
 */
class GuestBook {

    /**
     * @var mysqli
     */
    private $conn;

/**
 * Class to connect to the DB
 *
 * @param string $servername  The host name running the database serve
 * @param string $username The username used to connect to the database, default root
 * @param string $password The password used to connect to the database default "" empty string.
 * @param string $dbname The name of the database to connect , 
 */
public function __construct($servername, $username, $password, $dbname) {
    try {
        // Set the data source name
       // $dsn = "mysql:host=$servername;dbname=$dbname";
        
        // Create a new PDO object with the data source name, username, and password
        $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        // Set the error mode to throw exceptions
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // If connection fails, terminate the script and display an error message
        die("Connection failed: " . $e->getMessage());
    }
    // If connection is successful, no need to do anything else
}




    /**
     * 
     *  Give each 
     */
public function __destruct() {
    // Set the connection object to null to close the database connection
    $this->conn = null;
}


/**
 * Adds a new record to the guestbook table.
 *
 * @param string $name The name of the user who posted the message
 * @param string $message The message that was posted
 * @return void
 */
public function addRecord($name, $message) {
    try {
        // Prepare the SQL statement with placeholders (?)
        $sql = "INSERT INTO guestbook (Username, Post) VALUES (?, ?)";

        // Prepare the statement with the database connection
        $stmt = $this->conn->prepare($sql);

        // Bind the values to the placeholders and execute the statement
        $stmt->execute([$name, $message]);
    } catch (PDOException $e) {
        // If there is an exception, display the error message
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}



/**
 * souce to read: 
 * 
 * https://stackoverflow.com/questions/17144846/how-to-add-a-delete-button-to-a-php-form-that-will-delete-a-row-from-a-mysql-tab
 * 
 * Deletes a record from the GuestBookTable with the specified user ID.
 * 
 * @param int $user_id The user ID of the record to be deleted.
 */
public function deleteRecord($user_id) {
    try {
        $sql = "DELETE FROM guestbook WHERE user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
    } catch (PDOException $e) {
        // If an error occurs, display the error message
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }
}




/**
 *  Print data to the screen
 * @return void
 */
public function printRecords() {
    try {
            $sql = "SELECT * FROM guestbook ORDER BY PostDate DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            // Execute the query

            // Check if there is an error in the query execution
            if ($this->conn->query($sql) === false) {
                echo "Error: " . $sql . "<br>" . $this->conn->error; // Display the error message
            } else {
                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo '<div class="container">';
                    echo '<div id="box"">';
                    echo '<h2 id="getName">' . $row["Username"] . "</h2>";
                    echo "<p id='getMessage'>" . $row["Post"]  . "</p>";
                    echo  "<p id='getTime'>" . htmlspecialchars( $row["PostDate"] ) . "</p>";

                    // Display a form for deleting the record, with the user_id as a hidden input
                    echo '<form  method="GET">';
                    echo '<input type="hidden"  name="delete" value="' . $row["user_id"] .'">';  // The key is here
                    echo '<input type="submit"id="delete" value="Delete">';
                    echo '</form>';

                    echo "</div>";
                    echo "<br>";
                    echo "</div>";
                }
            }
    } catch (PDOException $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n"; // Display the error message
    }

}

}


