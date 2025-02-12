<?php
$token = $_POST["token"];
$token_hash = hash("sha256",$token);
$mysqli = require __DIR__ . "/database.php";
$sql = "SELECT email FROM password_reset WHERE token_hash = ?";
$stmt = $mysqli -> prepare($sql);
$stmt -> bind_param("s",$token_hash);
$stmt -> execute();
$result = $stmt -> get_result();
$user = $result -> fetch_assoc();
if(!$user){
          die("Invalid token");
}
strtotime($user["reset_token_expires_at"]) <= time()){
          die("Token expired");
}
if(strlen($_POST["password"])<8){
          die("Password must be at least 8 characters");
}
if(!preg_match("/[a-z]/i",$_POST["password"])){
          die("Password must contain at least one letter");
}
if(!preg_match("/[0-9]/",$_POST["password"])){
          die("Password must contain at least one number");
}
if($_POST["password"]!== $_POST["password_confirmation"]){
          die("Passwords must match");
}
$password_hash = password_hash($_POST["password"],PASSWORD_DEFAULT);
$sql = "UPDATE user SET password_hash = ?,reset_token = NULL,reset_token_expires_at = NULL WHERE id = ?";
$stmt = $mysqli -> prepare($sql);
$stmt = bind_param("ss",$password_hash,$user["id"]);
$stmt -> execute();
echo "Password updated.You can now login";
<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
          <title>Reset Password</title>
</head>
<body>
          <h1>Reset Password</h1>
          <form action="process-reset-password.php" method="post">
                    <input type="hidden" name="token" value="<?=htmlspecialchars($token)?>">
                    <label for="password">New password</label>
                    <input type="password" name="password" id="password">
                    <label for="password_confirmation">Repeat password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation">
                    <button>Send</button>
                    </form>
</body>
</html>