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

/**
 * Facade acts as a bridge between an instance of Form and the developer's code. It allows the developer to write the form output code
 * with simple static method calls - which looks a lot more natural inside a view - rather than instantiating a new object.
 */
class Facade {

	protected static $form;

	public static function __callStatic($method, $params = array())
	{
		$form = self::formObject();
	}
}