<!-- 1. На карманы при замене Дана строка вида 'a1b2c3'. 
Напишите регулярку, которая найдет все цифры и удвоит 
их количество таким образом: 'a11b22c33' 
(то есть рядом с каждой цифрой напишет такую же). -->

<?php
$str = 'a1b2c3';
// Заменяем каждую цифру на саму себя дважды
$result = preg_replace_callback('/\d/', function($matches) {
    return $matches[0] . $matches[0];
}, $str);

echo $result.'<BR>'.'<BR>';


// 10. Задачи на preg_match[_all] 
// Задачи не всегда можно решить с помощью одной только регулярки. 
// Может понадобится еще что-нибудь дописать на PHP (не всегда, но такое может быть). 
// С помощью preg_match определите, что переданная строка является доменом. 
// Протокол может быть как http, так и https. 
// Домен может быть со слешем в конце: http://site.ru, http://site.ru/, https://site.ru, https://site.ru/.

function isValidDomain($url) {
    return preg_match('#^https?://[a-z0-9\-]+\.[a-z]{2,}(/)?$#i', $url);
}

// Примеры проверки
$tests = [
    'http://site.ru',
    'https://site.ru/',
    'http://site.com',
    'https://site.org/',
    'ftp://site.ru',           //невалидный
    'http://site',             //невалидный
    'https://site.toolongext', //невалидный
];

foreach ($tests as $test) {
    echo $test . ' — ' . (isValidDomain($test) ? '✅ валидный' : '❌ невалидный') . "<br>";
}
echo '<BR>';


// 15. На обратный слеш \ Дана строка 'a\a abc'. 
// Напишите регулярку, которая заменит строку 'a\a' на '!'.

$str = 'a\\a abc';
$result = preg_replace('/a\\\\a/', '!', $str);
echo $result.'<BR>'.'<BR>';


// 30. Задачи на preg_replace С помощью preg_replace 
// замените в строке домены вида http://site.ru, http://site.com на site.ru.

$str = 'Сайты: http://site.ru, http://site.com';
$result = preg_replace('#http://([a-z0-9\.-]+\.[a-z]{2,})#i', '$1', $str);
echo $result.'<BR>'.'<BR>';


// 49. На '+', '*', '?', () Дана строка 'aa aba abba abbba abca abea'. 
// Напишите регулярку, которая найдет строки aa, aba по шаблону: 
// буква 'a', буква 'b' один раз или ниодного, буква 'a'.

$str = 'aa aba abba abbba abca abea';
preg_match_all('/ab?a/', $str, $matches);
echo implode('<br>', $matches[0]) . '<br><br>';


// 62. На [], '^' - не, [a-zA-Z], кириллицу Напишите регулярку, которая найдет строки следующего вида: 
// по краям стоят буквы 'a', а между ними - буква от a до f и от A до Z.

$str = 'aAa aba aZa aga a1a a*a afa aGa';
preg_match_all('/a[a-fA-Z]a/', $str, $matches);
echo implode('<br>', $matches[0]);
?>