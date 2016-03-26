<?php
    require 'lib/game.inc.php';

    $view = new SudokuView($game);
?>


<!DOCTYPE HTML>
<html>


<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <meta charset="utf-8">
    <title>Give Up | Super Sudoku</title>
</head>


<body>
    <header>
        <img src="images/SuperSudokuBanner.png" width="600" height="175" alt="Super Sudoku Banner"/>
    </header>

    <div class="container">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>

        <h1>You Chose to Give Up</h1>

        <div class="content">
            <h2>Here is the solution:</h2>

            <!-- Display the puzzle solution and unset the session -->
            <?php
                echo $view->presentPuzzleSolution();
                session_unset();
            ?>
        </div>
    </div>
</body>
</html>