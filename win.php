<?php
    require 'lib/game.inc.php';

    $view = new SudokuView($game);
?>


<!DOCTYPE HTML>
<html>


<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <meta charset="utf-8">
    <title>You Win! | Super Sudoku</title>
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

        <h1>You Win!</h1>

        <div class="content">
            <h2>Here is the solution:</h2>

            <?php echo $view->presentPuzzleSolution(); ?>

            <br/>
            <h3 id="clueNum">You entered <?php echo $_SESSION['total_notes']; ?> clues to solve this puzzle</h3>
        </div>
    </div>
</body>
</html>