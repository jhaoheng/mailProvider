<?php

use Phalcon\Http\Response;
use Phalcon\HTTP\Request;


$app->get('/hello', function() use ($app){
	return "hello";
});

// 一組公司序號，建立一個 api 接口

/**
 * default company 
	- header => authmailprovider : {set in mail_send/default.php}
	- body(json) => { 	
						"mailConfig" : "default",
						"emails" : ["{your email address}"],
						"mailType" : "index",
    					"mailViewArg" : {"text" : "Hi , this is a default set"}
    				}
	- curl -X POST -H "authmailprovider : test" -d '{
	    "mailConfig" : "default",
	    "emails" : [
	        "xxxxxx@gmail.com"
	    ],
	    "mailType" : "index",
	    "mailViewArg" : {
	        "text" : "Hi , this is a default set"
	    } http://{url}/mail/default/send
 */
$app->post('/mail/default/send', function () use ($app) {
	return include "mail_send/default.php";
});

/**
 * Not found handler
 */
$app->notFound(function () {
	$response = new Response();
	$response->setStatusCode(404, "Not Found")->sendHeaders();
	$response->setJsonContent(
		array(
			'status'		=>		'ERROR',
			'messages'		=>		'The api not exist.'
		)
	);
	return $response;
});
