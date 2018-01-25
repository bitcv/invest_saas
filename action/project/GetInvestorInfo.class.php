<?php
include_once __DIR__ . '/../BaseAction.php';
include_once __DIR__ . '/../../logic/CheckLogic.php';

class GetInvestorInfo extends BaseAction {
    public function doAction () {
        try {
            $rtn['errcode'] = 104;

            $investorId = CheckLogic::checkInvestorLogin($rtn);

            // 获取投资人信息
            $sql = "SELECT * FROM proj_investor WHERE id=$investorId";
            $projInvestorList = $this->dbSelect($sql);
            if ($projInvestorList == null) {
                $rtn['errcode'] = 102;
                throw new Exception('未找到投资人信息');
            }
            $projInvestor = $projInvestorList[0];

            $rtn['errcode'] = 0;
            $rtn['data'] = $projInvestor;

        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
