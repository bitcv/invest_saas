<?php
class CheckLogic {
    public static function checkInvestorLogin (&$rtn) {
        $projId = $_SESSION['projId'];
        $investorId = $_SESSION['investorId'];
        $investorSign = $_SESSION['investorSign'];
        $sign = md5("projId-$projId&investorId$investorId&kingco");
        if ($investorSign != $sign) {
            $rtn['errcode'] = 102;
            throw new Exception('未登录');
        }
        return $investorId;
    }
}
