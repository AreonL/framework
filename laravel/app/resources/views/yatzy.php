<?php

/**
 * Standard view template to generate a simple web page, or part of a web page.
 */

declare(strict_types=1);

namespace AreonL\Controller;

use function Mos\Functions\url;

$header = "Yatzy";
$message = $message ?? null;
$end = $_SESSION["end"] ?? null;
$action = $action ?? url("/yatzy/game");
$yatzy = $yatzy ?? null;
$dh = $dh ?? null;
$roll = $roll ?? null;
$select1 = $_SESSION["select1"] ?? null;
$select2 = $_SESSION["select2"] ?? null;
$select3 = $_SESSION["select3"] ?? null;
$select4 = $_SESSION["select4"] ?? null;
$select5 = $_SESSION["select5"] ?? null;
$select6 = $_SESSION["select6"] ?? null;
$summa = $_SESSION["summa"];
$bonus = $_SESSION["bonus"] ?? 0;

?><h1><?= $header ?></h1>

<p><?= $message ?></p>

<!-- If first visit -->
<?php if ($end) : ?>
    <p>The end</p>
    <p>Total sum: <?= $bonus + $summa ?></p>
<?php elseif ($yatzy) : ?>
<form method="post" action="<?= $action ?>">
    <p>
        <input type="hidden" name="firstRoll" value="firstRoll">
        <input type="submit" value="Play">
    </p>
</form>
<!-- If pressed play -->
<?php elseif ($roll) : ?>
<p class="dices"><?= $dh ?></p>
<form method="post" action="<?= $action ?>">
    <p>
        <input type="hidden" name="roll" value="roll">
        <?php if ($_SESSION["rollCounter"] < 3) : ?>
        <input type="checkbox" name="check[]" value="0" checked="checked">
        <input type="checkbox" name="check[]" value="1" checked="checked">
        <input type="checkbox" name="check[]" value="2" checked="checked">
        <input type="checkbox" name="check[]" value="3" checked="checked">
        <input type="checkbox" name="check[]" value="4" checked="checked">
        <br>
        <br>
        <input type="submit" value="Roll selected">
        <br>
        <?php endif; ?>
        <p>
            <label>1:or</label>
            <?php if (is_null($select1)) : ?>
            <input type="checkbox" name="selection[]" value="1">
            <?php else :?>
                = <?= $select1 ?>
            <?php endif; ?>
        </p>
        <p>
            <label>2:or</label>
            <?php if (is_null($select2)) : ?>
            <input type="checkbox" name="selection[]" value="2">
            <?php else :?>
                = <?= $select2 ?>
            <?php endif; ?>
        </p>
        <p>
            <label>3:or</label>
            <?php if (is_null($select3)) : ?>
            <input type="checkbox" name="selection[]" value="3">
            <?php else :?>
                = <?= $select3 ?>
            <?php endif; ?>
        </p>
        <p>
        <label>4:or</label>
            <?php if (is_null($select4)) : ?>
            <input type="checkbox" name="selection[]" value="4">
            <?php else :?>
                = <?= $select4 ?>
            <?php endif; ?>
        </p>
        <p>
        <label>5:or</label>
            <?php if (is_null($select5)) : ?>
            <input type="checkbox" name="selection[]" value="5">
            <?php else :?>
                = <?= $select5 ?>
            <?php endif; ?>
        </p>
        <p>
        <label>6:or</label>
            <?php if (is_null($select6)) : ?>
            <input type="checkbox" name="selection[]" value="6">
            <?php else :?>
                = <?= $select6 ?>
            <?php endif; ?>
        </p>
        <p>Summa: <?= $summa ?></p>
        <p>Bonus: <?= $bonus ?></p>
        <p>Total: <?= $bonus + $summa ?></p>
        <input type="submit" value="Select">
    </p>
</form>
<?php endif; ?>