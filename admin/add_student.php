<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST['student_id'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $teacher_name = $_POST['teacher_name'];
    $class_name = $_POST['class_name'];
    $section_name = $_POST['section_name'];

    $stmt = $conn->prepare("INSERT INTO students (student_id, last_name, first_name, middle_name, teacher_name, class_name, section_name) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $student_id, $last_name, $first_name, $middle_name, $teacher_name, $class_name, $section_name);

    if ($stmt->execute()) {
        echo "<script>alert('Student added successfully!'); window.history.back();</script>";
    } else {
        echo "<script>alert('Error adding student: " . addslashes($stmt->error) . "'); window.history.back();</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
