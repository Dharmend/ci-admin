<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Cron_model extends CI_Model
{

	/**
     * This function used to get all active cubes
     * @return array $result : This is active cube information
     */
    function getActiveCubeSlides($userId=0)
    {
		$sql = "SELECT c.cube_title, s.* FROM tbl_cube c, tbl_slides s WHERE c.cube_id=s.cube_id AND c.status=1 AND c.isDeleted=0 AND s.status=1 AND s.isDeleted=0 ORDER BY s.cube_id DESC, s.slide_id ASC";

        $query = $this->db->query($sql);
        $result = $query->result();
		return $result;
    }
	
    
}  