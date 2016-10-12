<?php
namespace Admin;
class AboutController extends BaseController{
	public function index(){
		global $G,$lang;
		include template('about');
	}
}