<?php namespace Wordpress\Foundation\Event\Listener;
/**
 * ------------------------------------------------------------------------------------
 * HookEventListener.php
 * ------------------------------------------------------------------------------------
 *
 * @package Wordpress\Foundation\Event\Listener
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
use Symfony\Component\EventDispatcher\EventSubscriberInterface,
	Wordpress\Foundation\Hooks\HookInterface,
	Wordpress\Foundation\Event\HookEvents;

class HookEventListener implements EventSubscriberInterface {

	public function onAction(HookEvents $event)
	{
		if($event->offsetExists('type') && $event->offsetExists('tag') && $event->offsetExists('closure')){
			$hook = $event->getHook();

			$priority = $event->offsetExists('priority') ? $event->offsetGet('priority') : 10;
			$args = $event->offsetExists('args') ? $event->offsetGet('args') : 1;

			return $hook->action($event->offsetGet('type'), $event->offsetGet('tag'), $event->offsetGet('closure'), $priority, $args);
		} else {
			throw new InvalidArgumentException('Identifier type or tag or closure is not defined.');
		}
	}

	public function onFilter(HookEvents $event)
	{

	}

	public static function getSubscribedEvents()
    {
        return array(
        	HookInterface::ACTION => array('onAction', 0),
        	HookInterface::FILTER => array('onFilter', 0)
        );
    }
}
/* @end HookEventListener.php */
