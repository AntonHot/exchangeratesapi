<?php

namespace Mvc\Controllers;

class CurrenciesController extends BaseController {

    public function exec($params) {
        $count = $params['count'];
        $page = $params['page'];
        $offset = $count * ($page - 1);

        $sql = 'SELECT * FROM ' . $this->_table;

        if (isset($count)) {
            $limit = ' LIMIT ' . $count . ' OFFSET ' . $offset;
            $sql .= $limit;
        }

        $pdoStatePrepared = $this->_db->prepare($sql);
        $pdoStatePrepared->execute();
        $resultRaw = $pdoStatePrepared->fetchAll();

        foreach ($resultRaw as $row) {
            $result[] = [
                'id' => $row['id'],
                'name' => $row['name'],
                'rate' => $row['rate']
            ];
        }

        http_response_code(200);
        $this->setHeaders();
        echo json_encode($result, JSON_FORCE_OBJECT | JSON_UNESCAPED_UNICODE);
    }
}