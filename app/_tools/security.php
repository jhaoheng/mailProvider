<?php  
// - 雜湊
// 	- md5
// 	- sha128
// - 加密
// 	- aes256
	

function encrypt_aes128($plaintext){
	
	$hash_value = hash("sha256","orbwebkey20170801maxhu");
	$key = pack('H*', $hash_value);
	$key_size =  strlen($key);
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
    $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $plaintext, MCRYPT_MODE_CBC, $iv);
    $ciphertext = $iv . $ciphertext;
    $ciphertext_base64 = base64_encode($ciphertext);

    return $ciphertext_base64;
}

function decrypt_aes128($ciphertext_base64){
	
	$hash_value = hash("sha256","orbwebkey20170801maxhu");
	$key = pack('H*', $hash_value);
	$key_size =  strlen($key);
	$ciphertext_dec = base64_decode($ciphertext_base64);
	$iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
	$iv_dec = substr($ciphertext_dec, 0, $iv_size);
	$ciphertext_dec = substr($ciphertext_dec, $iv_size);
	$plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);

	return json_decode(str_replace('\\u0000', "", json_encode($plaintext_dec)));
}

function sha256work($password){
	return hash("sha256",$password);
}
?>