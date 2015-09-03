<?php

require_once(SMARTY_PATH . 'smarty-3.1.24/libs/Smarty.class.php');

class Core_Request
{

	// private $request_url = '';
	// 登録していなくても、$this->request_urlで使えるのはなぜか
	// 「$this->xx」でクラス変数を設定できるのか?

	/**
	 * コンストラクタ
	 */
	public function __construct()
	{
		$this->request_url = $_SERVER['REQUEST_URI'];
	}

	/**
	 * viewの初期化を行う
	 */
	public function setup()
	{
		// ルーティング
		$class_info = explode('/', $this->request_url);
		$this->class_name = ucfirst(strtolower($class_info[1]));
		$this->method = strtolower($class_info[2]);
		//　Smartyを初期化
		// インスタンス生成
		// $this->objSmarty = new Smarty();
		// // ディレクトリを指定
		// $this->objSmarty->compile_dir = SMARTY_COMPIlE_DIR;
		// $this->objSmarty->cache_dir = SMARTY_CACHE_PATH;
		// // ディレクトリの指定(引数とかでなんとかする)
		// $this->objSmarty->template_dir = '/var/www/html/Application/View/' . $this->class_name;
	}

	/**
	 * URLからの解析や振り分けを行う
	 *
	 * ルーティング:URLからファイルの名前を取得する（整形する）処理
	 * ディスパッチ:ルーティング後、そのファイルに遷移（振分）する処理
	 */
	public function dispatch()
	{
		$class = 'Controller_' . $this->class_name;
		$method = $this->method;

		// ディスパッチ
		$instance = new $class();
		$instance->$method();
	}

	/**
	 * view読み込みを行う
	 */
	public function desplay()
	{
		//　viewを表示 一旦
		// $this->objSmarty->display($this->method . '.tpl');
	}
}
