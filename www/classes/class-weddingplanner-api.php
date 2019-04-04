<?php
	if ( ! defined('WEDDING_API_DIR')) { exit; }
	
	class WeddingPlannerApi {

		public static $instance;
		public $api_url 			= 'http://api.convenantgemeenten.nl';
		
		public function __construct( $api_url = false ) {

			if( $api_url )
				$this->api_url = $api_url;

			 self::$instance = $this;

		}

		public static function get_instance() {
		
			if (self::$instance === null) {
				self::$instance = new self();
			}

			return self::$instance;
		
		}

		public function person($method = 'GET', $arguments = array()) {

			$endpoint = 'person';

			return $this->request($endpoint, $method, $arguments);

		}

		public function place($method = 'GET', $arguments = array()) {

			$endpoint = 'place';

			return $this->request($endpoint, $method, $arguments);

		}


		public function request( $endpoint, $method = 'GET', $arguments = array() ) {

			$custom_methods = array( 'POST', 'PUT' );
			$headers 		= array( 'Accept: application/json' );
			
			// Initiate the curl-request
			$ch = curl_init( $this->get_endpoint_url($endpoint) );
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

			if( in_array($method, $custom_methods) ) {
				
				// Set the request method
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
				
				// Set the postdata
				$data_string 	= json_encode($arguments);
				$headers[] 		= 'Content-Length: ' . strlen($data_string);

			}
			
			// Set the headers and ask to return data
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

			// Execute the curl-request
			$response = curl_exec($ch);
			$httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
			curl_close($ch);

			if( !$response || $httpcode !== 200 ) {

				// There was an error
				return false;

			}
			
			// Convert the response
			$data = $this->get_response( $response );

			return $data;

		}

		public function get_endpoint_url( $endpoint ) {

			return rtrim($this->api_url, '/') . '/' . $endpoint;

		}

		public function get_response( $response ) {
		
			$object = json_decode($response, true);

			return (json_last_error() == JSON_ERROR_NONE ? $object : $response);
		
		}

	}