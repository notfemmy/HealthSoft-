<?php
include 'auth.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$conn = new mysqli("localhost", "root", "", "health_db");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';


$limit = 10; 
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM patients";
$count_sql = "SELECT COUNT(*) as total FROM patients";

if (!empty($search)) {
    $sql .= " WHERE full_name LIKE '%$search%' OR phone LIKE '%$search%'";
    $count_sql .= " WHERE full_name LIKE '%$search%' OR phone LIKE '%$search%'";
}

$sql .= " ORDER BY id ASC LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);
if (!$result) {
    die("Query Error: " . $conn->error);
}

$count_result = $conn->query($count_sql);
$total_rows = $count_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $limit);
?>
<!DOCTYPE html>
<html>

<head>
    <title>All Patients</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/view_patients.css">
</head>

<body>
    <?php include 'navbar.php'; ?>
    <h2>Registered Patients</h2>

    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by name or phone number"
            value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit">Search</button>
    </form>
    <br>

    <table>
        <tr>
            <th>ID</th>
            <th>Full name</th>
            <th>DOB</th>
            <th>Gender</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Date Registered</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row['id'] . "</td>
                        <td><a href='patient_history.php?id=" . $row['id'] . "'>" . htmlspecialchars($row['full_name']) . "</a></td>
                        <td>" . htmlspecialchars($row['dob']) . "</td>
                        <td>" . htmlspecialchars($row['gender']) . "</td>
                        <td>" . htmlspecialchars($row['phone']) . "</td>
                        <td>" . htmlspecialchars($row['address']) . "</td>
                        <td>" . htmlspecialchars($row['date_registered']) . "</td>
                        <td><a href='edit_patient.php?id=" . $row['id'] . "'>Edit</a></td>
                        <td><a href='delete_patient.php?id=" . $row['id'] . "' onclick=\"return confirm('Are you sure you want to delete this patient?');\">Delete</a></td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No patients found</td></tr>";
        }
        ?>
    </table>

    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">&laquo; Prev</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"
                class="<?= $i == $page ? 'active-page' : '' ?>">
                <?= $i ?>
            </a>
        <?php endfor; ?>

        <?php if ($page < $total_pages): ?>
            <a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>

</body>

</html>
<?php $conn->close(); ?>