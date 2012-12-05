<?php namespace Wordpress\Foundation;
/**
 * ------------------------------------------------------------------------------------
 * Application.php
 * ------------------------------------------------------------------------------------
 *
 * @package Websublime
 * @author 	Miguel Ramos <miguel.marques.ramos@gmail.com>
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
use Symfony\Component\EventDispatcher\EventDispatcher,
	Wordpress\Foundation\Event\HookEvents,
	Wordpress\Foundation\Hooks\HookInterface,
    Wordpress\Foundation\Event\Listener\HookEventListener;

class Application extends \Pimple {

	const VERSION = '0.3';

	public function __construct()
	{
		$app = $this;

		$this['autoloader'] = function () {
            throw new \RuntimeException('You tried to access the autoloader service. It is recommended that you use Composer to manage your dependencies and handle your autoloading. See http://getcomposer.org for more information.');
        };

        $this['exception_handler'] = $this->share(function () use ($app) {
            return new ExceptionHandler(WP_DEBUG);
        });

        $this['dispatcher'] = $this->share(function () use ($app) {
        	$dispatcher = new EventDispatcher();

        	$dispatcher->addSubscriber($app['exception_handler']);
            $dispatcher->addSubscriber(new HookEventListener());

        	return $dispatcher;
        });

        $this->action(HookInterface::ADD, 'after_setup_theme', 'polyglot', 10, 0);
	}

	public function action($type, $tag, $closure, $priority=10, $args=1)
	{
		$hookEvent = new HookEvents();
        $hookEvent['type'] = $type;
        $hookEvent['tag'] = $tag;
        $hookEvent['closure'] = $closure;
        $hookEvent['priority'] = $priority;
        $hookEvent['args'] = $priority;

        return $this['dispatcher']->dispatch(HookInterface::ACTION, $hookEvent);
	}
}
/* @end Application.php */
