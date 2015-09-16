<?php
define(CORE_PATH, '/var/www/html/Application/Core/');
define(CONTROLLER_PATH, '/var/www/html/Application/Controller/');
define(VIEW_PATH, '/var/www/html/Application/View/');
// Smartyパス設定
define('SMARTY_PATH', '/var/www/Smarty/');
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