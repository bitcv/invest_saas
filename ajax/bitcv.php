<?php
include_once __DIR__ . '/../lib/common.php';

$action = $_GET['action'] ?: null;
if ($action === null) {
    exit('Wrong action');
}
$isExist = include_once __DIR__ . '/../action/bitcv/' . ucfirst($action) . '.class.php';
if (!$isExist) {
    exit('Wrong action');
}
$actionClass = ucfirst($action);
$action = new $actionClass;
$rtn = $action->doAction();
echo json_encode($rtn);
