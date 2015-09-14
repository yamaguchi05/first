<?php
/**
 * オートローダー
 */
class Core_AutoLoader
{
	/**
	 * クラス情報 : ディレクトリ名
	 * @var int
	 */
	const INDEX_DIR = 0;

	/**
	 * クラス情報 : ファイル名
	 * @var int
	 */
	const INDEX_FILE = 1;

	public static function setup()
	{
		spl_autoload_register('self::default_load');
	}
	/**
	 * オートローダー
	 * @param array $class_name クラス情報
	 */
	public static function default_load($class_name)
	{

		$url_info = explode('_', $class_name);
		if (strcmp($url_info[self::INDEX_DIR], 'Core') === 0){
			require_once(CORE_PATH . $url_info[self::INDEX_FILE] . '.php');
		}elseif (strcmp($url_info[self::INDEX_DIR], 'Controller') === 0) {
			require_once(CONTROLLER_PATH . $url_info[self::INDEX_FILE] . '.php');
		}
	}
}

