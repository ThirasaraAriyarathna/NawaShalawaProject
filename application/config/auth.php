<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Title           Auth config
 *
 *
 * Description     This file include configuration variable of the auth module
 * 
 * */
 
	/**
	 * Minimum Required Length of Password
	 **/
	$config['min_password_length'] = 6;
	
	/**
	 * Maximum Allowed Length of Password
	 **/
	$config['max_password_length'] = 20;

	/**
	 * Email Activation for registration
	 **/
	$config['email_activation']    = TRUE;
	
	/**
	 * Allow users to be remembered and enable auto-login
	 **/
	$config['remember_users']      = TRUE;
	
	/**
	 * How long to remember the user (seconds)
	 **/
	$config['user_expire']         = 86500;
	
	/**
	 * Extend the users cookies everytime they auto-login
	 **/
	$config['user_extend_on_login'] = false;
	
	
	
	
	/**
	 * Salt Length
	 **/
	$config['salt_length'] = 10;

	/**
	 * Should the salt be stored in the database?
	 * This will change your password encryption algorithm, 
	 * default password, 'password', changes to 
	 * fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
	 **/
	$config['store_salt'] = true;
	