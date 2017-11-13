<?php



namespace App\Helpers;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use App\Exceptions\ConfigNotFoundException;

/**
 * Created by PhpStorm.
 * User: spbaniya
 * Date: 11/6/17
 * Time: 2:05 PM
 */
class ConfigHelper implements Helper
{

	/**
	 * @param $key
	 * @return string | array
	 * @throws ConfigNotFoundException
	 */
	public static function get($key)
	{
		global $config, $envConfig;
		if(is_array($envConfig) && is_array($config)) {
            $config = array_merge($config, $envConfig);
            $config = array_filter($config);
        }
		//echo $key;die();
		if(strpos($key, '.') !== false) {
			$keyDepth = explode('.', $key);
            //print_r($keyDepth);die();
			$depth = '';
			foreach($keyDepth as $value) {
				if(empty($depth)) {
					$depth = $config[$value];
				} else {
					$depth = $depth[$value];
				}
			}
			if(empty($depth)) {
				return null;
			}
			return $depth;
		} else {
			if(!isset($config[$key])) {
                return null;
			}
			return $config[$key];
		}
	}
	/**
	 * @param $key
	 * @return string | array
	 * @throws ConfigNotFoundException
	 */
	public static function getStrict($key)
	{
		global $config, $envConfig;
		if(is_array($envConfig) && is_array($config)) {
            $config = array_merge($config, $envConfig);
            $config = array_filter($config);
        }
		//echo $key;die();
		if(strpos($key, '.') !== false) {
			$keyDepth = explode('.', $key);
            //print_r($keyDepth);die();
			$depth = '';
			foreach($keyDepth as $value) {
				if(empty($depth)) {
					$depth = $config[$value];
				} else {
					$depth = $depth[$value];
				}
			}
			if(empty($depth)) {
				throw new ConfigNotFoundException("Config Not Found: " . json_encode($depth));
			}
			return $depth;
		} else {
			if(!isset($config[$key])) {
				throw new ConfigNotFoundException("Config Not Found: " . $key);
			}
			return $config[$key];
		}
	}

	public static function set($key, $value)
	{
        global $config, $envConfig;

        if(is_array($envConfig) && is_array($config)) {
            $config = array_merge($config, $envConfig);
        }
		$config[$key] = $value;

		return $config[$key];
	}
}