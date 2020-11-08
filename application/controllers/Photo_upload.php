<?php defined('BASEPATH') or exit('No direct script access allowed');

use Restapi\Libraries\REST_Controller;

require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';

class Photo_upload extends \Restapi\Libraries\REST_Controller
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
            # Create a User History
            # XSS Filtering (https://www.codeigniter.com/user_guide/libraries/security.html)
            $_POST = $this->security->xss_clean($_POST);
            
            $insertData = $this->post('photo');

             foreach($insertData as $dataInsert)
        {
            $data = array(
                'SupplierStatus'=>$dataInsert['SupplierStatus'],
                'MaterialStatus'=>$dataInsert['MaterialStatus'],
                'QuantityStatus'=>$dataInsert['QuantityStatus'],
                'ViewReferences'=>$dataInsert['Frontphoto'],
                'ViewReference2'=>$dataInsert['Sidephoto'],
                'ViewReference3'=>$dataInsert['Unloadphoto'],
                'lat'=>$dataInsert['Latitude'],
                'lng'=>$dataInsert['Longitude'],
                'UserName'=>$dataInsert['Username'],
                'Date'=>$dataInsert['Date'],
                'EntryType'=>$dataInsert['EntryType'],
                'Location'=>$dataInsert['Location'],
                'VehicleNo'=>$dataInsert['VehicleNo'],
                'Type'=>$dataInsert['VehicleType'],
                'Supplier'=>$dataInsert['Supplier'],
                'Material'=>$dataInsert['Material'],
                'Quantity'=>$dataInsert['Quantity'],
                'UOM'=>$dataInsert['UOM']
            );  
            
            $SupplierStatus=$dataInsert['SupplierStatus'];
            $MaterialStatus=$dataInsert['MaterialStatus'];
            $QuantityStatus=$dataInsert['QuantityStatus'];
            $ViewReferences=$dataInsert['Frontphoto'];
            $ViewReference2=$dataInsert['Sidephoto'];
            $ViewReference3=$dataInsert['Unloadphoto'];
            $Latitude=$dataInsert['Latitude'];
            $Longitude=$dataInsert['Longitude'];
            $UserName=$dataInsert['Username'];
            $Date=$dataInsert['Date'];
            $EntryType=$dataInsert['EntryType'];
            $Location=$dataInsert['Location'];
            $VehicleNo=$dataInsert['VehicleNo'];
            $Type=$dataInsert['VehicleType'];
            $Supplier=$dataInsert['Supplier'];
            $Material=$dataInsert['Material'];
            $Quantity=$dataInsert['Quantity'];
            $UOM=$dataInsert['UOM'];
            
            
            
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

                         else if(!$ViewReferences) {
                            // Form Validation Errors
                             $message = array(
                            'status' => 102,
                            'message' => "Front photo is required"
                        );
                             $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                         }
                         else if(!$ViewReference2) {
                            // Form Validation Errors
                             $message = array(
                            'status' => 102,
                            'message' => "Side photo is required"
                        );
                             $this->response($message, REST_Controller::HTTP_NOT_FOUND);
                         }
                         else if(!$ViewReference3) {
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
                         else if(!$UserName) {
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
                         else if(!$EntryType) {
                            // Form Validation Errors
                             $message = array(
                            'status' => 102,
                            'message' => "EntryType is required"
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
                         else if(!$Type) {
                            // Form Validation Errors
                             $message = array(
                            'status' => 102,
                            'message' => "Type is required"
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
         else{
    
            $this->load->model('Photo_upload_model');
            $response = $this->Photo_upload_model->photoUpload($data); 
        }}

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
    else {
                    $this->response(['status' => 104, 'message' => $is_valid_token['message']], REST_Controller::HTTP_NOT_FOUND);
                }
            }
        }


