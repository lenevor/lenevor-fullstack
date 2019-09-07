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
 * @since       0.3.0
 */

namespace Syscode\Support\Time\Exceptions;

use Exception;
use InvalidArgumentException;

/**
 * Invalid date exception.
 * 
 * @author Javier Alexander Campo M. <jalexcam@gmail.com>
 */
class InvalidDateException extends InvalidArgumentException
{
    /**
     * Constructor. The InvalidDateException class instance.
     * 
     * @param  string           $message
     * @param  int              $code
     * @param  \Exception|null  $previous
     * 
     * @return void
     */
    public function __construct($message, int $code = 0, Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}