<?php

/**
 * Lenevor Framework
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
 * @copyright   Copyright (c) 2019-2020 Lenevor Framework 
 * @license     https://lenevor.com/license or see /license.md or see https://opensource.org/licenses/BSD-3-Clause New BSD license
 * @since       0.1.0
 */

namespace Syscode\Support\Facades;

/**
 * Initialize the Config class facade.
 *
 * @author Javier Alexander Campo M. <jalexcam@gmail.com>
 * 
 * @method static bool has(string $key)
 * @method static mixed get(string $key, mixed $default = null)
 * @method static array|bool erase(string $key)
 * @method static void set(string $key, mixed $value = null)
 * @method static array all()
 * 
 * @see \Syscode\Config\Configure
 */
class Config extends Facade
{
    /**
     * Get the registered name of the component.
     * 
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'config';
    }
}