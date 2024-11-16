<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="art.css">
    <title>Login Form</title>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form action="loading.php" method="post"> <!-- Direct action to loading.php -->
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn blue">Login</button> <!-- Submit button to login -->
            <button type="button" class="btn red">Connect with Google</button>
            <a href="registre.php" style="color:white; margin-right:30px;">Create account</a>
        </form>
    </div>
</body>
</html>
