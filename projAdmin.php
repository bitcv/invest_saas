<?php
include_once __DIR__ . '/lib/common.php';

$page = $_GET['page'];

include_once __DIR__ . '/view/projAdmin/' . $page . '.html';
