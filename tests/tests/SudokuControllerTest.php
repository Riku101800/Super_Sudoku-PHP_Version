<?php

/**
 * @brief Unit tests for SudokuController
 */
class SudokuControllerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @brief Test the Constructor
     */
    public function test_construct() {
        $game = new SudokuGame();
        $controller = new SudokuController( $game, array() );

        $this->assertInstanceOf( 'SudokuController', $controller );
        $this->assertEquals( 'cell.php', $controller->getPage() );
    }

    /**
     * @brief Test inputEmpty()
     */
    public function test_inputEmpty() {
        $game = new SudokuGame();
        $controller = new SudokuController( $game, array() );

        // Format: [puzzle][row][column]
        $controller->inputAnswer( 0, 0, 6 );
        $controller->inputEmpty( 0, 0 );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[3][0][0] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[4][0][0] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[5][0][0] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[7][0][0] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[8][0][0] );

        $this->assertNotEquals( 0, $game->getAllPuzzlesStart()[1][0][0] );
        $this->assertNotEquals( 0, $game->getAllPuzzlesStart()[2][0][0] );
        $this->assertNotEquals( 0, $game->getAllPuzzlesStart()[6][0][0] );


        $controller->inputAnswer( 0, 8, 2 );
        $controller->inputEmpty( 0, 8 );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[0][0][8] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[1][0][8] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[2][0][8] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[3][0][8] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[4][0][8] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[5][0][8] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[6][0][8] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[9][0][8] );

        $this->assertNotEquals( 0, $game->getAllPuzzlesStart()[7][0][8] );
        $this->assertNotEquals( 0, $game->getAllPuzzlesStart()[8][0][8] );


        $controller->inputAnswer( 3, 6, 5 );
        $controller->inputEmpty( 3, 6 );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[2][3][6] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[3][3][6] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[6][3][6] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[7][3][6] );
        $this->assertEquals( 0, $game->getAllPuzzlesStart()[8][3][6] );

        $this->assertNotEquals( 0, $game->getAllPuzzlesStart()[4][3][6] );
        $this->assertNotEquals( 0, $game->getAllPuzzlesStart()[5][3][6] );
        $this->assertNotEquals( 0, $game->getAllPuzzlesStart()[9][3][6] );
    }

    /**
     * @brief Test inputAnswer(x, y, val)
     */
    public function test_inputAnswer() {
        $game = new SudokuGame();
        $controller = new SudokuController( $game, array() );

        $cheatPuzzleSolution = $game->getCheatPuzzleSolution();
        $this->assertEquals( $cheatPuzzleSolution[0][0], $controller->inputAnswer(0,0,2) );
        $this->assertEquals( $cheatPuzzleSolution[0][1], $controller->inputAnswer(0,1,6) );
        $this->assertEquals( $cheatPuzzleSolution[0][2], $controller->inputAnswer(0,2,3) );

        $this->assertEquals( $cheatPuzzleSolution[3][7], $controller->inputAnswer(3,7,6) );
        $this->assertEquals( $cheatPuzzleSolution[4][4], $controller->inputAnswer(4,4,3) );
        $this->assertEquals( $cheatPuzzleSolution[5][1], $controller->inputAnswer(5,1,2) );

        $this->assertEquals( $cheatPuzzleSolution[6][3], $controller->inputAnswer(6,3,3) );
        $this->assertEquals( $cheatPuzzleSolution[7][8], $controller->inputAnswer(7,8,8) );
        $this->assertEquals( $cheatPuzzleSolution[8][6], $controller->inputAnswer(8,6,5) );
    }

    /**
     * @brief Test inputNote()
     */
    public function test_inputNote() {
        $game = new SudokuGame();
        $controller = new SudokuController( $game, array() );

        // Format: [puzzle][row][column]
        $controller->inputNote( 0, 0, array(1,2) );
        $this->assertEquals( array(1,2), $_SESSION['current_notes'][0][0] );
        $controller->inputNote( 2, 3, array(3,5,7,8));
        $this->assertEquals( array(3,5,7,8), $_SESSION['current_notes'][2][3] );
    }
}

?>
