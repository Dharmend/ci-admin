<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Programme_model extends CI_Model
{

	/**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function programmeListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.id');
        $this->db->from('tbl_programme_info as BaseTbl');
        
		if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
			//$this->db->where('BaseTbl.createdby', $this->session->userdata("userId"));
		}
        $query = $this->db->get();
        
        return $query->num_rows();
    }
    
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    /**
     * This function used to get all active cubes
     * @return array $result : This is active cube information
     */
    function getActiveProgramme($userId=0)
    {
        $this->db->select('id');
        $this->db->from('tbl_programme_info');
        //$this->db->where('isDeleted', 0);
        $this->db->where('published', 1);
        if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
            //$this->db->where('site_id', $this->session->userdata("siteId"));
        }
        $query = $this->db->get();
        
        $result = $query->result();  
        return $result;
    }

    function getActiveProgrammeCat($userId=0)
    {
        $this->db->select('id, cat_name');
        $this->db->from('tbl_programme_category');
        //$this->db->where('isDeleted', 0);
        $this->db->where('published', 1);
        if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
            //$this->db->where('site_id', $this->session->userdata("siteId"));
        }
        $query = $this->db->get();
        
        $result = $query->result();  
        return $result;
    }

    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function programmeListing($searchText = '', $page, $segment, $cubeId)
    {
        
        $this->db->select('*');        
        $this->db->from('tbl_programme_info as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.title  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        /*if(!empty($cubeId)) {
            $this->db->where('BaseTbl.cube_id', $cubeId);
        }*/
        //$this->db->where('BaseTbl.published', 1);
        //$this->db->where('BaseTbl.isDeleted', 0);
        if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
            //$this->db->where('BaseTbl.createdby', $this->session->userdata("userId"));
        }
        $this->db->order_by("updated_datetime", "desc");
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        //echo $this->db->last_query();die;
        //print_r($query);
        $result = $query->result();        
        return $result;
    }

    /**
     * This function used to get user information by id
     * @param number $slideId : This is user id
     * @return array $result : This is user information
     */
    function getProgrammeInfo($slideId)
    {
        /*$this->db->select('tbl_pi.id as pid,tbl_pi.title,tbl_pi.published, tbl_pi.meta_title, tbl_pi.meta_keywords, tbl_pi.meta_description, tbl_pd.id, tbl_pd.block_name, tbl_pd.block_description, tbl_pd.block_order, tbl_pd.published as pd_published, tbl_pd.is_career_block');
        $this->db->from('tbl_programme_info as tbl_pi');
        $this->db->join('tbl_programme_details as tbl_pd', "tbl_pd.programme_id=tbl_pi.id", 'left');
        $this->db->order_by("tbl_pd.block_order", "asc");*/
        //$this->db->where('isDeleted', 0);
        $this->db->select('*');
        $this->db->from('tbl_programme_info as tbl_pi');
        $this->db->where('tbl_pi.id',$slideId);

        if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
            //$this->db->where('createdby', $this->session->userdata("userId"));
        }
        $this->db->where('tbl_pi.id', $slideId);
        $query = $this->db->get();
          
        return $query->result();
    }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function updateProgramme($slideInfo, $slideId)
    {
        $this->db->trans_start();
        $this->db->where('id', $slideId);
        $this->db->update('tbl_programme_info', $slideInfo);       
        
        $this->db->trans_complete();
        
        return true;        
    }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewProgramme($slideInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_programme_info', $slideInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function is used to delete slide
     * @param number $slideId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function deleteProgramme($slideId)
    {
        $slideInfo = array();
        //$slideInfo['isDeleted'] = 1;
        
       //$sql = "DELETE tbl_programme_info, tbl_programme_details from  tbl_programme_info inner join tbl_programme_details on tbl_programme_info.id=tbl_programme_details.programme_id where tbl_programme_info.id=$slideId";
        //return $this->db->query($sql);
        $this->db->where('id', $slideId);
        $this->db->delete('tbl_programme_info');
        /*$this->db->where('tbl_programme_details.programme_id', $slideId);
        $this->db->where('tbl_programme_details.programme_id', $slideId);*/
        
        
        return $this->db->affected_rows();
    }

    function deleteProgrammeDetail($slideId)
    {
        $slideInfo = array();
        //$slideInfo['isDeleted'] = 1;
        $this->db->where('programme_id', $slideId);
        $this->db->delete('tbl_programme_details');
        
        return $this->db->affected_rows();
    }

    function insertProgrammeDetails($details){
            $this->db->trans_start();
            $this->db->insert_batch('tbl_programme_details', $details);            
            return $this->db->trans_complete();            
    }


}