<?php

include_once "utils\db.php";
$lists = getList();

?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Trello_trial</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

<!--
    <?php foreach($lists as $list):
        $id_l = $list['id_l'];
        $tasks = getAll($id_l); ?>
        <div class="all list" data-id="<?=$list['id_l'];?>">
            <div class="all header">
                <?=$list['name'];?>
            </div>
            <div class="sortable connectedSortable">
                <?php foreach($tasks as $task):?>
                    <div class="ui-state-default">
                        <div class="all cell" data-id="<?=$task['id'];?>">
                            <div class="all task"><?=$task['name'];?></div>
                            <div class="all" id="detailsbutton"><a href="details.php?id=<?=$task['id']; ?>">Details</a></div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
            <div class="all" id="addbutton">
                <a href="addtask1.php?id_l=<?=$id_l; ?>">Add task</a>
            </div>
            <div class="all" id="addbutton"><a href="deletelist.php?id_l=<?=$id_l; ?>">Delete list</a></div>
        </div>
    <?php endforeach ?>

    <div>
        <form action="reorder.php" method="POST">
            <input type="text" name="tasks_order">
            <input type="submit" name="reorder" value="Save order">
        </form>
    </div>

    <div class="all" id="detailsbutton"><a href="addlist.php">Add New List</a></div>


-->
csadsadasddas
</div>
    <script>
        $(document).ready(function ()
        {
            $(".sortable").sortable(
            {
                connectWith: ".connectedSortable",
                placeholder: "ui-state-highlight",
                stop: function ()
                {
                    var lists = $('.list'),
                        listsData = [],
                        tasksOrderInput = $('[name=tasks_order]');

                    lists.each(function() {
                        var idList = $(this).data('id'),
                            tasksInList = $(this).find('.cell'),
                            tasksIds = [];

                        tasksInList.each(function() {
                            tasksIds.push($(this).data('id'))
                        });

                        if(tasksIds.length > 0)
                            listsData.push(idList + ':' + tasksIds.join(';'));
                    });

                    tasksOrderInput.val(listsData.join('|'));
                }
            })
        });
    </script>


</body>
</html>


