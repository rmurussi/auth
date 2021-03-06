<?php defined('SYSPATH') OR die('No direct access allowed.');
/**
 * Postgres Auth driver.
 * [!!] this Auth driver does not support roles nor autologin.
 *
 * @package    Kohana/Auth
 * @author     Kohana Team | Renan Murussi
 * @copyright  (c) 2007-2012 Kohana Team
 * @license    http://kohanaframework.org/license
 */
class Kohana_Auth_Postgres extends Auth {

	protected $_db = null;
	protected $_settings = [];

	public function __construct($config = array())
	{
		parent::__construct($config);

		$this->_settings['column_user'] = $config->get('column_user');
		$this->_settings['column_password'] = $config->get('column_password');
		$this->_settings['database_name'] = $config->get('database_name');
		$this->_settings['table_name'] = $config->get('table_name');

		$this->_db = ORM::factory($this->_settings['database_name'] .'_'.$this->_settings['table_name']);


	}

	protected function _login($username, $password, $remember)
	{
		if (is_string($password))
		{
			// Create a hashed password
			$password = $this->hash($password);
		}

		$query_result = $this->_db
			->where($this->_settings['column_user'], '=', ':'.$this->_settings['column_user'])
			->param(':'.$this->_settings['column_user'], $username)
			->find();

		$document = $query_result->object();

		if ( !count($document) )
			return FALSE;

		$_username = Arr::path($document, $this->_settings['column_user'], FALSE);
		$_password = Arr::path($document, $this->_settings['column_password'], FALSE);

		if (!(empty($_username)) && $username === $_username)
		{
			if (!empty($_password) && hash_equals($_password, $password)) {
				// Complete the login
				return $this->complete_login($document);
			}
		}

		// Login failed
		return FALSE;
	}

	public function password($username)
	{
		// TODO: Implement password() method.
	}

	public function check_password($password)
	{
		// TODO: Implement check_password() method.
	}

	public static function instance()
	{
		return parent::instance(); // TODO: Change the autogenerated stub
	}

	public function get_user($default = NULL)
	{
		return parent::get_user($default); // TODO: Change the autogenerated stub
	}

	public function login($username, $password, $remember = FALSE)
	{
		return parent::login($username, $password, $remember); // TODO: Change the autogenerated stub
	}

	public function logout($destroy = FALSE, $logout_all = FALSE)
	{
		return parent::logout($destroy, $logout_all); // TODO: Change the autogenerated stub
	}

	public function logged_in($role = NULL)
	{
		return parent::logged_in($role); // TODO: Change the autogenerated stub
	}

	public function hash_password($password)
	{
		return parent::hash_password($password); // TODO: Change the autogenerated stub
	}

	public function hash($str)
	{
		return parent::hash($str); // TODO: Change the autogenerated stub
	}

	protected function complete_login($user)
	{
		return parent::complete_login($user); // TODO: Change the autogenerated stub
	}


}