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
	 * URLの解析を行う
	 * ルーティング:URLからファイルの名前を取得する（整形する）
	 */
	public function setup()
	{
		// ルーティング
		$class_info = explode('/', $this->request_url);
		$this->class_name = ucfirst(strtolower($class_info[self::INDEX_CLASS]));
		$this->method = strtolower($class_info[self::INDEX_METHOD]);
	}

	/**
	 * URLから振り分けを行う
	 * ディスパッチ:任意のファイルに遷移（振り分け）する
	 */
	public function dispatch()
	{
		$class = 'Controller_' . $this->class_name;
		$method = $this->method;
		// ディスパッチ
		$instance = new $class();
		$instance->$method($this->objSmarty);
	}
}
