<?php 
	namespace App\Http\Controllers;

	use App\User;
	use App\Http\Controllers\Controller;
	class WelcomeController extends Controller {
	
		public function contact() {
			return view('pages.home');		
		}
        
        public function showHomePage() {
            return view('pages.home');
        }
	}
