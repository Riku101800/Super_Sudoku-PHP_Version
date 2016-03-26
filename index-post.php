<?php
    require 'lib/game.inc.php';

    session_unset();
    if(isset($_POST['cheatMode'])){
        header( 'Location: cheat.php ');
    }
    else {
        $controller = new SudokuController( $game, $_REQUEST );
        header( 'Location: sudoku.php ');
    }

    //phpinfo();

?>
