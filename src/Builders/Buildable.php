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

interface Buildable {

	/**
	 * @var string $url The target URL
	 * @var array $options Array of HTML attributes
	 * @return string Opening <form> tag
	 */
	public function open($url, array $options = array());

	/**
	 * @return string Closing </form> tag
	 */
	public function close();

}