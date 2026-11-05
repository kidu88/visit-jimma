<?php
session_start();

$message = "";
$message_type = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = htmlspecialchars(trim($_POST['email']));
    $password = htmlspecialchars(trim($_POST['password']));

    $users = [
        ['email' => 'user@example.com', 'password' => 'password']
    ];
    
    $authenticated = false;
    $userExists = false; 

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $userExists = true; 
            if ($user['password'] === $password) {
                $_SESSION['user'] = $user;
                $authenticated = true; 
            }
            break;
        }
    }
    
    if ($authenticated) {
        header("Location: index.php");
        exit();
    } elseif ($userExists) {
        $message = "Invalid password. Please try again.";
        $message_type = "error";
    } else {
        $message = "Account not found. Please sign up first.";
        $message_type = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In - Visit Jimma</title>
    <link rel="stylesheet" href="assets/css/signin.css?v=<?php echo time(); ?>">
</head>
<body>

    <?php include 'includes/header.php'; ?>

    <main class="signin-wrapper">
        <div class="signin-container">
            <h2>Welcome <span>Back</span></h2>
            <p class="subtitle">Sign in to your Visit Jimma account</p>

            <?php if (!empty($message)): ?>
                <div class="auth-alert <?php echo $message_type; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <form id="signinForm" action="signin.php" method="POST" onsubmit="return validateForm()">
                <div class="input-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required autocomplete="email">
                </div>
                
                <div class="input-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                </div>
                
                <button type="submit" class="btn-signin">Sign In</button>
            </form>

            <div class="signin-footer">
                <p>Don't have an account? <a href="signup.php">Sign up here</a></p>
            </div>
        </div>
    </main>

    <script src="assets/js/signin.js"></script>
</body>
</html>