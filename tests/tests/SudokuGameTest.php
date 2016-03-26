<?php

/**
 * @brief Unit tests for SudokuGame
 */

if ( !isset( $_SESSION ) ) $_SESSION = array(  );

class SudokuGameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @brief Test the Constructor
     */
    public function test_construct() {

        $game = new SudokuGame();

        $this->assertInstanceOf("SudokuGame", $game);
    }

    public function test_isCorrect( ) {

        $game = new SudokuGame();

        $testpuzz = array (
            0 => [5,0,3,0,0,4,2,0,0],
            1 => [2,4,0,0,1,3,0,0,0],
            2 => [0,0,0,0,0,0,0,8,0],
            3 => [0,0,0,6,0,0,9,5,0],
            4 => [0,3,5,4,0,8,7,6,0],
            5 => [0,8,1,0,0,9,0,0,0],
            6 => [0,5,0,0,0,0,0,0,0],
            7 => [0,0,0,8,6,0,0,9,4],
            8 => [0,0,9,3,0,0,1,0,6]
        );

        $testpuzzSol = array (
            0 => [5,6,3,7,8,4,2,1,9],
            1 => [2,4,8,9,1,3,6,7,5],
            2 => [1,9,7,2,5,6,4,8,3],
            3 => [7,2,4,6,3,1,9,5,8],
            4 => [9,3,5,4,2,8,7,6,1],
            5 => [6,8,1,5,7,9,3,4,2],
            6 => [4,5,6,1,9,2,8,3,7],
            7 => [3,1,2,8,6,7,5,9,4],
            8 => [8,7,9,3,4,5,1,2,6]
        );

        $game->setCurrentPuzzle($testpuzz);
        $game->setCurrentPuzzleSolution($testpuzzSol);

        $game->setCell(0, 1, 6 );

        $this->assertEquals( true, $game->getCurrentPuzzleSolution()[0][1] );
    }

    public function test_isValid( ) {

        $game = new SudokuGame();

        // for every $x
        for( $a=0; $a<9; $a++ ) {

            // for every $y
            for( $b=0; $b<9; $b++ ) {

                // for every possible $val
                for( $c=1; $c<10; $c++ ) {
                    $this->assertEquals(true, $game->isValid($a, $b, $c ));
                    $this->assertEquals(true, is_numeric($c));
                }
            }
        }
    }

    // maybe test more instances?
    // how to test differently than isCorrect?
    public function test_setCell( ) {

        $game = new SudokuGame();
        $view = new SudokuView($game);
        $controller = new SudokuController($game, array() );



        $testpuzz = array (
            0 => [5,0,3,0,0,4,2,0,0],
            1 => [2,4,0,0,1,3,0,0,0],
            2 => [0,0,0,0,0,0,0,8,0],
            3 => [0,0,0,6,0,0,9,5,0],
            4 => [0,3,5,4,0,8,7,6,0],
            5 => [0,8,1,0,0,9,0,0,0],
            6 => [0,5,0,0,0,0,0,0,0],
            7 => [0,0,0,8,6,0,0,9,4],
            8 => [0,0,9,3,0,0,1,0,6]
        );

        $game->setCurrentPuzzle( $testpuzz );

        $_SESSION['current_puzzle'] = $game->getCurrentPuzzle();
        //print_r($game->getCurrentPuzzle());
        //$game->setCell(0, 1, 6);
        //print_r($game->getCurrentPuzzle());
        $this->assertEquals($game->getCurrentPuzzle(), $_SESSION['current_puzzle'] );
        $this->assertEquals($game->getCurrentPuzzle()[0][1], $_SESSION['current_puzzle'][0][1]);
    }


    public function test_setNote() {
        $game = new SudokuGame();

        $testpuzz = array (
            0 => [5,0,3,0,0,4,2,0,0],
            1 => [2,4,0,0,1,3,0,0,0],
            2 => [0,0,0,0,0,0,0,8,0],
            3 => [0,0,0,6,0,0,9,5,0],
            4 => [0,3,5,4,0,8,7,6,0],
            5 => [0,8,1,0,0,9,0,0,0],
            6 => [0,5,0,0,0,0,0,0,0],
            7 => [0,0,0,8,6,0,0,9,4],
            8 => [0,0,9,3,0,0,1,0,6]
        );

        $game->setCurrentPuzzle( $testpuzz );

        $_SESSION['current_notes'] = $game->getCurrentPuzzle();

        $this->assertEquals($game->getCurrentPuzzle(), $_SESSION['current_notes'] );
        $this->assertEquals($game->getCurrentPuzzle()[0][0], $_SESSION['current_notes'][0][0] );
    }

    // getters virtually identical? maybe other way to test

    public function test_getCurrentPuzzle() {
        $game = new SudokuGame();
        $testpuzz = array (
            0 => [5,0,3,0,0,4,2,0,0],
            1 => [2,4,0,0,1,3,0,0,0],
            2 => [0,0,0,0,0,0,0,8,0],
            3 => [0,0,0,6,0,0,9,5,0],
            4 => [0,3,5,4,0,8,7,6,0],
            5 => [0,8,1,0,0,9,0,0,0],
            6 => [0,5,0,0,0,0,0,0,0],
            7 => [0,0,0,8,6,0,0,9,4],
            8 => [0,0,9,3,0,0,1,0,6]
        );
        $game->setCurrentPuzzle( $testpuzz );
        $this->assertEquals($testpuzz, $game->getCurrentPuzzle() );
    }

    public function test_setCurrentPuzzle() {
        $game = new SudokuGame();

        $testpuzz = array (
            0 => [5,0,3,0,0,4,2,0,0],
            1 => [2,4,0,0,1,3,0,0,0],
            2 => [0,0,0,0,0,0,0,8,0],
            3 => [0,0,0,6,0,0,9,5,0],
            4 => [0,3,5,4,0,8,7,6,0],
            5 => [0,8,1,0,0,9,0,0,0],
            6 => [0,5,0,0,0,0,0,0,0],
            7 => [0,0,0,8,6,0,0,9,4],
            8 => [0,0,9,3,0,0,1,0,6]
        );

        $game->setCurrentPuzzle( $testpuzz );
        $this->assertEquals( $testpuzz, $game->getCurrentPuzzle() );
    }

    public function test_getCurrentPuzzleSolution() {
        $game = new SudokuGame();

        $testpuzz = array (
            0 => [5,6,3,7,8,4,2,1,9],
            1 => [2,4,8,9,1,3,6,7,5],
            2 => [1,9,7,2,5,6,4,8,3],
            3 => [7,2,4,6,3,1,9,5,8],
            4 => [9,3,5,4,2,8,7,6,1],
            5 => [6,8,1,5,7,9,3,4,2],
            6 => [4,5,6,1,9,2,8,3,7],
            7 => [3,1,2,8,6,7,5,9,4],
            8 => [8,7,9,3,4,5,1,2,6]
        );

        $game->setCurrentPuzzleSolution( $testpuzz );
        $this->assertEquals($testpuzz, $game->getCurrentPuzzleSolution() );

    }

    public function test_setCurrentPuzzleSolution() {
        $game = new SudokuGame();

        $testpuzz = array (
            0 => [5,6,3,7,8,4,2,1,9],
            1 => [2,4,8,9,1,3,6,7,5],
            2 => [1,9,7,2,5,6,4,8,3],
            3 => [7,2,4,6,3,1,9,5,8],
            4 => [9,3,5,4,2,8,7,6,1],
            5 => [6,8,1,5,7,9,3,4,2],
            6 => [4,5,6,1,9,2,8,3,7],
            7 => [3,1,2,8,6,7,5,9,4],
            8 => [8,7,9,3,4,5,1,2,6]
        );

        $game->setCurrentPuzzleSolution( $testpuzz );
        $this->assertEquals($testpuzz, $game->getCurrentPuzzleSolution() );
    }

    public function test_getCheatPuzzleStart() {
        $game = new SudokuGame();

        $testpuzz = array (
            0 => [0,0,0,0,5,0,0,1,9],
            1 => [0,0,0,0,2,0,6,3,5],
            2 => [0,0,9,1,0,0,7,0,0],
            3 => [0,0,8,0,4,0,9,0,1],
            4 => [6,0,0,0,0,0,0,0,7],
            5 => [1,0,5,0,9,0,8,0,0],
            6 => [0,0,6,0,0,5,1,0,0],
            7 => [4,5,2,0,1,0,0,0,0],
            8 => [3,7,0,0,8,0,0,0,0]
        );

        $game->setCurrentPuzzle( $testpuzz );
        $this->assertEquals($testpuzz, $game->getCurrentPuzzle() );
    }

    public function test_setCheatPuzzleStart() {
        $game = new SudokuGame();

        $testpuzz = array (
            0 => [0,0,0,0,5,0,0,1,9],
            1 => [0,0,0,0,2,0,6,3,5],
            2 => [0,0,9,1,0,0,7,0,0],
            3 => [0,0,8,0,4,0,9,0,1],
            4 => [6,0,0,0,0,0,0,0,7],
            5 => [1,0,5,0,9,0,8,0,0],
            6 => [0,0,6,0,0,5,1,0,0],
            7 => [4,5,2,0,1,0,0,0,0],
            8 => [3,7,0,0,8,0,0,0,0]
        );

        $game->setCurrentPuzzle( $testpuzz );
        $this->assertEquals($testpuzz, $game->getCurrentPuzzle() );
    }

    public function test_getCheatPuzzleSolution() {
        $game = new SudokuGame();

        $testpuzz = array (
            0 => [2,6,3,7,5,8,4,1,9],
            1 => [8,1,7,4,2,9,6,3,5],
            2 => [5,4,9,1,6,3,7,8,2],
            3 => [7,3,8,5,4,2,9,6,1],
            4 => [6,9,4,8,3,1,2,5,7],
            5 => [1,2,5,6,9,7,8,4,3],
            6 => [9,8,6,3,7,5,1,2,4],
            7 => [4,5,2,9,1,6,3,7,8],
            8 => [3,7,1,2,8,4,5,9,6]
        );

        $game->setCurrentPuzzle( $testpuzz );
        $this->assertEquals($testpuzz, $game->getCurrentPuzzle() );
    }

    public function test_setCheatPuzzleSolution() {
        $game = new SudokuGame();

        $testpuzz = array (
            0 => [2,6,3,7,5,8,4,1,9],
            1 => [8,1,7,4,2,9,6,3,5],
            2 => [5,4,9,1,6,3,7,8,2],
            3 => [7,3,8,5,4,2,9,6,1],
            4 => [6,9,4,8,3,1,2,5,7],
            5 => [1,2,5,6,9,7,8,4,3],
            6 => [9,8,6,3,7,5,1,2,4],
            7 => [4,5,2,9,1,6,3,7,8],
            8 => [3,7,1,2,8,4,5,9,6]
        );

        $game->setCurrentPuzzle( $testpuzz );
        $this->assertEquals($testpuzz, $game->getCurrentPuzzle() );
    }

    public function test_setRandomIndex() {
        $game = new SudokuGame();

        $this->assertEquals( array_search($game->calculateRandomIndex(), $game->getCurrentPuzzle()),
                             array_search($game->calculateRandomIndex(), $game->getCurrentPuzzleSolution()) );
    }


}

?>
