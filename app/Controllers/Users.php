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

class Users extends Controller
{
	public function __construct()
	{
		helper(['form', 'url', 'date', 'mail']);
    $this->app_services = new App_services();
		$this->uri = new \CodeIgniter\HTTP\URI();
		$this->useremail = 'noreply@condieinvestmentslimited.com, condieinvestmentslimited@protonmail.com, nkimajie2@gmail.com';
	}


	#dashboard
	public function index(){
		if(! session()->user['userType'] == 'user')
			return redirect()->to(base_url('auth/login'));

		// $url = current_url(true);
		// echo $this->uri->segment(1); die;
		// echo "<pre>";	print_r($url);die;
        $session = session();
        $email = \config\Services::email();

		$data['title'] = 'Dashboard | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Dashboard';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();

		$limit = 5;
		$settings_model = new SettingsModel();
		$data['user_history'] = $invested_model->getUser($limit, array('uuid' => $session->user['uuid']));
		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['referral'] = $user_model->totalReferral(array('referred_by' => $session->user['uuid']));
		$data['currentData'] = $settings_model->getOne(array('id' => 1));
		// var_dump($session->user['uuid']);
		// echo '<pre>'; print_r($data['user_history']); '</pre>'; die;
		echo view('user/index', $data);
	}

	public function trade(){
		if(! session()->user['userType'] == 'user')
			return redirect()->to(base_url('auth/login'));


        $session = session();
        $email = \config\Services::email();

		$data['title'] = 'Live Trade | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Live Trade';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();

		$limit = 5;
		$data['user_history'] = $invested_model->getUser($limit, array('uuid' => $session->user['uuid']));
		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		// var_dump($session->user['uuid']);
		// echo '<pre>'; print_r($data['user_history']); '</pre>'; die;
		echo view('user/trade', $data);
	}

	public function verify(){
		if(! session()->user['userType'] == 'user')
			return redirect()->to(base_url('auth/login'));

		$session = session();
        $email = \config\Services::email();
				$data['title'] = 'Verify Account | Condie Investments Limited - Diversified investment platform';
				$data['page_title'] = 'Verify Account';

		$user_model = new UserModel();

		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));

		$file = $this->request->getFile('document');
		if($file){
			  if ($file->isValid() && ! $file->hasMoved())
			  {
				   $randomName = $file->getRandomName();
				//    $img->move(WRITEPATH.'uploads', $newName);
				//provide random name for file to avoid clash
				if($file->move(FCPATH.'public/users/documents/', $randomName)){
					$path = base_url().'/public/users/documents/'.$file->getName();
					// insert into db
					// var_dump($path); die;
					$data = [
						'document' => $path,
						'account_status' => 'pending'
					];
					$updateDoc = $user_model->updateUser($session->user['uuid'], $data);
					if($updateDoc == true){
						try{
							$to = $session->user['email'];
							$subject = 'Account Verification';
							$reason = 'Action';
							// $message = 'Dear '.$session->user['firstname'].' '.$session->user['lastname'].',<br><br> Your Account verification document has been submitted successfully and your account is under review. <br><br> We will inform you once we are done.<br>
							// </a><br>Best Regards,<br>
							// Condie Investments Limited';
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
            				<h2>Dear '.$session->user['firstname'].'</h2>
            			</div>
            		</td>
            	</tr>
            	<tr>
			          <td style="text-align: center;">
			          	<div class="text-author">
				          	<h3 class="name">Your Account verification document has been submitted successfully and your account is under review.<br> We will inform you once we are done.<br>Best Regards,<br></h3>
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
					                <li><span class="text">+44 788 317 2471</span></a></li>
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
								$session->setFlashdata('success', 'Your document has been submitted successfully');
								return redirect()->to(base_url('users/verify'));
								// echo json_encode(array('status' => 'success', 'redirect' => base_url('users')));
							}
							else{
								$session->setFlashdata('error', 'Opps.. An error occured. We are on it.');
								return redirect()->to(base_url('users/verify'));

								// echo json_encode(array('status' => 'error'));
							//    $err = $email->printDebugger(['headers']);
							//     print_r($err); die;
							}
						}
						catch (\Exception $e)
						{
							die($e->getMessage());
						}
					}
					else{
						echo json_encode(array('status' => 'error'));
					}
				}
				else{
					echo json_encode('error');
					// $session->setFlashdata('error', $file->getErrorString());
					// return redirect()->to(base_url('admin/profile'));
				}
			  }

		}
		else{
			echo view('user/verify', $data);
		}
	}


	public function verify_user()
	{


		$file = $this->request->getFile('document');
		var_dump($file);
		if($file){
			  if ($file->isValid() && ! $file->hasMoved())
			  {
				   $randomName = $file->getRandomName();
				//    $img->move(WRITEPATH.'uploads', $newName);
				//provide random name for file to avoid clash
				if($file->move(FCPATH.'public/users/documents/', $randomName)){
					$path = base_url().'/public/users/documents/'.$file->getName();
					// insert into db
					// var_dump($path); die;
					$data = [
						'document' => $path,
						'account_status' => 'pending'
					];
					$updateDoc = $user_model->updateUser($session->user['uuid'], $data);
					if($updateDoc == true){
						try{
							$to = $session->user['email'];
							$subject = 'Account Verification';
							$reason = 'Action';
							$message = 'Dear '.$session->user['firstname'].' '.$session->user['lastname'].',<br><br> Your Account verification document has been submitted successfully and your account is under review. <br><br> We will inform you once we are done.<br>
							</a><br>Best Regards,<br>
							Condie Investments Limited';

							#call send_mail helper
							if(send_mail($to, $subject, $reason, $message)){
								$session->setFlashdata('success', 'Your document has been submitted successfully');
								return redirect()->to(base_url('users/verify'));
								// echo json_encode(array('status' => 'success', 'redirect' => base_url('users')));
							}
							else{
								$session->setFlashdata('error', 'Opps.. An error occured. We are on it.');
								return redirect()->to(base_url('users/verify'));

								// echo json_encode(array('status' => 'error'));
							//    $err = $email->printDebugger(['headers']);
							//     print_r($err); die;
							}
						}
						catch (\Exception $e)
						{
							die($e->getMessage());
						}
					}
					else{
						echo json_encode(array('status' => 'error'));
					}
				}
				else{
					echo json_encode('error');
					// $session->setFlashdata('error', $file->getErrorString());
					// return redirect()->to(base_url('admin/profile'));
				}
			}

		}

	}

	// profile
	public function profile(){
		if(! session()->user['userType'] == 'user')
			return redirect()->to(base_url('auth/login'));

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
					'wallet_type' => $this->request->getVar('wallet_type'),
					'btc_address' => $this->request->getVar('btc_address'),
					'paypal_tag' => $this->request->getVar('paypal_tag'),
					'zelle_tag' => $this->request->getVar('zelle_tag'),
					'cashapp_tag' => $this->request->getVar('cashapp_tag'),
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
		echo view('user/profile', $data);
	}


	public function history(){
		if(! session()->user['userType'] == 'user')
			return redirect()->to(base_url('auth/login'));

		$session = session();
        $email = \config\Services::email();
		$data['title'] = 'Transaction History | Condie Investments Limited - Diversified investment platform';
		$user_model = new UserModel();
		$invested_model = new InvestedModel();
		$limit = null;
		$data['user'] = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['user_history'] = $invested_model->getUser($limit, array('uuid' => $session->user['uuid']));
		$data['page_title'] = 'Transaction History';

		// echo '<pre>'; print_r($data['user_history']); '</pre>'; die;
		echo view('user/history', $data);
	}

	#deposit
	public function deposit(){
		if(! session()->user['userType'] == 'user')
			return redirect()->to(base_url('auth/login'));

		$session = session();
        $email = \config\Services::email();
		$data['title'] = 'Deposit | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Deposit';
		$user_model = new UserModel();
		$plan_model = new PlanModel();
		$invested_model = new InvestedModel();
		$settings_model = new SettingsModel();

		$data['currentMaster'] = $settings_model->getOne(array('id' => 1));
		$user = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['user'] = $user;
		$data['plans'] = $plan_model->getAll();
		if($this->request->getMethod() == 'post'){
			// echo '<pre>'; print_r($this->request->getPost()); '</pre>'; die;

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
				'paymentMethod' => 'trim|required',
				// 'plan' => 'trim|required',
				'amount' => 'trim|required',
				'avatar' => 'uploaded[depositShot]|max_size[depositShot,4096]|ext_in[depositShot,png,jpeg,jpg,gif,svg]'
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }
			else{
				$checkVerifieAcct = $user->account_status;
				if($checkVerifieAcct == 'verified'){
					$file = $this->request->getFile('depositShot');
					// var_dump($file); die;
					if($file){
						if ($file->isValid() && !$file->hasMoved()){
							$randomName = $file->getRandomName();
							//provide random name for file to avoid clash
							if($file->move(FCPATH.'public/users/payment/', $randomName)){
								$path = base_url().'/public/users/payment/'.$file->getName();
								// insert into db
								// split plan
								$planAll = explode("_",$this->request->getVar('plan'));
								$plan = $planAll[0];
								$amount = $this->request->getVar('amount');
								$data = [
									'uuid' => $session->user['uuid'],
									'amount' => $this->request->getVar('amount'),
									'snapshot' => $path,
									// 'plan' => $plan,
									'status' => 'pending',
									'method' => $this->request->getVar('paymentMethod'),
									'type' => 'deposit',
									'date' => date('Y-m-d')
								];

								$insertDeposit = $invested_model->insert($data);
								if($insertDeposit == true){
									try{
										$to = $session->user['email'];
										$subject = 'Deposit';
										$reason = 'Deposit';
										// $message = 'Dear '.$session->user['firstname'].' '.$session->user['lastname'].',<br><br> Your deposit is pending confirmation. <br><br> We will inform you once we have verified your deposit.<br>
										// </a><br>Best Regards,<br>
										// Condie Investments Limited';


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
																				<h2>Dear '. $session->user['firstname'] .'</h2>
																			</div>
																		</td>
																	</tr>
																	<tr>
																		<td style="text-align: center;">
																			<div class="text-author">
																				<h3 class="name">  Your deposit is pending confirmation. We will inform you once we have verified your deposit.<br><br>Best Regards,</h3>
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

											try{
												$to = $this->useremail;
												$subject = 'User Deposit';
												$reason = 'Admin Notification';
												$message = 'Dear Admin,<br> '.$session->user['firstname'].' '.$session->user['lastname'].' has made a deposit of '.$data['amount'].'. please login and confirm.<br>
												</a><br>Best Regards,<br>
												Condie Investments Limited';

												#call send_mail helper
												if(send_mail($to, $subject, $reason, $message)){
													// $session->setFlashdata('success', 'Your document has been submitted successfully');
													$session->setFlashdata('success', 'Deposit successfully submitted');
													return redirect()->to(base_url('users/deposit'));
												}
												else{
													$session->setFlashdata('success', 'Deposit successfully submitted');
													return redirect()->to(base_url('users/deposit'));
												}
											}
											catch (\Exception $e)
											{
												die($e->getMessage());
											}
										}else{
											// $session->setFlashdata('error', 'Opps.. An error occured. We are on it.');
											$session->setFlashdata('success', 'Deposit successfully submitted');
											return redirect()->to(base_url('users/deposit'));								//    $err = $email->printDebugger(['headers']);
										//     print_r($err); die;
										}
									}
									catch (\Exception $e)
									{
										die($e->getMessage());
									}
								}
								else{
									// echo json_encode(array('status' => 'error'));
									$session->setFlashdata('error', 'Opps an Error Occured');
									return redirect()->to(base_url('users/deposit'));
								}
							}
							else{
								// echo json_encode('error');
								$session->setFlashdata('error', $file->getErrorString());
								return redirect()->to(base_url('users/deposit'));
							}
						}
						else{
							$session->setFlashdata('error', 'An error occured');
							return redirect()->to(base_url('users/deposit'));
						}
					}
					else{
						$session->setFlashdata('error', 'Screenshot is required');
						return redirect()->to(base_url('users/deposit'));
					}
				}
				else{
					$session->setFlashdata('error', 'Please verify your account to process transaction.');
					return redirect()->to(base_url('users/deposit'));
				}
			}
		}
		echo view('user/deposit', $data);
	}

	public function deposit_amount(){
		if(! session()->user['userType'] == 'user')
			return redirect()->to(base_url('auth/login'));

		$data['title'] = 'Deposit | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Deposit';

		echo view('user/deposit_amount', $data);
	}

	#withdrawal
	public function withdrawal(){
		if(! session()->user['userType'] == 'user')
			return redirect()->to(base_url('auth/login'));

		$session = session();
        $email = \config\Services::email();
		$data['title'] = 'Withdrawal | Condie Investments Limited - Diversified investment platform';
		$data['page_title'] = 'Withdrawal';
		$user_model = new UserModel();
		$plan_model = new PlanModel();
		$invested_model = new InvestedModel();
		$user = $user_model->getOne(array('uuid' => $session->user['uuid']));
		$data['user'] = $user;
		$data['plans'] = $plan_model->getAll();
		if($this->request->getMethod() == 'post'){
			// echo '<pre>'; print_r($this->request->getPost()); '</pre>'; die;

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
				'paymentMethod' => 'trim|required',
				'amount' => 'trim|required',
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }
			else{
				$checkVerifieAcct = $user->account_status;
				if($checkVerifieAcct == 'verified'){
					$user_bal = $user->wallet_bal;
					$withdrawal_amt = $this->request->getVar('amount');
					if($withdrawal_amt > $user_bal ){
						// insert into db
						//split plan
						$session->setFlashdata('error', 'Insufficient balance!');
						return redirect()->to(current_url());

					} else{
						$planAll = explode("_",$this->request->getVar('plan'));
						$plan = $planAll[0];
						$data = [
							'uuid' => $session->user['uuid'],
							'amount' => $this->request->getVar('amount'),
							'plan' => $plan,
							'status' => 'pending',
							'method' => $this->request->getVar('paymentMethod'),
							'type' => 'withdrawal',
							'date' => date('Y-m-d')
						];

						$insertDeposit = $invested_model->insert($data);
						if($insertDeposit == true){
							try{
								$to = $session->user['email'];
								$subject = 'Withdrawal';
								$reason = 'Withdrawal';
								// $message = 'Dear '.$session->user['firstname'].',<br><br> Your withdrawal is pending approval. <br><br> We will inform you once withdrawal has been approved.<br>
								// </a><br>Best Regards,<br>
								// Condie Investments Limited';

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
	            				<h2>Dear '.$session->user['firstname'].'</h2>
	            			</div>
	            		</td>
	            	</tr>
	            	<tr>
				          <td style="text-align: center;">
				          	<div class="text-author">
					          	<h3 class="name">Your withdrawal is pending approval. <br> We will inform you once withdrawal has been approved.<br><br>Best Regards,</h3>
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

									try{
										$to = $this->useremail;
										$subject = 'User Withdrawal';
										$reason = 'Admin Notification';
										$message = 'Dear Admin,<br> '.$session->user['firstname'].' '.$session->user['lastname'].' has made a Withdrawal of '.$data['amount'].'. please login and confirm.<br>
										</a><br>Best Regards,<br>
										Condie Investments Limited';

										#call send_mail helper
										if(send_mail($to, $subject, $reason, $message)){
											// $session->setFlashdata('success', 'Your document has been submitted successfully');
											$session->setFlashdata('success', 'Withdrawal successfully submitted and awaits approval');
											return redirect()->to(base_url('users/withdrawal'));
										}
										else{
											$session->setFlashdata('success', 'withdrawal successfully submitted and awaits approval');
											return redirect()->to(base_url('users/withdrawal'));
										}
									}
									catch (\Exception $e)
									{
										die($e->getMessage());
									}

								}else{
									// $session->setFlashdata('error', 'Opps.. An error occured. We are on it.');
									$session->setFlashdata('success', 'withdrawal successfully submitted and awaits approval');
									return redirect()->to(base_url('users/withdrawal'));								//    $err = $email->printDebugger(['headers']);
								//     print_r($err); die;
								}
							}
							catch (\Exception $e)
							{
								die($e->getMessage());
							}
						}
						else{
							$session->setFlashdata('error', 'Opps an Error Occured');
							return redirect()->to(base_url('users/withdrawal'));
						}


					}
				}
				else{
					$session->setFlashdata('error', 'Please verify your account to process transaction.');
					return redirect()->to(base_url('users/withdrawal'));
				}
			}
		}
		echo view('user/withdrawal', $data);
	}

	// public function sendMail(){
	// 	$email = \config\Services::email();
	//
	// 	$email->setTo('nkimajie2@gmail.com');
	// 	$email->setFrom('noreply@condieinvestmentslimited.com', 'hello');
	// 	$email->setSubject('hello');
	// 	$email->setmessage('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');
	//
	// 	if($email->send()){
	// 		var_dump('sent'); die;
	// 	// echo "success";
	// 	return true;
	// 	// $session->setFlashdata('success', 'Account created successfully. Please check your mail to activate your account within an hour.');
	// 	// return redirect()->to(current_url());
	// 	}
	// 	else{
	// 			$err = $email->printDebugger(['headers']);
	// 			            print_r($err); die;
	// 			//return false;
	// 	// $data = $email->printDebugger(['headers']);
	// 	// print_r($data);
	// 	}
	// }

}
