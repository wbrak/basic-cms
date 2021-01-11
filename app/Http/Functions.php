<?php

// Key Value From Json
function kvfj($json, $key){
	if($json == null):
		return null;
	else:
		$json = json_decode($json, true);
		if(array_key_exists($key, $json)):
			return $json[$key];
		else:
			return null;
		endif;
	endif;

}

function getModulesArray(){
	$a = [
		'0' => Lang::get('Posts'),
		'1' => Lang::get('Pages'),
		'2' => Lang::get('Comments'),
        '3' => Lang::get('Products'),
	];

	return $a;
}

function getRoleUserArray($mode, $id){
	$roles = ['0' => Lang::get('User'), '1' => Lang::get('Customer'), '2' => Lang::get('SuperAdmin'), '3' => Lang::get('Employee'), '4' => Lang::get('Interpreter')];
	if(!is_null($mode)):
		return $roles;
	else:
		return $roles[$id];
	endif;
}

function getUserStatusArray($mode, $id){
	$status = ['0' => Lang::get('Registered'), '1' => Lang::get('Verified'), '100' => Lang::get('Banned')];
	if(!is_null($mode)):
		return $status;
	else:
		return $status[$id];
	endif;
	return $status[$id];
}

function user_permissions(){
	$permission = [
		'Dashboard' => [
			'icon' => '<i class="fas fa-home"></i>',
			'title' => Lang::get('Module Dashboard'),
			'keys' => [
				'Dashboard' => Lang::get('Can see the Dashboard'),
				'Dashboard_posts_stats' => Lang::get('Can see the Posts stats'),
				'Dashboard_pages_stats' => Lang::get('Can see the Pages stats'),
				'Dashboard_comments_stats' => Lang::get('Can see the Comments stats'),
				'Dashboard_users_stats' => Lang::get('Can see the Users stats'),
			]
		],
		'Categories' => [
			'icon' => '<i class="fas fa-folder-open"></i>',
			'title' => Lang::get('Module Categories'),
			'keys' => [
				'Categories' => Lang::get('Can see the Categories'),
				'CategoryAdd' => Lang::get('Can add Categories'),
				'CategoryEdit' => Lang::get('Can edit Categories'),
				'CategoryDelete' => Lang::get('Can delete Categories'),
			]
		],
		'Posts' => [
			'icon' => '<i class="fas fa-newspaper"></i>',
			'title' => Lang::get('Module Posts'),
			'keys' => [
				'Posts' => Lang::get('Can see the Posts'),
				'PostAdd' => Lang::get('Can add Posts'),
				'PostEdit' => Lang::get('Can edit Posts'),
				'PostDetail' => Lang::get('Can see details the Posts'),
				'PostDelete' => Lang::get('Can delete Posts'),
			]
		],
		'Pages' => [
			'icon' => '<i class="fas fa-pager"></i>',
			'title' => Lang::get('Module Pages'),
			'keys' => [
				'Pages' => Lang::get('Can see the Pages'),
				'PageAdd' => Lang::get('Can add Pages'),
				'PageEdit' => Lang::get('Can edit Pages'),
				'PageDetail' => Lang::get('Can see details the Pages'),
				'PageDelete' => Lang::get('Can delete Pages'),
			]
		],
		'Comments' => [
			'icon' => '<i class="fas fa-comments"></i>',
			'title' => Lang::get('Module Comments'),
			'keys' => [
				'Comments' => Lang::get('Can see the Comments'),
				'CommentAdd' => Lang::get('Can add Comments'),
				'CommentEdit' => Lang::get('Can edit Comments'),
				'CommentDetail' => Lang::get('Can see details the Comments'),
				'CommentDelete' => Lang::get('Can delete Comments'),
			]
		],
        'Products' => [
            'icon' => '<i class="fas fa-shopping-cart"></i>',
            'title' => Lang::get('Module Products'),
            'keys' => [
                'Products' => Lang::get('Can see the Products'),
                'ProductAdd' => Lang::get('Can add Products'),
                'ProductEdit' => Lang::get('Can edit Products'),
                'ProductDetail' => Lang::get('Can see details the Products'),
                'ProductDelete' => Lang::get('Can delete Products'),
            ]
        ],
		'Users' => [
			'icon' => '<i class="fas fa-users"></i>',
			'title' => Lang::get('Module Users'),
			'keys' => [
				'Users' => Lang::get('Can see the Users'),
				'UserEdit' => Lang::get('Can edit Users'),
				'UserBanned' => Lang::get('Can suspend Users'),
				'UserPermissions' => Lang::get('Can change permissions Users'),
				'UserProfile' => Lang::get('Can see your Profile'),
				'UserProfileAvatar' => Lang::get('Can edit your Avatar'),
				'UserProfileInfo' => Lang::get('Can edit your Profile'),
				'UserProfilePassword' => Lang::get('Can edit your Password'),
				'UserDelete' => Lang::get('Can delete Users'),
			]
		],
		'Settings' => [
			'icon' => '<i class="fas fa-cogs"></i>',
			'title' => Lang::get('Module Settings'),
			'keys' => [
				'Settings' => Lang::get('Can see the Settings'),
				'SettingsLogo' => Lang::get('Can change the Logo'),
				'SettingsFaviconAdmin' => Lang::get('Can change the FaviconAdmin'),
				'SettingsFavicon' => Lang::get('Can change the Favicon'),
				'SettingsLang' => Lang::get('Can change the Language'),
			]
		]
	];
	return $permission;
}
