<?php
namespace Admin;
class UserController extends BaseController{
	public function index(){
		global $G,$lang;
		if ($this->checkFormSubmit()){
			$delete = $_GET['delete'];
			if ($delete && is_array($delete)){
				$deleteids = implodeids($delete);
				M('users')->where(array('userid'=>array('IN', $deleteids)))->delete();
			}
			$this->showSuccess('delete_succeed');
		}else {
			$pagesize = 20;
			$totalnum = M('users')->count();
			$pagecount = $totalnum < $pagesize ? 1 : ceil($totalnum/$pagesize);
			$userlist  = M('users')->page($G['page'], $pagesize)->order('userid ASC')->select();
			$pages = $this->showPages($G['page'], $pagecount, $totalnum, '', 1);
			
			if ($userlist){
				$datalist = array();
				foreach ($userlist as $user){
					//$user['Dir'] = str_replace(C('ftp_dir'), '', $user['Dir']);
					$datalist[$user['userid']] = $user;
				}
				$userlist = $datalist;
				unset($datalist);
			}
			
			include template('user_list');
		}
	}
	
	public function add(){
		global $G,$lang;
		if ($this->checkFormSubmit()){
			$newuser = $_GET['newuser'];
			if ($newuser['User'] && $newuser['Password']){
				$newuser['Dir'] = C('ftp_dir').$newuser['Dir'];
				$newuser['Password'] = md5($newuser['Password']);
				M('users')->insert($newuser);
				$this->showSuccess('save_succeed');
			}else {
				$this->showError('invalid_parameter');
			}
		}else {
			$user = array(
					'Uid'=>C('ftp_uid'),
					'Gid'=>C('ftp_gid'),
					'Status'=>1,
					'QuotaSize'=>C('ftp_quotasize'),
					'ULBandwidth'=>C('ftp_ulbandwidth'),
					'DLBandwidth'=>C('ftp_dlbandwidth')
			);
			include template('user_form');
		}
	}
	
	public function edit(){
		global $G,$lang;
		$userid = intval($_GET['userid']);
		if ($this->checkFormSubmit()) {
			$newuser = $_GET['newuser'];
			if ($newuser['User']){
				$newuser['Dir'] = C('ftp_dir').$newuser['Dir'];
				if ($newuser['Password']) {
					$newuser['Password'] = md5($newuser['Password']);
				}else {
					unset($newuser['Password']);
				}
				M('users')->where(array('userid'=>$userid))->update($newuser);
				$this->showSuccess('update_succeed');
			}else {
				$this->showError('invalid_parameter');
			}
		}else {
			$user = M('users')->where(array('userid'=>$userid))->getOne();
			$user['Dir'] = str_replace(C('ftp_dir'), '', $user['Dir']);
			include template('user_form');
		}
	}
	
	public function checkuser(){
		$user = $_GET['user'];
		$num = M('users')->where(array('User'=>$user))->count();
		$this->showAjaxReturn(array('num'=>$num));
	}
}