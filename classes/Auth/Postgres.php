<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Postgres Auth driver and ORM ***
 *
 * @package    Kohana/Auth
 * @author     Renan Murussi
 * @link	   https://github.com/rmurussi/auth
 */
class Auth_Postgres extends Kohana_Auth_Postgres {

	protected $auth_config = null;

	public function simulateUser($username) {
		$query_result = $this->_db
			->where($this->_settings['column_user'], '=', $username)
			->find();

		$document = $query_result->object();

		if ( !count($document) )
			return FALSE;

		$_username = Arr::path($document, $this->_settings['column_user'], FALSE);
		if (!(empty($_username)) && $username === $_username)
		{
			if ( $this->auth_config == null )
				$this->auth_config = Kohana::$config->load('auth');

			$obSession = Session::instance();
			$UserNow = $obSession->get($this->auth_config['session_key']);
			$obSession->set($this->auth_config['bck_session_key'], $UserNow);
			// Complete the login
			return $this->complete_login($document);
		}

		// Login failed
		return FALSE;
	}

	public function finishSimulation() {
		$obSession = Session::instance();
		if ( $this->auth_config == null )
			$this->auth_config = Kohana::$config->load('auth');

		$UserNow = $obSession->get($this->auth_config['bck_session_key']);
		if ( $UserNow ) {
			$obSession->set($this->auth_config['session_key'], $UserNow);
			$obSession->delete($this->auth_config['bck_session_key']);
			return TRUE;
		} else {
			return FALSE;
		}

	}

}