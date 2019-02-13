<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class blog_model extends CI_Model {

        public function getRecord()
        {
                $query = $this->db->query("SELECT * from blogs where status = 1 ORDER BY created DESC");
                return $query->result();
        }
        

}