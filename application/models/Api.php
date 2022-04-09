<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	function register_user($data)
	{
		return $this->db->insert('users', $data) ? $this->db->insert_id() : false;
	}

	function get_user_by_email($email)
	{
		$this->db->where('email', $email);
		$this->db->from('users');
		$query = $this->db->get();
		return $query->row();
	}

	function get_user_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->from('users');
		$query = $this->db->get();
		return $query->row();
	}

	function update_user($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('users', $data);
	}

	function get_countries()
	{
		$this->db->from('countries');
		$query = $this->db->get();
		return $query->result();
	}

	function get_states($country_id)
	{
		$this->db->where('country_id', $country_id);
		$this->db->from('states');
		$query = $this->db->get();
		return $query->result();
	}

	function get_cities($state_id)
	{
		$this->db->where('state_id', $state_id);
		$this->db->from('cities');
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

	function get_trending_products()
	{
		$this->db->select('id,name,image,price');
		$this->db->where('status', 1);
		$this->db->from('products');
		$this->db->order_by('views', 'desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result();
	}

	function get_active_products()
	{
		$this->db->select('id,name,image,price');
		$this->db->where('status', 1);
		$this->db->from('products');
		$query = $this->db->get();
		return $query->result();
	}

	function get_product($id)
	{
		$this->db->select('products.*,categories.name as category_name');
		$this->db->where('products.id', $id);
		$this->db->from('products');
		$this->db->join('categories', 'categories.id = products.category_id');
		$query = $this->db->get();
		return $query->row();
	}

	function get_product_reviews_count($id)
	{
		$this->db->where('product_id', $id);
		$this->db->where('review is NOT NULL', NULL, FALSE);
		$this->db->from('product_reviews');
		return $this->db->count_all_results();
	}

	function get_product_ratings_count($id)
	{
		$this->db->where('product_id', $id);
		$this->db->from('product_reviews');
		return $this->db->count_all_results();
	}

	function get_product_variations($id)
	{
		$this->db->where('product_id', $id);
		$this->db->from('product_variations');
		$query = $this->db->get();
		return $query->result();
	}
}
