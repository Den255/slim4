<?php
namespace App;
use App\Models\User;
/**
 * Auth
 *
 * @author    Haven Shen <havenshen@gmail.com>
 * @copyright    Copyright (c) Haven Shen
 */
class Auth
{
	public function user()
	{
		return User::find(isset($_SESSION['user']) ? $_SESSION['user'] : 0);
	}
	public function check()
	{
		return isset($_SESSION['user']);
	}
	public function attempt($login, $password)
	{
		$user = User::where('login', $login)->first();
		if (! $user) {
            print_r("No user");
			return false;
		}
		if (password_verify($password, $user->password)) {
			$_SESSION['user'] = $user->id;
			return true;
		}
		return false;
	}
	public function logout()
	{
        unset($_SESSION['user']);
        return "OK";
	}
}