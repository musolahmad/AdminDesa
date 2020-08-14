<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class PHPMailer_lib {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct()
	{
		# code...
		log_message('Debug','PHPMailer class is loaded.');
	}
	public function load()
	{
		# code...
		require_once APPPATH.'third_party/PHPMailer/Exception.php';
		require_once APPPATH.'third_party/PHPMailer/PHPMailer.php';
		require_once APPPATH.'third_party/PHPMailer/SMTP.php';

		$email = new PHPMailer;
		return $email;
	}
}
