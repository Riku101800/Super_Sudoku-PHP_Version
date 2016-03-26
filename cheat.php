<?php
    require 'lib/game.inc.php';

    $view = new SudokuView($game);
    $controller = new SudokuController( $game, $_REQUEST, true );
?>

<!DOCTYPE HTML>
<html>


<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <meta charset="utf-8">
    <title>Cheat Mode | Super Sudoku</title>
</head>


<body>
    <header>
        <img src="images/SuperSudokuBanner.png" width="600" height="175" alt="Super Sudoku Banner"/>
    </header>

    <div class="container">
        <nav>
            <ul>
                <li><a href="giveup.php">Give Up</a></li>
                <li><a href="index.php">Home</a></li>
            </ul>
        </nav>

        <h1>Cheat Mode</h1>

        <div class="content">
            <?php echo $view->presentPuzzle(); ?>
        </div>
    </div>
</body>
</html>
