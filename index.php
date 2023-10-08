<?php

$todos = [];
if (file_exists("todos.json")) {
    $todos = json_decode(file_get_contents("todos.json"), true);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Todo">
  <title>Todo</title>
  <link rel="shortcut icon" href="./favicon.png" type="image/png">

  <link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="nav">
  <div class="nav__wrap">
    <a class="nav__logo" href="/">🚀 Todo</a>
    <div>
      <span class="nav__user">Guest</span>
      <a class="nav__link" href="#">Register</a>
      <a class="nav__link" href="#">Log In</a>
    </div>
  </div>
</nav>

<header class="header">
  <div class="header__wrap">
    <h1 class="header__title">Todo list</h1>
  </div>
</header>

<main class="main">
  <div class="main__wrap">

    <div class="todo">
      <form action="newtodo.php" method="post">
        <button class="todo_create" type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" width="20px" height="20px" viewBox="0 0 24 24" stroke="currentColor">
					  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
        </button>
        <input type="text" name="todo_name" placeholder="Add a new task" autofocus>
      </form>
    </div>

    <div class="tasks">
     <?php foreach ($todos as $taskId => $todo): ?>
      <div class="task__wrap">
        <form action="change_status.php" method="post">
          <input type="hidden" name="task_id" value="<?=$taskId?>">
          <input type="checkbox" id="<?=$taskId?>" class="hidden" <?=$todo["completed"] ? "checked" : ""?>>
          <label for="<?=$taskId?>" class="task">
            <span class="task__checkbox">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" width="20px" height="20px" fill="currentColor">
                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
              </svg>
            </span>
            <span class="task__content"><?=$todo["content"]?></span>
          </label>
        </form>

        <form action="delete.php" method="post">
            <input type="hidden" name="task_id" value="<?=$taskId?>">
            <button type="submit" class="task__destroy">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="15px" height="15px" fill="currentColor"><path d="M23 20.168l-8.185-8.187 8.185-8.174-2.832-2.807-8.182 8.179-8.176-8.179-2.81 2.81 8.186 8.196-8.186 8.184 2.81 2.81 8.203-8.192 8.18 8.192z"/></svg>
            </button>
          </form>
      </div>
     <?php endforeach?>
    </div>

  </div>
</main>

<script>
  const checkboxes = document.querySelectorAll("input[type=checkbox]");

  checkboxes.forEach(item => {
    item.addEventListener("change", function () {
      this.closest('form').submit();
    });
  });
</script>
</body>
</html>
