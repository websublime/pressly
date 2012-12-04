<?php namespace Wordpress\Foundation;
/**
 * ------------------------------------------------------------------------------------
 * Application.php
 * ------------------------------------------------------------------------------------
 *
 * @package Wordpress\Foundation
 * @author 	Miguel Ramos <miguel.marques.ramosgmail.com>
 * @link 	https://www.websublime.com
 * @version 0.3
 *
 * This file is part of Pressly.
 *
 * Copyright (c) 2012 Miguel Ramos
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is furnished
 * to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

class Application extends \Pimple {

	const VERSION = '0.3';

	public function __construct()
	{
		$app = $this;

		$this['autoloader'] = function () {
            throw new \RuntimeException('You tried to access the autoloader service. It is recommended that you use Composer to manage your dependencies and handle your autoloading. See http://getcomposer.org for more information.');
        };
	}
}
/* @end Application.php */
