<?php
include 'db_connect.php'; // Your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_id'])) {
  $student_id = $conn->real_escape_string($_POST['student_id']);
  $deleteSQL = "DELETE FROM students WHERE student_id = '$student_id'";
  
  if ($conn->query($deleteSQL)) {
    header("Location: dashboard.php ");
    exit();
  } else {
    echo "Error deleting student: " . $conn->error;
  }
} else {
  echo "Invalid request.";
}
?>
