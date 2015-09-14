<?php
/**
 * ラジオコントローラー
 */
class Controller_Radio
{
	/**
	 * ラジオをきく
	 * @param object $objSmarty　Smartyのインスタンス
	 */
	public function listen($objSmarty)
	{
		// テンプレート変数の設定
		$objSmarty->assign('message', 'LoveLive!');
	}
}
