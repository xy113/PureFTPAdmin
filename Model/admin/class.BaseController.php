<?php
namespace Admin;
use Core\Controller;
class BaseController extends Controller{
	function __construct(){
		parent::__construct();
		define('IN_ADMIN', true);
		//M('admins')->update(array('password'=>getPassword('$pureftp@dashixiong$')));
		if (!cookie('adminlogined')){
			if (G('c') != 'login'){
				$this->showlogin();
			}
		}else {
			cookie('adminlogined', 1 ,1800);
		}
	}
	
	/**
	 * 显示管理员登录
	 */
	protected function showlogin(){
		global $G,$lang;
		include template('admin_login');
		exit();
	}
}