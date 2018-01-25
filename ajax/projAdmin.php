<?php
include_once __DIR__ . '/../lib/common.php';

$action = $_GET['action'] ?: null;
if ($action === null) {
    exit('Wrong action');
}
$dir = __DIR__ . '/../action/admin/' . ucfirst($action) . 'Action.php';
$isExist = include_once __DIR__ . '/../action/admin/' . ucfirst($action) . 'Action.php';
if (!$isExist) {
    exit('Wrong action');
}
$actionClass = ucfirst($action) . 'Action'; 
$action = new $actionClass;
$rtn = $action->doAction();
echo json_encode($rtn);
