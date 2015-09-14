<?php

require_once(SMARTY_PATH . 'smarty-3.1.24/libs/Smarty.class.php');

/**
 * ルーティングやディスパッチを行う
 */
class Core_Request
{
	/**
	 * リクエストURL : クラス名
	 * @var int
	 */
	const INDEX_CLASS = 1;

	/**
	 * リクエストURL : メソッド名
	 * @var int
	 */
	const INDEX_METHOD = 2;

	/**
	 * コンストラクタ
	 */
	public function __construct()
	{
		$this->request_url = $_SERVER['REQUEST_URI'];
	}

	/**
	 * URLからの解析やviewの初期化を行う
	 * ルーティング:URLからファイルの名前を取得する（整形する）処理
	 */
	public function setup()
	{
		// ルーティング
		$class_info = explode('/', $this->request_url);
		$this->class_name = ucfirst(strtolower($class_info[self::INDEX_CLASS]));
		$this->method = strtolower($class_info[self::INDEX_METHOD]);
		// Smartyを初期化
		$this->objSmarty = new Smarty();
		$this->objSmarty->compile_dir = SMARTY_COMPIlE_DIR;
		$this->objSmarty->cache_dir = SMARTY_CACHE_PATH;
		$this->objSmarty->template_dir = VIEW_PATH . $this->class_name;
	}

	/**
	 * URLからの解析や振り分けを行う
	 *
	 * ディスパッチ:ルーティング後、そのファイルに遷移（振分）する処理
	 */
	public function dispatch()
	{
		$class = 'Controller_' . $this->class_name;
		$method = $this->method;
		// ディスパッチ
		$instance = new $class();
		$instance->$method($this->objSmarty);
	}

	/**
	 * viewの読み込みを行う
	 */
	public function display()
	{
		// viewを表示
		$this->objSmarty->display($this->method . '.tpl');
	}
}
