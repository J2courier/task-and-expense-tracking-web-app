<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../home/index.css?v=1.0.1">
    <link rel="stylesheet" href="../home/task.css?v=1.0.1">
    <title>Expense</title>
</head>
<body>
<nav>
    <ul>
        <li><a href="../home/dashboard.php"><img src="../img/logo1.png" alt="img" class="logo"></a></li>
        <li><a href="../home/dashboard.php"><img src="../img/home.png" alt="img" class="icon"></a></li>
        <li><a href="../home/task.php"><img src="../img/task.png" alt="img" class="icon"></a></li>
        <li><a href="../home/expenses.php"><img src="../img/expense.png" alt="img" class="icon"></a></li>
        <li><a href="../home/settings.php"><img src="../img/settings.png" alt="img" class="icon"></a></li>
    </ul>
</nav>
<section class="main-section">

    <div class="task-list-container">

        <div class="task-list-head">
            <p>EXPENSE LIST</p>
            <img src="../img/add.png" alt="img" class="add-item-img">
        </div>

        <div class="item-list-container">
            <ul>
                <li></li>
            </ul>
        </div>
    </div>

    <form action="task.php" method="post">
        <label for="add-title">CREATE TITLE</label>
        <input type="text" name="add-title" placeholder="Title">
        <textarea name="description" id="list-description" placeholder="Description"></textarea>
        <div class="btn-container">
            <button id="cancel-btn">cancel</button>
            <button id="addtask-btn">add expense</button>
        </div>
        
    </form>

</section>
</body>
</html>