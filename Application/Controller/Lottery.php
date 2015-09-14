<?php
/**
 * 抽選し、常駐者定例担当表を出力するクラス
 */
class Controller_Lottery
{

	/**
	 * 担当配列インデックス : 担当者1
	 * @var int
	 */
	const INDEX_TANTOU_1 = 0;

	/**
	 * 担当配列インデックス : 担当者2
	 * @var int
	 */
	const INDEX_TANTOU_2 = 1;

	/**
	 * 担当配列インデックス : 司会者
	 * @var int
	 */
	const INDEX_SHIKAI = 2;

	/**
	 * 担当配列インデックス : 開催日時
	 * @var int
	 */
	const INDEX_DATE = 3;

	/**
	 * コンストラクタ
	 */
	public function __construct()
	{
		date_default_timezone_set('Asia/Tokyo');

		//　Smartyを初期化
		$this->objSmarty = new Smarty();
		$this->objSmarty->compile_dir = SMARTY_COMPIlE_DIR;
		$this->objSmarty->cache_dir = SMARTY_CACHE_PATH;
		$this->objSmarty->template_dir = VIEW_PATH . 'Lottery';
	}

	/**
	 * 常駐者定例担当表を出力
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

		// 開始日を設定
		$start_date = '2015-09-17';
		// 前半の日付情報を設定
		$first_tantou = self::tantou_array_create($first_users, $first_name_orders, $start_date);

		// 後半の日付情報を設定
		$week_count = count($first_name_orders);
		$second_start_date = date("Y-m-d",strtotime("+" . $week_count . "week" ,strtotime($start_date)));

		$last_tantou = self::tantou_array_create($last_users, $last_name_orders, $second_start_date);

		$tantou = $first_tantou + $last_tantou;
		$this->objSmarty->assign('tantou', $tantou);
	}

	/**
	 * 担当配列を生成
	 * @param array $users メンバー配列
	 * @param array $name_orders 名前順配列
	 * @param string $start_date 基準となる開催日付
	 */
	private function static tantou_array_create($users, $name_orders, $start_date)
	{
		$date ='';
		$tantou = array();

		foreach ($name_orders as $key => $val) {
			$tantou[$key][] = array_shift($users);
			$tantou[$key][] = array_shift($users);

			// 司会者と担当者が被った場合
			if (in_array($name_orders[$key], $tantou[$key]) === true) {
				// 前半、後半の最後の人の場合
				if (strcmp($key, '4') === 0 || strcmp($key, '9') === 0 ) {
					$pre_key = $key - 1;
					// 1つ前の$keyの担当者と入れ替える処理を行う
					$tmp[0] = $tantou[$pre_key][self::INDEX_TANTOU_1];
					$tmp[1] = $tantou[$pre_key][self::INDEX_TANTOU_2];

					$tantou[$pre_key][self::INDEX_TANTOU_1] = $tantou[$key][self::INDEX_TANTOU_1];
					$tantou[$pre_key][self::INDEX_TANTOU_2] = $tantou[$key][self::INDEX_TANTOU_2];

					$tantou[$key][self::INDEX_TANTOU_1] = $tmp[0];
					$tantou[$key][self::INDEX_TANTOU_2] = $tmp[1];
				}else{
					// 被った者を上書き
					if (strcmp($tantou[$key][self::INDEX_TANTOU_1], $name_orders[$key]) === 0 ){
						$tantou[$key][self::INDEX_TANTOU_1] = array_shift($users);
					}else{
						$tantou[$key][self::INDEX_TANTOU_2] = array_shift($users);
					}
					// 司会者と担当者が被った人を$usersに戻す
					$users[] = $name_orders[$key];
				}

			}

			$tantou[$key][self::INDEX_SHIKAI] = $name_orders[$key];

			// 前半、後半の最初の人の場合
			if (strcmp($key, '0') === 0 || strcmp($key, '5') === 0 ) {
				$tantou[$key][self::INDEX_DATE] = $start_date;
				$date = $start_date;
			}else{
				// 上記以外の場合
				$tantou[$key][self::INDEX_DATE] = date("Y-m-d",strtotime("+1 week" ,strtotime($date)));
				$date = $tantou[$key][self::INDEX_DATE];
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
