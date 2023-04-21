<?php 

/**
 * Lenevor Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * https://lenevor.com/license
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@Lenevor.com so we can send you a copy immediately.
 *
 * @package     Lenevor
 * @subpackage  Base
 * @link        https://lenevor.com
 * @copyright   Copyright (c) 2019 - 2023 Alexander Campo <jalexcam@gmail.com>
 * @license     https://opensource.org/licenses/BSD-3-Clause New BSD license or see https://lenevor.com/license or see /LICENSE
 */

namespace Syscodes\Components\Dotenv\Repository\Adapters;

use Syscodes\Components\Contracts\Dotenv\Adapter;

/**
 * Read, write and delete an environment variable for 
 * process of global.
 */
class GlobalAdapter implements Adapter
{
    /**
     * Determines if the adapter is supported.
     * 
     * @return bool
     */
    public function isSupported(): bool
    {
        return true;
    }

    /**
     * Check if a variable exists.
     * 
     * @param  string  $name
     * 
     * @return bool
     */
    public function has(string $name): bool
    {
        global ${$name};

        return isset(${$name});
    }

    /**
     * Read an environment variable.
     * 
     * @param  string  $name
     * 
     * @return mixed
     */
    public function read(string $name)
    {
        if ($this->has($name)) {
            global ${$name};

            return ${$name};
        }

        return null;
    }

    /**
     * Write to an environment variable.
     * 
     * @param  string  $name
     * @param  string  $value
     * 
     * @return bool
     */
    public function write(string $name, string $value): bool
    {
        if ($this->has($name)) {
            global ${$name};

            ${$name} = $value;
        }

        return true;
    }

    /**
     * Delete an environment variable.
     * 
     * @param  string  $name
     * 
     * @return bool
     */
    public function delete(string $name): bool
    {
        global ${$name};
        
        unset(${$name});

        return true;
    }
}