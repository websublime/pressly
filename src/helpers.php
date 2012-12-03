<?php
/**
 * ------------------------------------------------------------------------------------
 * helpers.php
 * ------------------------------------------------------------------------------------
 *
 * @package Websublime
 * @author 	Miguel Ramos <miguel.marques.ramosgmail.com>
 * @link 	https://www.websublime.com
 * @version 0.3
 */

/**
 * Determine if the current version of PHP is at least the supplied version.
 *
 * @param  string  $version
 * @return bool
 */
if(!function_exists('has_php')){
	function has_php($version = '5.0.0')
	{
		return version_compare(PHP_VERSION, $version) >= 0;
	}
}

/**
 * Function to determine if the page is the posts page. Function
 * that escape in core of wordpress.
 *
 * @return boolean
 */
if(!function_exists('is_posts_page')){
	function is_posts_page()
	{
		global $wp_query;

		if(isset($wp_query->is_posts_page)){
			return $wp_query->is_posts_page;
		}

		return false;
	}
}

/* @end helpers.php */
