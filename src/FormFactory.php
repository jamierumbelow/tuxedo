<?php
/**
 * Tuxedo
 * 
 * @package Tuxedo
 * @version 0.1.0
 * @author Jamie Rumbelow <http://jamierumbelow.net>
 * @copyright (c) 2013, Jamie Rumbelow
 * @link https://github.com/jamierumbelow/tuxedo
 */

namespace Tuxedo;

class FormFactory {

	/**
	 * The globally default instance of Buildable to use when instantiating new Form objects
	 *
	 * @var Buildable
	 */
	protected static $globalBuilder;

	/**
	 * The globally default instance of Inputable
	 *
	 * @var Buildable
	 */
	protected static $globalInput;

	/**
	 * Set the global instance of Buildable
	 *
	 * @param  Buildable  $builder
	 * @return void
	 */
	public static function setGlobalBuilder(Builders\Buildable $builder)
	{
		self::$globalBuilder = $builder;
	}

	/**
	 * Get the global instance of Buildable
	 *
	 * @return Buildable
	 */
	public static function getGlobalBuilder()
	{
		return self::$globalBuilder;
	}

	/**
	 * Set the global instance of Inputable
	 *
	 * @param  Inputable  $input
	 * @return void
	 */
	public function setGlobalInput(Input\Inputable $input)
	{
		self::$globalInput = $input;
	}

	/**
	 * Get the global instance of Inputable
	 *
	 * @return Inputable
	 */
	public function getGlobalInput()
	{
		return self::$globalInput;
	}

	/**
	 * The default instance of Buildable to use when instantiating new Form objects
	 *
	 * @var Buildable
	 */
	protected $defaultBuilder;

	/**
	 * The default instance of Inputable
	 *
	 * @var Buildable
	 */
	protected $defaultInput;

	/**
	 * Instantiate a new instance of FormFactory
	 *
	 * @var Buildable $builder
	 * @var Inputable $input
	 */
	public function __construct(Buildable $builder = null, Inputable $input = null)
	{
		if ($builder) $this->setDefaultBuilder($builder);
		if ($input) $this->setDefaultInput($input);
	}

	/**
	 * Set the default instance of Buildable
	 *
	 * @param  Buildable  $builder
	 * @return void
	 */
	public function setDefaultBuilder(Builders\Buildable $builder)
	{
		$this->defaultBuilder = $builder;
	}

	/**
	 * Get the default instance of Buildable
	 *
	 * @return Buildable
	 */
	public function getDefaultBuilder()
	{
		return $this->defaultBuilder;
	}

	/**
	 * Set the default instance of Inputable
	 *
	 * @param  Inputable  $input
	 * @return void
	 */
	public function setDefaultInput(Input\Inputable $input)
	{
		$this->defaultInput = $input;
	}

	/**
	 * Get the default instance of Inputable
	 *
	 * @return Inputable
	 */
	public function getDefaultInput()
	{
		return $this->defaultInput;
	}

	/**
	 * Create a new instance of Form
	 *
	 * @return Tuxedo\Form
	 */
	public function make($config = array())
	{
		$form = new Form($config);

		$form->setBuilder($this->resolveBuilder());
		$form->setInput($this->resolveInput());

		return $form;
	}

	/**
	 * Resolve a new instance of the default Buildable class
	 * 
	 * @todo Let it actually resolve things; strings or a Closure
	 * @return Buildable
	 */
	protected function resolveBuilder()
	{
		return $this->defaultBuilder ?: self::$globalBuilder;
	}

	/**
	 * Resolve a new instance of the default Inputable class
	 * 
	 * @todo Let it actually resolve things; strings or a Closure
	 * @return Inputable
	 */
	protected function resolveInput()
	{
		return $this->defaultInput ?: self::$globalInput;
	}
}