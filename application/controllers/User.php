<?php
	defined('BASEPATH') OR exit('no direct script access allowed');

	require APPPATH . '/libraries/REST_Controller.php';
	use Restserver\Libraries\REST_Controller;

	class User extends REST_Controller	{

		function __construct( $config = 'rest'){

			parent::__construct($config);
			$this->load->database();
			$this->load->model('GambarModel');
		}

		function index_get()
		{

			$data['gambar'] = $this->GambarModel->view();
			$id = $this->get('username');
			if($id =="")
			{
				$user = $this->db->get('users')->result();
			}else{
				$this->db->where('username', $id);
				$user = $this->db->get('users')->result();
			}

			$data['title_page'] = 'Users | Test Web';
			$data['users']      = $user;
			$this->template->load('layouts/default', 'user/index', $data);
		}
	}