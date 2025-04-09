<?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "ams"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add_admin'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $contact = $_POST['contact'];

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $check_sql = "SELECT * FROM admin WHERE email = ? OR name = ? OR contact = ? OR password = ?";
  $check_stmt = $conn->prepare($check_sql);
  $check_stmt->bind_param("ssss", $email, $name, $contact, $hashed_password);
  $check_stmt->execute();
  $result = $check_stmt->get_result();

  if ($result->num_rows > 0) {
    echo "<script>alert('An admin with this email, name, contact, or password already exist!');</script>";
  } else {
    $insert_sql = "INSERT INTO admin (name, email, password, contact) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ssss", $name, $email, $hashed_password, $contact);
    if ($insert_stmt->execute()) {
      echo "<script>alert('Admin added successfully');</script";
    } else {
      echo "<script>alert('Error adding admin');</script>";
    }
  }
}

// Fetch admin list
$admin = $conn->query("SELECT id, name, email, contact FROM admin");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-PDUiPu3vDllMfrUHnurV430Qg8chPZTNhY8RUpq89lq22R3PzypXQifBpcpE1eoB" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="dashboard.css">
<body>

    <div class="sidebar border-end">
        <div class="sidebar-header border-bottom">
          <div class="sidebar-brand">SuperUser</div>
          <img src="img/user_logo.png" alt="no picture">
        </div>
        <!--dashboard-->
        <ul class="sidebar-nav">
          <li class="nav-title">Dashboard</li>
          <li class="nav-item">
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('dashboard_section')">
              <i class="nav-icon cil-speedometer"></i>Dashboard
            </a>
          </li>
        <!--manage admin-->
        <ul class="sidebar-nav">
          <li class="nav-title">MANAGE ADMIN</li>
          <li class="nav-item">
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('add_admin_section')">
              <i class="nav-icon cil-speedometer"></i>Add Admin
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('admin_list_section')">
              <i class="nav-icon cil-speedometer"></i>Admin List
            </a>
          </li>

        </ul>
        <div class="sidebar-footer border-top d-flex">
          <a href="logout.php" class="btn btn-primary">Logout</a>
        </div>
      </div>
      <!--main content-->
      <div class="content">
        <div id="dashboard_section">
          <h2>Welcome to the Super-User Dashboard</h2>
        </div>

        <!--add admin-->
        <div id="add_admin_section" class="center-content" style="display:none;">
          <form method="POST" action="add_admin.php" enctype="multipart/form-data">
            <div class="form-row">
              <div class="form-group col-md-6">
                <label for="inputText">Name:</label>
                <input type="text" class="form-control" id="inputText" name="name" placeholder="Enter Name" required>
              </div>
              <div class="form-group col-md-6">
                <label for="inputText">Contact #:</label>
                <input type="tel" class="form-control" id="inputtext" name="contact" placeholder="Enter Contact #" required>
              </div>
            </div>
            <div class="form-group">
              <label for="inputEmail">Email:</label>
              <input type="text" class="form-control" id="inputEmail" name="email" placeholder="Enter Email" required>
            </div>
            <div class="form-group">
              <label for="inputPassword">Password:</label>
              <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Enter Password" required>
            </div>
            <div class="form-row">
            </div>
            <div class="form-group">
            </div>
            <button type="submit" class="btn btn-primary">Add admin</button>
          </form>
        </div>

        <!--admin list-->
        <div id="admin_list_section" class="center-content" style="display:none;">
          <h2>Admin List</h2>
          <table class="table">
            <thead>
              <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact #</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $count = 1; 
              while ($row = $admin->fetch_assoc()) { ?>
              <tr>
                <th scope="row"><?php echo $count++; ?></th>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['contact']); ?></td>
                <td>
                  <form action="delete_admin.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this admin?');">
                    <input type="hidden" name="admin_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                  </form>
                </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>

    <!--Footer-->
    <footer class="footer">
        <div>
          <span>&copy; 2025 HelloTech. All Rights Reserved.</span>
        </div>
      </footer>

      <script src="dashboard.js"></script>
</body>
</html>