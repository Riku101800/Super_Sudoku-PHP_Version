<?php

/**
 * @brief Unit tests for SudokuView
 */
class SudokuViewTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @brief Test the Constructor
     */
    public function test_construct() {
        $game = new SudokuGame();
        $view = new SudokuView($game);

        $this->assertInstanceOf( 'SudokuView', $view );
    }

    /**
     * @brief Checks if a puzzle was displayed
     */
    public function test_presentPuzzle()
    {
        $game = new SudokuGame();
        $view = new SudokuView($game);
        $controller = new SudokuController( $game, array() );   // sets the current puzzle

        $puzzle = $view->presentPuzzle();

        // Puzzle contains a complete table
        $this->assertContains( '<table', $puzzle );
        $this->assertContains( '<tr>', $puzzle );
        $this->assertContains( '<td>', $puzzle );
        $this->assertContains( '</td>', $puzzle );
        $this->assertContains( '</tr>', $puzzle );
        $this->assertContains( '</table>', $puzzle );

        // Puzzle has to contain 0s
        $this->assertContains( '0', $puzzle );

        // Puzzle does not contain any negatives, > 9, or decimals
        $this->assertNotContains( '-33', $puzzle );
        $this->assertNotContains( '-5.6', $puzzle );
        $this->assertNotContains( '77.8', $puzzle );
        $this->assertNotContains( '10', $puzzle );
        $this->assertNotContains( '200', $puzzle );
    }

    /**
     * @brief Checks if a puzzle solution was displayed
     */
    public function test_presentPuzzleSolution() {
        $game = new SudokuGame();
        $view = new SudokuView($game);
        $controller = new SudokuController( $game, array() );   // sets the current puzzle solution

        $puzzleSolution = $view->presentPuzzleSolution();

        // Solution contains a complete table
        $this->assertContains( '<table', $puzzleSolution );
        $this->assertContains( '<tr>', $puzzleSolution );
        $this->assertContains( '<td>', $puzzleSolution );
        $this->assertContains( '</td>', $puzzleSolution );
        $this->assertContains( '</tr>', $puzzleSolution );
        $this->assertContains( '</table>', $puzzleSolution );

        // Solution contains numbers 1 - 9
        $this->assertContains( '1', $puzzleSolution );
        $this->assertContains( '2', $puzzleSolution );
        $this->assertContains( '3', $puzzleSolution );
        $this->assertContains( '4', $puzzleSolution );
        $this->assertContains( '5', $puzzleSolution );
        $this->assertContains( '6', $puzzleSolution );
        $this->assertContains( '7', $puzzleSolution );
        $this->assertContains( '8', $puzzleSolution );
        $this->assertContains( '9', $puzzleSolution );

        // Solution does not contain any 0s, negatives, > 9, or decimals
        $this->assertNotContains( '0', $puzzleSolution );
        $this->assertNotContains( '-33', $puzzleSolution );
        $this->assertNotContains( '-5.6', $puzzleSolution );
        $this->assertNotContains( '77.8', $puzzleSolution );
        $this->assertNotContains( '10', $puzzleSolution );
        $this->assertNotContains( '200', $puzzleSolution );

        // Solution does not contain any incorrect answers
        $this->assertNotContains( "<td class='incorrect'>", $puzzleSolution );
    }

    /**
     * @brief Checks if a note was added
     */
    public function test_addNote() {
        $game = new SudokuGame();
        $view = new SudokuView($game);
        $_SESSION['current_notes'][1][2] = array();
        $note = $view->addNote(1,2);

        $this->assertContains("<table class='noteTable'>", $note);
        $this->assertContains( '<tr>', $note );
        $this->assertContains( '<td>', $note );
        $this->assertContains( '</td>', $note );
        $this->assertContains( '</tr>', $note );
        $this->assertContains( '</table>', $note );
    }
}

?>
