<?php  

$authorization = $app->request->getHeader("authmailprovider");

if ($authorization!="test") {
	echo "Error Auth";
	return;
}

$jsonRawBody = $app->request->getJsonRawBody();

$mailConfig = strtolower($jsonRawBody->mailConfig);
$emails = $jsonRawBody->emails;
$mailType = strtolower($jsonRawBody->mailType);
$mailViewArg = json_decode(json_encode($jsonRawBody->mailViewArg), true);


if (is_file(APP_PATH.'/config/mail_config/'.$mailConfig.'.php')) {
	$mailSetting = include APP_PATH.'/config/mail_config/'.$mailConfig.'.php';
}
else
	$mailSetting = include APP_PATH.'/config/mail_config/default.php';


/*
	[1] : mails
	[2] : mailType
	[3] : mailSetting
	[4] : mail content info
 */
$app->getDI()->getMail()->send(
    $emails,
    $mailType,
    $mailSetting,
    $mailViewArg
);

?>