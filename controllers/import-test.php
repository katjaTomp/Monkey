<?php
//import -test

if($_SERVER['REQUEST_METHOD']=='POST'){
$locals=array('GB'=>'GB','DE'=>'DE','NL'=>'NL','FR'=>'FR','IT'=>'IT','ES'=>'ES','BE'=>'BE','IE'=>'IE','AT'=>'AT','DK'=>'DK','FI'=>'FI','SE'=>'SE','PL'=>'PL','SK'=>'SK','CZ'=>'CZ','RU'=>'RU');
$intersection=array_intersect($_POST, $locals);

var_dump($intersection);
}
?>