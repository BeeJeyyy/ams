<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_section'])) {
    $section_id = $_POST['section_id'];
    
    // Prepare and execute the delete query
    $stmt = $conn->prepare("DELETE FROM section WHERE id = ?");
    $stmt->bind_param("i", $section_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Section deleted successfully.'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting section.'); window.location.href='dashboard.php';</script>";
    }
    
    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href='dashboard.php';</script>";
} 
?>
