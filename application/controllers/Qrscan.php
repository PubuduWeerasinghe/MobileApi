<?php defined('BASEPATH') or exit('No direct script access allowed');

use Restapi\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class Qrscan extends \Restapi\Libraries\REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function fetchData_post()
    {
        header("Access-Control-Allow-Origin: *");

        // Load Authorization Token Library
        $this->load->library('Authorization_Token');
        /**
         * User Token Validation
         */
        $is_valid_token = $this->authorization_token->validateToken();
        if (!empty($is_valid_token) and $is_valid_token['status'] === TRUE) {

            # XSS Filtering (https://www.codeigniter.com/user_guide/libraries/security.html)
            $_POST = $this->security->xss_clean($_POST);

            $user = array(
                'qrcode' => $this->post('qrcode')
            );
            $qrcode= $user['qrcode'];
            
            # Form Validation

            if (!$qrcode) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "QR field is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }  else {

                $UserName = $is_valid_token['data']->id;
                $qrcode= $user['qrcode'];

                // Load Qrscan_model
                $this->load->model('Qrscan_model');

                $Check_QrCodeAssing = $this->Qrscan_model->Check_QrCodeAssing($qrcode);

                // Insert Data
                if(!empty($Check_QrCodeAssing) and $Check_QrCodeAssing != FALSE){
                    $output = $this->Qrscan_model->fetch_qr_data($qrcode);
                if (!empty($output) and $output != FALSE) {
                    // Success

                    foreach ($output->result() as $row) {
                        $user_data[] = [
                            'VehicleNo' => $row->VehicleNo,
                            'VehicleType' => $row->VehicleType,
                            'Capacity' => $row->Capacity,
                            'UOM' => $row->UOM,
                            'SupplierName' => $row->SupplierName
                        ];
                    }

                    $message = [
                        'status' => 100,
                        'respond' => $user_data
                    ];
                    $this->response($message, REST_Controller::HTTP_OK);
                } else {
                    // Error
                    $message = [
                        'status' => 101,
                        'message' => "QR no is not assigned for a vehicle"
                    ];
                    $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                }
            }else{
                // Error
                $message = [
                    'status' => 103,
                    'message' => "QR number not found"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
            }
        } else {
            $this->response(['status' => 104, 'message' => $is_valid_token['message']], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    
}