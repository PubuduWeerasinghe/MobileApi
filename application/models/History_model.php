<?php defined('BASEPATH') or exit('No direct script access allowed');
class History_model extends CI_Model
{

    // /**
    //  * Add a new History
    //  * @param: {array} History Data
    //  */
    // public function create_History(array $data) {
    //     $this->db->insert('verification', $data);
    //     return $this->db->insert_id();
    // }


    public function fetch_history_data($UserName, $Date)
    {

        $this->db->where('UserName', $UserName);
        $this->db->where('Date', $Date);
        $query = $this->db->get('verification');
        return $query;
    }


}