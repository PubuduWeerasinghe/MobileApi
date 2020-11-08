<?php defined('BASEPATH') or exit('No direct script access allowed');

use Restapi\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class File_Upload extends \Restapi\Libraries\REST_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function image_post()
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
                'SupplierStatus' => $this->post('SupplierStatus'),
                'MaterialStatus' => $this->post('MaterialStatus'),
                'QuantityStatus' => $this->post('QuantityStatus'),
                'Frontphoto' => $this->post('Frontphoto'),
                'Sidephoto' => $this->post('Sidephoto'),
                'Unloadphoto' => $this->post('Unloadphoto'),
                'Latitude' => $this->post('Latitude'),
                'Longitude' => $this->post('Longitude'),
                'Username' => $this->post('Username'),
                'Date' => $this->post('Date'),
                'Location' => $this->post('Location'),
                'VehicleNo' => $this->post('VehicleNo'),
                'VehicleType' => $this->post('VehicleType'),
                'Supplier' => $this->post('Supplier'),
                'Material' => $this->post('Material'),
                'Quantity' => $this->post('Quantity'),
                'UOM' => $this->post('UOM'),

            );
            $SupplierStatus= $user['SupplierStatus'];
            $MaterialStatus= $user['MaterialStatus'];
            $QuantityStatus= $user['QuantityStatus'];
            $Frontphoto= $user['Frontphoto'];
            $Sidephoto= $user['Sidephoto'];
            $Unloadphoto= $user['Unloadphoto'];
            $Latitude= $user['Latitude'];
            $Longitude= $user['Longitude'];
            $Username= $user['Username'];
            $Date= $user['Date'];
            $Location= $user['Location'];
            $VehicleNo= $user['VehicleNo'];
            $VehicleType= $user['VehicleType'];
            $Supplier= $user['Supplier'];
            $Material= $user['Material'];
            $Quantity= $user['Quantity'];
            $UOM= $user['UOM'];
           
            // echo $UOM;
            // echo $SupplierStatus;
            // echo $Quantity;
            // echo $Username;

            
            # Form Validation

            if(!$SupplierStatus) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Supplier status is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$MaterialStatus) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Material status is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$QuantityStatus) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Quantity status is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }

             else if(!$Frontphoto) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Front photo is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$Sidephoto) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Side photo is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$Unloadphoto) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Unload photo is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$Latitude) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Latitude is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$Longitude) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Longitude is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$Username) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Username is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$Date) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Date is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }

             else if(!$Location) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Location is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$VehicleNo) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "VehicleNo is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$VehicleType) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Vehicle type is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$Supplier) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Supplier is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$Material) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Material is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$Quantity) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "Quantity is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             else if(!$UOM) {
                // Form Validation Errors
                 $message = array(
                'status' => 102,
                'message' => "UOM is required"
            );
                 $this->response($message, REST_Controller::HTTP_NOT_FOUND);
             }
             
             else {

                // Load Qrscan_model
                $this->load->model('File_upload_model');

                $response = $this->File_upload_model->fileUpload($UOM,$Quantity,$Material,$Supplier,
                $VehicleType,$VehicleNo,$Location,$Date,$Username,$Longitude,$Latitude,$Unloadphoto,
                $Sidephoto,$Frontphoto,$QuantityStatus,$MaterialStatus,$SupplierStatus);

                // Insert Data
                if (!empty($response) and $response != FALSE) {
                    // Success
                    $message = [
                        'status' => 100,
                        'message' => "Successfully data inserted"
                    ];
                
                $this->response($message, REST_Controller::HTTP_OK);
            } else {
                // Error
                $message = [
                    'status' => 101,
                    'message' => "Data not inserted"
                ];
                $this->response($message, REST_Controller::HTTP_NOT_FOUND);
            }
        }
    } 
        else {
            $this->response(['status' => 104, 'message' => $is_valid_token['message']], REST_Controller::HTTP_NOT_FOUND);
        }
    

    
}
}