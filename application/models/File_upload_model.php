<?php defined('BASEPATH') or exit('No direct script access allowed');
class File_upload_model extends CI_Model
{

    public function fileUpload($UOM,$Quantity,$Material,$Supplier,
    $VehicleType,$VehicleNo,$Location,$Date,$Username,$Longitude,$Latitude,$Unloadphoto,
    $Sidephoto,$Frontphoto,$QuantityStatus,$MaterialStatus,$SupplierStatus)
    { //print_r($data['Location']);


        $Project=$this->db->query("SELECT ProjectCode FROM locationsubmaster where LocationCode='$Location'");
        if($Project->num_rows() > 0 ){

            $query=$this->db->query("INSERT INTO verification 
            (Date,UserName,Material,Location,EntryType,SupplierStatus,MaterialStatus,QuantityStatus,
            Supplier,VehicleNo,Quantity,UOM,Type,ViewReferences,ViewReference2,ViewReference3,lat,lng,Verification,Project) 
            VALUES('$Date','$Username','$Material','$Location','Scanned','$SupplierStatus','$MaterialStatus','$QuantityStatus',
            '$Supplier','$VehicleNo','$Quantity','$UOM','$VehicleType',
            '$Frontphoto','$Sidephoto', '$Unloadphoto','$Latitude','$Longitude','No',
            (SELECT ProjectCode FROM locationsubmaster where LocationCode='$Location'))"); 

            return $query;
              
        }else{
            return false;
        }


        

    


    }


}