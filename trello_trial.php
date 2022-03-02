<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trello_trial";

try 
{
    $dbh = new PDO('mysql:host=localhost;dbname=trello_trial', $username, $password);
    echo "Connected\n";
} 
catch (Exception $e) 
{
    die("Unable to connect: " . $e->getMessage());
}
  
try 
{  
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  
    $dbh->beginTransaction();
    $name = !empty($_POST['Task']) ? htmlspecialchars(stripslashes(trim($_POST['name']))) : false;
    $picture = !empty($_POST['Picture']) ? htmlspecialchars(stripslashes(trim($_POST['picture']))) : false;
    $description = !empty($_POST['Description']) ? htmlspecialchars(stripslashes(trim($_POST['description']))) : false;
    $dbh->exec("insert into tasks (Name, Picture, Description) values ($name, $picture, $description)");
    $dbh->commit();
    
} 
catch (Exception $e) 
{
    $dbh->rollBack();
    echo "Failed: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trello_trial</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Trello_trial</h2>
<form method="post" id="contact-form">

    <div><label for="name">Task: </label></div>
    <div><input type="text" name="Task" id="Task" class="formField"></div>

    <div><label for="email">Picture: </label></div>
    <div><input type="text" name="Picture" id="Picture" class="formField"></div>

    <div><label for="phone">Description: </label></div>
    <div><input type="text" name="Description" id="Description" class="formField"></div>

    <div><button id="sendBtn" name="sendBtn">Add</button></div>

</form>

</body>
</html>
