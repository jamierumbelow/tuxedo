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

class CodeIgniterBuilder implements Buildable
{
	public function __construct()
	{
		get_instance()->load->helper('form');
	}

	public function open($url, array $options = array())
	{
		return form_open($url, $options);
	}

	public function close()
	{
		return form_close();
	}
}