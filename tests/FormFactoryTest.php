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

use Tuxedo\FormFactory;
use Mockery as m;

class FormFactoryTest extends \PHPUnit_Framework_TestCase {

	public function testConstructorAcceptsAndSetsDefaultDelegates()
	{
		$builder = m::mock('Tuxedo\Buildable');
		$input = m::mock('Tuxedo\Inputable');

		$factory = new FormFactory($builder, $input);
		$factory2 = new FormFactory($builder);

		$this->assertThat($builder, $this->identicalTo($factory->getDefaultBuilder()));
		$this->assertThat($input, $this->identicalTo($factory->getDefaultInput()));
		$this->assertThat($builder, $this->identicalTo($factory2->getDefaultBuilder()));
		$this->assertNull($factory2->getDefaultInput());
	}

	public function testItMakesForms()
	{
		$builder = m::mock('Tuxedo\Buildable');
		$input = m::mock('Tuxedo\Inputable');

		$factory = new FormFactory($builder, $input);
		$form = $factory->make();

		$this->assertInstanceOf('Tuxedo\Form', $form);
		$this->assertThat($builder, $this->identicalTo($form->getBuilder()));
		$this->assertThat($input, $this->identicalTo($form->getInput()));
	}

	public function tearDown()
	{
		m::close();
	}

}