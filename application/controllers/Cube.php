<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Cube (UserController)
 * Cube class to control all slide related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 12 April 2018
 */
class Cube extends BaseController
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('slide_model');
        $this->isLoggedIn();   
    }
    
    /**
     * This function used to load the first screen of the user
     */
    public function index()
    {
        $this->global['pageTitle'] = 'Manage Cube';        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the add new form
     */
    function newCube()
    {
        
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();
            $rows = array(1,2,3,4);
            $cols = array(1,2,3,4);
			
			$this->global['rows'] = $rows;
			$this->global['cols'] = $cols;
			
            $this->global['pageTitle'] = 'Indiatoday : Add New Cube';

            $this->loadViews("newCube", $this->global, $data, NULL);
        
    }

    
    /**
     * This function is used to add new user to the system
     */
    function addNewCube()
    {
        
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('cube_title','Title','trim|required');
            $this->form_validation->set_rules('description','Description','trim|required');
            if($this->form_validation->run() == FALSE)
            {
                $this->newCube();
            }
            else
            {

                $title = $this->security->xss_clean($this->input->post('cube_title'));
                $description = $this->security->xss_clean($this->input->post('description'));
                
				$slideInfo = array();
				$slideInfo['cube_title'] = $title;
				$slideInfo['site_id'] = $this->session->userdata("siteId");
				$slideInfo['description'] = $description;
				$slideInfo['created_by'] = $this->session->userdata('userId');
				$slideInfo['modified'] = @date('Y-m-d H:i:s');
				$slideInfo['created'] = @date('Y-m-d H:i:s');
				
               // print_r($slideInfo);die;
                $result = $this->slide_model->addNewCube($slideInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Cube created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Cube creation failed');
                }                
                redirect('newCube');
            }
        
    }
	
	/**
     * This function is used to load the user list
     */
    function manageCube()
    {
           
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->slide_model->cubeListing($searchText,'','');

			$returns = $this->paginationCompress ( "cubeListing/", count($count), 10 );
           
            $data['slideRecords'] = $this->slide_model->cubeListing($searchText, $returns["page"], $returns["segment"]);
            
            $this->global['pageTitle'] = 'Indiatoday : Cube Listing';
            
            $this->loadViews("cubes", $this->global, $data, NULL);
        
    }
	/**
     * This function is used load user edit information
     * @param number $cubeId : Optional : This is user id
     */
    function editCube($cubeId = NULL)
    {
		
        
            if($cubeId == null)
            {
                redirect('manageCube');
            }
            $rows = array(1,2,3,4);
            $cols = array(1,2,3,4);
			$this->global['rows'] = $rows;
			$this->global['cols'] = $cols;
           
            $data['slideInfo'] = $this->slide_model->getCubeInfo($cubeId)[0];
            $this->global['pageTitle'] = 'Indiatoday : Edit Cube';
            
            $this->loadViews("editCube", $this->global, $data, NULL);
        
    }
	
	/**
     * This function is used load user edit information
     * @param number $cubeId : Optional : This is user id
     */
    function updateCube($cubeId = NULL)
    {
		
        
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('cube_title','Title','trim|required');
            $this->form_validation->set_rules('description','Description','trim|required');
            if($this->form_validation->run() == FALSE)
            {
                $this->editCube($cubeId);
            }
            else
            {

                $title = $this->security->xss_clean($this->input->post('cube_title'));
                $description = $this->security->xss_clean($this->input->post('description'));
                
				$slideInfo = array();
				//$slideInfo['cube_id'] = $cubeId;
				$slideInfo['cube_title'] = $title;
				$slideInfo['description'] = $description;
				$slideInfo['created_by'] = $this->session->userdata('userId');
				$slideInfo['modified'] = @date('Y-m-d H:i:s');
				$slideInfo['created'] = @date('Y-m-d H:i:s');
				
               // print_r($slideInfo);die;
			  
                $result = $this->slide_model->updateCube($slideInfo, $cubeId);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Cube has been updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Cube updation failed');
                }                
                redirect('editCube');
            }
        
    }
	
	/**
     * This function is used to delete slide
     */
    function deleteCube($cubeId=0)
    {
        $result = $this->slide_model->deleteCube($cubeId);
		
		if($result > 0) 
		{
			$this->session->set_flashdata('success', 'Slide has been deleted successfully');
		}
		else
		{
			$this->session->set_flashdata('error', 'Cube deletion failed');
		}                
		redirect('manageCube');
    }
}

?>