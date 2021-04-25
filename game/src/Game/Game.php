<?php

namespace Aner\Game;

/**
 * 21 Game, class Game
*/

use Aner\Game\{
  DiceHand
};

class Game
{
    private int $player_points = 0;
    private int $player_wins = 0;
    private int $pc_points = 0;
    private int $pc_wins = 0;

    private ?int $dice_amount = null;
    private $hand;

    private ?string $winner = null;


    /** Setters */

    public function set_dice_amount($dice_amount)
    {
        $this->dice_amount = $dice_amount;

        $this->hand = new DiceHand($dice_amount);
    }

    public function set_winner($winner_name)
    {
        $this->winner = $winner_name;
        if ($winner_name === "Player") {
            $this->player_wins += 1;
        } else {
            $this->pc_wins += 1;
        }
    }


  /** Getters */

    public function get_hand()
    {
        return $this->hand;
    }

    public function get_dice_amount()
    {
        return $this->dice_amount;
    }

    public function get_player_wins()
    {
        return $this->player_wins;
    }

    public function get_pc_wins()
    {
        return $this->pc_wins;
    }

    public function get_player_points()
    {
        return $this->player_points;
    }

    public function get_pc_points()
    {
        return $this->pc_points;
    }

    public function get_winner()
    {
        return $this->winner;
    }


    /** Functionality */

    public function clear_winner()
    {
        $this->winner = null;
    }

    public function throw_dice()
    {
        $this->hand->throw_dice();

        $result = $this->hand->get_last_result();

        $this->player_points += $result;

        if ($this->player_points === 21) {
            $this->set_winner("Player");
        } else if ($this->player_points > 21) {
            $this->set_winner("Computer");
        }
    }

    public function play__pc()
    {
        while ($this->pc_points < 21) {
            $this->hand->throw_dice();

            $result = $this->hand->get_last_result();

            $this->pc_points += $result;

            if ($this->pc_points > 21) {
                break;
            }

            if ($this->pc_points >= $this->player_points || $this->pc_points === 21) {
                $this->set_winner("Computer");
                return;
            }
        }

        $this->set_winner("Player");
    }

    public function next_round()
    {
        $this->clear_winner();

        $this->player_points = 0;
        $this->pc_points = 0;
    }
}
