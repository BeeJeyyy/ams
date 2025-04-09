<?php
$host = "localhost";
$user = "root";
$pass = ""; // XAMPP default
$db = "ams";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $role = $_POST["role"];

    if (!empty($email) && !empty($password) && !empty($role)) {
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        $result = null;
        $sql = "";

        // Handle different roles
        if ($role === "super_user") {
            $sql = "SELECT * FROM super_user WHERE email = '$email' AND password = '$password'";
        } elseif ($role === "admin") {
            $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
        } elseif ($role === "teacher") {
            $sql = "SELECT * FROM teacher WHERE email = '$email' AND password = '$password'";
        }

        if ($sql != "") {
            $result = $conn->query($sql);
        }

        if ($result && $result->num_rows > 0) {
            // Redirect based on the role
            if ($role === "super_user") {
                header("Location: dashboard.php");
            } elseif ($role === "admin") {
                header("Location: admin/dashboard.php");
            } elseif ($role === "teacher") {
                header("Location: teacher/dashboard.php");
            }
            exit();
        } else {
            echo "<script>alert('Invalid credentials.');</script>";
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.0/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="index.css">
</head>
<body>

<form action="index.php" method="POST">
<div class="container">
  <div class="box">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" required>
  </div>
  <div class="select">
  <label for="options">--Select Role--</label>
  <br>
  <select name="role" id="options">
  <option value="super_user">Super User</option>
  <option value="admin">Administrators</option>
  <option value="teacher">Teacher</option>
  </select>
  </div>
  <button type="submit" name="submit" class="btn btn-primary">Login</button>
</div>
</div>
</form>


</body>
</html>