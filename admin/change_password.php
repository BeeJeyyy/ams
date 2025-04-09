<?php 
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ams";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['admin_id'])) {
    die("Unauthorized access.");
}

if($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['change_password'])) {
    $admin_id = $_SESSION['admin_id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $repeat_password = $_POST['repeat_password'];

    $stmt = $conn->prepare("SELECT password FROM admin WHERE id = ?");
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        
        if (password_verify($current_password, $row['password'])) {
            if ($new_password === $repeat_password) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                
                $update_stmt = $conn->prepare("UPDATE admin SET password = ? WHERE id = ?");
                $update_stmt->bind_param("si", $hashed_password, $admin_id);
                
                if ($update_stmt->execute()) {
                    echo "<script>alert('Password changed successfully!'); window.location='index.php';</script>";
                } else {
                    echo "<script>alert('Error updating password!'); window.location='dashboard.php';</script>";
                }
                
                $update_stmt->close();
            } else {
                echo "<script>alert('New password do not match!'); window.location='dashboard.php';</script>";
            }
        } else {
            echo "<script>alert('Incorrect current password!'); window.location='dashboard.php';</script>";
        }
    }

    $stmt->close();
}

$conn->close();
?>