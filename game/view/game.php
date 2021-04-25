<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

use function Mos\Functions\{
  url
};

?>

<h1>Game 21</h1>
<form method="POST" action="<?= url("/game/reset") ?>">
  <button type="submit">Reset</button>
</form>

<br>

<?php if (!$game->get_dice_amount()) { ?>
  <form method="POST" action="<?= url("/game/set-dice") ?>">
    <button type="submit" name="dice" value="1">Play with 1 dice</button>
    <button type="submit" name="dice" value="2">Play with 2 dice</button>
  </form>
<?php } else { ?>
    <p><b>Wins player:</b> <?= $game->get_player_wins() ?> <b>Wins computer:</b> <?= $game->get_pc_wins() ?></p>
    <p><b>Points player:</b> <?= $game->get_player_points() ?><br><b>Points computer:</b> <?= $game->get_pc_points() ?></p>
    
    <?php if ($game->get_winner()) { ?>
        <?php if ($game->get_winner() === "Player") { ?>
            <h3>You won, congratulations!</h3>
        <?php } else if ($game->get_winner() === "Computer") { ?>
            <h3>You lost, nooo..</h3>
        <?php } ?>

    <form method="POST" action="<?= url("/game/next-round") ?>">
      <button type="submit">Next round</button>
    </form>
    <?php } else { ?>
    <form style="display: inline-block;" method="POST" action="<?= url("/game/throw") ?>">
      <button type="submit">Throw</button>
    </form>
    <form style="display: inline-block;" method="POST" action="<?= url("/game/stop") ?>">
      <button type="submit">Stop</button>
    </form>

    <div class="clearfix">
        <?php foreach ($game->get_hand()->get_dice() as $dice) { ?>
            <span style="float: left;">
            <?= $dice->render() ?>
        </span>
        <?php } ?>
    </div>
    <?php } ?>
<?php } ?>