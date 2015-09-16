<?php
/**
 * ラジオコントローラー
 */
class Controller_Radio extends Controller_Base
{
	/**
	 * ラジオをきく
	 */
	public function listen()
	{
		Controller_Base::assign('mc', '矢沢先輩、りん、はなよ');
		Controller_Base::assign('message', 'LoveLive!');
	}
}
