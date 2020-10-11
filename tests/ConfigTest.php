<?php
namespace Tests;

use PHPUnit\Framework\TestCase;
use Simpl\Config;

class ConfigTest extends TestCase
{
	/**
	 * @var Config
	 */
	public $config;

	public function setUp()
	{
		$this->config = new Config(dirname(__FILE__) . '/resources');
	}

	public function testCanLoadConfigDirectory()
	{
		$this->assertEquals('Josh Moody', $this->config->get('app.author'));
		$this->assertEquals('Foo Bar', $this->config->get('foo.bar'));
		$this->assertEquals('Bar Baz', $this->config->get('bar.baz'));

		var_dump($this->config->get('DEBUG'));
		var_dump($this->config->get('app.environment'));
	}

	public function testConvertsBoolean()
	{
		$this->assertTrue($this->config->get('app.debug'));
		$this->assertTrue($this->config->get('DEBUG'));
		$this->assertFalse($this->config->get('app.should-be-false'));
	}

	public function testInvalidKeyReturnsDefaultValue()
	{
		$this->assertEquals('Default', $this->config->get('does-not-exist', 'Default'));
	}

	public function testUnsetEnvKeySetsDefaultValue()
	{
		$this->assertEquals('Picard', $this->config->get('app.captain'));
	}

	public function testCanLoadAlternateEnvFile()
	{
		$config = new Config(dirname(__FILE__) . '/resources', '.env.prod');

		$this->assertEquals('prod', $config->get('app.environment'));
		$this->assertFalse($config->get('app.debug'));
		$this->assertFalse($config->get('DEBUG'));
	}

	public function testCanLoadEnvWithoutConfigDirectory()
	{
		$config = new Config(dirname(__FILE__) . '/resources', null, false);
		$this->assertTrue($config->get('DEBUG'));
	}
}