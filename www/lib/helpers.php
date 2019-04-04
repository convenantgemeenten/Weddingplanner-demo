<?php 
	
	function weddingplanner_define_globals() {
		
		$wedding_api_url = 'http' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		$env_wedding_url = (getenv('WEDDING_API_URL') ? getenv('WEDDING_API_URL') : dirname($wedding_api_url));

		// define global path
		if ( ! defined('WEDDING_API_DIR'))  define('WEDDING_API_DIR', realpath(__DIR__ . '/..'));
		if ( ! defined('WEDDING_API_URL'))  define('WEDDING_API_URL', rtrim( $env_wedding_url, '/' ) );

	}

	function weddingplanner_location_list($key, $value) {

		$wedding_planner_api 	= WeddingPlannerApi::get_instance();
		$places 				= $wedding_planner_api->place();

		return weddingplanner_array_list($key, $value, $places);

	}

	function weddingplanner_functionary_list($key, $value) {

		$wedding_planner_api 	= WeddingPlannerApi::get_instance();
		$persons 				= $wedding_planner_api->person();

		return weddingplanner_array_list($key, $value, $persons);

	}

	function weddingplanner_array_list($key, $value, $array_list = array()) {

		$list = array();

		if( $array_list ) {
		
			foreach( $array_list as $item ) {

				$key_value = (isset($item[$key]) ? $item[$key] : false);
				$item_value = (isset($item[$value]) ? $item[$value] : false);

				if( $key_value && $item_value && !is_array($item_value) ) {
					$list[$key_value] = $item_value;
				}

			}

		}

		return $list;

	}