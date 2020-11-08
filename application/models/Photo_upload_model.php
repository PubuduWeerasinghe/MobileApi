<?php defined('BASEPATH') or exit('No direct script access allowed');
class Photo_upload_model extends CI_Model
{

    public function photoUpload($data)
    { //print_r($data['Location']);
        $Date=$data["Date"];
        $Username=$data["UserName"];
        $Material=$data["Material"];
        $Location=$data["Location"];
        $SupplierStatus=$data["SupplierStatus"];
        $MaterialStatus=$data["MaterialStatus"];
        $QuantityStatus=$data["QuantityStatus"];
        $lat=$data["lat"];
        $lng=$data["lng"];
        $UOM=$data["UOM"];
        $Supplier=$data["Supplier"];
        $VehicleNo=$data["VehicleNo"];
        $Type=$data["Type"];
        $UOM=$data["UOM"];
        $ViewReferences=$data["ViewReferences"];
        $ViewReference2=$data["ViewReference2"];
        $ViewReference3=$data["ViewReference3"];
        $Quantity=$data["Quantity"];

        $Project=$this->db->query("SELECT ProjectCode FROM locationsubmaster where LocationCode='$Location'");
        if($Project->num_rows() > 0 ){

            $query=$this->db->query("INSERT INTO verification 
            (Date,UserName,Material,Location,EntryType,SupplierStatus,MaterialStatus,QuantityStatus,
            Supplier,VehicleNo,Quantity,UOM,Type,ViewReferences,ViewReference2,ViewReference3,lat,lng,Verification,Project) 
            VALUES('$Date','$Username','$Material','$Location','Scanned','$SupplierStatus','$MaterialStatus','$QuantityStatus',
            '$Supplier','$VehicleNo','$Quantity','$UOM','$Type',
            '$ViewReferences','$ViewReference2', '$ViewReference3','$lat','$lng','No',
            (SELECT ProjectCode FROM locationsubmaster where LocationCode='$Location'))"); 

            return $query;
              
        }else{
            return false;
        }


        

    


    }


}