<?php
include_once('../wp-config.php');
$xml = file_get_contents('http://mebel.ankona.net/export.xml');
file_put_contents($_SERVER['DOCUMENT_ROOT'] . '/wp-export/export.xml', $xml);
