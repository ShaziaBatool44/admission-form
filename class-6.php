<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Admission Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f9;
        }
        .form-background {
            background-color: #ffffff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        form input[type="text"], form input[type="number"], form input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        form input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        form input[type="submit"]:hover {
            background-color: #4cae4c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="form-background">
        <h1>Admission Form</h1>
        <form action="" method="post">
            <label for="firstname">First Name:</label>
            <input type="text" name="firstname" id="firstname" placeholder="Enter your name">

            <label for="lastname">Last Name:</label>
            <input type="text" name="lastname" id="lastname" placeholder="Enter Last name">

            <label for="birthday">Date Of Birth:</label>
            <input type="date" name="birthday" id="birthday">

            <label for="address">Address:</label>
            <input type="text" name="address" id="address" placeholder="Enter your address">

            <label for="phone">Mobile Number:</label>
            <input type="number" name="phone" id="phone" placeholder="Enter your mobile number">

            <label for="email">Email:</label>
            <input type="text" name="email" id="email" placeholder="Enter your email">

            <input type="submit" value="Submit" id="submit">
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Sanitize and validate inputs
        $firstname = filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
        $lastname = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
        $birthday = filter_var($_POST['birthday'], FILTER_SANITIZE_STRING);
        $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
        $phone = filter_var($_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

        $errors = [];

        if (empty($firstname)) {
            $errors[] = "First Name is required.";
        }
        if (empty($lastname)) {
            $errors[] = "Last Name is required.";
        }
        if (empty($birthday)) {
            $errors[] = "Date of Birth is required.";
        }
        if (empty($address)) {
            $errors[] = "Address is required.";
        }
        if (empty($phone) || !preg_match('/^[0-9]{11}$/', $phone)) {
            $errors[] = "Valid Mobile Number is required (11 digits).";
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Valid Email is required.";
        }

        if (empty($errors)) {
            echo "<table>";
            echo "<tr><th>Field</th><th>Value</th></tr>";
            echo "<tr><td>First Name</td><td>" . htmlspecialchars($firstname) . "</td></tr>";
            echo "<tr><td>Last Name</td><td>" . htmlspecialchars($lastname) . "</td></tr>";
            echo "<tr><td>Date of Birth</td><td>" . htmlspecialchars($birthday) . "</td></tr>";
            echo "<tr><td>Address</td><td>" . htmlspecialchars($address) . "</td></tr>";
            echo "<tr><td>Mobile Number</td><td>" . htmlspecialchars($phone) . "</td></tr>";
            echo "<tr><td>Email</td><td>" . htmlspecialchars($email) . "</td></tr>";
            echo "</table>";
        } else {
            foreach ($errors as $error) {
                echo "<p style='color: red;'>$error</p>";
            }
        }
    }
    ?>
</body>
</html>
