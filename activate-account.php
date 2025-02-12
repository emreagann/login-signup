<?php
$token = $_GET["token"];
$token_hash = hash("sha256",$token);
$mysqli = require __DIR__ . "/database.php";
$sql = "SELECT email FROM password_reset WHERE activation_token_hash = ?";
$stmt = $mysqli -> prepare($sql);
$stmt -> bind_param("s",$activation_token_hash);
$stmt -> execute();
$result = $stmt -> get_result();
$user = $result -> fetch_assoc();
if(!$user){
          die("Invalid token");
}
$sql = "UPDATE user SET account_activation_hash = NULL
WHERE id = ?";
$stmt = $mysqli -> prepare($sql);
$stmt -> bind_param("i",$user["id"]);
$stmt -> execute();
?>
<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
          <title>Account Activated</title>
</head>
<body>
          <h1>Account Activated</h1>
          <p>Account activated successfully.You can now
          <a href="login.html">log in</a>.
          </p>
</body>
</html>