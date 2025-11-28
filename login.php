<!DOCTYPE html>
<html>
<head>
    <title>Login Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>Login Si-Event</h2>
        <form action="auth_proses.php" method="POST">
            <label>NIM:</label>
            <input type="text" name="nim" required>
            
            <label>Password:</label>
            <input type="password" name="password" required>
            
            <button type="submit" name="login">Masuk</button>
        </form>
    </div>
</body>
</html>
