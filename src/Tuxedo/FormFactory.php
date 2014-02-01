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
	public function setDefaultBuilder(Buildable $builder)
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
	public function setDefaultInput(Inputable $input)
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
	public function make(array $config = array())
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
		return $this->defaultBuilder;
	}

	/**
	 * Resolve a new instance of the default Inputable class
	 * 
	 * @todo Let it actually resolve things; strings or a Closure
	 * @return Inputable
	 */
	protected function resolveInput()
	{
		return $this->defaultInput;
	}
}