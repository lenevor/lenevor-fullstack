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
 * @since       0.6.0
 */

namespace Syscode\View;

use Syscode\Support\Arr;
use Syscode\Support\Str;
use InvalidArgumentException;
use Syscode\View\Engines\EngineResolver;
use Syscode\Contracts\Container\Container;
use Syscode\Contracts\View\Parser as ParserContract;

/**
 * This class allows parser of a view.
 * 
 * @author Javier Alexander Campo M. <jalexcam@gmail.com>
 */
class Parser implements ParserContract
{
	use Extensions,
		Establishes\ManagesLayouts,
		Establishes\ManagesComponents,
		Establishes\ManagesTranslations;
	
	/**
	 * The IoC container instance.
	 * 
	 * @var \Syscode\Contracts\Container\Container $container
	 */
	protected $container;

	/**
	 * The engine implementation.
	 * 
	 * @var \Syscode\View\Engines\EngineResolver $engines
	 */
	protected $engines;

	/**
	 * The view finder implementation.
	 * 
	 * @var \Syscode\View\FileViewFinder $finder
	 */
	protected $finder;

	/**
	 * Array of shared data.
	 * 
	 * @var array $shared
	 */
	protected $shared = [];

	/**
	 * Constructor: Create a new Parser class instance.
	 * 
	 * @param  \Syscode\View\Engines\EngineResolver  $engine
	 * @param  \Syscode\View\FileViewFinder  $finder
	 *
	 * @return void
	 */
	public function __construct(EngineResolver $engines, FileViewFinder $finder)
	{
		$this->engines = $engines;
		$this->finder  = $finder;

		$this->share('__env', $this);
	}
	
	/**
	 * Check existance view file.
	 * 
	 * @param  string  $view
	 *
	 * @return bool
	 */
	public function viewExists($view)
	{
		try 
		{
			$this->finder->find($view);
		}
		catch(InvalidArgumentException $e)
		{
			return false;
		}

		return true;
	}
	
	/**
	 * Global and local data are merged and extracted to create local variables within the view file.
	 * Renders the view object to a string.
	 *
	 * @example $output = $view->make();
	 *
	 * @param  string  $view  View filename
	 * @param  array  $data  Array of values
	 *
	 * @return string
	 *
	 * @throws \Syscode\View\Exceptions\ViewException
	 */
	public function make($view, $data = []) 
	{
		$view = $this->finder->find($view);
		
		// Loader class instance.
		return take($this->viewInstance($view, $data), function ($view) {
			return $view;
		});
	}

	/**
	 * Create a new view instance from the given arguments.
	 * 
	 * @param  string  $file  View filename
	 * @param  array  $data  Array of values
	 * 
	 * @return \Syscode\Contracts\View\View
	 */
	protected function viewInstance($view, $data)
	{
		return new View($this, $this->getEngineFromPath($view), $view, $data);
	}
	
	/**
	 * Get the appropriate view engine for the given path.
	 * 
	 * @param  string  $path
	 * 
	 * @return \Illuminate\Contracts\View\Engine
	 * 
	 * @throws \InvalidArgumentException
	 */
	public function getEngineFromPath($path)
	{
		if ( ! $extension = $this->getExtension($path))
		{
			throw new InvalidArgumentException("Unrecognized extension in file: {$path}");
		}
		
		$engine = $this->extensions[$extension];
		
		return $this->engines->resolve($engine);
	}
	
	/**
	 * Get the extension used by the view file.
	 * 
	 * @param  string  $path
	 * 
	 * @return string
	 */
	protected function getExtension($path)
	{
		$extensions = array_keys($this->extensions);
		
		return Arr::first($extensions, function($key, $value) use ($path)
		{
			return Str::endsWith($path, '.'.$value);
		});
	}
	
	/**
	 * Get the extension to engine bindings.
	 * 
	 * @return array
	 */
	public function getExtensions()
	{
		return $this->extensions;
	}
	
	/**
	 * Add a piece of shared data to the environment.
	 * 
	 * @param  array|string  $key
	 * @param  mixed|null  $value  (null by default)
	 * 
	 * @return mixed
	 */
	public function share($key, $value = null)
	{
		$keys = is_array($key) ? $key : [$key => $value];
		
		foreach ($keys as $key => $value)
		{
			$this->shared[$key] = $value;
		}
		
		return $value;
	}

	/**
	 * Get all of the shared data for the environment.
	 * 
	 * @return void
	 */
	public function getShared()
	{
		return $this->shared;
	}

	/**
	 * Get the IoC container instance.
	 * 
	 * @return \Syscode\Contracts\Container\Container
	 */
	public function getContainer()
	{
		return $this->container;
	}

	/**
	 * Set the IoC container instance.
	 * 
	 * @param  \Syscode\Contracts\Container\Container  $container
	 * 
	 * @return void
	 */
	public function setContainer($container)
	{
		$this->container = $container;
	}
}