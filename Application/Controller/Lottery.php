<?php
/**
 * 抽選コントローラー
 */
class Controller_Lottery
{
	/**
	 * コンストラクタ
	 */
	public function __construct()
	{
		//　Smartyを初期化
		// インスタンス生成
		$this->objSmarty = new Smarty();
		// ディレクトリを指定
		$this->objSmarty->compile_dir = SMARTY_COMPIlE_DIR;
		$this->objSmarty->cache_dir = SMARTY_CACHE_PATH;
		// ディレクトリの指定(引数とかでなんとかする)
		$this->objSmarty->template_dir = '/var/www/html/Application/View/' . 'Lottery';
	}

	public function play()
	{
		// 名前順 (司会者)
		$name_orders = array('秋山','金澤','白石','袖山','豊田','丸山','宮本','村山','山口','山本');
		// 発表者を決める順番
		$users = array('秋山','金澤','白石','袖山','豊田','丸山','宮本','村山','山口','山本','秋山','金澤','白石','袖山','豊田','丸山','宮本','村山','山口','山本');
		shuffle($users);
		// 結果を入れる配列
		$tantou = array();

		// 担当者を取りだす
		foreach ($name_orders as $key => $val) {
			// 司会者とかぶらないように、発表者を出す array_shiftで引っ張るので難しい
			// array_shiftしたあとにかぶっていたら、$usersにもっかい代入して、再度array_shiftする？
			$tantou[$key][] = array_shift($users);
			$tantou[$key][] = array_shift($users);

			// 同じ人が2回出た場合
			if (strcmp($tantou[$key][0], $tantou[$key][1]) === 0 ){
				// 片方を上書き(2人出ているので再びかぶることはない)
				$tantou[$key][1] = array_shift($users);
				$users[] = $tantou[$key][0];
			}

			//司会者と担当者が被った場合
			if (in_array($name_orders[$key], $tantou[$key]) === true) {

	// echo($name_orders[$key].'さん');
	// echo(司会者と担当者がかぶったぞい);
				//司会者と担当者が被ったとのことなので、
				//担当者2名のどっちかを判定($name_orders[$key])、array_shiftで再度ひく
				if (strcmp($tantou[$key][0], $name_orders[$key]) === 0 ){
					// 被った人を上書き
					$tantou[$key][0] = array_shift($users);
				}else{
					$tantou[$key][1] = array_shift($users);
				}
				// 司会者と担当者が被った人を$usersにもどす
				$users[] = $name_orders[$key];

			}
		}
		// var_dump($tantou);
        $this->objSmarty->assign('tantou', $tantou);
        $this->objSmarty->assign('name_orders', $name_orders);
	}

    /**
     * デストラクタ
     */
    function __destruct() {
        $this->objSmarty->display('play.tpl');
    }
}
