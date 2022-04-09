<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AdminController extends CI_Controller
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
		$admin_id = $this->session->userdata('id');
		if (!$admin_id) {
			redirect('/login');
		}
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
	public function addCategories()
	{
		$data = [
			[
				"name" => "Bed Room",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Bed+Room",
				"status" => 1
			],
			[
				"name" => "Living Room",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Living+Room",
				"status" => 1
			],
			[
				"name" => "DSLR Camera",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=DSLR+Camera",
				"status" => 1
			],
			[
				"name" => "Appliances",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Appliances",
				"status" => 1
			],
			[
				"name" => "Storage",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Storage",
				"status" => 1
			],
			[
				"name" => "Packages",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Packages",
				"status" => 1
			]
		];
		$res = $this->admin->add_categories($data);
		if ($res) {
			$this->session->set_flashdata('success', 'Categories Added!');
		} else {
			$this->session->set_flashdata('error', 'Failed to add categories!');
		}
		redirect('/dashboard');
	}
	public function addProducts()
	{
		$categories = $this->admin->get_categories();
		if (!$categories) {
			$this->session->set_flashdata('error', 'Add categories first!');
			redirect('/dashboard');
		}
		$data = [
			[
				"category_id" => random_element($categories)->id,
				"name" => "Product 1",
				"description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae nisi beatae impedit voluptatibus recusandae, exercitationem atque dolores animi blanditiis aspernatur, delectus, debitis labore eum rerum error iure suscipit ullam est.",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Product+1",
				"price" => rand(100, 1000),
				"rating" => rand(1, 5),
				"refund_deposit" => rand(1000, 5000),
				"quantity" => rand(10, 100),
				"views" => rand(0, 100),
				"status" => 1
			],
			[
				"category_id" => random_element($categories)->id,
				"name" => "Product 2",
				"description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae nisi beatae impedit voluptatibus recusandae, exercitationem atque dolores animi blanditiis aspernatur, delectus, debitis labore eum rerum error iure suscipit ullam est.",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Product+2",
				"price" => rand(100, 1000),
				"rating" => rand(1, 5),
				"refund_deposit" => rand(1000, 5000),
				"quantity" => rand(10, 100),
				"views" => rand(0, 100),
				"status" => 1
			],
			[
				"category_id" => random_element($categories)->id,
				"name" => "Product 3",
				"description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae nisi beatae impedit voluptatibus recusandae, exercitationem atque dolores animi blanditiis aspernatur, delectus, debitis labore eum rerum error iure suscipit ullam est.",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Product+3",
				"price" => rand(100, 1000),
				"rating" => rand(1, 5),
				"refund_deposit" => rand(1000, 5000),
				"quantity" => rand(10, 100),
				"views" => rand(0, 100),
				"status" => 1
			],
			[
				"category_id" => random_element($categories)->id,
				"name" => "Product 4",
				"description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae nisi beatae impedit voluptatibus recusandae, exercitationem atque dolores animi blanditiis aspernatur, delectus, debitis labore eum rerum error iure suscipit ullam est.",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Product+4",
				"price" => rand(100, 1000),
				"rating" => rand(1, 5),
				"refund_deposit" => rand(1000, 5000),
				"quantity" => rand(10, 100),
				"views" => rand(0, 100),
				"status" => 1
			],
			[
				"category_id" => random_element($categories)->id,
				"name" => "Product 5",
				"description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae nisi beatae impedit voluptatibus recusandae, exercitationem atque dolores animi blanditiis aspernatur, delectus, debitis labore eum rerum error iure suscipit ullam est.",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Product+5",
				"price" => rand(100, 1000),
				"rating" => rand(1, 5),
				"refund_deposit" => rand(1000, 5000),
				"quantity" => rand(10, 100),
				"views" => rand(0, 100),
				"status" => 1
			],
			[
				"category_id" => random_element($categories)->id,
				"name" => "Product 6",
				"description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae nisi beatae impedit voluptatibus recusandae, exercitationem atque dolores animi blanditiis aspernatur, delectus, debitis labore eum rerum error iure suscipit ullam est.",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Product+6",
				"price" => rand(100, 1000),
				"rating" => rand(1, 5),
				"refund_deposit" => rand(1000, 5000),
				"quantity" => rand(10, 100),
				"views" => rand(0, 100),
				"status" => 1
			],
			[
				"category_id" => random_element($categories)->id,
				"name" => "Product 7",
				"description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae nisi beatae impedit voluptatibus recusandae, exercitationem atque dolores animi blanditiis aspernatur, delectus, debitis labore eum rerum error iure suscipit ullam est.",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Product+7",
				"price" => rand(100, 1000),
				"rating" => rand(1, 5),
				"refund_deposit" => rand(1000, 5000),
				"quantity" => rand(10, 100),
				"views" => rand(0, 100),
				"status" => 1
			],
			[
				"category_id" => random_element($categories)->id,
				"name" => "Product 8",
				"description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae nisi beatae impedit voluptatibus recusandae, exercitationem atque dolores animi blanditiis aspernatur, delectus, debitis labore eum rerum error iure suscipit ullam est.",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Product+8",
				"price" => rand(100, 1000),
				"rating" => rand(1, 5),
				"refund_deposit" => rand(1000, 5000),
				"quantity" => rand(10, 100),
				"views" => rand(0, 100),
				"status" => 1
			],
			[
				"category_id" => random_element($categories)->id,
				"name" => "Product 9",
				"description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae nisi beatae impedit voluptatibus recusandae, exercitationem atque dolores animi blanditiis aspernatur, delectus, debitis labore eum rerum error iure suscipit ullam est.",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Product+9",
				"price" => rand(100, 1000),
				"rating" => rand(1, 5),
				"refund_deposit" => rand(1000, 5000),
				"quantity" => rand(10, 100),
				"views" => rand(0, 100),
				"status" => 1
			],
			[
				"category_id" => random_element($categories)->id,
				"name" => "Product 10",
				"description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae nisi beatae impedit voluptatibus recusandae, exercitationem atque dolores animi blanditiis aspernatur, delectus, debitis labore eum rerum error iure suscipit ullam est.",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Product+10",
				"price" => rand(100, 1000),
				"rating" => rand(1, 5),
				"refund_deposit" => rand(1000, 5000),
				"quantity" => rand(10, 100),
				"views" => rand(0, 100),
				"status" => 1
			],
			[
				"category_id" => random_element($categories)->id,
				"name" => "Product 11",
				"description" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestiae nisi beatae impedit voluptatibus recusandae, exercitationem atque dolores animi blanditiis aspernatur, delectus, debitis labore eum rerum error iure suscipit ullam est.",
				"image" => "https://dummyimage.com/400x400/000/fff.png&text=Product+11",
				"price" => rand(100, 1000),
				"rating" => rand(1, 5),
				"refund_deposit" => rand(1000, 5000),
				"quantity" => rand(10, 100),
				"views" => rand(0, 100),
				"status" => 1
			],
		];
		$res = $this->admin->add_products($data);
		if ($res) {
			$this->session->set_flashdata('success', 'Products Added!');
		} else {
			$this->session->set_flashdata('error', 'Failed to add products!');
		}
		redirect('/dashboard');
	}
	public function addProductVariations()
	{
		$products = $this->admin->get_products();
		if (!$products) {
			$this->session->set_flashdata('error', 'Add products first!');
			redirect('/dashboard');
		}
		foreach ($products as $product) {
			$data = [
				[
					"product_id" => $product->id,
					"name" => "Small",
					"price" => rand(100, 1000),
					"quantity" => rand(10, 100)
				],
				[
					"product_id" => $product->id,
					"name" => "Medium",
					"price" => rand(100, 1000),
					"quantity" => rand(10, 100)
				],
				[
					"product_id" => $product->id,
					"name" => "Large",
					"price" => rand(100, 1000),
					"quantity" => rand(10, 100)
				],
			];
			$res = $this->admin->add_product_variations($data);
		}
		if ($res) {
			$this->session->set_flashdata('success', 'Product Variations Added!');
		} else {
			$this->session->set_flashdata('error', 'Failed to add product variations!');
		}
		redirect('/dashboard');
	}
	public function addUsers()
	{
		$data = [
			[
				"name" => $this->generateRandomName(),
				"email" => $this->generateRandomEmail(),
				"password" => password_hash('password', PASSWORD_DEFAULT),
				"phone" => $this->generateRandomPhone(),
				"address" => "Lorem, ipsum dolor sit amet",
			],
			[
				"name" => $this->generateRandomName(),
				"email" => $this->generateRandomEmail(),
				"password" => password_hash('password', PASSWORD_DEFAULT),
				"phone" => $this->generateRandomPhone(),
				"address" => "Lorem, ipsum dolor sit amet",
			],
			[
				"name" => $this->generateRandomName(),
				"email" => $this->generateRandomEmail(),
				"password" => password_hash('password', PASSWORD_DEFAULT),
				"phone" => $this->generateRandomPhone(),
				"address" => "Lorem, ipsum dolor sit amet",
			],
		];
		$res = $this->admin->add_users($data);
		if ($res) {
			$this->session->set_flashdata('success', 'Users Added!');
		} else {
			$this->session->set_flashdata('error', 'Failed to add users!');
		}
		redirect('/dashboard');
	}
	public function addProductReviews()
	{
		$products = $this->admin->get_products();
		if (!$products) {
			$this->session->set_flashdata('error', 'Add products first!');
			redirect('/dashboard');
		}
		$users = $this->admin->get_users();
		if (!$users) {
			$this->session->set_flashdata('error', 'Add users first!');
			redirect('/dashboard');
		}
		foreach ($products as $product) {
			for ($i = 0; $i < rand(100, 1000); $i++) {
				$data[] = [
					"product_id" => $product->id,
					"review" => "Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempora perspiciatis laudantium molestias ratione modi. Quibusdam molestiae dolor porro totam. Rem!",
					"rating" => rand(1, 5),
					"user_id" => random_element($users)->id
				];
			}
			$res = $this->admin->add_product_reviews($data);
		}
		if ($res) {
			$this->session->set_flashdata('success', 'Product Reviews Added!');
		} else {
			$this->session->set_flashdata('error', 'Failed to add product reviews!');
		}
		redirect('/dashboard');
	}
	function generateRandomName()
	{
		$firstname = array(
			'Johnathon',
			'Anthony',
			'Erasmo',
			'Raleigh',
			'Nancie',
			'Tama',
			'Camellia',
			'Augustine',
			'Christeen',
			'Luz',
			'Diego',
			'Lyndia',
			'Thomas',
			'Georgianna',
			'Leigha',
			'Alejandro',
			'Marquis',
			'Joan',
			'Stephania',
			'Elroy',
			'Zonia',
			'Buffy',
			'Sharie',
			'Blythe',
			'Gaylene',
			'Elida',
			'Randy',
			'Margarete',
			'Margarett',
			'Dion',
			'Tomi',
			'Arden',
			'Clora',
			'Laine',
			'Becki',
			'Margherita',
			'Bong',
			'Jeanice',
			'Qiana',
			'Lawanda',
			'Rebecka',
			'Maribel',
			'Tami',
			'Yuri',
			'Michele',
			'Rubi',
			'Larisa',
			'Lloyd',
			'Tyisha',
			'Samatha',
		);

		$lastname = array(
			'Mischke',
			'Serna',
			'Pingree',
			'Mcnaught',
			'Pepper',
			'Schildgen',
			'Mongold',
			'Wrona',
			'Geddes',
			'Lanz',
			'Fetzer',
			'Schroeder',
			'Block',
			'Mayoral',
			'Fleishman',
			'Roberie',
			'Latson',
			'Lupo',
			'Motsinger',
			'Drews',
			'Coby',
			'Redner',
			'Culton',
			'Howe',
			'Stoval',
			'Michaud',
			'Mote',
			'Menjivar',
			'Wiers',
			'Paris',
			'Grisby',
			'Noren',
			'Damron',
			'Kazmierczak',
			'Haslett',
			'Guillemette',
			'Buresh',
			'Center',
			'Kucera',
			'Catt',
			'Badon',
			'Grumbles',
			'Antes',
			'Byron',
			'Volkman',
			'Klemp',
			'Pekar',
			'Pecora',
			'Schewe',
			'Ramage',
		);

		$name = $firstname[rand(0, count($firstname) - 1)];
		$name .= ' ';
		$name .= $lastname[rand(0, count($lastname) - 1)];

		return $name;
	}
	function generateRandomEmail()
	{
		$username = array(
			'Johnathon',
			'Anthony',
			'Erasmo',
			'Raleigh',
			'Nancie',
			'Tama',
			'Camellia',
			'Augustine',
			'Christeen',
			'Luz',
			'Diego',
			'Lyndia',
			'Thomas',
			'Georgianna',
			'Leigha',
			'Alejandro',
			'Marquis',
			'Joan',
			'Stephania',
			'Elroy',
			'Zonia',
			'Buffy',
			'Sharie',
			'Blythe',
			'Gaylene',
			'Elida',
			'Randy',
			'Margarete',
			'Margarett',
			'Dion',
			'Tomi',
			'Arden',
			'Clora',
			'Laine',
			'Becki',
			'Margherita',
			'Bong',
			'Jeanice',
			'Qiana',
			'Lawanda',
			'Rebecka',
			'Maribel',
			'Tami',
			'Yuri',
			'Michele',
			'Rubi',
			'Larisa',
			'Lloyd',
			'Tyisha',
			'Samatha',
		);

		$domain = array(
			'google',
			'outlook',
			'bing',
			'edu',
		);

		$afterDot = array(
			'com',
			'pk',
			'uk',
			'com.pk',
		);

		$email = strtolower($username[rand(0, count($username) - 1)]);
		$email .= '@';
		$email .= $domain[rand(0, count($domain) - 1)];
		$email .= '.';
		$email .= $afterDot[rand(0, count($afterDot) - 1)];

		return $email;
	}
	function generateRandomPhone()
	{
		$characters = '0123456789';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < 4; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$randomString .= '-';
		for ($i = 0; $i < 3; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		$randomString .= '-';
		for ($i = 0; $i < 4; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
}
