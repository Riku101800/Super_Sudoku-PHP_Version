<?php

/**
 * Class SudokuGame
 * @brief The model for the game
 */
class SudokuGame {
    /**
     * @brief Constructor
     */
    public function __construct() {
    }

    /**
     * @brief Set the puzzle
     * @param array $puzzle  Puzzle to set
     */
    public function setPuzzle( $puzzle ) {
        $this->current_puzzle = $puzzle;
    }

    /**
     * @brief Set the puzzle solution
     * @param array $puzzleSol  Puzzle solution to set
     */
    public function setPuzzleSolution( $puzzleSol ) {
        $this->current_puzzleSol = $puzzleSol;
    }

    /**
     * @brief Set a cell to a value
     * @param int $x    Row number
     * @param int $y    Column number
     * @param int $val  Value to set
     */
    public function setCell( $x, $y, $val ) {
        $_SESSION['current_puzzle'][$x][$y] = $val;
    }

    /**
     * @brief Set a note in a cell
     * @param int $x    Row number
     * @param int $y    Column number
     * @param array $arr   Array of notes
     */
    public function setNote( $x, $y, $arr ) {
        $_SESSION['current_notes'][$x][$y] = $arr;
    }

    /**
     * @brief Erase notes in a cell
     * @param int $x  Row number
     * @param int $y  Column number
     */
    public function setEmptyNote( $x, $y ) {
        unset( $_SESSION['current_notes'][$x][$y] );
    }


    /**
     * @brief Dhruv's function; he's very proud of it
     * @param array $two_d
     * @return array
     */
    private function convert2d_to1d ( $two_d ) {
        $one_d = array();

        for( $i=0; $i<count($two_d); $i++) {
            for( $j=0; $j<count($two_d[$i]); $j++) {
                $one_d[] = $two_d[$i][$j];
            }
        }
        return $one_d;
    }


    /**
     * @brief Check the validity of a cell's value
     * @param int $x    Row number
     * @param int $y    Column number
     * @param int $val  Cell value
     * @return bool  True, if value is valid
     */
    public function isValid( $x, $y, $val ) {
        if( is_numeric($x) && is_numeric($y) && is_numeric($val)) {
            if( $x > 8 || $x < 0 || $y > 8 || $y < 0 || $val > 9 || $val < 1 ) {
                return false;
            }
            else {
                return true;
            }
        } else {
            return false;
        }
    }

    /**
     * @brief Check whether the value of cell is correct
     * @param int $x    Row number
     * @param int $y    Column number
     * @param int $val  Cell value
     * @return bool  True, if value is correct
     */
    public function isCorrect( $x, $y, $val ) {
        if( $this->current_puzzleSol[$x][$y] == $val ) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * @brief Get the current puzzle
     * @return array
     */
    public function getCurrentPuzzle() {
        return $this->current_puzzle;
    }

    /**
     * @brief Set the current puzzle
     * @param array $puzzle  The puzzle
     */
    public function setCurrentPuzzle( $puzzle ) {
        $this->current_puzzle = $puzzle;

        if(empty($_SESSION['current_puzzle'])) {
            $_SESSION['current_puzzle'] = $puzzle;
            $_SESSION['current_notes'] = array();
            $_SESSION['total_notes'] = 0;
        }
    }

    /**
     * @brief Get the current puzzle solution
     * @return array
     */
    public function getCurrentPuzzleSolution() {
        return $this->current_puzzleSol;
    }

    /**
     * @brief Set the current puzzle solution
     * @param array $puzzleSol  The puzzle solution
     */
    public function setCurrentPuzzleSolution( $puzzleSol ) {
        $this->current_puzzleSol = $puzzleSol;
    }


    /**
     * @brief Get the cheat puzzle
     * @return array
     */
    public function getCheatPuzzleStart() {
        return $this->cheatPuzzle_start;
    }

    /**
     * @brief Get the cheat puzzle solution
     * @return array
     */
    public function getCheatPuzzleSolution() {
        return $this->cheatPuzzle_solution;
    }

    /**
     * @brief Get every puzzle
     * @return array
     */
    public function getAllPuzzlesStart() {
        return $this->allPuzzlesStart;
    }

    /**
     * @brief Get every puzzle solution
     * @return array
     */
    public function getAllPuzzlesSolution() {
        return $this->allPuzzlesSolution;
    }


    /**
     * @brief Calculate a random value to use as the index to the puzzle arrays
     * @return int randomPuzzleIndex
     */
    public function calculateRandomIndex() {
        return rand(1, 9);
    }

    /**
     * @brief Set the randomly calculated index to the puzzle arrays
     */
    public function setRandomIndex() {
        if(empty($_SESSION['puzzle_set'])) {
            $_SESSION['puzzle_set'] = $this->calculateRandomIndex();
        }

        $this->setCurrentPuzzle( $this->allPuzzlesStart[$_SESSION['puzzle_set']] );
        $this->setCurrentPuzzleSolution( $this->allPuzzlesSolution[$_SESSION['puzzle_set']] );
    }


    /* Member Variables */
    private $current_puzzle = array();      // Current puzzle start
    private $current_puzzleSol = array();   // Current puzzle solution

    /**
     * @brief All the puzzles
     * @var array
     */
    private $allPuzzlesStart = array (
        0 => array (
            0 => [5,0,3,0,0,4,2,0,0],
            1 => [2,4,0,0,1,3,0,0,0],
            2 => [0,0,0,0,0,0,0,8,0],
            3 => [0,0,0,6,0,0,9,5,0],
            4 => [0,3,5,4,0,8,7,6,0],
            5 => [0,8,1,0,0,9,0,0,0],
            6 => [0,5,0,0,0,0,0,0,0],
            7 => [0,0,0,8,6,0,0,9,4],
            8 => [0,0,9,3,0,0,1,0,6]
        ),
        1 => array (
            0 => [9,0,0,6,7,0,1,0,0],
            1 => [0,0,0,0,1,8,0,2,0],
            2 => [1,7,0,0,0,0,0,5,6],
            3 => [2,0,0,0,0,9,7,0,0],
            4 => [0,0,7,0,0,0,2,0,0],
            5 => [0,0,6,2,0,0,0,0,5],
            6 => [4,3,0,0,0,0,0,8,1],
            7 => [0,1,0,8,5,0,0,0,0],
            8 => [0,0,8,0,6,1,0,0,3]
        ),
        2 => array (
            0 => [6,0,9,5,4,8,0,0,0],
            1 => [0,0,1,3,0,0,0,0,8],
            2 => [0,0,0,0,0,0,5,9,6],
            3 => [0,0,7,0,0,0,0,0,9],
            4 => [0,9,0,1,2,5,0,8,0],
            5 => [3,0,0,0,0,0,4,0,0],
            6 => [1,6,3,0,0,0,0,0,0],
            7 => [7,0,0,0,0,2,6,0,0],
            8 => [0,0,0,6,3,4,8,0,7]
        ),
        3 => array (
            0 => [0,1,0,3,0,0,0,6,0],
            1 => [6,0,5,4,1,0,0,0,0],
            2 => [0,0,7,0,0,8,0,0,4],
            3 => [0,2,0,0,8,9,0,0,1],
            4 => [8,0,0,0,0,0,0,0,5],
            5 => [7,0,0,2,5,0,0,8,0],
            6 => [9,0,0,6,0,0,4,0,0],
            7 => [0,0,0,0,9,1,8,0,6],
            8 => [0,6,0,0,0,4,0,3,0]
        ),
        4 => array (
            0 => [0,0,0,4,0,7,0,8,0],
            1 => [0,0,9,0,0,5,3,0,4],
            2 => [5,0,0,0,0,1,0,0,6],
            3 => [8,3,6,0,0,0,4,0,0],
            4 => [0,9,0,0,0,0,0,5,0],
            5 => [0,0,5,0,0,0,8,2,7],
            6 => [7,0,0,3,0,0,0,0,8],
            7 => [4,0,8,5,0,0,9,0,0],
            8 => [0,6,0,1,0,8,0,0,0]
        ),
        5 => array (
            0 => [0,2,0,5,3,0,0,0,0],
            1 => [4,0,3,0,0,2,7,0,0],
            2 => [8,0,0,0,0,0,2,9,0],
            3 => [0,0,0,0,0,5,6,1,0],
            4 => [0,0,5,8,2,1,9,0,0],
            5 => [0,1,4,6,0,0,0,0,0],
            6 => [0,9,7,0,0,0,0,0,1],
            7 => [0,0,8,2,0,0,3,0,9],
            8 => [0,0,0,0,7,9,0,2,0]
        ),
        6 => array (
            0 => [6,0,0,0,0,5,9,0,0],
            1 => [0,5,0,1,8,0,0,0,2],
            2 => [3,0,1,0,0,2,0,0,0],
            3 => [1,0,0,0,0,7,0,6,0],
            4 => [9,0,0,4,0,8,0,0,1],
            5 => [0,7,0,6,0,0,0,0,5],
            6 => [0,0,0,2,0,0,5,0,3],
            7 => [5,0,0,0,1,3,0,7,0],
            8 => [0,0,7,5,0,0,0,0,8]
        ),
        7 => array (
            0 => [0,0,2,3,1,7,0,8,9],
            1 => [0,1,0,0,0,0,0,0,2],
            2 => [7,0,9,5,0,0,0,0,0],
            3 => [0,0,8,0,0,3,0,5,7],
            4 => [0,0,0,0,0,0,0,0,0],
            5 => [9,7,0,8,0,0,3,0,0],
            6 => [0,0,0,0,0,4,7,0,1],
            7 => [1,0,0,0,0,0,0,2,0],
            8 => [8,3,0,2,7,1,4,0,0]
        ),
        8 => array (
            0 => [0,2,0,0,9,4,0,1,6],
            1 => [0,4,0,0,0,0,0,0,5],
            2 => [0,0,0,0,1,7,0,8,0],
            3 => [0,0,0,0,3,0,0,6,9],
            4 => [0,0,9,4,0,1,5,0,0],
            5 => [4,3,0,0,5,0,0,0,0],
            6 => [0,8,0,1,2,0,0,0,0],
            7 => [7,0,0,0,0,0,0,3,0],
            8 => [5,9,0,8,7,0,0,4,0]
        ),
        9 => array (
            0 => [8,0,3,0,0,9,2,0,0],
            1 => [0,2,9,0,4,0,0,0,0],
            2 => [4,0,0,2,0,8,0,0,0],
            3 => [1,0,4,0,0,0,3,0,0],
            4 => [0,3,0,9,0,7,0,1,0],
            5 => [0,0,2,0,0,0,7,0,6],
            6 => [0,0,0,5,0,1,0,0,8],
            7 => [0,0,0,0,7,0,1,6,0],
            8 => [0,0,1,8,0,0,5,0,2]
        )
    );

    /**
     * @brief All the puzzle solutions
     * @var array
     */
    private $allPuzzlesSolution = array(
        0 => array (
            0 => [5,6,3,7,8,4,2,1,9],
            1 => [2,4,8,9,1,3,6,7,5],
            2 => [1,9,7,2,5,6,4,8,3],
            3 => [7,2,4,6,3,1,9,5,8],
            4 => [9,3,5,4,2,8,7,6,1],
            5 => [6,8,1,5,7,9,3,4,2],
            6 => [4,5,6,1,9,2,8,3,7],
            7 => [3,1,2,8,6,7,5,9,4],
            8 => [8,7,9,3,4,5,1,2,6]
        ),
        1 => array (
            0 => [9,8,2,6,7,5,1,3,4],
            1 => [5,6,4,3,1,8,9,2,7],
            2 => [1,7,3,9,2,4,8,5,6],
            3 => [2,4,1,5,3,9,7,6,8],
            4 => [3,5,7,1,8,6,2,4,9],
            5 => [8,9,6,2,4,7,3,1,5],
            6 => [4,3,5,7,9,2,6,8,1],
            7 => [6,1,9,8,5,3,4,7,2],
            8 => [7,2,8,4,6,1,5,9,3]
        ),
        2 => array (
            0 => [6,2,9,5,4,8,3,7,1],
            1 => [5,7,1,3,9,6,2,4,8],
            2 => [8,3,4,2,7,1,5,9,6],
            3 => [2,8,7,4,6,3,1,5,9],
            4 => [4,9,6,1,2,5,7,8,3],
            5 => [3,1,5,7,8,9,4,6,2],
            6 => [1,6,3,8,5,7,9,2,4],
            7 => [7,4,8,9,1,2,6,3,5],
            8 => [9,5,2,6,3,4,8,1,7]
        ),
        3 => array (
            0 => [4,1,9,3,2,5,7,6,8],
            1 => [6,8,5,4,1,7,3,9,2],
            2 => [2,3,7,9,6,8,1,5,4],
            3 => [5,2,3,7,8,9,6,4,1],
            4 => [8,9,6,1,4,3,2,7,5],
            5 => [7,4,1,2,5,6,9,8,3],
            6 => [9,5,8,6,3,2,4,1,7],
            7 => [3,7,4,5,9,1,8,2,6],
            8 => [1,6,2,8,7,4,5,3,9]
        ),
        4 => array (
            0 => [3,2,1,4,6,7,5,8,9],
            1 => [6,7,9,2,8,5,3,1,4],
            2 => [5,8,4,9,3,1,2,7,6],
            3 => [8,3,6,7,5,2,4,9,1],
            4 => [2,9,7,8,1,4,6,5,3],
            5 => [1,4,5,6,9,3,8,2,7],
            6 => [7,5,2,3,4,9,1,6,8],
            7 => [4,1,8,5,7,6,9,3,2],
            8 => [9,6,3,1,2,8,7,4,5]
        ),
        5 => array (
            0 => [7,2,9,5,3,8,1,4,6],
            1 => [4,6,3,9,1,2,7,8,5],
            2 => [8,5,1,7,6,4,2,9,3],
            3 => [9,8,2,3,4,5,6,1,7],
            4 => [6,7,5,8,2,1,9,3,4],
            5 => [3,1,4,6,9,7,8,5,2],
            6 => [2,9,7,4,8,3,5,6,1],
            7 => [1,4,8,2,5,6,3,7,9],
            8 => [5,3,6,1,7,9,4,2,8]
        ),
        6 => array (
            0 => [6,2,8,7,3,5,9,1,4],
            1 => [7,5,9,1,8,4,6,3,2],
            2 => [3,4,1,9,6,2,8,5,7],
            3 => [1,8,5,3,2,7,4,6,9],
            4 => [9,6,3,4,5,8,7,2,1],
            5 => [4,7,2,6,9,1,3,8,5],
            6 => [8,1,6,2,7,9,5,4,3],
            7 => [5,9,4,8,1,3,2,7,6],
            8 => [2,3,7,5,4,6,1,9,8]
        ),
        7 => array (
            0 => [4,6,2,3,1,7,5,8,9],
            1 => [5,1,3,4,9,8,6,7,2],
            2 => [7,8,9,5,2,6,1,4,3],
            3 => [6,2,8,1,4,3,9,5,7],
            4 => [3,5,4,7,6,9,2,1,8],
            5 => [9,7,1,8,5,2,3,6,4],
            6 => [2,9,5,6,8,4,7,3,1],
            7 => [1,4,7,9,3,5,8,2,6],
            8 => [8,3,6,2,7,1,4,9,5]
        ),
        8 => array (
            0 => [3,2,8,5,9,4,7,1,6],
            1 => [1,4,7,6,8,2,3,9,5],
            2 => [9,6,5,3,1,7,2,8,4],
            3 => [2,5,1,7,3,8,4,6,9],
            4 => [8,7,9,4,6,1,5,2,3],
            5 => [4,3,6,2,5,9,8,7,1],
            6 => [6,8,4,1,2,3,9,5,7],
            7 => [7,1,2,9,4,5,6,3,8],
            8 => [5,9,3,8,7,6,1,4,2]
        ),
        9 => array (
            0 => [8,5,3,7,6,9,2,4,1],
            1 => [7,2,9,1,4,3,6,8,5],
            2 => [4,1,6,2,5,8,9,3,7],
            3 => [1,7,4,6,8,5,3,2,9],
            4 => [6,3,5,9,2,7,8,1,4],
            5 => [9,8,2,3,1,4,7,5,6],
            6 => [2,6,7,5,3,1,4,9,8],
            7 => [5,9,8,4,7,2,1,6,3],
            8 => [3,4,1,8,9,6,5,7,2]
        )
    );

    /**
     * @brief Cheat Mode Puzzle - Solution
     * @var array
     */
    private $cheatPuzzle_start = array (
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

    /**
     * @brief Cheat Mode Puzzle - Start
     * @var array
     */
    private $cheatPuzzle_solution = array (
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
}
?>
