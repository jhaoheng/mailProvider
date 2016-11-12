<?php

use Phalcon\Mvc\User\Component,
	Phalcon\Mvc\View;
use Phalcon\Mvc\View\Simple as SimpleView;

require_once __DIR__ . '/../../vendor/Swift/swift_required.php';
/**
 *
 * Sends e-mails based on pre-defined templates
 */
class Mail extends Component
{

	protected $_transport;

	/**
	 * Applies a template to be used in the e-mail
	 *
	 * @param string $companyFolder : 
	 * @param string $tmplate_name : 版型名稱
	 * @param array $params : 要帶入版型的參數
	 */
	public function getTemplate($companyFolder, $tmplate_name, $params)
	{
		return $this->view->render('emailTemplates/'.$companyFolder.'/'.$tmplate_name, $params);
	}

	/**
	 * Sends e-mails via gmail based on predefined templates
	 *
	 * @param array $to
	 * @param string $mailType
	 * @param string $mailSetting
	 * @param array $params : 要帶入版型的參數
	 */
	public function send($to, $mailType, $mailSettings, $params)
	{

		$template = $this->getTemplate($mailSettings['company'],$mailType, $params);


		$mail_subject = !empty($mailSettings['subject'][$mailType]) ? $mailSettings['subject'][$mailType] : 'No find Title';
		$mail_to = $to;
		$mail_fromMail = $mailSettings['mailFrom']['Email'];
		$mail_fromName = $mailSettings['mailFrom']['Name'];
		$mail_smtp_server = $mailSettings['mail']['smtp']['server'];
		$mail_smtp_port = $mailSettings['mail']['smtp']['port'];
		$mail_smtp_security = $mailSettings['mail']['smtp']['security'];
		$mail_smtp_username = $mailSettings['mail']['smtp']['username'];
		$mail_smtp_password = $mailSettings['mail']['smtp']['password'];


		// Create the message
		$message = Swift_Message::newInstance()
  			->setSubject($mail_subject)
  			->setTo($to)
  			->setFrom(array(
  				$mail_fromMail => $mail_fromName
  			))
  			->setBody($template, 'text/html');
  			if (!$this->_transport) {
				$this->_transport = Swift_SmtpTransport::newInstance(
					$mail_smtp_server,
					$mail_smtp_port,
					$mail_smtp_security
				)
	  			->setUsername($mail_smtp_username)
	  			->setPassword($mail_smtp_password);
		  	}
		  	// Create the Mailer using your created Transport
			$mailer = Swift_Mailer::newInstance($this->_transport);

			return $mailer->send($message);
	}

}