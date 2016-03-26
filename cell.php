<?php
    require 'lib/game.inc.php';

    $view = new SudokuView($game);
    //$controller = new SudokuController($game, $_REQUEST);
?>


<!DOCTYPE HTML>
<html>


<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <meta charset="utf-8">
    <title>Cell Options | Super Sudoku</title>
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


        <h1>Cell Options</h1>

        <div class="content">
            <!-- Empty the cell -->
            <form method="post" action="cell-post.php">
                <p>
                    <label for="cellEmpty">Set the cell to empty?</label>
                </p>

                <p>
                    <input type="submit" name="empty" id="empty" value="Empty Cell"/>
                    <input type="hidden" name="row" id="row" value="<?php echo $_GET['x']; ?>"/>
                    <input type="hidden" name="column" id="column" value="<?php echo $_GET['y']; ?>"/>
                </p>
            </form>
            <br/>

            <!-- Put an answer in the cell -->
            <form method="post" action="cell-post.php">
                <p>
                    <label for="cellAnswer">Put an answer in the cell (1-9):</label>
                    <input type="text" name="cellAnswer" id="cellAnswer"/>
                    <input type="hidden" name="row" id="row" value="<?php echo $_GET['x']; ?>"/>
                    <input type="hidden" name="column" id="column" value="<?php echo $_GET['y']; ?>"/>
                </p>

                <p>
                    <input type="submit" value="Submit Answer"/>
                </p>
            </form>
            <br/>

            <!-- Put clues in the cell -->
            <form method="post" action="cell-post.php">
                <p>
                    <label for="cellClue">Select which clues to put in the cell:</label>
                    <br/><br/>

                    <input type="checkbox" name="checkbox1" id="checkbox1"/>
                    <label for="checkbox1">1</label>

                    <input type="checkbox" name="checkbox2" id="checkbox2"/>
                    <label for="checkbox2">2</label>

                    <input type="checkbox" name="checkbox3" id="checkbox3"/>
                    <label for="checkbox3">3</label>
                    <br/><br/>

                    <input type="checkbox" name="checkbox4" id="checkbox4"/>
                    <label for="checkbox4">4</label>

                    <input type="checkbox" name="checkbox5" id="checkbox5"/>
                    <label for="checkbox5">5</label>

                    <input type="checkbox" name="checkbox6" id="checkbox6"/>
                    <label for="checkbox6">6</label>
                    <br/><br/>

                    <input type="checkbox" name="checkbox7" id="checkbox7"/>
                    <label for="checkbox7">7</label>

                    <input type="checkbox" name="checkbox8" id="checkbox8"/>
                    <label for="checkbox8">8</label>

                    <input type="checkbox" name="checkbox9" id="checkbox9"/>
                    <label for="checkbox9">9</label>
                    <input type="hidden" name="row" id="row" value="<?php echo $_GET['x']; ?>">
                    <input type="hidden" name="column" id="column" value="<?php echo $_GET['y']; ?>">
                </p>

                <p>
                    <input type="submit" value="Submit Clue(s)"/>
                </p>
            </form>
        </div>
    </div>
</body>
</html>