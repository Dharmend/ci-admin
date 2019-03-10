<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Profile_model extends CI_Model
{

	/**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function profileListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.id');
        $this->db->from('tbl_profile as BaseTbl');
        
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
    function getActiveProfile($userId=0)
    {
        $this->db->select('id,profile_name');
        $this->db->from('tbl_profile');
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
    function profileListing($searchText = '', $page, $segment, $cubeId)
    {
        
        $this->db->select('*');        
        $this->db->from('tbl_profile as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.profile_name  LIKE '%".$searchText."%'
                            OR  BaseTbl.profile_title  LIKE '%".$searchText."%')";
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
    function getProfileInfo($slideId)
    {
        $this->db->select('*');
        $this->db->from('tbl_profile');
        //$this->db->where('isDeleted', 0);
        if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
            //$this->db->where('createdby', $this->session->userdata("userId"));
        }
        $this->db->where('id', $slideId);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function updateProfile($slideInfo, $slideId)
    {
        $this->db->trans_start();
        $this->db->where('id', $slideId);
        $this->db->update('tbl_profile', $slideInfo);       
        
        $this->db->trans_complete();
        
        return true;        
    }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewProfile($slideInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_profile', $slideInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function is used to delete slide
     * @param number $slideId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function deleteProfile($slideId)
    {
        $slideInfo = array();
        //$slideInfo['isDeleted'] = 1;
        
        $this->db->where('id', $slideId);
        $this->db->delete('tbl_profile');
        
        return $this->db->affected_rows();
    }



    function profileCatListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.id');
        $this->db->from('tbl_profile_category as BaseTbl');
        
        if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
            //$this->db->where('BaseTbl.createdby', $this->session->userdata("userId"));
        }
        $query = $this->db->get();
        
        return $query->num_rows();
    }


    function getActiveProfileCat($userId=0)
    {
        $this->db->select('id,cat_name');
        $this->db->from('tbl_profile_category');
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
    function profileCatListing($searchText = '', $page, $segment, $cubeId)
    {
        
        $this->db->select('*');        
        $this->db->from('tbl_profile_category as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.cat_name  LIKE '%".$searchText."%')";
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
    function getProfileCatInfo($slideId)
    {
        $this->db->select('*');
        $this->db->from('tbl_profile_category');
        //$this->db->where('isDeleted', 0);
        if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
            //$this->db->where('createdby', $this->session->userdata("userId"));
        }
        $this->db->where('id', $slideId);
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function updateProfileCat($slideInfo, $slideId)
    {
        $this->db->trans_start();
        $this->db->where('id', $slideId);
        $this->db->update('tbl_profile_category', $slideInfo);       
        
        $this->db->trans_complete();
        
        return true;        
    }

    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewProfileCat($slideInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_profile_category', $slideInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }

    /**
     * This function is used to delete slide
     * @param number $slideId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function deleteProfileCat($slideId)
    {
        $slideInfo = array();
        //$slideInfo['isDeleted'] = 1;
        
        $this->db->where('id', $slideId);
        $this->db->delete('tbl_profile_category');
        
        return $this->db->affected_rows();
    }


}