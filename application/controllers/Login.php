<?php defined('BASEPATH') or exit('No direct script access allowed');

use Restapi\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class Login extends \Restapi\Libraries\REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function login_post()
    {
        header("Access-Control-Allow-Origin:*");
        # XSS Filtering (https://www.codeigniter.com/user_guide/libraries/security.html)

        $user = array(
            'username' => $this->post('username'),
            'password' => $this->post('password')
        );
        $username= $user['username'];
        $password= $user['password'];

        # Form Validation

        if (!$username) {
            // Form Validation Errors
            $message = array(
                'status' => 104,
                'message' => "Username field is required"
            );
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }else if (!$password) {
            // Form Validation Errors
            $message = array(
                'status' => 103,
                'message' => "Password field is required"
            );
            $this->response($message, REST_Controller::HTTP_NOT_FOUND);
        }else {
            // Load Login Function
            $output = $this->User_model->user_login($username, $password);
            if (!empty($output) and $output != FALSE) {
                // Load Authorization Token Library
                $this->load->library('Authorization_Token');
                // Generate Token
                $token_data['id'] = $output->UserName;
                $token_data['time'] = time();

                //$token_data['username'] = $output->UserName;
                //$token_data['name'] = $output->Name;
                //$token_data['position'] = $output->Position;
                

                $user_token = $this->authorization_token->generateToken($token_data);

                // print_r($this->authorization_token->userData($user_token));
                // exit;

                $return_data = [
                    'user_id' => $output->UserName,
                    'token' => $user_token
                    // 'name' => $output->Name,
                    // 'position' => $output->Position,
                    
                ];
                // Login Success
                $message = [
                    'status' => 100,
                    'token' => $return_data['token'],
                    //'message' => "User login successful"
                ];

                $this->response($message, REST_Controller::HTTP_OK);
            } else {
                // Login Error
                $message = [
                    'status' => 104,
                    'message' => "Invalid Username or Password"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    }

    public function location_get()
    {
        header("Access-Control-Allow-Origin: *");

        // Load Authorization Token Library
        $this->load->library('Authorization_Token');
        /**
         * User Token Validation
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) and $is_valid_token['status'] === TRUE) {
            # Create a User History
            # XSS Filtering (https://www.codeigniter.com/user_guide/libraries/security.html)
            $_POST = $this->security->xss_clean($_POST);

            $UserName = $is_valid_token['data']->id;

            $this->load->model('User_model');
            $response = $this->User_model->fetch_location_data($UserName);

            if (!empty($response) and $response != FALSE) {

                foreach ($response->result() as $row) {
                    $user_data[] = [
                        'Location' => $row->Location
                    ];
                }

                // Fetch Location Success
                $message = [
                    'status' => 100,
                    'respond' => $user_data,
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            } else {
                // Fetch Location Error
                $message = [
                    'status' => 105,
                    'message' => "User is not assigned for a project"
                ];
                $this->response($message, REST_Controller::HTTP_OK);
            }
        } else {
            $this->response(['status' => 104, 'message' => $is_valid_token['message']], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}