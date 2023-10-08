<?php

$todos = json_decode(file_get_contents("todos.json"), true);
$task = $_POST["task_id"];

if ($task) {
    unset($todos[$task]);

    file_put_contents("todos.json", json_encode($todos, JSON_PRETTY_PRINT));
}

header("Location: index.php");
exit();
