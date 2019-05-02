<?php

namespace Syscode\Log;

/**
 * Lenevor PHP Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file license.md.
 * It is also available through the world-wide-web at this URL:
 * https://lenevor.com/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@Lenevor.com so we can send you a copy immediately.
 *
 * @package     Lenevor
 * @subpackage  Base
 * @author      Javier Alexander Campo M. <jalexcam@gmail.com>
 * @link        https://lenevor.com 
 * @copyright   Copyright (c) 2018-2019 Lenevor PHP Framework 
 * @license     https://lenevor.com/license or see /license.md or see https://opensource.org/licenses/BSD-3-Clause New BSD license
 * @since       0.2.0
 */
 class Logger
 {
	 /**
	  * No exist error level.
	  */
 	const L_NONE = 0;

	 /**
	  * Activate all errors level
	  */
	const L_ALL = 99;

	/**
	 * Activate error level DEBUG
	 */
	const L_DEBUG = 100;

	/**
	 * Activate error level INFO
	 */
	const L_INFO = 200;

	/**
	 * Activate error level WARNING
	 */
	const L_WARNING = 300;

	/**
	 * Activate error level ERROR
	 */
	const L_ERROR = 400;

	/**
	 * Activate error level NOTICES
	 */
	const L_NOTICES = 500;
 }