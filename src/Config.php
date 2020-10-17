<?php
namespace Simpl;

use Dotenv\Dotenv;
use Dflydev\DotAccessData\Data;

class Config
{
	/**
	 * @var Dotenv
	 */
	public $dotenv;

	/**
	 * @var Data
	 */
	public $data;

	/**
	 * Config constructor.
	 * @param $directory
	 * @param null $filename
	 * @param bool $load_config_directory
	 */
	public function __construct($directory = null, $filename = null, $load_config_directory = true)
	{
		if (empty($directory)){
			$backtrace = debug_backtrace();
			$directory = dirname($backtrace[0]['file']);
		}

		$this->dotenv = Dotenv::createMutable($directory, $filename);
		$this->dotenv->load();

		array_walk($_ENV, function(&$v, $k){
			// Handle booleans
			if (strtolower($v) === "true" || strtolower($v) === "false") {
				$v = filter_var($v, FILTER_VALIDATE_BOOLEAN);
			}
		});

		$data = [];
		if ($load_config_directory){
			$config_directory = rtrim($directory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . 'config';
			$data = $this->loadConfigDirectory($config_directory);
		}

		$this->data = new Data(array_merge($_ENV, $data));
	}

	/**
	 * @param $directory
	 * @param string $file_pattern
	 * @return array
	 */
	public function loadConfigDirectory($directory, $file_pattern = '*.php')
	{
		$search = rtrim($directory, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $file_pattern;

		$files = glob($search);

		$data = [];

		foreach ($files as $file) {
			$basename = basename($file, '.php');
			$data[$basename] = require($file);
		}

		return $data;
	}

	/**
	 * @param $key
	 * @param null $default
	 * @return array|mixed|null
	 */
	public function get($key, $default = null)
	{
		return $this->data->has($key) ? $this->data->get($key) : $default;
	}

	/**
	 * Get the entire configuration as an array.
	 * @return array|null
	 */
	public function toArray()
	{
		return $this->data->export();
	}
}
