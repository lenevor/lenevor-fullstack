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
 * @copyright   Copyright (c) 2019 - 2021 Alexander Campo <jalexcam@gmail.com>
 * @license     https://opensource.org/licenses/BSD-3-Clause New BSD license or see https://lenevor.com/license or see /license.md
 */

namespace Syscodes\Translation;

use MessageFormatter;
use Syscodes\Support\Str;
use Syscodes\Support\Finder;
use InvalidArgumentException;
use Syscodes\Contracts\Translation\Loader;
use Syscodes\Contracts\Translation\Translator as TranslatorContract;

/**
 * Handle system messages and localization. Locale-based, 
 * built on top of PHP internationalization.
 * 
 * @author Alexander Campo <jalexcam@gmail.com>
 */
class Translator implements TranslatorContract
{
    /**
     * The fallback locale used by the translator.
     * 
     * @var string $fallback
     */
    protected $fallback;

    /**
     * Get the language lines from files.
     * 
     * @var array $language
     */
    protected $language = [];

    /**
     * Array of loaded files.
     * 
     * @var array $loaded
     */
    protected $loaded = [];

    /**
     * The loader implementation.
     * 
     * @var \Syscodes\Contracts\Translation\Loader $loader
     */
    protected $loader;

    /**
     * The default locale being used by the translator.
     * 
     * @var array $locale
     */
    protected $locale;

     /**
     * Boolean value whether the intl libraries exist on the system.
     * 
     * @var bool $intlSupport
     */
    protected $intlSupport = false;

    /**
     * Constructor language.
     * 
     * @param  string  $locale
     * @param  \Syscodes\Contracts\Translation\Loader  $loader
     * 
     * @return void
     */
    public function __construct($locale, Loader $loader)
    {   
        $this->setLocale($locale);

        $this->loader = $loader;

        if (class_exists('\MessageFormatter')) {
            $this->intlSupport = true;
        }
    }

    /**
     * Get the translation for the given key.
     * 
     * @param  string  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @param  bool  $fallback
     * 
     * @return string|array
     */
    public function get($key, array $replace = [], string $locale = null, bool $fallback = true)
    {
        return $this->getLine($key, $replace);
    }

    /**
     * Parses the language string for a file, loads the file, if necessary,
     * getting the line.
     * 
     * @param  string  $line
     * @param  array  $replace
     * 
     * @return string|array  Returns line
     */
    protected function getLine($line, array $replace = [])
    {
        // Parse out the file name and the actual alias.
        // Will load the language file and strings.
        list($file, $group) = $this->parseLine($line);
        
        $output = $this->language[$this->locale][$file][$group] ?? $line;

        if (is_string($output)) {
            return $this->makeReplacements($output, $replace);
        } elseif (is_array($output) && count($output) > 0) {
            foreach ($output as $key => $value) {
                $output[$key] = $this->makeReplacements($value, $replace);
            }

            return $output;
        }
    }
    
    /**
     * Parses the language string which should include the
     * filename as the first segment (separated by period).
     * 
     * @param  string  $line
     * 
     * @return array
     */
    protected function parseLine($line)
    {
        // If there's no possibility of a filename being in the string
        // simply return the string, and they can parse the replacement
        // without it being in a file.
        if (strpos($line, '.') === false) {
            return [
                null,
                $line
            ];
        }
        
        $file = substr($line, 0, strpos($line, '.'));
        $line = substr($line, strlen($file) + 1);

        if ( ! array_key_exists($line, $this->language)) {
            $this->load($file, $this->locale);
        }
        
        return [
            $file,
            $this->language[$this->locale][$line] ?? $line
        ];
    }

    /**
     * Loads a language file in the current locale. If $return is true
     * will return the file's contents, otherwise will merge with the 
     * existing language lines.
     * 
     * @param  string  $file
     * @param  string  $locale
     * @param  bool  $return  
     * 
     * @return array|null
     */
    protected function load($file, $locale, $return = false)
    {
        if ( ! array_key_exists($locale, $this->loaded)) {
            $this->loaded[$locale] = [];
        }
        
        if (in_array($file, $this->loaded)) {
            return [];
        }

        if ( ! array_key_exists($locale, $this->language)) {
            $this->language[$locale] = [];
        }

        if ( ! array_key_exists($file, $this->language[$locale])) {
            $this->language[$locale][$file] = [];
        }

        $path = $locale.DIRECTORY_SEPARATOR.$file;

        $lang = $this->requireFile($path);

        if ($return) {
            return $lang;
        }

        $this->loaded[$locale][] = $file;

        $this->language[$this->locale][$file] = $lang;
    }

    /**
     * A simple method for includin files.
     * 
     * @param  string  $path
     * 
     * @return array
     */
    protected function requireFile($path)
    {
        $files = (array) Finder::search($path, 'lang');

        foreach ($files as $file) {
            if ( ! is_file($file)) {
                continue;
            }
            
            return require $file;
        }

        return [];
    }

    /**
     * Make the place-holder replacements on a line.
     * 
     * @param  string  $line
     * @param  array  $replace
     * 
     * @return string
     */
    protected function makeReplacements($line, array $replace)
    {
        $line = $this->formatMessage($line, $replace);

        if (empty($replace)) {
            return $line;
        }

        foreach ($replace as $key => $value) {
            $line = str_replace(
                [':'.$key, ':'.Str::upper($key), ':'.Str::ucfirst($key)],
                [$value, Str::upper($value), Str::ucfirst($value)],
                $line
            );
        }

        return $line;
    }

    /**
     * Advanced line formatting.
     * 
     * @param  string  $line
     * @param  array  $replace
     * 
     * @return string|array
     */
    protected function formatMessage($line, array $replace = [])
    {
        if ( ! $this->intlSupport || ! count($replace)) {
            return $line;
        }

        return MessageFormatter::formatMessage($this->locale, $line, $replace);
    }

    /**
     * Get the default locale being used.
     * 
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Set the default locale.
     * 
     * @param  string  $locale
     * 
     * @return void
     */
    public function setLocale($locale)
    {
        if (Str::contains($locale, ['/', '\\'])) {
            throw new InvalidArgumentException('Invalid characters present in locale.');
        }
        
        $this->locale = $locale;
    }

    /**
     * Get the fallback locale being used.
     * 
     * @return string
     */
    public function getFallback()
    {
        return $this->fallback;
    }

    /**
     * Set the default locale.
     * 
     * @param  string  $locale
     * 
     * @return void
     */
    public function setFallback($fallback)
    {        
        $this->fallback = $fallback;
    }
}