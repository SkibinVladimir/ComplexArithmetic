<?php
require (__DIR__ . '/ComplexArithmetic.php');
$complexArithmetic = new ComplexArithmetic();


$nom1 = (object) ['x' => 1, 'y' => 2];

$nom2 = (object) ['x' => 0, 'y' => 0];


$sum = $complexArithmetic->add($nom1, $nom2);

$diff = $complexArithmetic->sub($nom1, $nom2);

$prod = $complexArithmetic->mult($nom1, $nom2);

$quot = $complexArithmetic->div($nom1, $nom2);


echo "<p>
nom1 = <i>{$complexArithmetic->toStr($nom1)}</i><br>
nom2 = <i>{$complexArithmetic->toStr($nom2)}</i><br>
<hr>
add = <i>{$complexArithmetic->toStr($sum)}</i><br>
diff = <i>{$complexArithmetic->toStr($diff)}</i><br>
prod = <i>{$complexArithmetic->toStr($prod)}</i><br>
quot = <i>{$complexArithmetic->toStr($quot)}</i><br>
</p>";