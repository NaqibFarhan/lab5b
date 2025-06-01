<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'Lab_5b');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user data
$id = $_GET['id'];
$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $accessLevel = $_POST['accessLevel'];
    
    // Check if password is being updated
    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sql = "UPDATE users SET matric = ?, name = ?, email = ?, password = ?, accessLevel = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $matric, $name, $email, $password, $accessLevel, $id);
    } else {
        $sql = "UPDATE users SET matric = ?, name = ?, email = ?, accessLevel = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $matric, $name, $email, $accessLevel, $id);
    }
    
    if ($stmt->execute()) {
        $success = "User updated successfully!";
        // Refresh user data
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
    } else {
        $error = "Error updating user: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 500px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        button { padding: 10px 15px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
        .error { color: red; }
        .success { color: green; }
        .back-btn { display: inline-block; margin-top: 10px; padding: 8px 15px; background-color: #555; color: white; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit User</h2>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        <?php if (isset($success)) echo "<p class='success'>$success</p>"; ?>
        
        <form method="post" action="">
            <div class="form-group">
                <label for="matric">Matric Number:</label>
                <input type="text" id="matric" name="matric" value="<?php echo htmlspecialchars($user['matric']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            
            <div class="form-group">
                <label for="password">New Password (leave blank to keep current):</label>
                <input type="password" id="password" name="password">
            </div>
            
            <div class="form-group">
                <label for="accessLevel">Role:</label>
                <select id="accessLevel" name="accessLevel" required>
                    <option value="lecturer" <?php echo ($user['accessLevel'] == 'lecturer') ? 'selected' : ''; ?>>Lecturer</option>
                    <option value="student" <?php echo ($user['accessLevel'] == 'student') ? 'selected' : ''; ?>>Student</option>
                </select>
            </div>
            
            <button type="submit">Update User</button>
            <a href="dashboard.php" class="back-btn">Back to Dashboard</a>
        </form>
    </div>
</body>
</html>