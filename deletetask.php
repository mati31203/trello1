<?php
include "utils\db.php";

getpicture($_GET['id']);
deleteTask($_GET['id']);
changePositions($_GET['position']);
header("Location: index.php");


