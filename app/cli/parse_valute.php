<?php

use Libs\Db;

$url = 'http://www.cbr.ru/scripts/XML_daily.asp';

$curlResource = curl_init();
curl_setopt($curlResource, CURLOPT_URL, $url);
curl_setopt($curlResource, CURLOPT_RETURNTRANSFER, true);
$xml = curl_exec($curlResource);
curl_close($curlResource);

$valuteXML = new SimpleXMLElement($xml);

$db = Db::getInstance();
$sql = 'REPLACE INTO currency SET id = ?, name = ?, rate = ?';
$pdoStatePrepared = $db->prepare($sql);

foreach ($valuteXML->Valute as $valuta) {
    $id = reset($valuta['ID']);
    $name = reset($valuta->Name);
    $rate = floatval(str_replace(',','.',reset($valuta->Value)));
    $options = [$id, $name, $rate];
    $pdoStatePrepared->execute($options);
}