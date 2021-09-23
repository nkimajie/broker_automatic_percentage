<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;
use App\Libraries\App_services;
// import configurations
use Config\Services;
use Config\Database;

class Auth extends Controller
{
	public function __construct()
	{
		helper(['form', 'url', 'date', 'mail']);
    $this->app_services = new App_services();
		$this->request = service('request');
		$this->useremail = 'noreply@condieinvestmentslimited.com, condieinvestmentslimited@protonmail.com, nkimajie2@gmail.com';
	}


	#register
	public function register($params=""){

        $session = session();
        $email = \config\Services::email();
				$data['title'] = 'Register | Condie Investments Limited - Diversified investment platform';
        $data['countries'] = $this->app_services->getCountries();
				$data['params'] = $params;
        // echo '<pre>';  print_r($data['countries']); die;
        // echo '<pre>'; print_r($data['countries']); '</pre>';
        if($this->request->getMethod() == 'post'){

            $rules = [
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'email'    => [
                    'rules'  => 'required|valid_email|trim|is_unique[users.email]',
                    'errors' => [
                        'is_unique' => '{value} already exist!'
                    ]
                ],
								'phone' => 'required|string',
								// 'btc_address' => 'required|string',
                'country' => 'required|trim',
                'password' => 'required|min_length[5]',
								'upload' => 'uploaded[depositShot]|max_size[depositShot,4096]|ext_in[depositShot,png,jpeg,jpg,gif,svg]'
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
							$file = $this->request->getFile('depositShot');
							// var_dump($file); die;
							if($file){
								if ($file->isValid() && !$file->hasMoved()){
									$randomName = $file->getRandomName();
									//provide random name for file to avoid clash
									if($file->move(FCPATH.'public/users/id/', $randomName)){
										$path = base_url().'/public/users/id/'.$file->getName();
										// insert into db
										// split plan

										$uuid = md5(str_shuffle('dhabsuhiqooc273vdhab291sncsbajboednvbapwweuowxmmc;ada'));
		                $password = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
		                // var_dump($password); die;
		                $data = [
		                    'uuid' => $uuid,
		                    'firstname' => $this->request->getPost('firstname', FILTER_SANITIZE_STRING),
		                    'lastname' => $this->request->getPost('lastname', FILTER_SANITIZE_STRING),
		                    'email' => $this->request->getPost('email', FILTER_SANITIZE_STRING),
		                    'country' => $this->request->getPost('country', FILTER_SANITIZE_STRING),
												'phone' => $this->request->getPost('phone', FILTER_SANITIZE_STRING),
												'document' => $path,
		                    'password' => $password,
		                    'status' => 1,
												'referred_by' => $params
		                ];
										// echo "<pre>"; print_r($data); die;
		                $user_model = new UserModel();


										if($user_model->insert($data)){
											try{
												$to = $this->useremail;
												$subject = 'New User Signup';
												$reason = 'Admin Notification';
												$message = 'Dear admin,<br> A new user has just sign up.<br>
												</a><br>Best Regards,<br>
												Condie Investments Limited';

												#call send_mail helper
												if(send_mail($to, $subject, $reason, $message)){

													$session->setFlashdata('success', 'Account created successfully. Please login.');
					                return redirect()->to(site_url('login'));

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

		                // try{
		                //     $to = $this->request->getPost('email');
		                //     $subject = 'Account Activation';
		                //     $reason = 'Action';
		                //     $message = 'Dear '.$this->request->getVar('firstname', FILTER_SANITIZE_STRING).' '.$this->request->getVar('lastname', FILTER_SANITIZE_STRING).',<br><br> Your Condie Investments Limited Account has been created successfully. <br><br> Kindly click the link below to activate your account.<br>
		                //     <a href="'.base_url().'/auth/activate/'.$uuid.'" target="_blank">Activate Now
		                //     </a><br>Thanks, Condie Investments Limited<br>';
										//
		                //     #call send_mail helper
		                //     if(send_mail($to, $subject, $reason, $message)){
		                //         $session->setFlashdata('success', 'Account created successfully. Please check your mail to activate your account within an hour.');
		                //         return redirect()->to(current_url());
		                //     }
		                //     else{
		                //         $session->setFlashdata('error', 'Opps.. An error occured. We are on it.');
		                //         return redirect()->to(current_url());
		                //     //    $err = $email->printDebugger(['headers']);
		                //     //     print_r($err); die;
		                //     }
		                // }
		                // catch (\Exception $e)
		                // {
		                //     die($e->getMessage());
		                // }
									}
								}
							}else {
								// code...
							}

            }
        }

		echo view('auth/register', $data);
	}

	#login
	public function login(){
        $session = session();
		$data['title'] = 'Login | Condie Investments Limited - Diversified investment platform';

        if($this->request->getMethod() == 'post'){
            $rules = [
                'email'    => [
                    'rules'  => 'required|valid_email|trim',
                    'errors' => [
                        'required' => 'email is required!'
                    ]
                ],
                'password' => 'required'
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $user_model = new UserModel();
                $user = $user_model->getOne(array('email' => $this->request->getPost('email')));
                // echo '<pre>'; print_r($user); die;
                if($user){
                    $comparePass = password_verify($this->request->getPost('password'), $user->password);
                    if($comparePass){
                        if($user->status == 0){
                            $session->setFlashdata('error', 'please check your mail to activate your account');
                            return redirect()->to(current_url());
                        }
                        else{
                            if($user->account_status == 'suspended'){
                                $session->setFlashdata('error', 'Your account has been suspended. Contact support!');
                                return redirect()->to(current_url());
                            }else{
                                $sessionData = [
                                    'uuid' => $user->uuid,
                                    'firstname' => $user->firstname,
                                    'lastname' => $user->lastname,
                                    'email' => $user->email,
                                    'country' => $user->country,
                                    'userType' => $user->userType,
                                    'subscription' => $user->subscription,
                                    'account_status' => $user->account_status
                                ];

                                $session->set('user', $sessionData);
                                $session->setFlashdata("success", "Welcome {$user->firstname}");
                                if($user->userType == 'user'){
                                    return redirect()->to(base_url('users'));
                                }else{
                                    return redirect()->to(base_url('admin'));
                                }
                            }
                        }

                    }
                    else{
                        $session->setFlashdata('error', 'Incorrect email and/or password');
                        return redirect()->to(current_url());
                    }
                }else{
                    $session->setFlashdata('error', 'Incorrect email and/or password');
                    return redirect()->to(current_url());
                }
            }
        }

		echo view('auth/login', $data);
	}

    #activate account
    public function activate($uuid){
        $session = session();
        $email = \config\Services::email();

        if(!empty($uuid)){
            $user_model = new UserModel();
            $user = $user_model->getOne(array('uuid' => $uuid));
            #check expiration time
            // echo '<pre>'; print_r($user); die;
            if($user){
                if($user->status == 0){
                    $data = [
                        'status' => 1,
                        'account_status' => 'pending'
                    ];
                    $user_model->updateUser($uuid, $data);
                    $session->setFlashdata('success', 'Your Account has been activated.');
                    return redirect()->to(base_url('auth/login'));
                }
                else{
                    $session->setFlashdata('success', 'Account already activated.');
                    return redirect()->to(base_url('auth/login'));
                }
            }else{
                $session->setFlashdata('error', 'Account does not exist');
                return redirect()->to(base_url('auth/login'));
            }
        }else{
            $session->setFlashdata('error', 'Invalid request');
            return redirect()->to(base_url('auth/login'));
        }
    }

    #forgot password
	public function forgot(){
        $session = session();
		$data['title'] = 'Forgot Password | Condie Investments Limited - Diversified investment platform';

        if($this->request->getMethod() == 'post'){
            $rules = [
                'email'    => [
                    'rules'  => 'required|valid_email|trim',
                    'errors' => [
                        'required' => 'email is required!'
                    ]
                ],
            ];

            if(!$this->validate($rules)){
                $data['validation'] = $this->validator;
            }else{
                $user_model = new UserModel();
                $user = $user_model->getOne(array('email' => $this->request->getPost('email')));
                // echo '<pre>'; print_r($user); die;
                if($user){
                    $uuid = $user->uuid;
                    try{
                        $to = $this->request->getPost('email');
                        $subject = 'Password Reset';
                        $reason = 'Action';
                        $message = 'Dear '.$user->firstname.' '.$user->lastname.',<br> Kindly click the link below to change your password.<br>If the activity was not done by you kindly contact the support team. <br>
                        <a href="'.base_url().'/auth/reset/'.$uuid.'" target="_blank">Reset Now!
                        </a><br>Thanks, Condie Investments Limited<br>';

                        #call send_mail helper
                        if(send_mail($to, $subject, $reason, $message)){
                            $session->setFlashdata('success', 'A reset link has been sent to your mail.');
                            return redirect()->to(current_url());
                        }
                        else{
                            $session->setFlashdata('error', 'Opps.. TRY AGAIN!');
                            return redirect()->to(current_url());
                        //    $err = $email->printDebugger(['headers']);
                        //     print_r($err); die;
                        }
                    }
                    catch (\Exception $e)
                    {
                        die($e->getMessage());
                    }
                        // $session->setFlashdata('error', 'Incorrect email and/or password');
                        // return redirect()->to(current_url());
                }else{
                    $session->setFlashdata('error', 'Email does not exist!');
                    return redirect()->to(current_url());
                }
            }
        }

		echo view('auth/forgot', $data);
	}

    #reset
    public function reset($uuid=null){
        $session = session();
        $user_model = new UserModel();
        // var_dump($uuid); die;

        if(!empty($uuid)){
            #check uuid in users
            // $data = array('uuid', $uuid);
            $user = $user_model->getOne(array('uuid' => $uuid));
            if($user){
                $data['title'] = 'Reset Password | Condie Investments Limited - Diversified investment platform';
                if($this->request->getMethod() == 'post'){
                    $rules = [
                        'password' => 'required|min_length[5]',
                        'confirm_password' => 'required|min_length[5]|matches[password]',
                    ];

                    if(!$this->validate($rules)){
                        $data['validation'] = $this->validator;
                    }else{
                        $password = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                        $data = [
                            'password' => $password
                        ];
                        $user_model->updateUser($uuid, $data);
                        $session->setFlashdata('success', 'Password changed successfully.');
                        return redirect()->to(base_url('auth/login'));
                    }
                }

                echo view('auth/reset', $data);
            }
            else{
                $session->setFlashdata('error', 'Unauthorised!');
                return redirect()->to(base_url('auth/login'));
            }
        }
        else{
            $session->setFlashdata('error', 'Unauthorised request!');
            return redirect()->to(base_url('auth/login'));
        }
	}

    public function logout(){
        session()->destroy();
        return redirect()->to(base_url('auth/login'));
    }
}
