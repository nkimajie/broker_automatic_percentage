<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Models\PlanModel;
use App\Models\InvestedModel;
use App\Models\SettingsModel;
use App\Libraries\App_services;
// import configurations
use Config\Services;
use Config\Database;

class Admin extends Controller
{
	public function __construct()
	{
		helper(['form', 'url', 'date', 'mail']);
        $this->app_services = new App_services();
	}


	#dashboard
	public function index(){
		if(! session()->user['userType'] == 'admin')
			return redirect()->to(base_url('auth/login'));

        $session = session();
        $email = \config\Services::email();
		$data['title'] = 'Dashboard | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Admin Dashboard';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();
		$plan_model = new PlanModel();

		$limit = 5;
		$data['user_history'] = $invested_model->getUser($limit, array('uuid' => $session->user['uuid']));
		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['users'] = $user_model->getUsers();
		$data['admins'] = $user_model->getAdmin();
		$data['pendingAcct'] = $user_model->getPendingAcct();
		$data['pendingDeposit'] = $invested_model->getPendingDeposit();
		$data['pendingWithdrawal'] = $invested_model->getPendingWithdrawal();
		$data['allWithdrawal'] = $invested_model->getAllWithdrawal();
		$data['allDeposit'] = $invested_model->getAllDeposit();
		$data['plans'] = $plan_model->getAll();
		$data['usersTrans'] = $invested_model->getUsersTrans(5);

		// echo $data['allDeposit']; die;
		// echo '<pre>'; print_r($data['allDeposit']->invested); '</pre>'; die;

		echo view('admins/index', $data);
	}

	public function users(){
		$session = session();
        $email = \config\Services::email();
		$data['title'] = 'Users | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Users';

		$user_model = new UserModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['verifiedUsers'] = $user_model->getVerifiedUsers();
		$data['countries'] = $this->app_services->getCountries();

		if($this->request->getMethod() == 'post'){
			// echo '<pre>'; print_r($this->request->getPost()); '</pre>'; die;

			$rules = [
                'email' => 'required|string|valid_email',
                'name' => 'required|string',
                'wallet_bal' => 'required|trim',
				'invested' => 'required|trim',
				'withdrawal' =>  'required|trim',
				'bonus' =>  'required|trim',
				'subscription' =>  'required|trim',
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
				$email = $this->request->getVar('email');

				$data = [
					'wallet_bal' => $this->request->getVar('wallet_bal'),
					'invested' => $this->request->getVar('invested'),
					'withdrawal' => $this->request->getVar('withdrawal'),
					'bonus' => $this->request->getVar('bonus'),
					'subscription' => $this->request->getVar('subscription'),
				];

				$check = $user_model->updateUserByEmail($email, $data);
				try{
                    $to = $this->request->getPost('email');
                    $subject = 'Account Update';
                    $reason = 'Update';
                    // $message = 'Dear '.$this->request->getVar('name', FILTER_SANITIZE_STRING).',<br><br> Your Condie Investments Limited trading account has been updated . <br><br> Kindly check new trading account update.<br>
                    // <a href="'.base_url().'/login" target="_blank">Login Now
                    // </a><br>Thanks, Condie Investments Limited<br>';

										$message = '<!DOCTYPE html>
			<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
			<head>
			    <meta charset="utf-8">
			    <meta name="viewport" content="width=device-width">
			    <meta http-equiv="X-UA-Compatible" content="IE=edge">
			    <meta name="x-apple-disable-message-reformatting">
			    <title></title>

			    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">


			    <style>

			        html,
							body {
							    margin: 0 auto !important;
							    padding: 0 !important;
							    height: 100% !important;
							    width: 100% !important;
							    background: #f1f1f1;
							}

							* {
							    -ms-text-size-adjust: 100%;
							    -webkit-text-size-adjust: 100%;
							}


							div[style*="margin: 16px 0"] {
							    margin: 0 !important;
							}


							table,
							td {
							    mso-table-lspace: 0pt !important;
							    mso-table-rspace: 0pt !important;
							}

							table {
							    border-spacing: 0 !important;
							    border-collapse: collapse !important;
							    table-layout: fixed !important;
							    margin: 0 auto !important;
							}

							img {
							    -ms-interpolation-mode:bicubic;
							}

							a {
							    text-decoration: none;
							}

							*[x-apple-data-detectors],
							.unstyle-auto-detected-links *,
							.aBn {
							    border-bottom: 0 !important;
							    cursor: default !important;
							    color: inherit !important;
							    text-decoration: none !important;
							    font-size: inherit !important;
							    font-family: inherit !important;
							    font-weight: inherit !important;
							    line-height: inherit !important;
							}

							.a6S {
							    display: none !important;
							    opacity: 0.01 !important;
							}

							.im {
							    color: inherit !important;
							}

							img.g-img + div {
							    display: none !important;
							}


							@media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
							    u ~ div .email-container {
							        min-width: 320px !important;
							    }
							}

							@media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
							    u ~ div .email-container {
							        min-width: 375px !important;
							    }
							}

							@media only screen and (min-device-width: 414px) {
							    u ~ div .email-container {
							        min-width: 414px !important;
							    }
							}


							    </style>


							    <style>

								    .primary{
								background: #17bebb;
							}
							.bg_white{
								background: #ffffff;
							}
							.bg_light{
								background: #f7fafa;
							}
							.bg_black{
								background: #000000;
							}
							.bg_dark{
								background: rgba(0,0,0,.8);
							}
							.email-section{
								padding:2.5em;
							}


							.btn{
								padding: 10px 15px;
								display: inline-block;
							}
							.btn.btn-primary{
								border-radius: 5px;
								background: #17bebb;
								color: #ffffff;
							}
							.btn.btn-white{
								border-radius: 5px;
								background: #ffffff;
								color: #000000;
							}
							.btn.btn-white-outline{
								border-radius: 5px;
								background: transparent;
								border: 1px solid #fff;
								color: #fff;
							}
							.btn.btn-black-outline{
								border-radius: 0px;
								background: transparent;
								border: 2px solid #000;
								color: #000;
								font-weight: 700;
							}
							.btn-custom{
								color: rgba(0,0,0,.3);
								text-decoration: underline;
							}

							h1,h2,h3,h4,h5,h6{
								font-family: "Poppins", sans-serif;
								color: #000000;
								margin-top: 0;
								font-weight: 400;
							}

							body{
								font-family: "Poppins", sans-serif;
								font-weight: 400;
								font-size: 15px;
								line-height: 1.8;
								color: rgba(0,0,0,.4);
							}

							a{
								color: #17bebb;
							}

							table{
							}

							.logo h1{
								margin: 0;
							}
							.logo h1 a{
								color: #17bebb;
								font-size: 24px;
								font-weight: 700;
								font-family: "Poppins", sans-serif;
							}


							.hero{
								position: relative;
								z-index: 0;
							}

							.hero .text{
								color: rgba(0,0,0,.3);
							}
							.hero .text h2{
								color: #000;
								font-size: 34px;
								margin-bottom: 0;
								font-weight: 200;
								line-height: 1.4;
							}
							.hero .text h3{
								font-size: 24px;
								font-weight: 300;
							}
							.hero .text h2 span{
								font-weight: 600;
								color: #000;
							}

							.text-author{
								bordeR: 1px solid rgba(0,0,0,.05);
								max-width: 50%;
								margin: 0 auto;
								padding: 2em;
							}
							.text-author img{
								border-radius: 50%;
								padding-bottom: 20px;
							}
							.text-author h3{
								margin-bottom: 0;
							}
							ul.social{
								padding: 0;
							}
							ul.social li{
								display: inline-block;
								margin-right: 10px;
							}


							.footer{
								border-top: 1px solid rgba(0,0,0,.05);
								color: rgba(0,0,0,.5);
							}
							.footer .heading{
								color: #000;
								font-size: 20px;
							}
							.footer ul{
								margin: 0;
								padding: 0;
							}
							.footer ul li{
								list-style: none;
								margin-bottom: 10px;
							}
							.footer ul li a{
								color: rgba(0,0,0,1);
							}


							@media screen and (max-width: 500px) {


							}


					</style>


							</head>

							<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
								<center style="width: 100%; background-color: #f1f1f1;">
							    <div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
							      &zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
							    </div>
							    <div style="max-width: 600px; margin: 0 auto;" class="email-container">

							      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
							      	<tr>
							          <td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
							          	<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
							          		<tr>
							          			<td class="logo" style="text-align: center;">
										            <h1><a href="#">Condie Investments Limited</a></h1>
										          </td>
							          		</tr>
							          	</table>
							          </td>
								      </tr>
											<tr>
							          <td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
							            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
							            	<tr>
							            		<td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
							            			<div class="text">
							            				<h2>Dear '.$this->request->getVar('name', FILTER_SANITIZE_STRING).'</h2>
							            			</div>
							            		</td>
							            	</tr>
							            	<tr>
										          <td style="text-align: center;">
										          	<div class="text-author">
											          	<h3 class="name"> Your Condie Investments Limited trading account has been updated.<br> Kindly check new trading account update.<br><br>Best Regards,</h3>
																	<br><br>
											          	<span class="position">Condie Investments Limited</span>
											           	<p><a href="'. site_url() .'login" class="btn btn-primary">Log In</a></p>
										           	</div>
										          </td>
										        </tr>
							            </table>
							          </td>
								      </tr>
							      </table>
							      <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
							      	<tr>
							          <td valign="middle" class="bg_light footer email-section">
							            <table>
							            	<tr>
							                <td valign="top" width="33.333%" style="padding-top: 20px;">
							                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
							                    <tr>
							                      <td style="text-align: left; padding-right: 10px;">
							                      	<h3 class="heading">About</h3>
							                      	<p>Condie Investments Limited is a licensed UK Private Limited Company with Share Capital incorporated on 28 October 2002.</p>
							                      </td>
							                    </tr>
							                  </table>
							                </td>
							                <td valign="top" width="33.333%" style="padding-top: 20px;">
							                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
							                    <tr>
							                      <td style="text-align: left; padding-left: 5px; padding-right: 5px;">
							                      	<h3 class="heading">Contact Info</h3>
							                      	<ul>
												                <li><span class="text">FAIRHURST HOUSE, 7 ACORN BUSINESS PARK HEATON,LANE STOCKPORT, CHESHIRE, SK4 1AS</span></li>
												                <li><span class="text">+447883172471</span></a></li>
												              </ul>
							                      </td>
							                    </tr>
							                  </table>
							                </td>
							                <td valign="top" width="33.333%" style="padding-top: 20px;">
							                  <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
							                    <tr>
							                      <td style="text-align: left; padding-left: 10px;">
							                      	<h3 class="heading">Useful Links</h3>
							                      	<ul>
																			<li>
																				<a href="<?= site_url() ?>">Home</a>
																			</li>
																			<li>
																				<a href="'. site_url() .'pricing">Plan</a>
																			</li>
																			<li>
																				<a href="'. site_url() .'pricing">Why Us</a>
																			</li>
																			<li>
																				<a href="'. site_url() .'about">About Us</a>
																			</li>
																			<li>
																				<a href="'. site_url() .'contact">Contact us</a>
																			</li>
												              </ul>
							                      </td>
							                    </tr>
							                  </table>
							                </td>
							              </tr>
							            </table>
							          </td>
							        </tr>
							        <tr>
							          <td class="bg_light" style="text-align: center;">
							          	<p>No longer want to receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p>
							          </td>
							        </tr>
							      </table>

							    </div>
							  </center>
							</body>
							</html>';

                    #call send_mail helper
                    if(send_mail($to, $subject, $reason, $message)){
                        $session->setFlashdata('success', 'Account successfully updated.');
                        return redirect()->to(current_url());
                    }
                    else{
                        $session->setFlashdata('success', 'Account successfully updated.');
                        return redirect()->to(current_url());
                    //    $err = $email->printDebugger(['headers']);
                    //     print_r($err); die;
                    }
                }
                catch (\Exception $e)
                {
                    die($e->getMessage());
                }


			}
		}
		echo view('admins/users', $data);
	}

	// profile
	public function profile(){
        $session = session();
        $email = \config\Services::email();
		$data['title'] = 'Profile | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Profile';
		$user_model = new UserModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['countries'] = $this->app_services->getCountries();
		// echo '<pre>'; print_r($data['countries']); '</pre>'; die;
		if($this->request->getMethod() == 'post'){
			$rules = [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email'    => [
                    'rules'  => 'required|valid_email|trim',
                    'errors' => [
                        'is_unique' => '{value} already exist!'
                    ]
                ],
                'country' => 'required|trim',
				'username' => 'trim|permit_empty',
				'phone' => 'trim|permit_empty',
				'address' => 'trim|permit_empty',

            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
				$data = [
					'firstname' => $this->request->getVar('firstname'),
					'lastname' => $this->request->getVar('lastname'),
					'country' => $this->request->getVar('country'),
					'username' => $this->request->getVar('username'),
					'phone' => $this->request->getVar('phone'),
					'address' => $this->request->getVar('address'),
				];

				$updateUser = $user_model->updateUser($session->user['uuid'], $data);
				if($updateUser){
					$session->setFlashdata('success', 'Profile successfully updated');
					return redirect()->to(current_url());
				}else{
					$session->setFlashdata('error', 'Opps! An Error occured');
					return redirect()->to(current_url());
				}
			}
		}
		echo view('admins/profile', $data);
	}


	public function history(){
		$session = session();
        $email = \config\Services::email();
		$data['title'] = 'Transaction History | Condie Investments Limited - Diversified investment platform';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['user_history'] = $invested_model->getUser(array('uuid' => $session->user['uuid']));

		// echo '<pre>'; print_r($data['user_history']); '</pre>'; die;
		echo view('users/history', $data);
	}

	#approve user
	public function approveUser(){
		if (!$this->request->isAJAX())
        {
            exit('No direct allowed');
        }
		$session = session();
        $email = \config\Services::email();
		$user_model = new UserModel();
		$plan_model = new PlanModel();
		$invested_model = new InvestedModel();

		$user_data = $user_model->getOne(array('uuid' => $this->request->getVar('userId')));
		// echo "<pre>"; print_r($data['user']); die;
		$data['plans'] = $plan_model->getAll();
		if($this->request->getMethod() == 'post'){
			$user_id = $this->request->getVar('userId');
			$data = [
				'account_status' => 'verified'
			];
			$updateUser = $user_model->updateUser($user_id, $data);
			if($updateUser == true){
				$name = $user_data->firstname;
				$user_email = $user_data->email;
				try{
					$to = $user_email;
					$subject = 'Approved';
					$reason = 'Approved';


					$message = '<!DOCTYPE html>
					<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
					<head>
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width">
					<meta http-equiv="X-UA-Compatible" content="IE=edge">
					<meta name="x-apple-disable-message-reformatting">
					<title></title>

					<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">


					<style>

							html,
							body {
									margin: 0 auto !important;
									padding: 0 !important;
									height: 100% !important;
									width: 100% !important;
									background: #f1f1f1;
							}

							* {
									-ms-text-size-adjust: 100%;
									-webkit-text-size-adjust: 100%;
							}


							div[style*="margin: 16px 0"] {
									margin: 0 !important;
							}


							table,
							td {
									mso-table-lspace: 0pt !important;
									mso-table-rspace: 0pt !important;
							}

							table {
									border-spacing: 0 !important;
									border-collapse: collapse !important;
									table-layout: fixed !important;
									margin: 0 auto !important;
							}

							img {
									-ms-interpolation-mode:bicubic;
							}

							a {
									text-decoration: none;
							}

							*[x-apple-data-detectors],
							.unstyle-auto-detected-links *,
							.aBn {
									border-bottom: 0 !important;
									cursor: default !important;
									color: inherit !important;
									text-decoration: none !important;
									font-size: inherit !important;
									font-family: inherit !important;
									font-weight: inherit !important;
									line-height: inherit !important;
							}

							.a6S {
									display: none !important;
									opacity: 0.01 !important;
							}

							.im {
									color: inherit !important;
							}

							img.g-img + div {
									display: none !important;
							}


							@media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
									u ~ div .email-container {
											min-width: 320px !important;
									}
							}

							@media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
									u ~ div .email-container {
											min-width: 375px !important;
									}
							}

							@media only screen and (min-device-width: 414px) {
									u ~ div .email-container {
											min-width: 414px !important;
									}
							}


									</style>


									<style>

										.primary{
								background: #17bebb;
							}
							.bg_white{
								background: #ffffff;
							}
							.bg_light{
								background: #f7fafa;
							}
							.bg_black{
								background: #000000;
							}
							.bg_dark{
								background: rgba(0,0,0,.8);
							}
							.email-section{
								padding:2.5em;
							}


							.btn{
								padding: 10px 15px;
								display: inline-block;
							}
							.btn.btn-primary{
								border-radius: 5px;
								background: #17bebb;
								color: #ffffff;
							}
							.btn.btn-white{
								border-radius: 5px;
								background: #ffffff;
								color: #000000;
							}
							.btn.btn-white-outline{
								border-radius: 5px;
								background: transparent;
								border: 1px solid #fff;
								color: #fff;
							}
							.btn.btn-black-outline{
								border-radius: 0px;
								background: transparent;
								border: 2px solid #000;
								color: #000;
								font-weight: 700;
							}
							.btn-custom{
								color: rgba(0,0,0,.3);
								text-decoration: underline;
							}

							h1,h2,h3,h4,h5,h6{
								font-family: "Poppins", sans-serif;
								color: #000000;
								margin-top: 0;
								font-weight: 400;
							}

							body{
								font-family: "Poppins", sans-serif;
								font-weight: 400;
								font-size: 15px;
								line-height: 1.8;
								color: rgba(0,0,0,.4);
							}

							a{
								color: #17bebb;
							}

							table{
							}

							.logo h1{
								margin: 0;
							}
							.logo h1 a{
								color: #17bebb;
								font-size: 24px;
								font-weight: 700;
								font-family: "Poppins", sans-serif;
							}


							.hero{
								position: relative;
								z-index: 0;
							}

							.hero .text{
								color: rgba(0,0,0,.3);
							}
							.hero .text h2{
								color: #000;
								font-size: 34px;
								margin-bottom: 0;
								font-weight: 200;
								line-height: 1.4;
							}
							.hero .text h3{
								font-size: 24px;
								font-weight: 300;
							}
							.hero .text h2 span{
								font-weight: 600;
								color: #000;
							}

							.text-author{
								bordeR: 1px solid rgba(0,0,0,.05);
								max-width: 50%;
								margin: 0 auto;
								padding: 2em;
							}
							.text-author img{
								border-radius: 50%;
								padding-bottom: 20px;
							}
							.text-author h3{
								margin-bottom: 0;
							}
							ul.social{
								padding: 0;
							}
							ul.social li{
								display: inline-block;
								margin-right: 10px;
							}


							.footer{
								border-top: 1px solid rgba(0,0,0,.05);
								color: rgba(0,0,0,.5);
							}
							.footer .heading{
								color: #000;
								font-size: 20px;
							}
							.footer ul{
								margin: 0;
								padding: 0;
							}
							.footer ul li{
								list-style: none;
								margin-bottom: 10px;
							}
							.footer ul li a{
								color: rgba(0,0,0,1);
							}


							@media screen and (max-width: 500px) {


							}


					</style>


					</head>

					<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
						<center style="width: 100%; background-color: #f1f1f1;">
							<div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
								&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
							</div>
							<div style="max-width: 600px; margin: 0 auto;" class="email-container">

								<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
									<tr>
										<td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
											<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td class="logo" style="text-align: center;">
														<h1><a href="#">Condie Investments Limited</a></h1>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
											<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
												<tr>
													<td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
														<div class="text">
															<h2>Dear '. $name .'</h2>
														</div>
													</td>
												</tr>
												<tr>
													<td style="text-align: center;">
														<div class="text-author">
															<h3 class="name">Your account has been activated. <br><br>You can now login and deposit your investment.<br><br>Best Regards,</h3>
															<br><br>
															<span class="position">Condie Investments Limited</span>
															<p><a href="'. site_url() .'login" class="btn btn-primary">Log In</a></p>
														</div>
													</td>
												</tr>
											</table>
										</td>
									</tr>
								</table>
								<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
									<tr>
										<td valign="middle" class="bg_light footer email-section">
											<table>
												<tr>
													<td valign="top" width="33.333%" style="padding-top: 20px;">
														<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
															<tr>
																<td style="text-align: left; padding-right: 10px;">
																	<h3 class="heading">About</h3>
																	<p>Condie Investments Limited is a licensed UK Private Limited Company with Share Capital incorporated on 28 October 2002.</p>
																</td>
															</tr>
														</table>
													</td>
													<td valign="top" width="33.333%" style="padding-top: 20px;">
														<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
															<tr>
																<td style="text-align: left; padding-left: 5px; padding-right: 5px;">
																	<h3 class="heading">Contact Info</h3>
																	<ul>
																		<li><span class="text">FAIRHURST HOUSE, 7 ACORN BUSINESS PARK HEATON,LANE STOCKPORT, CHESHIRE, SK4 1AS</span></li>
																		<li><span class="text">+447883172471</span></a></li>
																	</ul>
																</td>
															</tr>
														</table>
													</td>
													<td valign="top" width="33.333%" style="padding-top: 20px;">
														<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
															<tr>
																<td style="text-align: left; padding-left: 10px;">
																	<h3 class="heading">Useful Links</h3>
																	<ul>
																	<li>
																		<a href="<?= site_url() ?>">Home</a>
																	</li>
																	<li>
																		<a href="'. site_url() .'pricing">Plan</a>
																	</li>
																	<li>
																		<a href="'. site_url() .'pricing">Why Us</a>
																	</li>
																	<li>
																		<a href="'. site_url() .'about">About Us</a>
																	</li>
																	<li>
																		<a href="'. site_url() .'contact">Contact us</a>
																	</li>
																	</ul>
																</td>
															</tr>
														</table>
													</td>
												</tr>
											</table>
										</td>
									</tr>
									<tr>
										<td class="bg_light" style="text-align: center;">
											<p>No longer want to receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p>
										</td>
									</tr>
								</table>

							</div>
						</center>
					</body>
					</html>';

					#call send_mail helper
					if(send_mail($to, $subject, $reason, $message)){
						echo json_encode('success');
					}else{
						echo json_encode('error');
					}
				}
				catch (\Exception $e)
				{
					die($e->getMessage());
				}
			}
			else{
				$session->setFlashdata('error', 'Opps an Error Occured');
				// return redirect()->to(base_url('users/withdrawal'));
			}
			// echo json_encode('success');
		}
	}

	#decline user
	public function declineUser(){
		if (!$this->request->isAJAX())
        {
            exit('No direct allowed');
        }
		$session = session();
        $email = \config\Services::email();
		$user_model = new UserModel();
		$plan_model = new PlanModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['plans'] = $plan_model->getAll();
		if($this->request->getMethod() == 'post'){
			$user_id = $this->request->getVar('userId');
			$data = [
				'account_status' => 'declined'
			];
			$updateUser = $user_model->updateUser($user_id, $data);
			echo json_encode('success');
		}
	}

	// pendingWithdrawal
	public function pendingWithdrawal(){
        $session = session();
        $email = \config\Services::email();
		$data['title'] = 'Pending Withdrawal | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Pending Withdrawal';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['countries'] = $this->app_services->getCountries();
		$data['pendingWithdrawal'] = $invested_model->getPendingWithdrawal();
		// echo '<pre>'; print_r($data['pendingWithdrawal']); die;

		echo view('admins/pendingWithdrawal', $data);
	}


	#approve withdrawal
	public function approveWithdrawal(){
		if (!$this->request->isAJAX())
        {
            exit('No direct allowed');
        }
		$session = session();
        $email = \config\Services::email();
		$user_model = new UserModel();
		$plan_model = new PlanModel();
		$invested_model = new InvestedModel();

    $email = $this->request->getVar('email');

		$data['user'] = $user_model->getOne(array('email' => $email));
		$data['plans'] = $plan_model->getAll();
		if($this->request->getMethod() == 'post'){
			$amount = $this->request->getVar('amount');
			$wallet_bal = $data['user']->wallet_bal - $amount;
			$withdrawal = $data['user']->withdrawal + $amount;
			$data1 = [
        'withdrawal' => $withdrawal,
				'wallet_bal' => $wallet_bal,
      ];
			$result = $user_model->updateOne($data['user']->uuid, $data1);

			$investedId = $this->request->getVar('investedId');
			$email = $this->request->getVar('email');
			$name = $this->request->getVar('name');
			// var_dump($this->request->getPost()); die;

			if ($result) {
				$data = [
					'status' => 'approved'
				];
				$updateUser = $invested_model->updateOne($investedId, $data);
				if($updateUser == true){
					try{
						$to = $email;
						$subject = 'Withdrawal';
						$reason = 'Withdrawal';


						$message = '<!DOCTYPE html>
						<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
						<head>
						<meta charset="utf-8">
						<meta name="viewport" content="width=device-width">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta name="x-apple-disable-message-reformatting">
						<title></title>

						<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">


						<style>

								html,
								body {
										margin: 0 auto !important;
										padding: 0 !important;
										height: 100% !important;
										width: 100% !important;
										background: #f1f1f1;
								}

								* {
										-ms-text-size-adjust: 100%;
										-webkit-text-size-adjust: 100%;
								}


								div[style*="margin: 16px 0"] {
										margin: 0 !important;
								}


								table,
								td {
										mso-table-lspace: 0pt !important;
										mso-table-rspace: 0pt !important;
								}

								table {
										border-spacing: 0 !important;
										border-collapse: collapse !important;
										table-layout: fixed !important;
										margin: 0 auto !important;
								}

								img {
										-ms-interpolation-mode:bicubic;
								}

								a {
										text-decoration: none;
								}

								*[x-apple-data-detectors],
								.unstyle-auto-detected-links *,
								.aBn {
										border-bottom: 0 !important;
										cursor: default !important;
										color: inherit !important;
										text-decoration: none !important;
										font-size: inherit !important;
										font-family: inherit !important;
										font-weight: inherit !important;
										line-height: inherit !important;
								}

								.a6S {
										display: none !important;
										opacity: 0.01 !important;
								}

								.im {
										color: inherit !important;
								}

								img.g-img + div {
										display: none !important;
								}


								@media only screen and (min-device-width: 320px) and (max-device-width: 374px) {
										u ~ div .email-container {
												min-width: 320px !important;
										}
								}

								@media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
										u ~ div .email-container {
												min-width: 375px !important;
										}
								}

								@media only screen and (min-device-width: 414px) {
										u ~ div .email-container {
												min-width: 414px !important;
										}
								}


										</style>


										<style>

											.primary{
									background: #17bebb;
								}
								.bg_white{
									background: #ffffff;
								}
								.bg_light{
									background: #f7fafa;
								}
								.bg_black{
									background: #000000;
								}
								.bg_dark{
									background: rgba(0,0,0,.8);
								}
								.email-section{
									padding:2.5em;
								}


								.btn{
									padding: 10px 15px;
									display: inline-block;
								}
								.btn.btn-primary{
									border-radius: 5px;
									background: #17bebb;
									color: #ffffff;
								}
								.btn.btn-white{
									border-radius: 5px;
									background: #ffffff;
									color: #000000;
								}
								.btn.btn-white-outline{
									border-radius: 5px;
									background: transparent;
									border: 1px solid #fff;
									color: #fff;
								}
								.btn.btn-black-outline{
									border-radius: 0px;
									background: transparent;
									border: 2px solid #000;
									color: #000;
									font-weight: 700;
								}
								.btn-custom{
									color: rgba(0,0,0,.3);
									text-decoration: underline;
								}

								h1,h2,h3,h4,h5,h6{
									font-family: "Poppins", sans-serif;
									color: #000000;
									margin-top: 0;
									font-weight: 400;
								}

								body{
									font-family: "Poppins", sans-serif;
									font-weight: 400;
									font-size: 15px;
									line-height: 1.8;
									color: rgba(0,0,0,.4);
								}

								a{
									color: #17bebb;
								}

								table{
								}

								.logo h1{
									margin: 0;
								}
								.logo h1 a{
									color: #17bebb;
									font-size: 24px;
									font-weight: 700;
									font-family: "Poppins", sans-serif;
								}


								.hero{
									position: relative;
									z-index: 0;
								}

								.hero .text{
									color: rgba(0,0,0,.3);
								}
								.hero .text h2{
									color: #000;
									font-size: 34px;
									margin-bottom: 0;
									font-weight: 200;
									line-height: 1.4;
								}
								.hero .text h3{
									font-size: 24px;
									font-weight: 300;
								}
								.hero .text h2 span{
									font-weight: 600;
									color: #000;
								}

								.text-author{
									bordeR: 1px solid rgba(0,0,0,.05);
									max-width: 50%;
									margin: 0 auto;
									padding: 2em;
								}
								.text-author img{
									border-radius: 50%;
									padding-bottom: 20px;
								}
								.text-author h3{
									margin-bottom: 0;
								}
								ul.social{
									padding: 0;
								}
								ul.social li{
									display: inline-block;
									margin-right: 10px;
								}


								.footer{
									border-top: 1px solid rgba(0,0,0,.05);
									color: rgba(0,0,0,.5);
								}
								.footer .heading{
									color: #000;
									font-size: 20px;
								}
								.footer ul{
									margin: 0;
									padding: 0;
								}
								.footer ul li{
									list-style: none;
									margin-bottom: 10px;
								}
								.footer ul li a{
									color: rgba(0,0,0,1);
								}


								@media screen and (max-width: 500px) {


								}


						</style>


						</head>

						<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f1f1f1;">
							<center style="width: 100%; background-color: #f1f1f1;">
								<div style="display: none; font-size: 1px;max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden; mso-hide: all; font-family: sans-serif;">
									&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;&zwnj;&nbsp;
								</div>
								<div style="max-width: 600px; margin: 0 auto;" class="email-container">

									<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
										<tr>
											<td valign="top" class="bg_white" style="padding: 1em 2.5em 0 2.5em;">
												<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td class="logo" style="text-align: center;">
															<h1><a href="#">Condie Investments Limited</a></h1>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td valign="middle" class="hero bg_white" style="padding: 2em 0 4em 0;">
												<table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
													<tr>
														<td style="padding: 0 2.5em; text-align: center; padding-bottom: 3em;">
															<div class="text">
																<h2>Dear '. $name .'</h2>
															</div>
														</td>
													</tr>
													<tr>
														<td style="text-align: center;">
															<div class="text-author">
																<h3 class="name">Your withdrawal has been approved. <br><br>$'. $amount .' has been successfully paid into your btc address provided in your profile.<br><br>Best Regards,</h3>
																<br><br>
																<span class="position">Condie Investments Limited</span>
																<p><a href="'. site_url() .'login" class="btn btn-primary">Log In</a></p>
															</div>
														</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
									<table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
										<tr>
											<td valign="middle" class="bg_light footer email-section">
												<table>
													<tr>
														<td valign="top" width="33.333%" style="padding-top: 20px;">
															<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
																<tr>
																	<td style="text-align: left; padding-right: 10px;">
																		<h3 class="heading">About</h3>
																		<p>Condie Investments Limited is a licensed UK Private Limited Company with Share Capital incorporated on 28 October 2002.</p>
																	</td>
																</tr>
															</table>
														</td>
														<td valign="top" width="33.333%" style="padding-top: 20px;">
															<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
																<tr>
																	<td style="text-align: left; padding-left: 5px; padding-right: 5px;">
																		<h3 class="heading">Contact Info</h3>
																		<ul>
																			<li><span class="text">FAIRHURST HOUSE, 7 ACORN BUSINESS PARK HEATON,LANE STOCKPORT, CHESHIRE, SK4 1AS</span></li>
																			<li><span class="text">+447883172471</span></a></li>
																		</ul>
																	</td>
																</tr>
															</table>
														</td>
														<td valign="top" width="33.333%" style="padding-top: 20px;">
															<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
																<tr>
																	<td style="text-align: left; padding-left: 10px;">
																		<h3 class="heading">Useful Links</h3>
																		<ul>
																		<li>
																			<a href="<?= site_url() ?>">Home</a>
																		</li>
																		<li>
																			<a href="'. site_url() .'pricing">Plan</a>
																		</li>
																		<li>
																			<a href="'. site_url() .'pricing">Why Us</a>
																		</li>
																		<li>
																			<a href="'. site_url() .'about">About Us</a>
																		</li>
																		<li>
																			<a href="'. site_url() .'contact">Contact us</a>
																		</li>
																		</ul>
																	</td>
																</tr>
															</table>
														</td>
													</tr>
												</table>
											</td>
										</tr>
										<tr>
											<td class="bg_light" style="text-align: center;">
												<p>No longer want to receive these email? You can <a href="#" style="color: rgba(0,0,0,.8);">Unsubscribe here</a></p>
											</td>
										</tr>
									</table>

								</div>
							</center>
						</body>
						</html>';

						#call send_mail helper
						if(send_mail($to, $subject, $reason, $message)){
							echo json_encode('success');
						}else{
							echo json_encode('error');
						}
					}
					catch (\Exception $e)
					{
						die($e->getMessage());
					}
				}
				else{
					$session->setFlashdata('error', 'Opps an Error Occured');
					// return redirect()->to(base_url('users/withdrawal'));
				}
			}
			// echo json_encode('success');
		}
	}

	#decline withdrawal
	public function declineWithdrawal(){
		if (!$this->request->isAJAX())
		{
			exit('No direct allowed');
		}
		$session = session();
		$email = \config\Services::email();
		$user_model = new UserModel();
		$plan_model = new PlanModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['plans'] = $plan_model->getAll();
		if($this->request->getMethod() == 'post'){
			$investedId = $this->request->getVar('investedId');

			$data = [
				'status' => 'declined'
			];
			$updateUser = $invested_model->updateOne($investedId, $data);
			echo json_encode('success');
		}
	}

	// pendingWithdrawal
	public function pendingDeposit(){
        $session = session();
        $email = \config\Services::email();
		$data['title'] = 'Pending Deposit | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Pending Deposit';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['countries'] = $this->app_services->getCountries();
		$data['pendingDeposit'] = $invested_model->getPendingDeposit();
		// echo '<pre>'; print_r($data['countries']); '</pre>'; die;

		echo view('admins/pendingDeposit', $data);
	}

	#approve deposit
	public function approveDeposit(){
		if (!$this->request->isAJAX())
        {
            exit('No direct allowed');
        }
		$session = session();
        $email = \config\Services::email();
		$user_model = new UserModel();
		$plan_model = new PlanModel();
		$invested_model = new InvestedModel();

		$email = $this->request->getVar('email');

		$data['user'] = $user_model->getOne(array('email' => $email));
		// echo "<pre>"; print_r($email); die;
		$data['plans'] = $plan_model->getAll();
		if($this->request->getMethod() == 'post'){
			$investedId = $this->request->getVar('investedId');
			$amount = $this->request->getVar('amount')+$data['user']->invested;
      $wallet_bal = $data['user']->wallet_bal + $this->request->getVar('amount');
			// echo "<pre>"; print_r($wallet_bal); die;
      if ($amount <= 9999) {
        $subscription = 'Basic';
      }elseif ($amount <= 49999) {
        $subscription = 'Silver';
      }elseif ($amount <= 99999) {
        $subscription = 'Business';
      }elseif ($amount >= 100000) {
        $subscription = 'Premium';
      }
      // var_dump($subscription); die;
      $data1 = [
        'wallet_bal' => $wallet_bal,
        'invested' => $amount,
        'subscription' => $subscription
      ];
			$result = $user_model->updateOne($data['user']->uuid, $data1);
			// echo "<pre>"; print_r($result); die;

			$data2 = [
				'status' => 'approved'
			];
			$updateUser = $invested_model->updateOne($investedId, $data2);
			echo json_encode('success');
		}
	}

	// public function getdata()
	// {
	// 	$user_model = new UserModel();
	// 	$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
	// 	return $data['user'];
	// }

	#decline deposit
	public function declineDeposit(){
		if (!$this->request->isAJAX())
		{
			exit('No direct allowed');
		}
		$session = session();
		$email = \config\Services::email();
		$user_model = new UserModel();
		$plan_model = new PlanModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['plans'] = $plan_model->getAll();
		if($this->request->getMethod() == 'post'){
			$investedId = $this->request->getVar('investedId');

			$data = [
				'status' => 'declined'
			];
			$updateUser = $invested_model->updateOne($investedId, $data);
			echo json_encode('success');
		}
	}

	#view all approved deposit
	public function approvedDeposit(){
        $session = session();
        $email = \config\Services::email();
		$data['title'] = 'Approved Deposit | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Approved Deposit';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['countries'] = $this->app_services->getCountries();
		$data['approvedDeposit'] = $invested_model->getApprovedDeposit();
		// echo '<pre>'; print_r($data['countries']); '</pre>'; die;

		echo view('admins/approvedDeposit', $data);
	}

	#view all declined deposit
	public function declinedDeposit(){
        $session = session();
        $email = \config\Services::email();
		$data['title'] = 'Declined Deposit | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Declined Deposit';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['countries'] = $this->app_services->getCountries();
		$data['declinedDeposit'] = $invested_model->getDeclinedDeposit();
		// echo '<pre>'; print_r($data['countries']); '</pre>'; die;

		echo view('admins/declinedDeposit', $data);
	}

	#view all approved withdrawal
	public function approvedWithdrawal(){
        $session = session();
        $email = \config\Services::email();
		$data['title'] = 'Approved Withdrawal | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Approved Withdrawal';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['countries'] = $this->app_services->getCountries();
		$data['approvedWithdrawal'] = $invested_model->getApprovedWithdrawal();
		// echo '<pre>'; print_r($data['countries']); '</pre>'; die;

		echo view('admins/approvedWithdrawal', $data);
	}

	#view all declined withdrawal
	public function declinedWithdrawal(){
        $session = session();
        $email = \config\Services::email();
		$data['title'] = 'Declined Withdrawal | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Declined Withdrawal';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['countries'] = $this->app_services->getCountries();
		$data['declinedWithdrawal'] = $invested_model->getDeclinedWithdrawal();
		// echo '<pre>'; print_r($data['countries']); '</pre>'; die;

		echo view('admins/declinedWithdrawal', $data);
	}

	#deactivate
	public function deactivateAcct(){
		if (!$this->request->isAJAX())
        {
            exit('No direct allowed');
        }
		$session = session();
        $email = \config\Services::email();
		$user_model = new UserModel();
		$plan_model = new PlanModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['plans'] = $plan_model->getAll();
		if($this->request->getMethod() == 'post'){
			$userId = $this->request->getVar('userId');

			$data = [
				'account_status' => 'suspended'
			];
			$updateUser = $user_model->updateUser($userId, $data);
			echo json_encode('success');
		}
	}

	#deactivated account
	public function deactivated(){
        $session = session();
        $email = \config\Services::email();
		$data['title'] = 'Deactivated Accounts | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Deactivated Accounts';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['deactivatedAcct'] = $user_model->deactivated();
		// echo '<pre>'; print_r($data['countries']); '</pre>'; die;

		echo view('admins/deactivated', $data);
	}

	#activate
	public function activateAcct(){
		if (!$this->request->isAJAX())
        {
            exit('No direct allowed');
        }
		$session = session();
        $email = \config\Services::email();
		$user_model = new UserModel();
		$plan_model = new PlanModel();
		$invested_model = new InvestedModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['plans'] = $plan_model->getAll();
		if($this->request->getMethod() == 'post'){
			$userId = $this->request->getVar('userId');

			$data = [
				'account_status' => 'verified'
			];
			$updateUser = $user_model->updateUser($userId, $data);
			echo json_encode('success');
		}
	}

	#settings view
	public function settings(){
        $session = session();
        $email = \config\Services::email();
		$data['title'] = 'Settings | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Settings';
		$settings_model = new SettingsModel();

		$data['currentData'] = $settings_model->getOne(array('id' => 1));
		// echo '<pre>'; print_r($data['countries']); '</pre>'; die;

		echo view('admins/settings', $data);
	}

	#settings
	public function settingsPost(){
		// if (!$this->request->isAJAX())
    //     {
    //         exit('No direct allowed');
    //     }
		$session = session();
        $email = \config\Services::email();
		$settings_model = new SettingsModel();

		// var_dump($this->request->getPost('btc_wallet')); die;
		if($this->request->getMethod() == 'post'){

			$data = [
				'btc_id' => $this->request->getPost('btc_wallet'),
				'ltc_id' => $this->request->getPost('ltc_wallet'),
        'eth_id' => $this->request->getPost('eth_wallet'),
				'usdt_id' => $this->request->getPost('usdt_wallet'),
        'referral' => $this->request->getPost('referral'),
        'basic_percentage' => $this->request->getPost('basic_percentage'),
        'silver_percentage' => $this->request->getPost('silver_percentage'),
        'business_percentage' => $this->request->getPost('business_percentage'),
				'premium_percentage' => $this->request->getPost('premium_percentage'),
			];
			// $updateUser = $user_model->updateUser($userId, $data);
			$insertUser = $settings_model->update('1', $data);
			if($insertUser){
					$session->setFlashdata('success', 'Settings successfully updated.');
					return redirect()->to('settings');
			}
			else{
				$session->setFlashdata('error', 'Opps! An Error occured');
				return redirect()->to('settings');

			}
		}
	}
}
