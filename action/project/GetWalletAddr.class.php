<?php
include_once __DIR__ . '/../BaseAction.php';
include_once __DIR__ . '/../../logic/CheckLogic.php';
include_once __DIR__ . '/../../vendor/blcokcypher/BlockCypherUtil.php';

class GetWalletAddr extends BaseAction {
    public function doAction () {
        try {
            $rtn['errcode'] = 104;

            $paramArr = $this->getParam(array('currencySymbol'));
            extract($paramArr);

            // 获取投资人ID
            $investorId = CheckLogic::checkInvestorLogin($rtn);

            $sql = "SELECT * FROM investor_wallet WHERE investor_id=$investorId and currency_symbol=$currencySymbol";
            $walletList = $this->dbSelect($sql);

            if ($walletList == null) {
                $walletInfo = BlockCypherUtil::createWallet($currencySymbol);
                if ($walletInfo === false) {
                    throw new Exception('创建钱包失败');
                }
                $privateKey = $walletInfo['private'];
                $publicKey = $walletInfo['public'];
                $address = $walletInfo['address'];
                $wif = isset($walletInfo['wif']) ? $walletInfo['wif'] : '';
                $curTime = time();
                $sql = "INSERT INTO investor_wallet(investor_id, wallet_type, private_key, public_key, address, wif, ctime) VALUES($investorId, $currencySymbol, '$privateKey', '$publicKey', '$address', '$wif' $curTime)";
                $this->dbInsert($sql);
                $rtn['data']['address'] = $address;
            } else {
                $rtn['data']['address'] = $walletList[0]['address'];
            }

            $rtn['errcode'] = 0;

        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
