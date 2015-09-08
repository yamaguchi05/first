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
		date_default_timezone_set('Asia/Tokyo');
		//　Smartyを初期化
		// インスタンス生成
		$this->objSmarty = new Smarty();
		// ディレクトリを指定
		$this->objSmarty->compile_dir = SMARTY_COMPIlE_DIR;
		$this->objSmarty->cache_dir = SMARTY_CACHE_PATH;
		// ディレクトリの指定(引数とかでなんとかする)
		$this->objSmarty->template_dir = '/var/www/html/Application/View/' . 'Lottery';
	}

	/**
	 * 名前順の配列を前半、後半にわけ、担当配列も10人に修正
	 * TODO マジックナンバーを減らす
	 */
	public function play()
	{
		// 前半名前順 (司会者)
		$first_name_orders = array('秋山','金澤','白石','袖山','豊田');
		// 後半名前順 (司会者)
		$last_name_orders = array('5' => '丸山'
								 ,'6' => '宮本'
								 ,'7' => '村山'
								 ,'8' => '山口'
								 ,'9' => '山本');
		// 前半（担当者）
		$first_users = array('秋山','金澤','白石','袖山','豊田','丸山','宮本','村山','山口','山本');
		// 後半（担当者）
		$last_users = array('秋山','金澤','白石','袖山','豊田','丸山','宮本','村山','山口','山本');
		shuffle($first_users);
		shuffle($last_users);

		// 日付情報を設定
		$start_date = '2015-09-17';
		$first_tantou = self::tantou_array_create($first_users, $first_name_orders, $start_date);

		// 2周目の日付情報を設定
		$week_count = count($first_name_orders);
		$second_start_date = date("Y-m-d",strtotime("+" . $week_count . "week" ,strtotime($start_date)));

		$last_tantou = self::tantou_array_create($last_users, $last_name_orders, $second_start_date);

		// 配列を結合
		$tantou = $first_tantou + $last_tantou;

		$this->objSmarty->assign('tantou', $tantou);
	}

	/**
	 * 担当配列を生成する関数(名前は変更する)
	 */
	public function tantou_array_create($users, $name_orders, $start_date)
	{
		//日付情報
		$date ='';
		// 結果を入れる配列
		$tantou = array();

		// 前半の担当者を取りだす
		foreach ($name_orders as $key => $val) {
			$tantou[$key][] = array_shift($users);
			$tantou[$key][] = array_shift($users);

			//司会者と担当者が被った場合
			if (in_array($name_orders[$key], $tantou[$key]) === true) {
				//1回目、2回目の最後$key(4または9)の場合、
				//前の番号のkeyの担当者と入れ替える処理を行う
				if (strcmp($key, '4') === 0 || strcmp($key, '9') === 0 ) {
					$pre_key = $key - 1;
					// 前の配列をこっちにいれるために、いったんてんぷ配列に格納
					$tmp[0] = $tantou[$pre_key][0];
					$tmp[1] = $tantou[$pre_key][1];

					$tantou[$pre_key][0] = $tantou[$key][0];
					$tantou[$pre_key][1] = $tantou[$key][1];

					$tantou[$key][0] = $tmp[0];
					$tantou[$key][1] = $tmp[1];
				}else{
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


			// 司会者情報も担当配列に代入
			$tantou[$key][2] = $name_orders[$key];

			//$keyが0または5（1人目）の場合は、$start_dayを代入
			if (strcmp($key, '0') === 0 || strcmp($key, '5') === 0 ) {
				$tantou[$key][3] = $start_date;
				$date = $start_date;
			}else{
				//　1週間先を表すので、2週目以降は、1週間後
				$tantou[$key][3] = date("Y-m-d",strtotime("+1 week" ,strtotime($date)));
				$date = $tantou[$key][3];
			}
		}
		return $tantou;
	}

	/**
	 * デストラクタ
	 */
	function __destruct() {
		$this->objSmarty->display('play.tpl');
	}
}
