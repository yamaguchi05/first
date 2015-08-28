<?php
/**
 * ラジオコントローラー
 */
class Controller_Radio
{
	/**
	 * ラジオをきく
	 */
	public function listen()
	{
		var_dump('ラジオをきく');
		// テンプレート変数の設定
		// コントローラーで呼び出すにはどうすればいいか
		// $this->objSmarty->assign('message', 'nikorinpana!');

	}

	/**
	 * ラジオを探す
	 */
	public function find()
	{
		var_dump('ラジオを探す');
	}
}
