<?php
include_once __DIR__ . '/../BaseAction.php';

class Apply extends BaseAction {
    public function doAction () {
        try {
            $rtn['errcode'] = 104;


            $paramArr = $this->getParam(array(
                'title',
                'intro',
                'tokenName',
                'tokenUnit',
                'tokenPrice',
                'startTime',
                'endTime',
                'advantage',
                'advantageDetail',
                'planMoney',
                'companyName',
                'companyAddr',
                'companyEmail',
                'memberName',
                'memberPosition',
                'memberIntro',
            ));
            extract($paramArr);
            $curTime = time();

            // 获取公司logo
            $tmpPath = $_FILES['companyLogo']['tmp_name'];
            $logoName = 'companyLogo' . $title . time() . '.jpg';
            if(!move_uploaded_file($tmpPath, __DIR__ . '/../../static/logo/' . $logoName)){
                $rtn['errcode'] = 100;
                throw new Exception('获取logo失败');
            }

            // 获取项目白皮书
            $tmpPath = $_FILES['whitePaper']['tmp_name'];
            $fileName = 'whitePaper' . $title . time() . '.pdf';
            if(!move_uploaded_file($tmpPath, __DIR__ . '/../../static/whitePaper/' . $fileName)){
                $rtn['errcode'] = 100;
                throw new Exception('获取whitePaper失败');
            }

            // 创建项目
            $sql = "INSERT INTO project(title, intro, token_name, plan_money, white_paper, company_name, company_logo, company_addr, company_email) VALUES('$title', '$intro', '$tokenName', $planMoney, '$fileName', '$companyName', '$logoName', '$companyAddr', '$companyEmail')";
            $projId = $this->dbInsert($sql);
            $projSign = md5($projId . 'kingco');
            $projUrl = "/project.php?page=home&projId=$projId&projSign=$projSign";
            $adminUrl = "/projAdmin.php?page=admin&projId=$projId&projSign=$projSign";

            // 插入项目亮点
            $sql = "INSERT INTO proj_advantage(proj_id, title, detail) VALUES($projId, '$advantage', '$advantageDetail')";
            $this->dbInsert($sql);

            // 插入项目成员
            $sql = "INSERT INTO proj_member(proj_id, name, position, intro) VALUES($projId, '$memberName', '$memberPosition', '$memberIntor')";
            $this->dbInsert($sql);

            // 插入项目里程碑
            $sql = "INSERT INTO proj_milestone(proj_id, timestamp, title, detail) VALUES($projId, $curTime, 'BitCv平台上交易数字货币', '在BitCv生成个性化项目和交易主页，拥有自己的数字货币交易平台')";
            $this->dbInsert($sql);

            // 插入项目报道
            $sql = "INSERT INTO proj_report(proj_id, url) VALUES($projId, 'www.baidu.com')";
            $this->dbInsert($sql);
            
            // 创建项目管理员账号
            $adminPasswd = mt_rand(100000, 999999);
            $initialPasswd = md5($adminPasswd);
            $sql = "INSERT INTO proj_admin(proj_id, nickname, account, passwd) VALUES($projId, '管理员', '$companyEmail', '$initialPasswd')";
            $this->dbInsert($sql);

            $rtn['errcode'] = 0;
            $rtn['data'] = array(
                'projId' => $projId,
                'projUrl' => $projUrl,
                'adminUrl' => $adminUrl,
                'adminAccount' => $companyEmail,
                'adminPasswd' => $adminPasswd,
            );

        } catch (Exception $e) {
            $this->writeLog($e, $rtn);
        }

        return $rtn;
    }
}
