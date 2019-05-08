<?php 

namespace Syscode\Core\Bootstrap;

use Exception;
use Syscode\Config\ParserEnv;
use Syscode\Contracts\Core\Application;

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
class BootDetectEnvironment
{
    /**
     * The application implementation.
     *
     * @var \Syscode\Contracts\Core\Application $app
     */
    protected $app;
    
    /**
     * Bootstrap the given application.
     *
     * @param  \Syscode\Contracts\Core\Application  $app
     * 
     * @return void
     */
    public function bootstrap(Application $app)
    {
        try
        {
            $this->createEnv($app)->load();
        }
        catch (Exception $e)
        {}
    }

    /**
     * Create a ParseEnv instance.
     * 
     * @param  \Syscode\Contracts\Core\Application  $app
     * 
     * @return new ParserEnv
     */
    protected function createEnv($app)
    {
        return (new ParserEnv(
                $app->environmentPath(), 
                $app->environmentFile()
        ));
    }
}