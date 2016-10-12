<?php
namespace Admin;
class AdminController extends BaseController{
	public function index(){
		global $G,$lang;
		if ($this->checkFormSubmit()){
			$delete = $_GET['delete'];
			if ($delete && is_array($delete)){
				$deleteids = implodeids($delete);
				M('admins')->where(array('adminid'=>array('IN', $deleteids)))->delete();
			}
			$this->showSuccess('delete_succeed');
		}else {
			$pagesize = 20;
			$totalnum = M('admins')->count();
			$pagecount = $totalnum < $pagesize ? 1 : ceil($totalnum/$pagesize);
			$adminlist = M('admins')->page($G['page'], $pagesize)->order('adminid ASC')->select();
			$pages = $this->showPages($G['page'], $pagecount, $totalnum, '', 1);
			
			include template('admin_list');
		}
	}
	
	public function add(){
		if ($this->checkFormSubmit()){
			$admin = $_GET['admin'];
			if ($admin['admin'] && $admin['password']) {
				$check = M('admins')->where(array('admin'=>$admin['admin']))->count();
				if ($check > 0){
					$this->showAjaxError(-1, L('username_be_occupied'));
				}
				$admin['logintime'] = TIMESTAMP;
				$admin['loginip'] = getIp();
				M('admins')->insert($admin);
				$this->showAjaxReturn(0);
			}else {
				$this->showAjaxError(-2, L('invalid_parameter'));
			}
		}
	}
	
	public function edit(){
		$adminid = intval($_GET['adminid']);
		if ($this->checkFormSubmit()){
			$admin = $_GET['admin'];
			if ($admin['admin']) {
				$check = M('admins')->where(array('admin'=>$admin['admin']))->count();
				if ($check > 1){
					$this->showAjaxError(-1, L('username_be_occupied'));
				}
				
				if ($admin['password']) {
					$admin['password'] = getPassword($admin['password']);
				}else {
					unset($admin['password']);
				}
				M('admins')->where(array('adminid'=>$adminid))->update($admin);
				$this->showAjaxReturn(0);
			}else {
				$this->showAjaxError(-2, L('invalid_parameter'));
			}
		}else {
			$admin = M('admins')->where(array('adminid'=>$adminid))->getOne();
			$this->showAjaxReturn($admin);
		}
	}
}