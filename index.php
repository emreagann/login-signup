<?php
session_start();
require __DIR__.'/vendor/autoload.php';
$client = new Google_Client();
$client->setClientId("94385342710-ngqnojeemp6ouhaf1an5qik53p300lum.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost:8000/redirect.php");
$client->addScope("email");
$client->addScope("profile");
$url = $client->createAuthUrl();
if(isset($_SESSION["user_id"])){
          $mysqli = require __DIR__ . "/database.php";
          $sql = "SELECT * FROM user WHERE id = {$_SESSION["user_id"]}";
          $result = $mysqli -> query($sql);
          $user = $result -> fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
          <title>Home</title>
</head>
<body>
          <h1>Home</h1>
          <?php if (isset($user)): ?>
                    <p>Hello <?= htmlspecialchars($user["name"])?></p>
                    <p><a href="logout.php">Log out</a></p>
          <?php else: ?>
                    <p><a href="login.php">Log in</a> or <a href="signup.html">Sign up</a></p>
          <?php endif;?>
          <a href="<?=$url?>">Sign in with Google</a>
</body>
</html>