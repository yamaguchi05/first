<?php
/**
 * ベースコントローラー
 */
class Controller_Base
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
		// URLを解析
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
	 * アサイン
	 * @param $key   Smartyにアサインするキー
	 * @param $value Smartyにアサインするバリュー
	 */
	protected function assign($key, $value)
	{
		$this->objSmarty->assign($key, $value);
	}

	/**
	 * デストラクタ
	 */
	public function __destruct()
	{
		// viewを表示
		$this->objSmarty->display($this->method . '.tpl');
	}

}