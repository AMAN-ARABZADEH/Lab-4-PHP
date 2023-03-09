

<?php

//declare(strict_types=1); // Check for type cast problems
//error_reporting(E_ALL); // Report and exit for all errors
include "includes/InputEvent.php";
/**
 *
 */
class FileHandler
{
    /**
     * private properties $fileName
     * @var
     */
    private $fileName;

    /**
     * The constructor method of the FileHandler class initializes a new FileHandler object
     * with the provided $filename property.
     *
     *  The constructor takes one parameter: $filename,
     *  which is used to set the corresponding property of the FileHandler object.
     *
     * @param $filename
     */
    public function __construct($filename)
    {
        $this->fileName = $filename;
    }

    /**
     * The GetFileName() method returns the value of the fileName property
     * @return fileName
     */
    public function GetFileName()
    {
        return $this->fileName;
    }



    /**
     * Adds an object to a file.
     *
     * Here's a reformulation of the text:
     *
     *
     * @param string $filename The name of the file to add the object to.
     *
     * @return void
     */
    function addObject($filename)
    {
        // Check if the 'submit' POST variable has been set
        if (isset($_POST['submit'])) {
            try {
                // Get the form data and sanitize it, for security
                $name = htmlspecialchars($_POST["name"]);
                $message = htmlspecialchars($_POST["message"]);
                $date = htmlspecialchars(date("d-m-y h:i:s"));

                // Create a new InputEvent object with the form data
                $user = new InputEvent($name, $message, $date);

                // Write the serialized object to the file
                $file = fopen($filename, "a");
                fwrite($file, serialize($user) . PHP_EOL);
                fclose($file);
                header  ("Location: ../Del1");
               exit;
            } catch (Exception $e) {
                // exception error
                echo "Error: " . $e->getMessage();
            }
        }
    }



    /**
     * Short Description:
     * Deletes an object from a file.
     
     *
     * @param string $filename The name of the file to delete the object from.
     *
     * @return void
     */
    function deleteObject($filename)
    {
        // Check if the 'delete' POST variable has been set
        if (isset($_POST['delete'])) {
            // Get the position of the object to delete
            $pos = $_POST["delete"];

            // Read existing users from file
            $users = array();
            $file = fopen($filename, "r");
            // Read each line in the file
            while (!feof($file)) {
                $line = fgets($file);
                if ($line) {
                    // Unserialize each line to an object and add it to the $users array
                    $user = unserialize($line);
                    $users[] = $user;
                }
            }
            fclose($file);

            // Remove the object at position $pos from the $users array
            unset($users[$pos]);

            // Save the remaining objects back to the file
            $file = fopen($filename, "w");
            foreach ($users as $user) {
                fwrite($file, serialize($user) . PHP_EOL);
            }
            fclose($file);
        header  ("Location: ../Del1");
        exit;
        }
    }




    /**
     * printObject" is a PHP function that requires a filename as input and outputs a list of objects stored in the file.
     *
     * @param $filename
     * @return void
     */

    function printObject($filename)
    {
        try {
            if (file_exists($filename) && filesize($filename) > 0) {
                $users = array();

                // Read existing users from file
                $file = fopen($filename, "r");
                while (!feof($file)) {
                    $line = fgets($file);
                    if ($line) {
                        $user = unserialize($line);  // unserialize the data from line
                        $users[] = $user;  // Save in array
                    }
                }
                fclose($file);
                // Index used to create a unique identifier for each data entry when generating the HTML output.
                //$index = 0;
                $users = array_reverse($users);
                // Foreach key in the value data do so
                foreach ($users as $index => $data) {
                    echo '<div class="box">';
                    echo '<div class="box-center">';
                    echo '<h2 class="getName">' . htmlspecialchars($data->getName()) . "</h2>";
                    echo "<p class='getMessage'>" . htmlspecialchars($data->getMessage()) . "</p>";
                    echo  "<p class='getTime'>" . htmlspecialchars($data->getTimestamp()) . "</p>";
                    echo '</div>';
                    echo '<form method="POST">';
                    echo '<input type="hidden"  name="delete" value="' . $index . '">';  // The key is here
                    echo '<input type="submit" class="delete" value="Delete">';
                    echo '</form>';
                    echo "</div>";
                    ///++$index;
                }
            } else {
                echo   "<p style='text-align: center'>" . "No data to display" . "</p>";
            }
        } catch (Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}
