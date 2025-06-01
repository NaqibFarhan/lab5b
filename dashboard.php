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

// Handle delete action
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard.php");
    exit();
}

// Fetch all users
$sql = "SELECT id, matric, name, accessLevel FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .container { max-width: 1000px; margin: 0 auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .action-buttons a { margin-right: 5px; padding: 5px 10px; text-decoration: none; color: white; border-radius: 3px; }
        .edit-btn { background-color: #4CAF50; }
        .delete-btn { background-color: #f44336; }
        .logout-btn { background-color: #555; float: right; }
        .welcome { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome">
            <h2>Welcome, <?php echo $_SESSION['name']; ?> (<?php echo $_SESSION['accessLevel']; ?>)</h2>
            <a href="logout.php" class="logout-btn">Logout</a>
            <div style="clear: both;"></div>
        </div>
        
        <h3>User List</h3>
        <table>
            <thead>
                <tr>
                    <th>Matric Number</th>
                    <th>Name</th>
                    <th>Access Level</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['matric']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['accessLevel']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="edit-btn">Edit</a>
                        <a href="dashboard.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        
        <?php if ($_SESSION['accessLevel'] === 'admin'): ?>
        <p><a href="register.php">Add New User</a></p>
        <?php endif; ?>
    </div>
</body>
</html>