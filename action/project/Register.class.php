<?php
include_once __DIR__ . '/../BaseAction.php';

class Register extends BaseAction {
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

            $sql = "SELECT * FROM proj_investor WHERE proj_id='$projId' and account='$account'";
            $projInvestorList = $this->dbSelect($sql);
            if ($projInvestorList != null) {
                $rtn['errcode'] = 101;
                throw new Exception('账号已注册');
            }
            $projInvestor = $projInvestorList[0];

            $passwdMd5 = md5($passwd);
            $sql = "INSERT INTO proj_investor(proj_id, account, passwd) VALUES($projId, '$account', '$passwdMd5')";
            $userId = $this->dbInsert($sql);

            $rtn['errcode'] = 0;
        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
