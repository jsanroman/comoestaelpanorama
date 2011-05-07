<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Curl {
	/**
	 * CodeIgniter global
	 *
	 * @var string
	 **/
	protected $ci;

	public $url = "";

	/**
	 * __construct
	 *
	 * @return void
	 * @author 
	 **/
	public function __construct() {
		$this->ci =& get_instance();
	}


	public function open_https_url($url) {
		$this->url = $url;

	    $ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, $this->url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
	    curl_setopt($ch, CURLOPT_HEADER, 1);
	    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$result =curl_exec ($ch);
		curl_close ($ch);

		return $result;
	}
	
	public function open_https_url_file($url) {

		$filename = basename($url);
		$year = substr($filename, -8,2);
		$month= substr($filename, -6,2);
		if (is_numeric($year) && is_numeric($month)) $path = PATH_TEMP."$year/$month/";
		else $path = (is_numeric($year)) ? PATH_TEMP."$year/other_data/" :  PATH_TEMP."non_structured_data/";
		if (!file_exists($path)) mkdir($path,'0777',true);
		$file = $path.$filename;
		if (file_exists($file)) return $file;
		
		$ch=curl_init($url);
		$fp=fopen ($file, "w");
		curl_setopt ($ch, CURLOPT_FILE, $fp);
		curl_setopt ($ch, CURLOPT_HEADER ,0);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,60);
		curl_exec ($ch);
		curl_close ($ch);
		fclose($fp);
		return $file;
	}
}