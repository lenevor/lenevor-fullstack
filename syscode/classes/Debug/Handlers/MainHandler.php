<?php 

namespace Syscode\Debug\Handlers;

use Syscode\Debug\Engine\Supervisor;

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
class MainHandler
{ 
    /**
     * The Handler has handled the Throwable in some way, and wishes to quit/stop execution.
     */
    const QUIT = 0x30;

    /**
	 * Get exception. 
	 * 
	 * @var \Throwable $exception
	 */
    protected $exception;
    
    /**
	 * Get supervisor. 
	 * 
	 * @var string $supervisor
	 */
    protected $supervisor;
    
    /**
	 * Gets exception already specified.
	 * 
	 * @return \Throwable
	 */
    public function getException()
    {
        return $this->exception;
    }

    /**
	 * Gets supervisor already specified.
	 * 
	 * @return \Syscode\Debug\Engine\Supervisor
	 */
    public function getSupervisor()
    {
        return $this->supervisor;
    }

    /**
     * Sets exception.
     * 
     * @param  \Throwable  $exception
     * 
     * @return void
     */
    public function setException($exception)
    {
        $this->exception = $exception;
    }

    /**
     * Sets supervisor.
     * 
     * @param  \Syscode\Debug\Engine\Supervisor  $supervisor
     * 
     * @return void
     */
    public function setSupervisor(Supervisor $supervisor)
    {
        $this->supervisor = $supervisor;
    }
}