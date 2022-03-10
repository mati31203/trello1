<?php

include_once "utils\db.php";

if (!empty($_POST['reorder'])):
    $array1 = explode(";", $_POST['tasks_order']);
    reorderTasks($array1);
    header("Location: index.php");  
endif; 
