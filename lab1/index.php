<!-- Арифметические операции. 
 Дано: $a = 27; $b = 12; 
 Найти: Значение гипотенузы с точностью до двух знаков после запятой -->

<?php

$a = 27;
$b = 12;

$c = sqrt($a**2+$b**2);

echo round($c, 2).'<BR>';

// Конкатенация. 
// Дано: $give = 'Дают';$take = 'бери'; $beat = 'бьют'; $run = 'беги'; 
// Найти: Собрать поучающую пословицу, используя операцию 'Конкатенация' и заданные переменные.

$give = 'Дают';
$take = 'бери'; 
$beat = 'бьют'; 
$run = 'беги';

echo ("$beat "."$run "."$give "."$take").'<BR>';

// Округление. 
// Дано: $a = 5.7;$b = 8.3; $c = '5.6'; $d = '9.2кг'; 
// Найти: Значение пола и потолка переменных. Выполнить арифмитеческое округление переменных.

$a = 5.7;
$b = 8.3; 
$c = '5.6'; 
$d = '9.2кг';

echo (" Пол - ").floor($a).(" Потолок - ").ceil($a).'<BR>';
echo (" Пол - ").floor($b).(" Потолок - ").ceil($b).'<BR>';
echo (" Пол - ").floor($c).(" Потолок - ").ceil($c).'<BR>';
echo (" Пол - ").floor((float)$d).(" Потолок - ").ceil((float)$d).'<BR>';

// Тернарный оператор. 
// Дано: $a = 36; $b = '4'; 
// Найти: Если остаток от деления $a на $b больше 0, 
// то вывести сообщение с типом данных результата деления $a на $b и остаток от деления, 
// иначе вывести выражение деления и результат (образец: 2 / 2 = 1). Используем тернарный оператор.

$a = 36; 
$b = '4';
$c = ($a % $b) > 0 ? gettype($c).($a % $b) : "($a / $b) = ".($a / $b);
print $c.'<BR>';

// Циклы. 
// Найти: Посчитать сумму первых пяти членов натурального ряда. 
// Выполнить в цикле счетчике.

$S = 0;
$a = 0;

while ($a < 5) {
    $a++;
    $S = $S + $a;
}

print "S=$S"."<BR>";