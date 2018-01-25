<?php
include_once __DIR__ . '/../BaseAction.php';

class Login extends BaseAction {
    public function doAction () {
        try {
            $rtn['errcode'] = 104;

            $paramArr = $this->getParam(array('account', 'passwd'));
            extract($paramArr);

            // 获取项目ID
            $projId = $_SESSION['projId'];
            if ($projId == null) {
                $rtn['errcode'] = 101;
                throw new Exception('未找到相关项目');
            }

            //验证账号是否存在
            $sql = "SELECT * FROM proj_investor WHERE proj_id=$projId and account='$account'";
            $projInvestorList = $this->dbSelect($sql);
            if ($projInvestorList == null) {
                $rtn['errcode'] = 102;
                throw new Exception('未找到投资人信息');
            }
            $projInvestor = $projInvestorList[0];

            //验证密码是否正确
            $passwdMd5 = md5($passwd);
            if ($passwdMd5 != $projInvestor['passwd']) {
                $rtn['errcode'] = 102;
                throw new Exception('密码输入错误');
            }

            $investorId = $projInvestor['id'];
            $_SESSION['investorId'] = $investorId;
            $sign = md5("projId-$projId&investorId$investorId&kingco");
            $_SESSION['investorSign'] = $sign;

            $rtn['errcode'] = 0;
        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
