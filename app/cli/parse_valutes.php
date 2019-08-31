<?php

require(PATH_TO_APP . '/bootstrap.php');

$url = 'http://www.cbr.ru/scripts/XML_daily.asp';

$curlResource = curl_init();
curl_setopt($curlResource, CURLOPT_URL, $url);
curl_setopt($curlResource, CURLOPT_RETURNTRANSFER, true);
$xml = curl_exec($curlResource);
curl_close($curlResource);

try {
    $db = new PDO($config['database']['dsn'], $config['database']['user'], $config['database']['password']);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
    
$valutesXML = new SimpleXMLElement($xml);

$sql = 'REPLACE INTO currency SET id = ?, name = ?, rate = ?';
$pdoStatePrepared = $db->prepare($sql);

foreach ($valutesXML->Valute as $valute) {
    $valutes[] = [
        'id' => reset($valute['ID']),
        'name' => htmlspecialchars_decode(reset($valute->Name)),
        'rate' => reset($valute->Value)
    ];
    $id = reset($valute['ID']);
    $name = reset($valute->Name);
    $rate = floatval(str_replace(',','.',reset($valute->Value)));

    $options = [$id, $name, $rate];

    // print_r($options);
    $pdoStatePrepared->execute($options);
}