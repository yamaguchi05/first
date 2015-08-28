<?php

class Core_AutoLoader
{
	public static function setup()
	{
		spl_autoload_register('self::default_load');
	}
	/**
	 * ここの$class_nameは裏で自動的に生成される
	 */
	public static function default_load($class_name)
	{

		$url_info = explode('_', $class_name);

		if (strcmp($url_info[0], 'Core') === 0){
			require_once(CORE_PATH . $url_info[1] . '.php');
		}elseif (strcmp($url_info[0], 'Controller') === 0) {
			require_once(CONTROLLER_PATH . $url_info[1] . '.php');
		}
	}
}

