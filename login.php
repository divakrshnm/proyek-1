<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
<form action="proses.php" method="post">
<input type="hidden" name="proses" value="login">
Username <input type="text" name="username">
Password <input type="password" name="password">
<input type="submit" value="Login">
</form>
</div>
</body>
</html>