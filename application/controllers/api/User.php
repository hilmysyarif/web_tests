<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
require APPPATH . '/libraries/REST_Controller.php';

// use namespace
use Restserver\Libraries\REST_Controller;

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Hilmy Syarif
 */
class User extends REST_Controller {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->database();
        $this->load->model('GambarModel');
        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function index_get()
    {


        // get params of username
        $username = $this->get('username');

        // collect the users data
        $users = $this->db->get('users')->result();
 
        // If the id parameter doesn't exist return all the users
        if ($username === NULL)
        {
            // Check if the users data store contains users (in case the database result returns NULL)
            if ($users)
            {
                // Set the response and exit
                $this->response($users, REST_Controller::HTTP_OK);
            }
            else
            {
                // Set the response and exit
                $this->response([
                    'status' => FALSE,
                    'message' => 'No users were found'
                ], REST_Controller::HTTP_NOT_FOUND); // NOT_FOUND (404) being the HTTP response code
            }
        }

        // Find and return a single record for a particular user.
        else {
            $username = (string) $username;

            // Get the user from the array, using the id as key for retrieval.
            // Usually a model is to be used for this.

            $user = NULL;

            if (!empty($users))
            {
                foreach ($users as $key => $value)
                {   
                    if (isset($value->username) && $value->username === $username)
                    {
                        $user = $value;
                    }
                }
            }

            if (!empty($user))
            {
                $this->set_response($user, REST_Controller::HTTP_OK);
            }
            else
            {
                $this->set_response([
                    'status' => FALSE,
                    'message' => 'User could not be found'
                ], REST_Controller::HTTP_OK); // NOT_FOUND (404) being the HTTP response code
            }
        }
    }

    public function index_post()
    {
        $upload = $this->GambarModel->upload($this->post('username'), $this->post('email'));
        if($upload)
        {
            $this->response($upload, REST_Controller::HTTP_OK);

        }else{
            $this->response(array('status'=>'fail', 201));
        }
    }
}
