<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);

$connection = mysqli_connect('localhost', 'root', '', 'book_db');

if (!$connection) {
    die("❌ Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['send'])) {
    // Sanitize input to prevent SQL injection
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $phone = mysqli_real_escape_string($connection, $_POST['phone']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $location = mysqli_real_escape_string($connection, $_POST['location']);
    $guests = mysqli_real_escape_string($connection, $_POST['guests']);
    $arrivals = mysqli_real_escape_string($connection, $_POST['arrivals']);
    $leaving = mysqli_real_escape_string($connection, $_POST['leaving']);

    // SQL query
    $request = "INSERT INTO book_form (name, email, phone, address, location, guests, arrivals, leaving) 
                VALUES ('$name', '$email', '$phone', '$address', '$location', '$guests', '$arrivals', '$leaving')";
    
    // Execute query and check for errors
    if (mysqli_query($connection, $request)) {
        session_start();
        $_SESSION['success_message'] = "Room booked successfully.";
        header('Location: book.php');
        exit;
    } else {
        die("❌ Error: " . mysqli_error($connection));
    }
} else {
    echo 'Something went wrong. Please try again!';
}
?>
