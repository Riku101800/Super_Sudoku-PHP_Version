<?php

/**
 * Class SudokuController
 * @brief The controller for the game
 */
class SudokuController {

    /**
     * @brief Constructor
     * @param SudokuGame $game  The SudokuGame object
     * @param array $request    The $_REQUEST array
     */
    public function __construct( SudokuGame $game, $request, $isCheat=false) {
        $this->game = $game;

        // this can't always be the cheat puzzle
        if($isCheat) {
            $_SESSION['isCheat'] = true;
            $this->game->setCurrentPuzzle($this->game->getCheatPuzzleStart());
            $this->game->setCurrentPuzzleSolution($this->game->getCheatPuzzleSolution());
        }
        else {
            $_SESSION['isCheat'] = false;
            $this->game->setRandomIndex();
        }
    }

    /**
     * @brief Get the page
     * @return string  The page to redirect to
     */
    public function getPage() {
        return $this->page;
    }


    /**
     * @brief Set the cell back to 0 (empty)
     * @param int $x  Puzzle row
     * @param int $y  Puzzle column
     */
    public function inputEmpty($x, $y) {
        $this->game->setCell($x, $y, 0);
        $this->game->setEmptyNote($x, $y);
    }

    /**
     * @brief Put an answer in the cell
     * @param int $x    Puzzle row
     * @param int $y    Puzzle column
     * @param int $val  Puzzle value to insert
     * @return bool  True, if the value can been inserted
     */
    public function inputAnswer($x, $y, $val) {
        if($this->game->isValid($x, $y, $val)) {
            $this->game->setCell($x, $y, $val);
            $this->game->setEmptyNote($x, $y);
                return true;
        }
        else{
            return false;
        }
    }

    /**
     * @brief Put a note in the cell
     */
    public function inputNote( $x, $y, $noteArray ) {
        $_SESSION['total_notes'] += count($noteArray);
        $this->game->setNote( $x, $y, $noteArray );
    }

    /**
     *
     */
    public function isWin() {
        if($this->game->getCurrentPuzzleSolution() === $_SESSION['current_puzzle']){
            return true;
        }
        else{
            return false;
        }
    }

    /* Member Variables */
    private $game;                // SudokuGame object
    private $page = 'cell.php';   // Default page to go to
}

?>
