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

	/**
	 * Delegate the call to the current instance of Form
	 *
	 * @return string
	 */
	public static function __callStatic($method, $params = array())
	{
		if (method_exists(self::$form, $method))
		{
			return call_user_func_array(array(self::$form, $method), $params);
		}
		else
		{
			throw new Exception('unknown method called statically: ' . __STATIC__ . '::' . $method);
		}
	}

	/**
	 * While most of the functions are delegated through __callStatic, we make a special exception for open() and close()
	 * because we need these to be responsible for the instantiation and destruction of the Form instance
	 *
	 * @return string
	 */
	public static function open($config)
	{
		$factory = new FormFactory;
		self::$form = $factory->make($config);

		return self::$form->open();
	}

	/**
	 * Reset the form instance, spit out the closing tag
	 *
	 * @return string
	 */
	public static function close()
	{
		$html = self::$form->close();
		self::$form = null;

		return $html;
	}
}