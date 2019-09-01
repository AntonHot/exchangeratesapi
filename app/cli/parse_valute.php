<?php

use Libs\Db;

require_once(__DIR__ . '/../bootstrap.php');

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

$i = 0;
foreach ($valuteXML->Valute as $valuta) {
    $id = reset($valuta['ID']);
    $name = reset($valuta->Name);
    $rate = floatval(str_replace(',','.',reset($valuta->Value)));
    $options = [$id, $name, $rate];
    $result = $pdoStatePrepared->execute($options);
    if ($result) {
        $i++;
    }
}

http_response_code(200);
echo json_encode(array(
    'Обновлено котировок' => $i
), JSON_UNESCAPED_UNICODE);
