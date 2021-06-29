<?php
include_once __DIR__ . '/includes/util.php';
include_once __DIR__ . '/includes/Task.php';
$tasks = \DataHandle\Task::selectData();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TODO</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
    <!--  CSS -->
    <link rel="stylesheet" href="./styles/styles.css" />
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/402cc49e6e.js" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <h1>TODO LIST</h1>

        <?php
        if (isset($_GET['edit'])) :  ?>
            <form action="./includes/modifica-todo.php" method="POST">
                <?php echo \DataHandle\Utils\get_editable_tasks($tasks); ?>
            </form>
        <?php else : ?>





            <form action="./includes/inserisci-todo.php" method="POST">

                <div class="row">
                    <div class="col">
                        <input type="text" name="task" id="task" class="form-control" autocomplete="off" required>
                    </div>
                    <div class="col">
                        <input type="submit" value="Add task" class="btn btn-dark">
                    </div>
                </div>
            </form>


            <?php if(count($tasks)>0):
             echo \DataHandle\Utils\get_tasks($tasks);
            else: ?>
            <div class="task-box no-task">There are no tasks yet!</div>

        <?php endif;
        endif;?>

        </div>
    </main>
</body>

</html>