<?php
include_once __DIR__ . '/../BaseAction.php';

class InitProjInfo extends BaseAction {
    public function doAction () {
        try {
            $rtn['errcode'] = 104;

            $paramArr = $this->getParam(array('projId', 'projSign'));
            extract($paramArr);

            // 验证签名是否正确
            $sign = md5($projId . 'kingco');
            if ($sign != $projSign) {
                $rtn['errcode'] = 101;
                throw new Exception('未找到项目信息');
            }

            // 获取项目信息
            $sql = "SELECT * FROM project WHERE id=$projId";
            $projInfoList = $this->dbSelect($sql);
            if ($projInfoList == null) {
                $rtn['errcode'] = 101;
                throw new Exception('未找到项目信息');
            }
            $projInfo = $projInfoList[0];

            // 设置session
            $_SESSION['projId'] = $projInfo['id'];

            // 获取项目亮点信息
            $sql = "SELECT * FROM proj_advantage WHERE proj_id=$projId";
            $projAdvantageList = $this->dbSelect($sql);
            $projInfo['advantageList'] = $projAdvantageList;

            // 获取团队信息
            $sql = "SELECT * FROM proj_member WHERE proj_id=$projId";
            $projMemberList = $this->dbSelect($sql);
            $projInfo['projMemberList'] = $projMemberList;

            // 获取里程碑
            $sql = "SELECT * FROM proj_milestone WHERE proj_id=$projId";
            $projMilestoneList = $this->dbSelect($sql);
            $projInfo['milestoneList'] = $projMilestoneList;

            // 获取媒体报道
            $sql = "SELECT * FROM proj_report WHERE proj_id=$projId";
            $projReportList = $this->dbSelect($sql);
            $projInfo['reportList'] = $projReportList;

            $rtn['errcode'] = 0;
            $rtn['data'] = $projInfo;

        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
