<?php
namespace Admin;
class LogoutController extends BaseController{
	public function index(){
		cookie('adminid', null);
		cookie('admin', null);
		cookie('adminlogined', null);
		$this->redirect($_SERVER['HTTP_REFERER']);
	}
}