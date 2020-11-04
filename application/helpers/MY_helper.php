<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( !function_exists('ValidateSession'))
{
    function ValidateSession()
    {
        $CI =& get_instance();
        if( $CI->agent->is_robot() )
		{
			show_error("Dispositivo desconocido.", 403, "Acceso denegado");
			die();
		}

		if( $CI->session->userdata('id') == null ) 
		{ 
			$CI->session->set_userdata('last_page', current_url());
			redirect("/user/login");
			return;
		}
		
		if (is_null($CI->session->userdata('vigencia')))
		{
			$CI->session->set_userdata('last_page', current_url());
			redirect("/user/change_password");
			return;
		}
    }   
}

if (!function_exists('GetRandomString'))
{
	function GetRandomString($length = 8)
	{
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$string = '';

		for ($i = 0; $i < $length; $i++) {
			$string .= $characters[mt_rand(0, strlen($characters) - 1)];
		}

		return $string;
	}
}