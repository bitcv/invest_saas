<?php
include_once __DIR__ . '/../BaseAction.php';
include_once __DIR__ . '/../../logic/CheckLogic.php';
include_once __DIR__ . '/../../vendor/blcokcypher/BlockCypherUtil.php';

class BuyToken extends BaseAction {
    public function doAction () {
        try {
            $rtn['errcode'] = 104;

            $paramArr = $this->getParam(array('payCurrencySymbol', 'payAmount', 'buyAmount'));
            extract($paramArr);

            $investorId = CheckLogic::checkInvestorLogin($rtn);
            $projId = $_SESSION['projId'];

            // 获取用户信息
            $sql = "SELECT * FROM proj_investor WHERE id=$investorId";
            $investorList = $this->dbSelect($sql);
            if ($investorList == null) {
                throw new Exception('未找到用户信息');
            }
            $investorTokenAddress = $investorList[0]['token_address'];

            // 获取公司信息
            $sql = "SELECT * FROM project WHERE proj_id=$projId";
            $projectList = $this->dbSelect($sql);
            if ($projList == null) {
                throw new Exception('未找到公司信息');
            }
            $projTokenSymbol = $projectList[0]['token_symbol'];
            $projTokenAddress = $projectList[0]['token_address'];
            $projTokenPrivateKey = $projectList[0]['token_private_key'];

            // 获取公司收款钱包
            $sql = "SELECT * FROM proj_wallet WHERE proj_id=$projId AND currency_symbol=$payCurrencySymbol";
            $projWalletList = $this->dbSelect($sql);
            if ($projWalletList == null) {
                throw new Exception('未找到公司收款钱包');
            }
            $outputAddress = $projWalletList[0]['address'];

            // 获取用户付款钱包信息
            $sql = "SELECT * FROM investor_wallet WHERE investor_id=$investorId AND currency_symbol=$payCurrencySymbol";
            $investorWalletList = $this->dbSelect($sql);
            if ($investorWalletList == null) {
                throw new Exception('未找到投资人付款钱包');
            }
            $inputAddress = $investorWalletList[0]['address'];
            $inputPrivateKey = $investorWalletList[0]['private_key'];

            // 获取公司代币汇率信息
            $sql = "SELECT * FROM currency_price WHERE from_currency_symbol=$projTokenSymbol AND to_currency_symbol=eth";
            $currencyPriceList = $this->dbSelect($sql);
            if ($currencyPriceList == null) {
                throw new Exception('未找到代币价格');
            }
            $buyPrice = $currencyPriceList[0]['exchange_rate'];
            // 获取交易货币汇率信息
            $sql = "SELECT * FROM currency_price WHERE from_currency_symbol=$payCurrencySymbol AND to_currency_symbol=eth";
            $currencyPriceList = $this->dbSelect($sql);
            if ($currencyPriceList == null) {
                throw new Exception('未找到代币价格');
            }
            $payPrice = $currencyPriceList[0]['exchange_rate'];
            if ($payPrice * $payAmount != $buyPrice * $buyAmount) {
                throw new Exception('汇率有误');
            }

            // 投资人向公司付款
            $payServiceCharge = BlockCypherUtil::makeTransaction($payCurrencySymbol, $inputAddress, $inputPrivateKey, $outputAddress, $payAmount);
            if ($payServiceCharge === false) {
                throw new Exception('付款失败');
            }

            // 公司向投资人支付代币
            $buyServiceCharge = BlockCypherUtil::makeTransaction($projTokenSymbol, $projTokenAddress, $projTokenPrivateKey, $investorTokenAddress, $buyAmount);
            if ($buyServiceCharge === false) {
                throw new Exception('付款失败');
            }

            // 创建用户购买记录
            $curTime = time();
            $sql = "INSERT INTO investor_purchase_record(investor_id, proj_id, pay_currency_symbol, pay_amount, buy_token_symbol, buy_amount, purchase_time) VALUES($investorId, $projId, $payCurrencySymbol, $payAmount, $projTokenSymbol, $buyAmount, $curTime)";
            $this->dbInsert($sql);

            $rtn['errcode'] = 0;
            $rtn['data'] = array(
                'payCurrencySymbol' => $payCurrencySymbol,
                'payAmount' => $payAmount,
                'payServiceCharge' => $payServiceCharge,
                'payTimestamp' => $curTime,
                'buyTokenSymbol' => $projTokenSymbol,
                'buyAmount' => $buyAmount,
                'buyServiceCharge' => $buyServiceCharge,
                'buyTimestamp' => $curTime,
            );

        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
