<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/signup.css">
    
</head>
<body>
    <h1>Sign Up</h1>
    <form action="signup.php" method="POST" onsubmit="return validateForm()">
        <input type="text" name="firstName" placeholder="First Name" required>
        <input type="text" name="lastName" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        
        
        <input type="number" name="age" placeholder="Age" required>
        <select name="gender" required>
            <option value="">Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <input type="number" name="phone" placeholder="Phone Number" required>
        <input type="password" name="password" placeholder="password" required>
        <div id="errorMessage"></div>
        <input type="submit" value="Sign Up">
        
        
    </form>
    <p>Already have an account? <a href="signin.php">Login here</a></p>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $conn = new mysqli('localhost', 'root', '', 'srs');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email= $_POST['email'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("INSERT INTO signup_users (first_name, last_name , email, age, gender, phone, password) VALUES (?, ?, ?, ?, ?,?,?)");
        $stmt->bind_param("ssissss", $firstName, $lastName,$email, $age, $gender, $phone,$password);
        

        if ($stmt->execute()) {
            echo "<p>Sign Up Successful!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        
        $stmt->close();
        $conn->close();
    }
    ?>
    <script src="new2.js"></script>
</body>
</html>