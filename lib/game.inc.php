<?php

    require __DIR__ . "/autoload.inc.php";

    // Start the PHP session system
    session_start();

    // Define the location in $_SESSION where the Sudoku object is saved
    define( "SUDOKU_SESSION", 'game');

    // If it doesn't already exist, create a new Sudoku session
    if( !isset($_SESSION[SUDOKU_SESSION]) ) {
        $_SESSION[SUDOKU_SESSION] = new SudokuGame();
    }

    // Otherwise, use the existing Sudoku session
    $game = $_SESSION[SUDOKU_SESSION];

    if(!isset($_SESSION['current_puzzle'])) {
        $_SESSION['current_puzzle'] = array();
    }

?>
