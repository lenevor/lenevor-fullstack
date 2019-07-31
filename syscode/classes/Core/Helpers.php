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
 * @copyright   Copyright (c) 2019 Lenevor Framework 
 * @license     https://lenevor.com/license or see /license.md or see https://opensource.org/licenses/BSD-3-Clause New BSD license
 * @since       0.1.0
 */

use Syscode\Core\Application;
use Syscode\Routing\UrlGenerator;

if ( ! function_exists('abort')) 
{
    /**
     * Throw an HttpException with the given data.
     *
     * @param  int     $code
     * @param  string  $message
     * @param  array   $headers
     * 
     * @return void
     *
     * @throws \Syscode\Core\Http\Exceptions\HttpException
     * @throws \Syscode\Core\Http\Exceptions\LenevorException
     */
    function abort($code, $message = '', array $headers = [])
    {
        return app()->abort($code, $message, $headers);
    }
}

if ( ! function_exists('app')) {
    /**
     * Get the available Application instance.
     *
     * @param  string  $id
     * @param  array   $parameters
     * 
     * @return mixed|\Syscode\Core\Application
     */
    function app($id = null, $parameters = [])
    {
        if (is_null($id))
        {
            return Application::getInstance();
        }

        return Application::getInstance()->make($id, $parameters);
    }
}

if ( ! function_exists('asset')) 
{
    /**
     * Generate an asset path for the application.
     * 
     * @param  string  $path
     * @param  bool    $secure
     * 
     * @return string
     */
    function asset($path, $secure = null)
    {
        return app('url')->asset($path, $secure);
    }
}

if ( ! function_exists('back')) 
{
    /**
     * Create a new redirect response to the previous location.
     * 
     * @param  int    $status    (302 by default)
     * @param  array  $headers
     * @param  mixed  $fallback  (false by default)
     * 
     * @return \Syscode\Http\RedirectResponse
     */
    function back($status = 302, $headers = [], $fallback = false)
    {
        return app('redirect')->back($status, $headers, $fallback);
    }
}


if ( ! function_exists('config'))
{
    /**
     * Get / set the specified configuration value.
     * If an array is passed as the key, we will assume you want to set 
     * an array of values.
     *
     * @param   array|string  $key
     * @param   mixed         $default
     *
     * @return  mixed|\Syscode\Config\Configure
     */
    function config($key = null, $value = null)
    {
        if ($key === null)
        {
            return app('config');
        }

        if (is_array($key))
        {
            return app('config')->set($key, $value);
        }
        
        return app('config')->get($key, $value);
    }
}

if ( ! function_exists('isImport'))
{
    /**
     * Loads in a core class and optionally an app class override if it exists.
     * 
     * @param  string  $path
     * @param  string  $folder
     * @return void
     */
    function isImport($path, $folder = 'classes')
    {
        $path = str_replace('/', DIRECTORY_SEPARATOR, $path);
        
        // load it ffrom the core if it exists
        if (is_file(SYS_PATH.$folder.DIRECTORY_SEPARATOR.$path.'.php'))
        {
            require_once SYS_PATH.$folder.DIRECTORY_SEPARATOR.$path.'.php';
        }
        
        // if the app has an override (or a non-core file), load that too
        if (is_file(APP_PATH.$folder.DIRECTORY_SEPARATOR.$path.'.php'))
        {
            require_once APP_PATH.$folder.DIRECTORY_SEPARATOR.$path.'.php';
        }
    }
}

if ( ! function_exists('e'))
{
    /**
     * Escape HTML entities in a string.
     *
     * @param  string  $value
     *
     * @return string
     */
    function e($value)
    {
        return htmlentities($value, ENT_QUOTES, 'UTF-8', false);
    }
}

if ( ! function_exists('getClass'))
{
    /**
     * Function to crop the full name of the namespace and leave 
     * only the name of the class.
     * 
     * @param  string  $classname
     * 
     * @return array
     */
    function getClass($classname)
    {
        $position = explode('\\', get_class($classname));
        
        return end($position);
    }
}

if ( ! function_exists('isGetCommonPath'))
{
    /**
     * Find the common "root" path of two given paths or FQFN's.
     * 
     * @param  array   $paths  Array with the paths to compare
     * 
     * @return string  The determined common path section
     */
    function isGetCommonPath($paths)
    {
        $lastOffset = 1;
        $common     = '/';
        
        while (($index = strpos($paths[0], '/', $lastOffset)) !== false)
        {
            $dirLen = $index - $lastOffset + 1; // include
            $dir = substr($paths[0], $lastOffset, $dirLen);
            
            foreach ($paths as $path)
            {
                if (substr($path, $lastOffset, $dirLen) != $dir)
                {
                    return $common;
                }
            }
            
            $common    .= $dir;
            $lastOffset = $index + 1;
        }
        
        return $common;
    }
}

if ( ! function_exists('redirect'))
{
    /**
     * Get an instance of the redirect.
     *
     * @param  string|null  $url      The url                        (null by default)
     * @param  int          $code     The redirect status code       (302 by default)
     * @param  array        $headers  An array of headers
     * @param  bool|null    $secure   Type of protocol (http|https)  (null by default)
     *
     * @return \Syscode\Routing\Redirector
     */
    function redirect($url = null, $code = 302, $headers = [], $secure = null)
    {
        if (null === $url)
        {
            return app('redirect');
        }
        
        return app('redirect')->to($url, $code, $headers, $secure);
    }
}

if ( ! function_exists('response')) {
    /**
     * Return a new Response from the application.
     *
     * @param  string  $body
     * @param  int     $status   (200 by default)
     * @param  array   $headers
     * 
     * @return \Syscode\Http\Response|\Syscode\Routing\RouteResponse
     */
    function response($body = '', $status = 200, array $headers = [])
    {
        $response = app('response');

        if (func_num_args() === 0) 
        {
            return $response;
        }

        return $response->make($body, $status, $headers);
    }
}

if ( ! function_exists('resourcePath')) {
    /**
     * Get the path to the resources folder.
     *
     * @param  string  $path
     * 
     * @return string
     */
    function resourcePath($path = '')
    {
        return app()->resourcePath($path);
    }
}

if ( ! function_exists('secureAsset'))
{
    /**
     * Generate an asset path for the application.
     * 
     * @param  string  $path
     * 
     * @return string
     */
    function secureAsset($path)
    {
        return asset($path, true);
    }
}

if ( ! function_exists('secureUrl'))
{
    /**
     * Generate a HTTPS URL for the application.
     * 
     * @param  string  $path
     * @param  array   $parameters
     * 
     * @return string
     */
    function secureUrl($path, $parameters = [])
    {
        return url($path, $parameters, true);
    }
}

if ( ! function_exists('storagePath')) {
    /**
     * Get the path to the storage folder.
     *
     * @param  string  $path
     * 
     * @return string
     */
    function storagePath($path = '')
    {
        return app('path.storage').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}

if ( ! function_exists('url'))
{
    /**
     * Generate a URL for the application.
     *
     * @param  string|null  $path        (null by default)
     * @param  array        $parameters
     * @param  bool|null    $secure      (null by default)
     *
     * @return string
     */
    function url($path = null, $parameters = [], $secure = null)
    {
        if (is_null($path)) 
        {
            return app(UrlGenerator::class);
        }

        return app(UrlGenerator::class)->to($path, $parameters, $secure);
    }
}

if ( ! function_exists('view'))
{
    /**
     * Returns a new View object. If you do not define the "file" parameter, 
     * you must call [$view->setFilename].
     *
     * @example $view->render($file, $data, $extension);
     *  
     * @param  string       $file       View filename
     * @param  array|null   $data       Array of values
     * @param  string|null  $extension  String extension
     * 
     * @return void
     *
     * @uses   \Syscode\View\View
     */
    function view($file = null, array $data = null, $extension = null)
    {
        $view = app('view');

        if (func_num_args() === 0) 
        {
            return $view;
        }

        return $view->render($file, $data, $extension);
    }
}

if ( ! function_exists('__'))
{
    /**
     * A convenience method to translate a string and format it
     * with the intl extension's MessageFormatter object.
     * 
     * @param  string  $line
     * @param  array   $args
     * 
     * @return string
     */
    function __($line, array $args = [])
    {
        return app('translator')->getLine($line, $args);
    }
}