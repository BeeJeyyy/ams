<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $section_name = $_POST['section_name'];
    $class_name = $_POST['class_name'];
    $teacher_name = $_POST['teacher_name'];

    // Insert the section into the database
    $sql = "INSERT INTO section (section_name, class_name, teacher_name) 
    VALUES ('$section_name', '$class_name', '$teacher_name')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Section added successfully!'); window.location.href='dashboard.php';</script>";
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
