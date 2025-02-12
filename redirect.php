<?php
require __DIR__.'/vendor/autoload.php';
$client = new Google_Client();
$client->setClientId("94385342710-ngqnojeemp6ouhaf1an5qik53p300lum.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("http://localhost:8000/redirect.php");
if(!isset($_GET["code"])){
         exit("Login failed");
}
$token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
$client->setAccessToken($token["access_token"]);
$oauth = new Google_Service_Oauth2($client);
$user_info = $oauth->userinfo->get();
var_dump(
          $user_info->email,
          $user_info->familyName,
          $user_info->givenName,
          $user_info->name

);
?>