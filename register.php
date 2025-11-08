<!DOCTYPE html>
<html>

<head>
    <title>Register Patient | Lagos Health Records</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <?php
    include 'auth.php';
    include 'navbar.php';

    ?>
    <div class="form-container">
        <h2>Patient Registration Form</h2>
        <form method="POST" action="save_patient.php" class="register-form">

            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" placeholder="Enter full name" required>

            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" name="dob" required>

            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="">-- Select Gender --</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>

            <label for="phone">Phone Number</label>
            <input type="text" id="phone" name="phone" placeholder="e.g. 08012345678" pattern="\d{11}" required>

            <label for="address">Address</label>
            <textarea id="address" name="address" placeholder="Enter patient's address" required></textarea>

            <button type="submit">Register</button>
        </form>

        <br>
        <a href="index.php" class="back-link">← Back to Dashboard</a>
    </div>
</body>

</html>