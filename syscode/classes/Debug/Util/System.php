<?php 

namespace Syscode\Debug\Util;

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
 * @copyright   Copyright (c) 2018-2019 Lenevor Framework 
 * @license     https://lenevor.com/license or see /license.md or see https://opensource.org/licenses/BSD-3-Clause New BSD license
 * @since       0.8.0
 */
class System 
{    
    /**
     * Turns on output buffering.
     *
     * @return bool
     */
    public function startOutputBuferring()
    {
        return ob_start();
    }

    /**
     * Error handler
     * 
     * This will catch the php native error and treat it as a exception which will
     * provide a full back trace on all errors.
     * 
     * @param  callable  $handler
     * @param  int       $types
     * 
     * @return callable|null
     */
    public function setErrorHandler(callable $handler, $types = 'use-php-defaults') 
    {
        if ($types === 'use-php-defaults')
        {
            $types = E_ALL | E_STRICT;
        }

        return set_error_handler($handler, $types);
    }

    /**
     * Exception handler
     * 
     * Catches any uncaught errors and exceptions, including most Fatal errors.
     * 
     * @param  callable  $handler
     * 
     * @return callable|null
     */
    public function setExceptionHandler(callable $handler)
    {
        return set_exception_handler($handler);
    }

    /** 
     * Restores the previously defined exception handler function.
     * 
     * @return void 
     */
    public function restoreExceptionHandler()
    {
        restore_exception_handler();
    }

    /**
     * Restores the previous error handler function.
     * 
     * @return void
     */
    public function restoreErrorHandler()
    {
        restore_error_handler();
    }

    /**
     * Registers a callback to be executed after script execution finishes or 
     * exit() is called.
     * 
     * @param  callable  $callback
     * 
     * @return void
     */
    public function registerShutdownFunction(callable $callback)
    {
        register_shutdown_function($callback);
    }

    /**
     * Returns the contents of the output buffer and end output buffering. If output 
     * buffering isn't active then FALSE is returned.
     * 
     * @return string|false
     */
    public function CleanOutputBuffer()
    {
        return ob_get_clean();
    }
    
    /**
     * Returns the level of nested output buffering handlers or zero if output 
     * buffering is not active.
     * 
     * @return int
     */
    public function getOutputBufferLevel()
    {
        return ob_get_level();
    }

    /**
     * Cleanes (erase) the output buffer and turn off output buffering.
     * 
     * @return bool
     */
    public function endOutputBuffering()
    {
        return ob_end_clean();
    }

    /**
     * Flushes the system write buffers of PHP and whatever backend PHP is using.
     * 
     * @return void
     */
    public function flushOutputBuffer()
    {
        return flush();
    }

    /**
     * Gets which PHP errors are reported.
     * 
     * @return int
     */
    public function getErrorReportingLevel()
    {
        return error_reporting();
    }

    /**
     * Gets information about the last error that occurred.
     * 
     * @return array|null
     */
    public function getLastError()
    {
        return error_get_last();
    }

    /**
     * Set the HTTP response code.
     * 
     * @param  int  $httpCode
     *
     * @return int
     */
    public function setHttpResponseCode($httpCode)
    {
        return http_response_code($httpCode);
    }

    /**
     * Output a message and terminate the current script.
     * 
     * @param  int  $status
     * 
     * @return void
     */
    public function stopException($status)
    {
        exit($status);
    }
}