<?php

    require 'lib/game.inc.php';

    $controller = new SudokuController( $game, $_REQUEST, $_SESSION['isCheat']);


    // Input answer into cell
    if(isset($_POST['column']) && isset($_POST['row']) && isset($_POST['cellAnswer'])) {
        $controller->inputAnswer(intval($_POST['column']), intval($_POST['row']), intval($_POST['cellAnswer']));
    }

    // Set cell to empty
    if(isset($_POST['column']) && isset($_POST['row']) && isset($_POST['empty'])) {
        $controller->inputEmpty($_POST['column'], $_POST['row']);
    }


    // Adding notes
    $noteArray = array();
    for( $x = 1; $x <= 9; $x++ ) {
        if (isset($_POST['checkbox'.$x])) {
            array_push($noteArray, $x);
        }
    }
    if(!empty($noteArray)) {
        $controller->inputNote(intval($_POST['column']),intval($_POST['row']),$noteArray);
    }


    // Redirect to the next page
    if($_SESSION['isCheat']) {
        if($controller->isWin()) {
            header( 'Location: win.php' );
        }
        else {
            header('Location: cheat.php');
        }
    }
    else {
        if($controller->isWin()) {
            header( 'Location: win.php' );
        }
        else {
            header('Location: sudoku.php');
        }
    }


    //phpinfo();

?>
