<?php
include 'db_connect.php'; // Ensure your database connection is included

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['admin_id'])) {
    $admin_id = intval($_POST['admin_id']);

    // Delete admin from the database
    $query = "DELETE FROM admin WHERE id = ?";
    $stmt = $conn->prepare($query);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("i", $admin_id);

    if ($stmt->execute()) {
        echo "<script>alert('Admin deleted successfully!'); window.location.href='dashboard.php';</script>";
    } else {
        echo "<script>alert('Error deleting admin.'); window.location.href='dashboard.php';</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "<script>alert('Invalid request.'); window.location.href='dashboard.php.php';</script>";
}
?>
