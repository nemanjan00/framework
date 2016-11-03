<?php
session_start();

Class Auth {
	private $badAuthFunction;

	public function setBadAuthFunction($function){
		$this->badAuthFunction = $function;
	}

	public function isAuthenticated($function = null){
		if($function !== null){
			if($this->_isAuthenticated()){
				return $function;
			} else {
				return $this->badAuthFunction;
			}
		} else {
			if($this->_isAuthenticated()){
				return true;
			} else {
				return false;
			}
		}
	}

	private function _isAuthenticated(){
		if(isset($_SESSION["username"]) && isset($_SESSION["password"])){
			$query = QB::table('admin')->where('username', '=', $_SESSION["username"])->where('password', '=', $_SESSION["password"]);
			$users = $query->get();

			if(count($users) > 0){
				return true;
			} else {
				unset($_SESSION["username"]);
				unset($_SESSION["password"]);

				return false;
			}
		}
		else
		{
			return false;
		}
	}

	public function login($username, $password){
		$query = QB::table('admin')->where('username', '=', $username)->where('password', '=', md5(md5($password)));
		$users = $query->get();

		if(count($users) > 0){
			$_SESSION["username"] = $username;
			$_SESSION["password"] = md5(md5($password));

			return true;
		} else {
			return false;
		}
	}

	public function logout(){
		unset($_SESSION["username"]);
		unset($_SESSION["password"]);
	}
}

