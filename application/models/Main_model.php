<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model
{
    public function __construct()
    {
		parent::__construct();
		
		$this->load->database();
	}

    public function ExecuteSP($SPname, $data = array())
    {
        
        if(count($data) == 0)
        {
            $sp = $SPname."()";
        }
        else
        {
            $sp = $SPname."(?". str_pad("", (count($data) - 1) * 2, ",?") .")";
        }

		$query = $this->db->query("CALL $sp", $data);
		$res = NULL;
		if ($query) $res = $query->result();

		$query->next_result(); 
		$query->free_result(); 

        return $res;
	}
}