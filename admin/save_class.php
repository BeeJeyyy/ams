<?php
include 'db_connect.php';

$class_name = $_POST['class_name'];
$teacher_name = $_POST['teacher_name'];

// Check if the class-teacher combination already exists
$check_sql = "SELECT * FROM classes WHERE class_name = ? AND teacher_name = ?";
$stmt = $conn->prepare($check_sql);
$stmt->bind_param("ss", $class_name, $teacher_name);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Already exists
    echo "<script>
        alert('This class is already assigned to the selected teacher.');
        window.history.back();
    </script>";
} else {
    // Insert the new class
    $insert_sql = "INSERT INTO classes (class_name, teacher_name) VALUES (?, ?)";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("ss", $class_name, $teacher_name);

    if ($stmt->execute()) {
        echo "<script>
            alert('Class successfully added!');
            window.location.href = 'dashboard.php';
        </script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

$conn->close();
?>

