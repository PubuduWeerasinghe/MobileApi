<?php defined('BASEPATH') or exit('No direct script access allowed');

/*history*/

use Restapi\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class History extends \Restapi\Libraries\REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Add new History with API
     * -------------------------
     * @method: POST
     */

    public function history_post()
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

            $user = array(
                'date' => $this->post('date')
            );
            $Date= $user['date'];
            # Form Validation
            

             if (!$Date) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Date field is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             } else {

                $UserName = $is_valid_token['data']->id;
                $Date= $user['date'];

                //$Date = $this->input->post('date');

                $this->load->model('History_model');
                $response = $this->History_model->fetch_history_data($UserName, $Date);

                if (!empty($response) and $response != FALSE) {

                    foreach ($response->result() as $row) {
                        $user_data[] = [
                            'VehicleNo' => $row->VehicleNo,
                            'Time' => $row->Time

                        ];
                    }

                    if (empty($user_data)) {
                        $message = [
                            'status' => 101,
                            'respond' => 'History not found',
                        ];
                    } else {
                        // Success
                        $message = [
                            'status' => 100,
                            'respond' => $user_data,
                        ];
                    }
                    $this->response($message, REST_Controller::HTTP_OK);
                } else {
                    // Error
                    $message = [
                        'status' => 101,
                        'message' => "Data not found"
                    ];
                    $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                }
            }
        } else {
            $this->response(['status' => 104, 'message' => $is_valid_token['message']], REST_Controller::HTTP_NOT_FOUND);
        }
    }
}