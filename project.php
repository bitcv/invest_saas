<?php
include_once __DIR__ . '/lib/common.php';

$page = $_GET['page'];

switch ($page) {
    case 'home':
        $isExist = include_once __DIR__ . '/action/project/InitProjInfo.class.php';
        if ($isExist) {
            $action = new InitProjInfo;
            $rtn = $action -> doAction();
            if ($rtn['errcode'] == 0) {
                extract($rtn['data']);
                include_once __DIR__ . '/view/project/home.html';
            } else {
                echo json_encode($rtn);
            }
        }
        break;
    case 'profile':
        $isLogin = checkInvestorLogin();
        if (!$isLogin) {
            header('Location: project.php?page=login');
        } else {
            include_once __DIR__ . '/view/project/' . $page . '.html';
        }
        break;
    default:
        include_once __DIR__ . '/view/project/' . $page . '.html';
        break;
}

function checkInvestorLogin () {
        $projId = $_SESSION['projId'];
        $investorId = $_SESSION['investorId'];
        $investorSign = $_SESSION['investorSign'];
        $sign = md5("projId-$projId&investorId$investorId&kingco");
        if ($investorSign != $sign) {
            return false;
        }
        return true;
}
