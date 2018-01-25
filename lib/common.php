<?php
date_default_timezone_set('PRC');
session_start();

class BaseUtil {
    public static function curlRequest($url, $method = 'get', $data = array()) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
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
