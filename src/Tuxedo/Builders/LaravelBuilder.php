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

namespace Tuxedo\Builders;

use \Illuminate\Facades\Form as Form;

class LaravelBuilder implements Buildable {

	public function open(array $options = array())
	{
		Form::foo(5);
	}

}