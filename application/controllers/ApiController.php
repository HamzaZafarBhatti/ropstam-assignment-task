<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class ApiController extends REST_Controller
{

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
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */

	function __construct()
	{
		parent::__construct();
		$this->load->library('authorization_token');
		$this->load->model('api');
	}
	public function dashboard()
	{
		$data['categories'] = $this->admin->get_categories();
		$data['products'] = $this->admin->get_products();
		$data['product_variations'] = $this->admin->get_product_variations();
		$data['product_reviews'] = $this->admin->get_product_reviews();
		$data['users'] = $this->admin->get_users();
		$this->load->view('dashboard', $data);
	}
	public function login_post()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$user = $this->api->get_user_by_email($email);
		if (!empty($user)) {
			if (password_verify($password, $user->password)) {
				$token_data = [
					'id' => $user->id,
					'name' => $user->name,
					'email' => $user->email,
					'phone' => $user->phone,
					'address' => $user->address
				];
				$tokenData = $this->authorization_token->generateToken($token_data);
				$this->api->update_user($user->id, ['token' => $tokenData]);
				$message = array('status' => "200", 'message' => "You are logged in!", 'contents' => $tokenData);
				$this->set_response($message, REST_Controller::HTTP_OK);
			} else {
				$message = array('status' => "401", 'message' => "Password is incorrect!");
				$this->set_response($message, REST_Controller::HTTP_UNAUTHORIZED);
			}
		} else {
			$message = array('status' => "404", 'message' => "User not found!");
			$this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function register_post()
	{
		$data['name'] = $this->input->post('name');
		$data['email'] = $this->input->post('email');
		$data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
		$data['phone'] = $this->input->post('phone');
		$data['address'] = $this->input->post('address');

		$prev_user = $this->api->get_user_by_email($data['email']);
		if ($prev_user) {
			$message = array('status' => "409", 'message' => "User email exist already!");
			$this->set_response($message, REST_Controller::HTTP_CONFLICT);
		} else {
			$res = $this->api->register_user($data);
			if ($res) {
				$message = array('status' => "200", 'message' => "User registered successfully!");
				$this->set_response($message, REST_Controller::HTTP_OK);
			} else {
				$message = array('status' => "500", 'message' => "User registeration failed!");
				$this->set_response($message, REST_Controller::HTTP_INTERNAL_SERVER_ERROR);
			}
		}
	}
	public function user_post()
	{
		$headers = $this->input->request_headers(); 
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
		$user = $this->api->get_user_by_id($decodedToken['data']->id);
		unset($user->password);
		unset($user->token);
		if($user) {
			$message = array('status' => "200", 'message' => "User!", 'contents' => $user);
			$this->set_response($message, REST_Controller::HTTP_OK);
		} else {
			$message = array('status' => "404", 'message' => "User not found!");
			$this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function countries_get()
	{
		$countries = $this->api->get_countries();
		if($countries) {
			$message = array('status' => "200", 'message' => "Countries!", 'count' => count($countries), 'contents' => $countries);
			$this->set_response($message, REST_Controller::HTTP_OK);
		} else {
			$message = array('status' => "404", 'message' => "User not found!");
			$this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function states_get($country_id)
	{
		$states = $this->api->get_states($country_id);
		if($states) {
			$message = array('status' => "200", 'message' => "States!", 'count' => count($states), 'contents' => $states);
			$this->set_response($message, REST_Controller::HTTP_OK);
		} else {
			$message = array('status' => "404", 'message' => "User not found!");
			$this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function cities_get($state_id)
	{
		$cities = $this->api->get_cities($state_id);
		if($cities) {
			$message = array('status' => "200", 'message' => "Cities!", 'count' => count($cities), 'contents' => $cities);
			$this->set_response($message, REST_Controller::HTTP_OK);
		} else {
			$message = array('status' => "404", 'message' => "User not found!");
			$this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function categories_get()
	{
		$categories = $this->api->get_active_categories();
		if($categories) {
			$message = array('status' => "200", 'message' => "Categories!", 'count' => count($categories), 'contents' => $categories);
			$this->set_response($message, REST_Controller::HTTP_OK);
		} else {
			$message = array('status' => "404", 'message' => "User not found!");
			$this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function trending_products_get()
	{
		$products = $this->api->get_trending_products();
		if($products) {
			$message = array('status' => "200", 'message' => "Trending Products!", 'count' => count($products), 'contents' => $products);
			$this->set_response($message, REST_Controller::HTTP_OK);
		} else {
			$message = array('status' => "404", 'message' => "User not found!");
			$this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function products_get()
	{
		$products = $this->api->get_active_products();
		if($products) {
			$message = array('status' => "200", 'message' => "Products!", 'count' => count($products), 'contents' => $products);
			$this->set_response($message, REST_Controller::HTTP_OK);
		} else {
			$message = array('status' => "404", 'message' => "User not found!");
			$this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
		}
	}
	public function product_get($id)
	{
		$product = $this->api->get_product($id);
		if($product) {
			$product->product_reviews_count = $this->api->get_product_reviews_count($id);
			$product->product_ratings_count = $this->api->get_product_ratings_count($id);
			$product->product_variations = $this->api->get_product_variations($id);
			$message = array('status' => "200", 'message' => "Product!", 'contents' => $product);
			$this->set_response($message, REST_Controller::HTTP_OK);
		} else {
			$message = array('status' => "404", 'message' => "User not found!");
			$this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
		}
	}
}
