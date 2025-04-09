<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/@coreui/coreui@5.3.1/dist/css/coreui.min.css" rel="stylesheet" integrity="sha384-PDUiPu3vDllMfrUHnurV430Qg8chPZTNhY8RUpq89lq22R3PzypXQifBpcpE1eoB" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/dashboard.css">
    <script src="js/dashboard.js"></script>
    <script src="js/student.js"></script>
    <title>Dashboard</title>
</head>


<div class="container">
    <div class="sidebar border-end">
        <div class="sidebar-header border-bottom">
          <div class="sidebar-brand">Admin</div>
          <img src="../img/user_logo.png" alt="no picture">
        </div>
        <ul class="sidebar-nav">
          <!--dashboard-->
        <li class="nav-title">DASHBOARD</li>
        <li class="nav-item"></li>
        <!--dashboard-->
        <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('dashboard_section')">
              <i class="nav-icon cil-speedometer"></i>Dashboard
            </a>
          </li>
          <hr>
            <!--manage teacher-->
          <li class="nav-title">MANAGE TEACHER</li>
          <li class="nav-item">
          </li>
          <!--add teacher-->
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('add_teacher_section')">
              <i class="nav-icon cil-speedometer"></i>Add Teacher
            </a>
          </li>
          <!--teacher list-->
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('teacher_list_section')">
              <i class="nav-icon cil-speedometer"></i>Teacher List
            </a>
          </li>
          <hr>
          <!--manage class-->
          <li class="nav-title">MANAGE CLASS</li>
          <li class="nav-item">
          </li>
          <!--add class-->
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('add_class_section')">
              <i class="nav-icon cil-speedometer"></i>Add Class
            </a>
          </li>
          <!--class list-->
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('class_list_section')">
              <i class="nav-icon cil-speedometer"></i>Class List
            </a>
          </li>
          <hr>
          <!--manage section-->
          <li class="nav-title">MANAGE SECTION</li>
          <li class="nav-item">
          </li>
          <!--add section-->
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('add_section_section')">
              <i class="nav-icon cil-speedometer"></i>Add Section
            </a>
          </li>
          <!--section list-->
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('section_list_section')">
              <i class="nav-icon cil-speedometer"></i>Section List
            </a>
          </li>
          <hr>
          <!--manage student-->
          <li class="nav-title">MANAGE STUDENT</li>
          <li class="nav-item">
          </li>
          <!--Add student-->
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('add_student_section')">
              <i class="nav-icon cil-speedometer"></i>Add Student
            </a>
          </li>
          <!--student list-->
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('student_list_section')">
              <i class="nav-icon cil-speedometer"></i>Student List
            </a>
          </li>
          <hr>
          <!--manage schedule-->
          <li class="nav-title">MANAGE SCHEDULE</li>
          <li class="nav-item">
          </li>
          <!--schedule-->
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('schedules_section')">
              <i class="nav-icon cil-speedometer"></i>Schedules 
            </a>
          </li>
          <hr>
          <!--Settings-->
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="showSection('settings_section')">
              <i class="nav-icon cil-speedometer"></i>Settings 
            </a>
          </li>
        </ul>
        <div class="sidebar-footer border-top d-flex">
          <a href="../logout.php" class="btn btn-primary">Logout</a>
        </div>
    </div>

      <!--dashboard-->
      <div class="content">
        <section id="dashboard_section">
          <h2>Dashboard</h2>
          <p>Welcome to the Attendace Monitoring System.</p>
        </section>
      </div>
      <!--add teacher-->
        <div class="content">
        <div id="add_teacher_section" class="center-content" style="display:none;">
          <form method="POST" action="save_teacher.php">
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
  </div>

        <!--teacher list-->
        <section id="teacher_list_section" style="display: none;">
          <h2>Teacher List</h2>
          <table class="table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="teacher_list">
              <?php
              include 'db_connect.php';
              $sql = "SELECT id, name, email, contact FROM teacher";
              $result = $conn->query($sql);

              if ($result) {
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo "<tr>
                          <td>{$row['name']}</td>
                          <td>{$row['email']}</td>
                          <td>{$row['contact']}</td>
                          <td>
                              <form method='POST' action='delete_teacher.php' onsubmit='return confirm(\"Are your sure you want to delete this teacher?\");'>
                              <input type='hidden' name='teacher_id' value='{$row['id']}'>
                              <button type='submit' class='btn btn-danger'>Delete</button>
                              </form>
                        </tr>";
                }
              } else {
                echo "<tr><td colspan='4'>No teachers added yet.</td></tr>";
              }
            } else {
              echo "<tr><td colspan='4'>Error: " . $conn->error . "</td></tr>";
            }
              ?>
            </tbody>
          </table>
        </section>

        <!--add class-->
        <section id="add_class_section" style="display: none;">
          <h2>Add Class</h2>
          <form method="POST" action="save_class.php">
            <div class="mb-3">
              <label for="class_name" class="form-label">Class Name:</label>
              <input type="text" class="form-control" id="class_name" 
              name="class_name" placeholder="Enter Class Name" required>
            </div>
            <div class="mb-3">
              <label for="teacher" class="form-label">Assign Teacher:</label>
              <select class="form-control" id="teacher" name="teacher_name" required>
                <option value="">Select Teacher</option>
                <?php
                include 'db_connect.php';
                $sql = "SELECT name FROM teacher";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='{$row['name']}'>{$row['name']}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Save Class</button>
    </form>
</section>

            <!--class list-->
            <section id="class_list_section" style="display:none;">
              <h2>Class List</h2>
              <table class="table">
                <thead>
                  <tr>
                    <th>Class Name</th>
                    <th>Assigned Teacher</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  include 'db_connect.php';
                  $sql = "SELECT * FROM classes";
                  $result = $conn->query($sql);

                  if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>{$row['class_name']}</td>";
                      echo "<td>{$row['teacher_name']}</td>";
                      echo "<td>
                              <form method='POST' action='delete_class.php' style=display:inline;'>
                              <input type='hidden' name='class_id' value='{$row['id']}'>
                              <button type='submit' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this class?\")'>Delete</button>
                              </form>
                            </td>";
                      echo "</tr>";
                    }
                  } else {
                    echo "<tr><td colspan='3'>No classes added yet.</td></tr>";
                  }
                  ?>
                </tbody>
              </table>
            </section>

                <!-- add_section_section -->
                <section id="add_section_section" style="display: none;">
  <h2>Add Section</h2>
  <?php
  include 'db_connect.php';
  $sql = "SELECT * FROM class"; // Assuming your save_class.php saves to a 'class' table
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
          echo "<div class='card mb-3'>";
          echo "<div class='card-body'>";
          echo "<h5 class='card-title'>Class: {$row['class_name']}</h5>";
          echo "<p class='card-text'>Teacher: {$row['teacher_name']}</p>";
          echo "<form method='POST' action='save_section.php'>";
          echo "<input type='hidden' name='class_id' value='{$row['id']}'>";
          echo "<div class='mb-2'><input type='text' name='section_name' class='form-control' placeholder='Enter Section Name' required></div>";
          echo "<div class='mb-2'><input type='text' name='subject' class='form-control' placeholder='Enter Subject' required></div>";
          echo "<button type='submit' class='btn btn-success'>Add Section</button>";
          echo "</form>";
          echo "</div></div>";
      }
  } else {
      echo "<p>No classes available. Please add a class first.</p>";
  }
  ?>
</section>

            


                  <!--settings-->
                  <div id="settings_section" style="display:none;">
                    <h3>Change Password</h3>
                    <form action="change_password.php" method="POST">
                      <div>
                        <label for="current_password">Current Password:</label>
                        <input type="password" name="current_password" required>              
                      </div>
                      <div>
                        <label for="new_passowrd">New Passowrd:</label>
                        <input type="password" name="new_password" required>
                      </div>
                      <div>
                        <label for="repeat_password">Repeat Password:</label>
                        <input type="password" name="repeat_password" required>
                      </div>
                      <button type="submit" name="change_password">Change Password</button>
                    </form>
                  </div>




</body>
</html>