<?php
	class WeddingplannerInit {

		public function __construct() {
			
			$dir = realpath(__DIR__ . '/..');

			// include the helper functions
			require_once $dir . '/lib/helpers.php';

			// Definie globals
			weddingplanner_define_globals();

			// include all the classes
			require_once WEDDING_API_DIR . '/classes/class-weddingplanner-api.php';
			require_once WEDDING_API_DIR . '/classes/class-weddingplanner-view.php';

		}

		public function init_view() {

			$variables = array(
				'locations_list' 		=> weddingplanner_location_list('@id', 'name'),
				'functionaries_list' 	=> weddingplanner_functionary_list('@id', 'name'),
			);

			WeddingPlannerView::get_index( $variables );

		}

	}