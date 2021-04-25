<?php

namespace Aner\Game;

/**
 * 21 Game, class Dice
*/

class Dice
{
    private int $sides;
    private ?int $last_throw = null;

    public function __construct($sides)
    {
        $this->set_sides($sides);
    }

    /** Setters */

    public function set_sides(int $sides)
    {
        $this->sides = $sides;
    }


    /** Getter */

    public function get_sides()
    {
        return $this->sides;
    }

    public function get_last_throw()
    {
        return $this->last_throw;
    }

    /** Functionality */

    public function throw_dice()
    {
        $this->last_throw = rand(1, $this->sides);

        return $this->last_throw;
    }
}
