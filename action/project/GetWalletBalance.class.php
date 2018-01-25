<?php
include_once __DIR__ . '/../BaseAction.php';
include_once __DIR__ . '/../../logic/CheckLogic.php';
include_once __DIR__ . '/../../vendor/blcokcypher/BlockCypherUtil.php';

class GetWalletBallance extends BaseAction {
    public function doAction () {
        try {
            $rtn['errcode'] = 104;

            // 获取投资人ID
            $investorId = CheckLogic::checkInvestorLogin($rtn);

            // 获取临时钱包余额
            $sql = "SELECT * FROM investor_wallet WHERE investor_id=$investorId";
            $walletList = $this->dbSelect($sql);
            $balanceList = array();
            foreach ($walletList as $wallet) {
                $currencySymbol = $wallet['currency_symbol'];
                $address = $wallet['address'];
                $balance = BlockCypherUtil::getBalance($currencySymbol, $address);
                if ($balance === false) {
                    throw new Exception('获取钱包余额失败');
                }
                $balanceList[] = array(
                    'currencySymbol' => $currencySymbol,
                    'balance' => $balance,
                );
            }

            $rtn['errcode'] = 0;
            $rtn['data']['balanceList'] = $balanceList;

        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
