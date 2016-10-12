<?php
namespace Core;
class UploadFile extends Upload {
	function save() {
		$this->savepath = $this->savepath ? $this->savepath : C('ATTACHDIR');
		$this->maxsize  = $this->maxsize ? $this->maxsize : setting('file_max_size') * 1048576;
		$this->allowtypes = $this->allowtypes ? $this->allowtypes : @explode(',', setting('file_allow_types'));
		$filename = date('Y').'/'.date('m').'/'.$this->setfilename();
		if ($filedata = parent::save($filename)){
			return $filedata;
		}else {
			return false;
		}
	}
}