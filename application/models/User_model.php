<?php

class User_model extends CI_Model
{
    public function fetch_location_data($UserName)
    {
        $query = $this->db->query("SELECT locationsubmaster.Location FROM `userproject` RIGHT JOIN 
        locationsubmaster ON userproject.ProjectName=locationsubmaster.ProjectName 
        WHERE userproject.UserName='$UserName' AND userproject.status='checked'");

        if($query->num_rows() > 0 ){
            return $query;
        }else{
            return false;
        }
 
    }
    

    public function user_login($username, $password)
    {
        $UserName = $username;
        $Password = sha1($password);
        $Status = "ACTIVE";
        $MobileUser="checked";

        $this->db->where('UserName', $UserName);
        $this->db->where('Password', $Password);
        $this->db->where('Status', $Status);
        $this->db->where('MobileUser',$MobileUser);

        $q = $this->db->get('usermaster');

        if ($q->num_rows() == 1) {
            return $q->row(0);
        } else {
            return false;
        }
    }
}