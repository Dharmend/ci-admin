<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Slide_model extends CI_Model
{
    /**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @return number $count : This is row count
     */
    function slideListingCount($searchText = '')
    {
        $this->db->select('BaseTbl.slide_id, BaseTbl.slide_heading, BaseTbl.slide_title, BaseTbl.status, created_by');
        $this->db->from('tbl_slides as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.slide_title  LIKE '%".$searchText."%'
                            OR  BaseTbl.slide_heading  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.status', 1);
		$this->db->where('BaseTbl.isDeleted', 0);
		
		if(!empty($cube_id)) {
			$this->db->where('BaseTbl.cube_id', $cube_id);
		}
		if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
			$this->db->where('BaseTbl.created_by', $this->session->userdata("userId"));
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
    function slideListing($searchText = '', $page, $segment, $cubeId)
    {
		
        $this->db->select('BaseTbl.slide_id, BaseTbl.slide_heading, BaseTbl.slide_title, BaseTbl.status, created_by');
		
        $this->db->from('tbl_slides as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.slide_title  LIKE '%".$searchText."%'
                            OR  BaseTbl.slide_heading  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
		if(!empty($cubeId)) {
			$this->db->where('BaseTbl.cube_id', $cubeId);
		}
        $this->db->where('BaseTbl.status', 1);
		$this->db->where('BaseTbl.isDeleted', 0);
		if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
			$this->db->where('BaseTbl.created_by', $this->session->userdata("userId"));
		}
        
        $this->db->limit($page, $segment);
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        //print_r($query);
        $result = $query->result();        
        return $result;
    }
    
   
    
    /**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewSlide($slideInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_slides', $slideInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
	
	/**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function updateSlide($slideInfo, $slideId)
    {
        $this->db->trans_start();
		$this->db->where('slide_id', $slideId);
        $this->db->update('tbl_slides', $slideInfo);
        
        
        $this->db->trans_complete();
        
        return true;		
    }
    
    /**
     * This function used to get user information by id
     * @param number $slideId : This is user id
     * @return array $result : This is user information
     */
    function getSlideInfo($slideId)
    {
        $this->db->select('*');
        $this->db->from('tbl_slides');
        $this->db->where('isDeleted', 0);
		if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
			$this->db->where('created_by', $this->session->userdata("userId"));
		}
        $this->db->where('slide_id', $slideId);
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
    /**
     * This function is used to update the user information
     * @param array $userInfo : This is users updated information
     * @param number $userId : This is user id
     */
    function editUser($userInfo, $userId)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return TRUE;
    }
    
    
    
    /**
     * This function is used to delete the user information
     * @param number $userId : This is user id
     * @return boolean $result : TRUE / FALSE
     */
    function deleteUser($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to match users password for change password
     * @param number $userId : This is user id
     */
    function matchOldPassword($userId, $oldPassword)
    {
        $this->db->select('userId, password');
        $this->db->where('userId', $userId);        
        $this->db->where('isDeleted', 0);
        $query = $this->db->get('tbl_users');
        
        $user = $query->result();

        if(!empty($user)){
            if(verifyHashedPassword($oldPassword, $user[0]->password)){
                return $user;
            } else {
                return array();
            }
        } else {
            return array();
        }
    }
    
	 /**
     * This function is used to delete slide
     * @param number $slideId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function deleteSlide($slideId)
    {
		$slideInfo = array();
		$slideInfo['isDeleted'] = 1;
        $this->db->where('slide_id', $slideId);
        $this->db->update('tbl_slides', $slideInfo);
        
        return $this->db->affected_rows();
    }
	
    /**
     * This function is used to change users password
     * @param number $userId : This is user id
     * @param array $userInfo : This is user updation info
     */
    function changePassword($userId, $userInfo)
    {
        $this->db->where('userId', $userId);
        $this->db->where('isDeleted', 0);
        $this->db->update('tbl_users', $userInfo);
        
        return $this->db->affected_rows();
    }


    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     */
    function loginHistoryCount($userId, $searchText, $fromDate, $toDate)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->from('tbl_last_login as BaseTbl');
        $query = $this->db->get();
        
        return $query->num_rows();
    }

    /**
     * This function is used to get user login history
     * @param number $userId : This is user id
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function loginHistory($userId, $searchText, $fromDate, $toDate, $page, $segment)
    {
        $this->db->select('BaseTbl.userId, BaseTbl.sessionData, BaseTbl.machineIp, BaseTbl.userAgent, BaseTbl.agentString, BaseTbl.platform, BaseTbl.createdDtm');
        $this->db->from('tbl_last_login as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.email  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        if(!empty($fromDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) >= '".date('Y-m-d', strtotime($fromDate))."'";
            $this->db->where($likeCriteria);
        }
        if(!empty($toDate)) {
            $likeCriteria = "DATE_FORMAT(BaseTbl.createdDtm, '%Y-%m-%d' ) <= '".date('Y-m-d', strtotime($toDate))."'";
            $this->db->where($likeCriteria);
        }
        $this->db->where('BaseTbl.userId', $userId);
        $this->db->order_by('BaseTbl.id', 'DESC');
        $this->db->limit($page, $segment);
        $query = $this->db->get();
        
        $result = $query->result();        
        return $result;
    }
	
	/**
     * This function used to get all active cubes
     * @return array $result : This is active cube information
     */
    function getActiveCubes($userId=0)
    {
        $this->db->select('cube_id, cube_title');
        $this->db->from('tbl_cube');
        $this->db->where('isDeleted', 0);
        $this->db->where('status', 1);
		if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
			$this->db->where('site_id', $this->session->userdata("siteId"));
		}
        $query = $this->db->get();
        
        $result = $query->result();  
		return $result;
    }
	
    /**
     * This function used to get user information by id
     * @param number $userId : This is user id
     * @return array $result : This is user information
     */
    function getUserInfoById($userId)
    {
        $this->db->select('userId, name, email, mobile, roleId');
        $this->db->from('tbl_users');
        $this->db->where('isDeleted', 0);
        $this->db->where('userId', $userId);
        $query = $this->db->get();
        
        return $query->row();
    }
	
	/**
     * This function is used to get the user listing count
     * @param string $searchText : This is optional search text
     * @param number $page : This is pagination offset
     * @param number $segment : This is pagination limit
     * @return array $result : This is result
     */
    function cubeListing($searchText = '', $page, $segment)
    {
       
		$this->db->select('BaseTbl.*');
        $this->db->from('tbl_cube as BaseTbl');
        if(!empty($searchText)) {
            $likeCriteria = "(BaseTbl.cube_title  LIKE '%".$searchText."%')";
            $this->db->where($likeCriteria);
        }
        //$this->db->where('BaseTbl.status', 1);
		$this->db->where('BaseTbl.isDeleted', 0);
		if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
			$this->db->where('BaseTbl.site_id', $this->session->userdata("siteId"));
		}
        
        $this->db->limit($page, $segment);
        $query = $this->db->get();
		//echo $this->db->last_query();
        //print_r($query);die;
        $result = $query->result();        
        return $result;
    }
	
	/**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function addNewCube($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_cube', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
	
	/**
     * This function is used to add new user to system
     * @return number $insert_id : This is last inserted id
     */
    function editCube($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_cube', $userInfo);
        
        $insert_id = $this->db->insert_id();
        
        $this->db->trans_complete();
        
        return $insert_id;
    }
	
	/**
     * This function used to get user information by id
     * @param number $cubeId : This is user id
     * @return array $result : This is user information
     */
    function getCubeInfo($cubeId)
    {
        $this->db->select('*');
        $this->db->from('tbl_cube');
        $this->db->where('isDeleted', 0);
		if($this->session->userdata("userId")==1)
        {
           //select all
        } else {
			$this->db->where('created_by', $this->session->userdata("userId"));
		}
        $this->db->where('cube_id', $cubeId);
        $query = $this->db->get();
        
        return $query->result();
    }
	
	/**
     * This function is used to add new user to system
     * @return number true : 
     */
    function updateCube($userInfo, $cubeId=0)
    {
        $this->db->trans_start();
		$this->db->where('cube_id', $cubeId);
        $this->db->update('tbl_cube', $userInfo);
        
        
        $this->db->trans_complete();
        
        return true;
    }
	/**
     * This function is used to delete cube
     * @param number $cubeId : This is cube id
     * @param array $userInfo : This is user updation info
     */
    function deleteCube($cubeId)
    {
		$cubeInfo = array();
		$cubeInfo['isDeleted'] = 1;
        $this->db->where('cube_id', $cubeId);
        $this->db->update('tbl_cube', $cubeInfo);
        

        $this->db->where('cube_id', $cubeId);
        $this->db->update('tbl_slides', $cubeInfo);
        

		
        return $this->db->affected_rows();
    }
}

  