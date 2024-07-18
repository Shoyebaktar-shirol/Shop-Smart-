<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="Registration.css">
    <title>Create Account</title>
</head>
<body>
    <div class="container">
        <h1>Create Account</h1>
        <form id="registration-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="fname">First Name:</label>
            <input type="text" placeholder="First Name" id="fname" name="fname" required />
            <label for="lname">Last Name:</label>
            <input type="text" id="lname" placeholder="Last Name" name="lname" required />
            <label for="email">Email:</label>
            <input type="email" id="email" placeholder="abc@gmail.com" name="email" required />
            <label for="password">Create Password:</label>
            <input type="password" id="password" placeholder="Create Password" name="password" required />
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" placeholder="Confirm Password" name="confirmPassword" required />
            <label>Gender:</label>
            <input type="radio" name="gender" id="male" value="male" required />
            <label for="male">Male</label>
            <input type="radio" name="gender" id="female" value="female" required />
            <label for="female">Female</label>
            <br><label for="phone">Phone:</label>
            <input type="tel" id="phone" placeholder="Phone" name="phone" required /><br>
            <label for="address">Address:</label>
            <input type="text" id="address" placeholder="Address" name="address" required />
            <div class="btn-container">
                <button type="submit" class="btn btn-submit">Submit</button>
                <button type="reset" class="btn btn-reset">Reset</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById("registration-form").addEventListener("submit", function (event) {
            var password = document.getElementById("password").value;
            var confirmPassword = document.getElementById("confirmPassword").value;

            if (password !== confirmPassword) {
                event.preventDefault();
                alert("Passwords do not match!");
            }
        });
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "localhost";
        $username = "root"; // default username
        $password = ""; // default password
        $dbname = "registrationshop"; // updated database name

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["email"];
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password
        $gender = $_POST["gender"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];

        $sql = "INSERT INTO users (fname, lname, email, password, gender, phone, address) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssss", $fname, $lname, $email, $password, $gender, $phone, $address);

        if ($stmt->execute()) {
            echo '<script>alert("New record created successfully");</script>';
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
