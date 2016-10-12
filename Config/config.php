<?php
return array(
		/* 数据库设置 */
		'DB_TYPE'               =>  'mysql',     // 数据库类型
		'DB_HOST'               =>  'localhost', // 服务器地址
		'DB_NAME'               =>  'pureftpd',          // 数据库名
		'DB_USER'               =>  'pureftpd',      // 用户名
		'DB_PWD'                =>  '',          // 密码
		'DB_PORT'               =>  '3306',        // 端口
		'DB_PREFIX'             =>  '',    // 数据库表前缀
		'DB_PCONNECT'           =>  1,        // 启用持久链接
		'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
		
		/* Cookie设置 */
		'COOKIE_EXPIRE'    =>  0,       // Cookie有效期
		'COOKIE_DOMAIN'    =>  '',      // Cookie有效域名
		'COOKIE_PATH'      =>  '/',     // Cookie路径
		'COOKIE_PREFIX'    =>  'pureftp_',      // Cookie前缀 避免冲突
		'COOKIE_SECURE'    =>  false,   // Cookie安全传输
		'COOKIE_HTTPONLY'  =>  '',      // Cookie httponly设置
		
		//自动加载文件配置
		'AUTO_LOAD_FUNCTIONS'=>array(),
		'AUTO_LOAD_LANGS'=>array(),
		'AUTO_LOAD_CONFIG'=>array(),
		
		/*应用配置*/
		'FOUNDERS'=>array('1000000'), //创始人UID
		'AUTHKEY'=>'000000000000',
		'STATICURL'=>'/static/',  //静态资源修正地址
		'IMAGEDIR'=>ROOT_PATH.'data/attachment/image/',
		'IMAGEURL'=>'/data/attachment/image/',  //附件修正地址
		'AVATARDIR'=>ROOT_PATH.'data/avatar/',
		'AVATARURL'=>'/data/avatar/', //头像修正地址
		
		/*FTP参数默认配置*/
		'ftp_dir'=>'/www/',
		'ftp_uid'=>'1000',
		'ftp_gid'=>'1000',
		'ftp_quotasize'=>'100',
		'ftp_ulbandwidth'=>'100',
		'ftp_dlbandwidth'=>'100'
);