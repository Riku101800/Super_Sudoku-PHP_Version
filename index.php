<?php
session_unset();
?>
<!DOCTYPE HTML>
<html>


<head>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <meta charset="utf-8">
    <title>Welcome | Super Sudoku</title>
</head>


<body>
    <header>
        <img src="images/SuperSudokuBanner.png" width="600" height="175" alt="Super Sudoku Banner"/>
    </header>


    <div class="container">
        <h1 id="welcome">Welcome to Super Sudoku!</h1>

        <div class="content">
            <form method="post" action="index-post.php">
                <p>
                    <label for="userName">Enter your name:</label>
                    <input type="text" name="userName" id="userName"/>
                </p>

                <p>
                    <label for="cheatMode">Cheat Mode:</label>
                    <input type="checkbox" name="cheatMode" id="cheatMode"/>
                </p>

                <p>
                    <input id="play" type="submit" value="Play!"/>
                </p>
            </form>
        </div>

    </div>
</body>
</html>
