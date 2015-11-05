<?php
define(DIR_PATH, dirname(__FILE__));
define(CORE_PATH, DIR_PATH . '/Application/Core/');
define(CONTROLLER_PATH, DIR_PATH . '/Application/Controller/');
define(VIEW_PATH, DIR_PATH . '/Application/View/');
// Smartyパス設定
define('SMARTY_PATH', DIR_PATH . '/Smarty/');
define('SMARTY_COMPIlE_DIR', SMARTY_PATH . 'compile/');
define('SMARTY_CACHE_DIR', SMARTY_PATH . 'chache/');

require_once(CORE_PATH . 'AutoLoader.php');

// オートローダー
Core_AutoLoader::setup();

// ルーティング、ディスパッチなど
$request = new Core_Request();
$request->setup();
$request->dispatch();

exit;