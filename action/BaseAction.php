<?php
include_once __DIR__ . '/../model/DB.class.php';

class BaseAction {
    private $mysql;

    public function getParam ($paramArr) {
        $result = array();
        foreach ($paramArr as $value) {
            $result[$value] = isset($_REQUEST[$value]) ? $_REQUEST[$value] : null;
            if ($result[$value] === null) {
                $errJson = json_encode(array(
                    'errcode' => 100,
                    'errmsg' => 'Param error',
                ));
                throw new Exception($errJson);
            }
        }
        return $result;
    }

    public function dbSelect ($sql) {
        if (!$this->mysql) {
            $this->mysql = new DB();
        }
        return $this->mysql->select($sql);
    }

    public function dbInsert ($sql) {
        if (!$this->mysql) {
            $this->mysql = new DB();
        }
        return $this->mysql->insert($sql);
    }

    public function dbUpdate ($sql) {
        if (!$this->mysql) {
            $this->mysql = new DB();
        }
        return $this->mysql->update($sql);
    }

    public function writeLog ($e, &$rtn) {
        $errmsg = $e->getMessage();
        $errArr = json_decode($errmsg, true);
        if ($errArr) {
            $rtn['errcode'] = $errArr['errcode'];
            $errmsg = $errArr['errmsg'];
        }
        $logArr = array(
            'Time' => date("Y-m-d H:i:s", time()),
            'File' => $e->getFile(),
            'Line' => $e->getLine(),
            'Error' => $errmsg,
        );
        $logStr = json_encode($logArr, JSON_UNESCAPED_UNICODE);
        $logStr = stripslashes($logStr) . "\n";
        file_put_contents(__DIR__ . '/../log/error.log', $logStr, FILE_APPEND);
    }

    public function curlRequest($url, $method = 'get', $data = array()) {
        $ch = curl_init();
        // 结果作为返回值由变量接收
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 不显示header
        curl_setopt($ch, CURLOPT_HEADER, 0);
        if ($method == 'post') {
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        } else if ($method == 'get') {
            if (is_array($data) && $data != null) {
                $url = $url . '?' . http_build_query($data);
            }
            curl_setopt($ch, CURLOPT_URL, $url);
        }
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            return false;
        }
        curl_close($ch);
        return $result;
    }
}
