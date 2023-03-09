
<!--  For design and  appearance -->

<?php include "includes/header.php"; 

/*
Author: Aman Arabzadeh 
Course: Webbprogrammin lab 4 
Teachers : Mikael Hasselmalm och Jan-Erik Jonsson 
Last Update: 2023-03-08
Done
*/

?>
<h2>Visitors Gästbok</h2>

<section class="entry-form">
    <form  method="post">
        <label for="name">Your Name or Alias:</label>
        <input type="text" name="name" id="name" placeholder="Enter your name or alias" required >
        <label for="message">Message:</label>
        <textarea name="message" id="message" cols="30" rows="10" placeholder="Enter your message"  required></textarea>
        <div class="form-actions">
            <input type="submit" name="submit" value="Create Entry">
        </div>
    </form>
</section>
<!-- <script src="./js/script.js"></script> -->

<?php
// Read the guestbook.txt file and output the entries
include "includes/FileHandler.php";

$fileName = "../writeable/guestbook.txt";
//$fileName = "tempfile.txt"; 

$file = new FileHandler($fileName);
$file->deleteObject($file->GetFileName());
$file->addObject($file->GetFileName());

$file->printObject($file->GetFileName());

// Include the footer.php file
include "includes/footer.php";
?>
</body>
</html>