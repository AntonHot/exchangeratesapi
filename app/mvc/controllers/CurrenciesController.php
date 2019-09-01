<?php

namespace Mvc\Controllers;

use Libs\Db;

class CurrenciesController {

    public function exec($params) {
        $db = Db::getInstance();

        $count = $params['count'];
        $page = $params['page'];
        $offset = $count * ($page - 1);

        $sql = 'SELECT * FROM currency';

        if (isset($count)) {
            $limit = ' LIMIT ' . $count . ' OFFSET ' . $offset;
            $sql .= $limit;
        }

        $pdoStatePrepared = $db->prepare($sql);
        $pdoStatePrepared->execute();
        $resultRaw = $pdoStatePrepared->fetchAll();

        foreach ($resultRaw as $row) {
            $result[] = [
                'name' => $row['name'],
                'rate' => $row['rate']
            ];
        }

        echo json_encode($result, JSON_FORCE_OBJECT);
    }

}