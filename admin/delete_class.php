<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['class_id'])) {
    $class_id = $_POST['class_id'];
    $sql = "DELETE FROM classes WHERE id = ?";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $class_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Class deleted successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting class.'); window.location.href='dashboard.php';</script>";
    }
    
    $stmt->close();
}
$conn->close();
?>
