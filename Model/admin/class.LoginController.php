<?php
namespace Admin;
class LoginController extends BaseController{
	function __construct(){
		parent::__construct();
		if (cookie('adminlogined')){
			$this->redirect('/?m='.G('m'));
		}
	}
	
	public function index(){
		if ($this->checkFormSubmit()){
			$account  = trim($_GET['account_'.FORMHASH]);
			$password = trim($_GET['password_'.FORMHASH]);
			if (ismobile($account)) {
				$condition = array('mobile'=>$account);
			}elseif (isemail($account)){
				$condition = array('email'=>$account);
			}else {
				$condition = array('admin'=>$account);
			}
			$data = M('admins')->where($condition)->getOne();
			if ($data) {
				if ($data['password'] == getPassword($password)){
					cookie('adminid', $data['adminid']);
					cookie('admin', $data['admin']);
					cookie('adminlogined', 1, 1800);
					$this->showAjaxReturn(0);
				}else {
					$this->showAjaxError(-1);
				}
			}else {
				$this->showAjaxError(-1);
			}
		}else {
			$this->showlogin();
		}
	}
}