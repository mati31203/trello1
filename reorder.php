<?php

include_once "utils\db.php";

if (!empty($_POST['reorder'])):
    $order = explode(";", $_POST['tasks_order']);
    reorderTasks($order);
endif;

header("Location: index.php");


