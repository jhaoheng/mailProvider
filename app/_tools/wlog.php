<?php  

include "tool.php";

use Phalcon\Logger\Formatter\Line as LineFormatter;
/**
* 
*/
class recordLog 
{
	
	function __construct(argument)
	{
		# code...
	}

	function wlog($nameTag, $log_parameters, $fileName='debug.log'){

		// use Phalcon\Logger;
		// use Phalcon\Logger\Adapter\File as FileAdapter;
		$logger = new Phalcon\Logger\Adapter\File ("../_logs/".$fileName);

		$formatter = new LineFormatter("\n\r【%date%】 - %message%");

		// Changing the logger format
		$logger->setFormatter($formatter);
		$logger->begin();
		$body = array(
			'Tag' => $nameTag,
			'Parameters' => $log_parameters 
		);

		$logger->info(json_encode($body));
		$logger->commit();
	}

	function wlogWithIp(){
		$ips = userIp();
		wlog('check admin login ip', $ips, 'call_adminPower_info.log');
	}

}
?>