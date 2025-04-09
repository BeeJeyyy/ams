<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the name, email, contact, or password already exists in the database
    $checkQuery = "SELECT * FROM admin WHERE name = '$name' OR email = '$email' OR contact = '$contact' OR password = '$password'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "<script>alert('Admin already exists. Please use a different name, contact, or email.');</script>";
        echo "<script>setTimeout(function(){ window.location.href = 'dashboard.php'; }, 1000);</script>";
    } else {
        // If no duplicates are found, proceed with the insertion
        $query = "INSERT INTO admin (name, contact, email, password) 
                  VALUES ('$name', '$contact', '$email', '$password')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Admin added successfully!');</script>";
            echo "<script>setTimeout(function(){ window.location.href = 'dashboard.php'; }, 1000);</script>";

        } else {
            echo "<script>alert('Error adding admin. Please try again later.');</script>";
            echo "<script>setTimeout(function(){ window.location.href = 'dashboard.php'; }, 1000);</script>";
        }
    }
}
?>



