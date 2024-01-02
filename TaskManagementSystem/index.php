<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewpoint" content="width=device-width, initial-scale=1">
    <title>E-Task</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
    <script src="bootstrap/scripts/bootstrap.min.js"></script>
    <script></script>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<h1>Login</h1>
<form action="auth.php" method="post">
    <label for="username">Username:</label>
    <input type="text" name="username" required>
    <br>
    <label for="password">Password:</label>
    <input type="password" name="password" required>
    <br>
    <input type="submit" value="Login">
</form>
</body>
</html>