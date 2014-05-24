<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Keek_tester extends CI_Controller {

	public function index()
	{
		//$this->load->view('home');
		$apiKey = '88987de8410554a86bad5b001b3141d785c09fc1';
		$apiSecret = '8d962a69eae797ffba996a11706b35d39a730759';
		$timestamp = time();

		$searchStr = $this->encodeURIComponent('usa today');

		$data = array(
			'auth_api'=>$apiKey,
			'auth_timestamp'=>$timestamp,
			'term' => $searchStr,
		);

		ksort($data);

		$urlencodedRequest = '';

		foreach($data as $paramName => $paramVal)
		{
			$urlencodedRequest .= "&$paramName=" . $this->encodeURIComponent($paramVal);
		}

		$urlencodedRequest = substr($urlencodedRequest, 1, strlen($urlencodedRequest));        
		$urlencodedRequest = $this->encodeURIComponent($urlencodedRequest);

		$url = 'http://api.keek.com/v/1/user/search?term=' . $searchStr;

		$initalAPIurl = $this->encodeURIComponent('http://api.keek.com/v/1/user/search');

		$signatureBase = 'GET&' . $initalAPIurl . '&' .  $urlencodedRequest;

		$signingToken = $apiKey . '&' . $timestamp . '&' . $apiSecret;
		$signature = base64_encode(hash_hmac('sha1', $signatureBase, $signingToken, true));

		$headersArr = array(
			"API: $apiKey",
			"Timestamp: $timestamp",
			"Signature: $signature",                
		);
		
		var_dump($this->curl->simple_get($url, $headersArr));   

			
	}
	
	function encodeURIComponent($str) 
	{
		$revert = array('%21'=>'!', '%2A'=>'*', '%27'=>"'", '%28'=>'(', '%29'=>')');
		return strtr(rawurlencode($str), $revert);
	}
}


