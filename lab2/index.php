<!-- 27 - X = 17 -->
<?php

function solve_equation($a, $b) {
    
    $X = $a - $b;
    return $X;
}

$a = 27;
$b = 17;

$X = solve_equation($a, $b);

echo "х = " . $X;

?>