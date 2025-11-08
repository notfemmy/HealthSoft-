<?php
include 'auth.php';

if ($_SESSION['role'] !== 'admin') {
    echo "Access Denied. Only admins can view this page.";
    exit;
}

$conn = new mysqli("localhost", "root", "", "health_db");

$result = $conn->query("SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View All Users</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
        }
        th, td {
            padding: 8px;
            border: 1px solid #333;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Registered Users</h2>
    <link rel="stylesheet" href="css/global.css">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['full_name'] ?? 'N/A' ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= ucfirst($row['role']) ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>
    <a href="index.php">← Back to Dashboard</a>
</body>
</html>
