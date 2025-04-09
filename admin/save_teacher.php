<?php
include 'db_connect.php'; // Ensure this file contains your database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password']; // Use the plain password
    $contact = $_POST['contact'];
    
    // Check if any of the fields (name, email, password, contact) already exist in the database
    $sql_check = "SELECT * FROM teacher WHERE name = ? OR email = ? OR password = ? OR contact = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("ssss", $name, $email, $password, $contact); // Bind the parameters
    $stmt_check->execute();
    $result = $stmt_check->get_result();
    
    if ($result->num_rows > 0) {
        echo "<script>alert('Teacher already exist!'); window.location.href='dashboard.php';</script>";
        exit();
    }
    
    // SQL query to insert data into the teacher table
    $sql = "INSERT INTO teacher (name, email, password, contact) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $password, $contact); // Bind the parameters to prevent SQL injection
    
    if ($stmt->execute()) {
        echo "<script>alert('Teacher added successfully!'); window.location.href='dashboard.php';</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
