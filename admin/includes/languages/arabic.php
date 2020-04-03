<?php

	function lang($phrase) {

		static $lang = array(

			// Navbar Links

			'HOME_ADMIN' 	=> 'الرئسيه',
			'CATEGORIES' 	=> 'الفئات',
			'ITEMS' 		=> 'العناصر',
			'MEMBERS' 		=> 'الاعضاء',
			'COMMENTS'		=> 'تعليق',
			'STATISTICS' 	=> 'ثاتب',
			'LOGS' 			=> 'خروج',
			'' => '',
			'' => '',
			'' => '',
			'' => '',
			'' => ''
		);

		return $lang[$phrase];

	}
