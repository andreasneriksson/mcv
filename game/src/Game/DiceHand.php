<?php

namespace Aner\Game;

/**
 * 21 Game, class DiceHand
*/

class DiceHand
{
    private int $dice_sides = 6;
    private int $dice_amount;
    private array $dice = [];

    public function __construct($dice_amount)
    {
        $this->set_dice_amount($dice_amount);
    }

    /** Setters */

    public function set_dice_amount(int $dice_amount)
    {
        $this->dice_amount = $dice_amount;

        $this->dice = [];

        for ($i = 0; $i < $dice_amount; $i++) {
            $dice = new GraphicalDice($this->dice_sides);
            array_push($this->dice, $dice);
        }
    }

    /** Getters */

    public function get_dice_amount()
    {
        return $this->dice_amount;
    }

    public function get_dice()
    {
        return $this->dice;
    }

    public function get_last_results()
    {
        return array_map(function ($dice) {
            return $dice->get_last_throw();
        }, $this->dice);
    }

    public function get_last_result()
    {
        $results = $this->get_last_results();

        return array_sum($results);
    }

    /** Functionality */

    public function throw_dice()
    {
        foreach ($this->dice as $dice) {
            $dice->throw_dice();
        }

        return $this->dice;
    }
}
