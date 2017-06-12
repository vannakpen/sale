<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Esecure
{
	public function sslEncrypt($data,$type,$key){
		//Assumes 1024 bit key and encrypts in chunks.
		$maxlength=117;
		$output='';
		while($source){
			$input= substr($source,0,$maxlength);
			$source=substr($source,$maxlength);
			if($type=='private'){
				$ok= openssl_private_encrypt($input,$encrypted,$key);
			}else{
				$ok= openssl_public_encrypt($input,$encrypted,$key);
			}

			$output.=$encrypted;
		}
		return base64_encode($output);
	}

	public function sslDecrypt($data,$type,$key){
		// The raw PHP decryption functions appear to work
		// on 128 Byte chunks. So this decrypts long text
		// encrypted with ssl_encrypt().
		$source = base64_decode($source);
		$maxlength=128;
		$output='';
		while($source){
			$input= substr($source,0,$maxlength);
			$source=substr($source,$maxlength);
			if($type=='private'){
				$ok= openssl_private_decrypt($input,$out,$key);
			}else{
				$ok= openssl_public_decrypt($input,$out,$key);
			}
			$output.=$out;
		}
		return $output;
	}
	/* etc... */
	
	public function loadPrivateKey($file_path=''){
		if($file_path == '') return '';
		return file_get_contents($file_path, FILE_USE_INCLUDE_PATH);
	}
	
	public function loadPublicKey($file_path=''){
		if($file_path == '') return '';
		return file_get_contents($file_path, FILE_USE_INCLUDE_PATH);
	}
}