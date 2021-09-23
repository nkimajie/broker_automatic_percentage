<?php
namespace App\Controllers;

use App\Models\RequestModel;
use App\Models\UserModel;
use App\Models\SettingsModel;



class Home extends BaseController
{
	public function __construct()
	{
		helper(['form', 'url', 'date']);
	}

	public function index(){
		$data['title'] = 'Home | Condie Investments Limited - Diversified investment platform';
		echo view('landing/home', $data);
	}

	#terms
	// public function testimonial(){
	// 	$data['title'] = 'Testimonial | Condie Investments Limited - Diversified investment platform';
	// 	echo view('landing/testimonial', $data);
	// }

	#contact
	public function contact(){
		$data['title'] = 'Contact | Condie Investments Limited - Diversified investment platform';
		echo view('landing/contact', $data);
	}

	#faq
	public function pricing(){
		$data['title'] = 'pricing | Condie Investments Limited - Diversified investment platform';
		echo view('landing/pricing', $data);
	}

	#faq
	public function why(){
		$data['title'] = 'Why Us | Condie Investments Limited - Diversified investment platform';
		echo view('landing/why', $data);
	}


	public function history(){
		$data['title'] = 'pricing | Condie Investments Limited - Diversified investment platform';
		echo view('landing/history', $data);
	}

	#about
	public function about(){
		$data['title'] = 'About | Condie Investments Limited - Diversified investment platform';
		echo view('landing/about', $data);
	}

	#terms
	// public function terms(){
	// 	$data['title'] = 'T&C | Condie Investments Limited - Diversified investment platform';
	// 	echo view('landing/terms', $data);
	// }

	#terms
	// public function faq(){
	// 	$data['title'] = 'Faq | Condie Investments Limited - Diversified investment platform';
	// 	echo view('landing/faq', $data);
	// }

	#affiliates
	// public function services(){
	// 	$data['title'] = 'Services | Condie Investments Limited - Diversified investment platform';
	// 	echo view('landing/services', $data);
	// }

	#register
	public function register(){
		$data['title'] = 'Register | Condie Investments Limited - Diversified investment platform';
		echo view('landing/register', $data);
	}

	#login
	public function login(){
		$data['title'] = 'Login | Condie Investments Limited - Diversified investment platform';
		echo view('auth/login', $data);
	}

	public function cron_job()
	{
		$user_model = new UserModel();
		$settings_model = new SettingsModel();

		$admin_settings = $settings_model->getOne(array('id' => 1));
		$all_users = $user_model->allUsers(array('userType' => 'user','subscription !=' => 'None', 'account_status' => 'verified', 'invested !=' => 0,));
		// echo "<pre>"; print_r($all_users); die;
		foreach ($all_users as $user) {
			// $sum = $user->subscription;
			// echo $sum."<br>";

			if ($user->subscription == "Basic") {

				$wallet_bal = $admin_settings->basic_percentage * $user->invested;
				$wallet_bal =  $wallet_bal / 100;

			}elseif ($user->subscription == "Silver") {

				$wallet_bal = $admin_settings->silver_percentage * $user->invested;
				$wallet_bal =  $wallet_bal / 100;

			}elseif ($user->subscription == "Business") {

				$wallet_bal = $admin_settings->business_percentage * $user->invested;
				$wallet_bal =  $wallet_bal / 100;

			}elseif ($user->subscription == "Premium") {

				$wallet_bal = $admin_settings->premium_percentage * $user->invested;
				$wallet_bal =  $wallet_bal / 100;

			}
			$wallet_bal = $wallet_bal + $user->wallet_bal;
			// echo $wallet_bal."<br>";

			$data = [
				'wallet_bal' => $wallet_bal
			];

			$query = $user_model->update_wallet(array('uuid' => $user->uuid),$data);

			if ($query) {
				echo "success <br>";
			}else {
				return false;
			}


		}

	}
}
