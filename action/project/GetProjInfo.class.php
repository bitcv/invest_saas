<?php
include_once __DIR__ . '/../BaseAction.php';
include_once __DIR__ . '/../../logic/CheckLogic.php';

class GetProjInfo extends BaseAction {
    public function doAction () {
        try {
            $rtn['errcode'] = 104;

            $investorId = CheckLogic::checkInvestorLogin($rtn);
            $projId = $_SESSION['projId'];

            // 获取项目基本信息
            $sql = "SELECT * FROM project WHERE id=$projId";
            $projectList = $this->dbSelect($sql);
            if ($projectList == null) {
                throw new Exception('未找到项目信息');
            }
            $projInfo = $projectList[0];
            $projTokenSymbol = $projInfo['token_symbol'];

            // 获取项目Token汇率
            $sql = "SELECT * FROM currency_price WHERE to_currency_symbol='eth' AND from_currency_symbol='$projTokenSymbol'";
            $projTokenPriceList = $this->dbSelect($sql);
            if ($projTokenPriceList == null) {
                throw new Exception('未找到项目token信息');
            }
            $projInfo['token_price'] = $projTokenPriceList[0]['exchange_rate'];

            // 获取项目货币汇率
            $sql = "SELECT * FROM currency_price WHERE to_currency_symbol='eth' AND from_currency_symbol IN (SELECT currency_symbol FROM proj_wallet WHERE proj_id=$projId)";
            $currencyPriceList = $this->dbSelect($sql);
            $currencyPriceArr = array();
            foreach ($currencyPriceList as $currencyPrice) {
                $currencyPriceArr[] = array(
                    'currencySymbol' => $currencyPrice['from_currency_symbol'],
                    'currencyPrice' => $currencyPrice['exchange_rate']
                );
            }

            $rtn['errcode'] = 0;
            $rtn['data'] = array(
                'projInfo' => $projInfo,
                'currencyPriceList' => $currencyPriceArr,
            );

        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
