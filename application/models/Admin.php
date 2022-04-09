<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function get_admin()
	{
		$this->db->from('admins');
		$query = $this->db->get();
		return $query->row();
	}

	function get_admin_by_email($email)
	{
		$this->db->where('email', $email);
		$this->db->from('admins');
		$query = $this->db->get();
		return $query->row();
	}

	function create_admin($data)
	{
		return $this->db->insert('admins', $data) ? $this->db->insert_id() : false;
	}

	function get_categories()
	{
		$this->db->from('categories');
		$query = $this->db->get();
		return $query->result();
	}

	function get_active_categories()
	{
		$this->db->where('status', 1);
		$this->db->from('categories');
		$query = $this->db->get();
		return $query->result();
	}

	function add_categories($data)
	{
		return $this->db->insert_batch('categories', $data) ? true : false;
	}

	function get_products()
	{
		$this->db->select('products.*,categories.name as category_name');
		$this->db->from('products');
		$this->db->join('categories', 'categories.id = products.category_id');
		$this->db->order_by('products.id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_active_products()
	{
		$this->db->where('status', 1);
		$this->db->from('products');
		$query = $this->db->get();
		return $query->result();
	}

	function add_products($data)
	{
		return $this->db->insert_batch('products', $data) ? true : false;
	}

	function get_product_variations()
	{
		$this->db->select('product_variations.*,products.name as products_name');
		$this->db->from('product_variations');
		$this->db->join('products', 'products.id = product_variations.product_id');
		$this->db->order_by('product_variations.id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	function add_product_variations($data)
	{
		return $this->db->insert_batch('product_variations', $data) ? true : false;
	}

	function get_product_reviews()
	{
		$this->db->select('product_reviews.*,products.name as products_name');
		$this->db->from('product_reviews');
		$this->db->join('products', 'products.id = product_reviews.product_id');
		$this->db->order_by('product_reviews.id', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	function add_product_reviews($data)
	{
		return $this->db->insert_batch('product_reviews', $data) ? true : false;
	}

	function get_users()
	{
		$this->db->from('users');
		$query = $this->db->get();
		return $query->result();
	}

	function add_users($data)
	{
		return $this->db->insert_batch('users', $data) ? true : false;
	}
}
