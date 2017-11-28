<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API 
 */
$clientId = '676124198523-iiq5kq7iicsvmk1etpu2ltqacqppv8v0.apps.googleusercontent.com';
$clientSecret = 'SXG8mEFllfORY1HmLWptRbqL';
$redirectURL = 'http://localhost/MyFirstPHP/';

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('Login to solvemydoubt.com');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>