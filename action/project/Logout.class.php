<?php
include_once __DIR__ . '/../BaseAction.php';

class Logout extends BaseAction {
    public function doAction () {
        try {
            $rtn['errcode'] = 104;

            unset($_SESSION['investorId']);
            unset($_SESSION['investorSign']);

            $rtn['errcode'] = 0;
        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
