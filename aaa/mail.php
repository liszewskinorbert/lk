`<?php
/**
 * Created by IntelliJ IDEA.
 * User: jaszczomp
 * Date: 2019.04.07
 * Time: 16:28
 */
// dopinam bibliotekę SwiftMailer - pobraną z GitHub
// https://github.com/swiftmailer/swiftmailer
// pobieramy przez
// git clone https://github.com/swiftmailer/swiftmailer.git swiftmailer
require 'swiftmailer/lib/swift_required.php';
// tu twój kod php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP wysyła maile przez SMTP</title>
</head>
<body>
<form action="">
    <input type="text" name="topic" id=""><br>
    <input type="text" name="recipient" id=""><br>
    <textarea name="message" id="" cols="30" rows="10"></textarea>
    <input type="submit" name="sendMessage" id="" value="Wyślij">
</form>
</body>
</html>
