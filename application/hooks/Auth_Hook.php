<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class AuthHook
{
	function __construct() {
	}


	function set_view() {

		$this->CI =&get_instance();

		if( isset($this->CI->layout) ) {
			
			$this->CI->data['header'] = $this->CI->load->view('layouts/_header', $this->CI->header, true);
			$this->CI->data['footer'] = $this->CI->load->view('layouts/_footer', $this->CI->footer, true);

			$this->CI->load->view($this->CI->layout, $this->CI->data);
		}
	}
}

/* End of file base.php */
/* Location: ./application/libraries/Auth_Hook.php */