<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Visit Jimma</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="signin.css">
    
</head>

<body>
    <div class="signin-container">
        <h1>Sign In</h1>
        <form id="signinForm" action="signin.php" method="POST" onsubmit="return validateForm()">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required placeholder="Email">
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required placeholder="password">
            
            <button type="submit">Sign In</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
    </div>
    
    <?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    
    
    $users = [
        ['email' => 'user@example.com', 'password' => 'password']
    ];
    
    
    $authenticated = false;
    $userExists = false; 

    foreach ($users as $user) {
        if ($user['email'] == $email) {
            $userExists = true; 
            if ($user['password'] == $password) {
                $_SESSION['user'] = $user;
                $authenticated = true; 
            }
            break;
        }
    }
    
    
    if ($authenticated) {
        echo "Sign-in successful! Welcome, " . $email;
    } elseif ($userExists) {
        echo "Invalid password. Please try again.";
    } else {
        echo "Please sign up first.";
    }
}
?>
<script src="new.js"></script>

</body>
</html>