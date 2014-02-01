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

interface Modelable {

	/**
	 * Called by \Tuxedo\Form#open(), should return the URL used by the model
	 *
	 * @return string
	 */
	public function toUrl();

}