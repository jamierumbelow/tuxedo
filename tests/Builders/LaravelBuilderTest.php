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

use Tuxedo\Builders\LaravelBuilder as Builder;
use Mockery as m;

class LaravelBuilderTest extends \PHPUnit_Framework_TestCase {

	public function testItDelegatesToLaravelsFormBuilder()
	{
		$mock = m::mock('alias:Illuminate\Facades\Form');
		$mock->shouldReceive('foo')->with(5)->once();
		
		$builder = new Builders\LaravelBuilder();
		$builder->open();
	}

	public function tearDown()
	{
		m::close();
	}

}