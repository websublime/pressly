<?php namespace Wordpress\Foundation\Event;
/**
 * ------------------------------------------------------------------------------------
 * HookEvents.php
 * ------------------------------------------------------------------------------------
 *
 * @package Wordpress\Foundation\Event
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
use Symfony\Component\EventDispatcher\Event,
	Wordpress\Foundation\Hooks\Hook;

class HookEvents extends Event implements \ArrayAccess {

	private $hook;

	private $parameters;

	public function __construct()
	{
		$this->hook = new Hook();
	}

	public function setHook(HookInterface $hook)
	{
		$this->hook = $hook;
	}

	public function getHook()
	{
		return $this->hook;
	}

	public function offsetSet($id, $value)
    {
        $this->parameters[$id] = $value;
    }

    public function offsetGet($id)
    {
        if (!array_key_exists($id, $this->parameters)) {
            throw new InvalidArgumentException(sprintf('Identifier "%s" is not defined.', $id));
        }

        return $this->parameters[$id];
    }

    public function offsetExists($id)
    {
        return array_key_exists($id, $this->parameters);
    }

    public function offsetUnset($id)
    {
        unset($this->parameters[$id]);
    }

    public function keys()
    {
        return array_keys($this->parameters);
    }
}
/* @end HookEvents.php */
