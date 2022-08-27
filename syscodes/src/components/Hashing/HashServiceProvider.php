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
 * @link        https://lenevor.com
 * @copyright   Copyright (c) 2019 - 2022 Alexander Campo <jalexcam@gmail.com>
 * @license     https://opensource.org/licenses/BSD-3-Clause New BSD license or see https://lenevor.com/license or see /license.md
 */

namespace Syscodes\Components\Hashing;

use Syscodes\Components\Support\ServiceProvider;
use Syscodes\Components\Contracts\Support\Deferrable;

/**
 * For loading the hash class from the container of services.
 * 
 * @author Alexander Campo <jalexcam@gmail.com>
 */
class HashServiceProvider extends ServiceProvider implements Deferrable
{
    /**
     * Register the service provider.
     * 
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hash', function ($app) {
            return new HashManager($app);
        });
        
        $this->app->singleton('hash.driver', function ($app) {
            return $app['hash']->driver();
        });
    }
    
    /**
     * Get the services provided by the provider.
     * 
     * @return array
     */
    public function provides()
    {
        return ['hash', 'hash.driver'];
    }
}