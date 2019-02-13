<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class guestbook_model extends CI_Model {

        public function getRecord()
        {
                $query = $this->db->query("SELECT * from guestbook ORDER BY date DESC");
                return $query->result();
        }

        public function insert($data)
        {
            $this->db->insert('guestbook',$data);
        }

}