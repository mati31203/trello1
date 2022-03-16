<?php

include_once "utils\db.php";

if (!empty($_POST['reorder'])):
    $order = explode(";", $_POST['tasks_order']);
    $id_l = $_POST['listid'];
    reorderTasks($order, $id_l);
endif;

header("Location: index.php");


