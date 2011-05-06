<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('flash_msg'))
{
	function flash_msg()
	{
		// get flash message from CI instance
		$ci =& get_instance();
		$flashmsg = $ci->session->flashdata('msg');

		$html = '';
		if (is_array($flashmsg))
		{
			$html = '
			<div id="flashmsg" class="'.$flashmsg["type"].'" hideDelay="'.$flashmsg['hideDelay'].'">
				<p>'.$flashmsg['msg'].'</p>
				</div>';
		}
		return $html;
	}
}

function msg_ok( $msg, $hideDelay=true ) {
	$ci =& get_instance();
	if($hideDelay) $hideDelay=1;
	$ci->session->set_flashdata( 'msg', array( 'msg' => $msg, 'type' => 'msg_ok', 'hideDelay' => $hideDelay ));
}

function msg_warning( $msg ) {
	$ci =& get_instance();
	$ci->session->set_flashdata( 'msg', array( 'msg' => $msg, 'type' => 'msg_warning' ));
}

function msg_error( $msg ) {
	$ci =& get_instance();
	$ci->session->set_flashdata( 'msg', array( 'msg' => $msg, 'type' => 'msg_error' ));
}
