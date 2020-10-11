<?php

if (!function_exists('env')) {
	/**
	 * @param $key
	 * @param null $default
	 * @return mixed|null
	 */
	function env($key, $default = null)
	{
		if (isset($_ENV[$key])) {
			$value = $_ENV[$key];
		} else {
			$value = $default;
		}
		return $value;
	}
}
