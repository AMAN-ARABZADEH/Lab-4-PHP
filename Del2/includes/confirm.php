<?php
   include_once "includes/GuestBook.php";
// Create a new GuestBook object
$guestbook = new GuestBook('studentmysql.miun.se', 'amar2100', '7gg2sm6k', 'amar2100');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate user input
    $name = strip_tags(trim(htmlspecialchars($_POST['name'])));
    $message = filter_var(trim(htmlspecialchars($_POST['message'])));
    if (!empty($name) && !empty($message)) {
        // Add the record to the guestbook
        $guestbook->addRecord($name, $message);
    }
    header("Location: index.php");
      exit();
}


// Check if the user_id parameter is set and is an integer
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $user_id = intval($_GET['delete']);

    // Delete the record with the specified user_id
    $guestbook->deleteRecord($user_id);

    // Redirect the user to the same page to avoid issues with browser navigation
    header("Location: index.php");
    exit();
}


// Print the records
$guestbook->printRecords();