<?php
function correct_pagination_numbers($cp, $pp, $counter)
{
    $c = (($pp * $cp) + $counter) - $pp;
    return $c;
}
?>
