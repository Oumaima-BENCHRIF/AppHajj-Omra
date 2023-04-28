<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Hello worde !!</h1>
<?php
$conn = new PDO('mysql:host=localhost;dbname=compulog_hajjomra_portal','compulog_userhaj','K;qKKxpMFdlm');
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// Check connection
if (!$conn) {
  die("Connection failed: " );
}
 $aray = $conn->query("SELECT * FROM  accompagnateurs ");
dd($aray);

?>
</body>
</html>