<?php include "service/db.php";
if (isset($_POST['add_task'])) {
  $task_name = $_POST['task_name'];
  $sql = "INSERT INTO tasks (task_name,task_status,created_at) VALUES ('$task_name','PENDING',now())"; #Eksekusi Queri
  $db->query($sql);

  header("Location: index.php");
  exit();
}


if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $sql = "UPDATE tasks SET task_status='DONE' WHERE id='$id'";
  $db->query($sql);
  header("Location: index.php");
  exit();
}

if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $sql = "DELETE FROM tasks WHERE id='$id'";
  $db->query($sql);
  header("Location: index.php");
  exit();
}


if (isset($_GET['deleteAll'])) {
  $sql = "TRUNCATE TABLE tasks";
  $db->query($sql);
  header("Location: index.php");
  exit();
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <!-- <h1>Hello, world!</h1> -->
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h4 class="text-center">
          TO-DO-LIST
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="card ">
          <div class="card-header">
            Form add list
          </div>
          <div class="card-body">
            <form action="index.php" method="POST">
              <div class="form-group d-grid row-gap-1">
                <input type="text" class="form-control" name="task_name" placeholder="input your task">
                <button type="submit" class="btn btn-primary" name="add_task">ADD</button>
              </div>
            </form>
          </div>
          <div class="card-footer">
            List task
          </div>
        </div>
        <ul class="list-group">
          <?php
          $query = mysqli_query($db, "SELECT * FROM tasks WHERE task_status='PENDING'");
          $tasks = mysqli_fetch_all($query, MYSQLI_ASSOC);
          foreach ($tasks as $row) {
            $id = $row['id'];
            $task_name = $row['task_name'];
            ?>
            <li class="list-group-item">
              <?= $task_name ?>
              <div class="float-end">
                <a href="index.php?edit=<?= $id ?>" class="btn btn-outline-success"><svg
                    xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                    <path
                      d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                  </svg>
                </a>
                <a href="index.php?delete=<?= $id ?>" class="btn btn-outline-danger">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-trash3-fill" viewBox="0 0 16 16">
                    <path
                      d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5" />
                  </svg>
                </a>
              </div>
            <?php } ?>
          </li>
        </ul>
      </div>
      <div class="col-md-6">
        <div class="card ">
          <div class="card-header">
            Task completed form
          </div>
          <div class="card-body">
            <ul class="list-group">
              <?php
              $query = mysqli_query($db, "SELECT * FROM tasks WHERE task_status='DONE'");
              $tasks = mysqli_fetch_all($query, MYSQLI_ASSOC);
              foreach ($tasks as $row) {
                $id = $row['id'];
                $task_name = $row['task_name'];
                ?>
                <li class="list-group-item"><?= $task_name ?> <span class="btn btn-success disabled float-end">Done
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-check2-circle" viewBox="0 0 16 16">
                      <path
                        d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0" />
                      <path
                        d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                    </svg>
                    <span />
                </li>
              <?php } ?>

              <li class="list-group-item">
                <a href="index.php?deleteAll=<? ?>" class="btn btn-danger float-end">DELETE ALL<a />
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>