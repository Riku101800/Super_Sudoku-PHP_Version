<?php

/**
 * Class SudokuView
 * @brief The view for the game
 */
class SudokuView {
    /**
     * @brief Constructor
     * @param SudokuGame $game  The SudokuGame object
     */
    public function __construct( SudokuGame $game ) {
        $this->game = $game;
    }

    /**
     * @brief Generate HTML for a puzzle
     * @return string $html
     */
    public function presentPuzzle() {
        $html = "<table class='normal''>";

        // Create table rows <tr>
        for( $x = 0; $x <= 8; $x++ ) {
            $html .= "<tr>";

            // Create table data <td>
            for( $y = 0; $y <= 8; $y++ ) {
                if( $_SESSION['current_puzzle'][$x][$y] == 0 ) {

                    // Loading Notes
                    if(isset($_SESSION['current_notes'][$x][$y])) {
                        $html .= "<td><a href='cell.php?x=$y&y=$x'>" . $this->addNote($x, $y) . "</a></td>";
                    }
                    else {
                        $html .= "<td><a href='cell.php?x=$y&y=$x'></a></td>";
                    }
                }

                // correct answer
                elseif($this->game->isCorrect($x,$y,$_SESSION['current_puzzle'][$x][$y])) {
                    if($this->game->getCurrentPuzzle()[$x][$y] == 0) {
                        $html .= "<td class='correct'>" . $_SESSION['current_puzzle'][$x][$y] . "</td>";
                    }
                    else {
                        $html .= "<td>" . $_SESSION['current_puzzle'][$x][$y] . "</td>";
                    }
                }

                // incorrect answer
                else {
                    $html .= "<td class='incorrect'><a href='cell.php?x=$y&y=$x'>" .
                              $_SESSION['current_puzzle'][$x][$y] . "</a></td>";
                }
            }
            $html .= "</tr>";
        }
        $html .= "</table>";

        return $html;
    }

    /**
     * @brief Generate HTML for a puzzle solution
     * @return string $html
     */
    public function presentPuzzleSolution() {
        $html = "<table class='normal'>";

        // Create table rows <tr>
        for( $x = 0; $x <= 8; $x++ ) {
            $html .= "<tr>";

            // Create table data <td>
            for( $y = 0; $y <= 8; $y++ ) {
                $html .= "<td>" . $this->game->getCurrentPuzzleSolution()[$x][$y] . "</td>";
            }
            $html .= "</tr>";
        }
        $html .= "</table>";

        return $html;
    }

    /**
     * @brief Add a note to the puzzle
     * @param int $row     Puzzle row
     * @param int $column  Puzzle column
     * @return string $html
     */
    public function addNote( $row, $column ) {
        $html = "<table class='noteTable'>";
        $count = 1;

        // Create table rows <tr>
        for($x =0; $x<=2; $x++) {
            $html .= "<tr>";

            // Create table data <td>
            for ($y = 0; $y <= 2; $y++) {
                if(in_array($count, $_SESSION['current_notes'][$row][$column])) {
                    $html .= "<td>" . $count . "</td>";
                }
                else {
                    $html .= "<td></td>";
                }
                $count += 1;
            }
            $html .= "</tr>";
        }
        $html .= "</table>";

        return $html;
    }


    /* Member Variable */
    private $game;   // The SudokuGame object
}

?>
