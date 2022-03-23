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
    <header> <img src="Group1.png"> </header>

    <div class="lists">

        <?php foreach($lists as $list):
            $id_l = $list['id_l'];
            $tasks = getAll($id_l); ?>
            <div class="onelist">

                <div class="listname" data-id="<?=$list['id_l'];?>">
                    <?=$list['name'];?>
                </div>

                <div class="sortable connectedSortable">
                    <?php foreach($tasks as $task):?>
                            <div class="ui-state-default task">

                                <div data-id="<?=$task['id'];?>">
                                    <div><?=$task['name'];?></div>
                                    <div><a class="detailsbuttons" href="details.php?id=<?=$task['id']; ?>">Details</a></div>
                                </div>
                            </div>
                    <?php endforeach ?>
                </div>

                <a href="addtask1.php?id_l=<?=$id_l; ?>">Add task</a>
                
                <a href="deletelist.php?id_l=<?=$id_l; ?>">Delete list</a>

            </div>

        <?php endforeach ?>

    </div>

    <footer>
        <div class="reordertasksbutton">
            <form action="reorder.php" method="POST">
                <input type="hidden" name="tasks_order">
                <input type="submit" name="reorder" value="Zapisz kolejność" ><img src="saveIcon.png">
            </form>
        </div>

        <a class="addnewlistbutton" href="addlist.php">Dodaj listę <img src="addIcon.png"></a>
    </footer>

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

<!--
.all
{
    background: lightskyblue;
    border: 5px ridge lightgrey;
    border-radius: 7px;
    font: 18px 'Trebuchet MS', sans-serif;
    color:black;
    word-wrap: break-word;
    margin: 4px;
    padding: 4px;
}

a
{
    text-decoration: none;
    color: black;
}

.ui-state-default
{
    border: none;
}

.sortable
{
    min-height: 30px;
}

.ui-state-highlight
{
    background: turquoise;
    height: 30px;
    line-height: 20px;
}

.list
{
    background-color: lightskyblue;
    width: 500px;
    max-height: 800px;
    overflow: auto;
}

.header
{
    width: 473px;
    border-style: none;
    font-weight: bold;
    align-items: center;
}

.cell
{
    border-radius: 0px;
    border-style: none;
    margin: 0px;
    padding: 0px;
}

.task
{
    background-color: white;
    width: 395px;
    min-height: 25px;
    display: inline-block;
}

.task:hover
{
    background-color: lightgray;
}

#addbutton
{
    background-color: white;
    height: 25px;
    margin-right: 22px;
    float: right;
    vertical-align: bottom;
    display: flex;
    justify-content: center;
    align-items: center;
    color: black;
}

#addbutton:hover
{
    background-color: lightsteelblue;
}

#detailsbutton {
    background-color: white;
    height: 25px;
    width: 50px;
    font: 18px 'Trebuchet MS', sans-serif;
    float: right;
    vertical-align: bottom;
    display: flex;
    justify-content: center;
    align-items: center;
}

#detailsbutton:hover
{
    background-color: lightsteelblue;
}

input[type=submit]
{
    background-color: white;
    height: 43px;
    border: 5px ridge lightgrey;
    border-radius: 7px;
    font: 18px 'Trebuchet MS', sans-serif;
    margin: 4px;
    padding: 4px;
    float: right;
    vertical-align: bottom;
    display: flex;
    justify-content: center;
    align-items: center;
}

input[type=submit]:hover
{
    background-color: lightsteelblue;
    cursor: pointer;
}