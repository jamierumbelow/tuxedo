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

namespace Tuxedo\Input;
use \CI_Input;

class CodeIgniterInput implements Inputable {

	public function __construct(CI_Input $input)
	{
		$this->input = $input;
	}

	public function get($key)
	{
		return $this->input->get($key);
	}

}