<?php

$todoName = $_POST["todo_name"] ?? "";
$todoName = trim($todoName);

if ($todoName) {
    if (file_exists("todos.json")) {
        $todos = json_decode(file_get_contents("todos.json"), true);
    } else {
        $todos = [];
    }

    $taskId = 1;
    while (isset($todos["task_" . $taskId])) {
        $taskId++;
    }

    $todos["task_" . $taskId] = [
        'content' => $todoName,
        'completed' => false,
    ];

    file_put_contents("todos.json", json_encode($todos, JSON_PRETTY_PRINT));

}

header("Location: index.php");
exit();
