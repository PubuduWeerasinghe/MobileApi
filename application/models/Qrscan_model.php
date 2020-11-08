<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Qrscan_model extends CI_Model
{

    // public function insert_Data($Username,$Location,$Material,$Date,$QRCodeNo,$SupplierStatus,$MaterialStatus,$QuantityStatus) {
        
    //     $result = $this->db->query("INSERT INTO verification 
    //     (Date,UserName,Material,Location,EntryType,SupplierStatus,MaterialStatus,QuantityStatus,
    //     Supplier,VehicleNo,Quantity,UOM,
    //     Type,Project) VALUES('$Date','$Username','$Material','$Location','Scanned','$SupplierStatus','$MaterialStatus','$QuantityStatus',
    //     (SELECT SupplierName FROM qrcodemaster where QRCodeNo='$QRCodeNo'),
    //     (SELECT VehicleNo FROM qrcodemaster where QRCodeNo='$QRCodeNo'),
    //     (SELECT vehiclemaster.Capacity FROM vehiclemaster RIGHT JOIN qrcodemaster on vehiclemaster.VehicleNo=qrcodemaster.VehicleNo where qrcodemaster.QRCodeNo='$QRCodeNo'),
    //     (SELECT vehiclemaster.UOM FROM vehiclemaster RIGHT JOIN qrcodemaster on vehiclemaster.VehicleNo=qrcodemaster.VehicleNo where qrcodemaster.QRCodeNo='$QRCodeNo'),
    //     (SELECT vehiclemaster.VehicleType FROM vehiclemaster RIGHT JOIN qrcodemaster on vehiclemaster.VehicleNo=qrcodemaster.VehicleNo where qrcodemaster.QRCodeNo='$QRCodeNo'),
    //     (SELECT ProjectCode FROM locationsubmaster where locationsubmaster.LocationCode='$Location'))");
        
    //     return $result;
    // }

    public function fetch_qr_data($qrcode) {
    

        $query = $this->db->query("SELECT * FROM vehiclemaster RIGHT JOIN 
        qrcodemaster ON vehiclemaster.VehicleNo = qrcodemaster.VehicleNo 
        where qrcodemaster.VehicleNo !='' AND QRCodeNo='$qrcode'");

if($query->num_rows() > 0 ){
    return $query;
}else{
    return false;
}
    }

    public function Check_QrCodeAssing($QRCodeNo) {
    
        $query = $this->db->query("SELECT SupplierName,VehicleNo FROM qrcodemaster where QRCodeNo='$QRCodeNo'");

        if($query->num_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }

    public function Check_Project($Location) {
    

        $query = $this->db->query("SELECT ProjectCode FROM locationsubmaster where locationsubmaster.LocationCode='$Location'");

        if($query->num_rows() > 0 ){
            return true;
        }else{
            return false;
        }
    }


}