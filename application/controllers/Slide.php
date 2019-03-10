<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Slide (UserController)
 * Slide class to control all slide related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 12 April 2018
 */
class Slide extends BaseController
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
        $this->global['pageTitle'] = 'Manage Slide';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
    }
    
    /**
     * This function is used to load the add new form
     */
    function newSlide()
    {
        
            $this->load->model('user_model');
            $data['roles'] = $this->user_model->getUserRoles();
            $data['cubes'] = $this->slide_model->getActiveCubes();
			//echo '<pre>';print_r($data['cubes']);die;
            $rows = array(1,2,3,4);
            $cols = array(1,2,3,4);
			
			$this->global['rows'] = $rows;
			$this->global['cols'] = $cols;
			
            $this->global['pageTitle'] = 'Indiatoday : Add New User';

            $this->loadViews("newSlide", $this->global, $data, NULL);

    }

    
    /**
     * This function is used to add new user to the system
     */
    function addNewSlide()
    {
        
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('title','Full Name','trim|required|max_length[28]');
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            if($this->form_validation->run() == FALSE)
            {
                $this->newSlide();
            }
            else
            {

                $title = $this->security->xss_clean($this->input->post('title'));
                $heading = $this->security->xss_clean($this->input->post('heading'));
                $rows = $this->security->xss_clean($this->input->post('rows'));
                $cols = $this->security->xss_clean($this->input->post('cols'));
                $cube_id = $this->security->xss_clean($this->input->post('cube_id'));
                
				$slideInfo = array();
				$slideInfo['cube_id'] = $cube_id;
				$slideInfo['site_id'] = $this->session->userdata("siteId");
				$slideInfo['slide_title'] = $title;
				$slideInfo['slide_heading'] = $heading;
				$slideInfo['no_of_rows'] = $rows;
				$slideInfo['no_of_cols'] = $cols;
				$slideInfo['created_by'] = $this->session->userdata('userId');
				$slideInfo['modified'] = @date('Y-m-d H:i:s');
				
				for($i=1;$i<=16;$i++) {
					$x = 'col-'.$i;
					@$xxx = $this->input->post($x);
					if(isset($xxx)) {
						
						$slideInfo['col'.$i] = $this->input->post($x)	;
					}
				}
				
               // print_r($slideInfo);die;
                $result = $this->slide_model->addNewSlide($slideInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Slide created successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Slide creation failed');
                }                
                redirect('newSlide');
            }
        
    }
	
	/**
     * This function is used to add new user to the system
     */
    function updateSlide($slideId)
    {

       
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('title','Full Name','trim|required|max_length[28]');
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            if($this->form_validation->run() == FALSE)
            {
                $this->newSlide();
            }
            else
            {

                $title = $this->security->xss_clean($this->input->post('title'));
                $heading = $this->security->xss_clean($this->input->post('heading'));
                $rows = $this->security->xss_clean($this->input->post('rows'));
                $cols = $this->security->xss_clean($this->input->post('cols'));
                $cube_id = $this->security->xss_clean($this->input->post('cube_id'));
                
				$slideInfo = array();
				$slideInfo['cube_id'] = $cube_id;
				$slideInfo['slide_title'] = $title;
				$slideInfo['slide_heading'] = $heading;
				$slideInfo['no_of_rows'] = $rows;
				$slideInfo['no_of_cols'] = $cols;
				$slideInfo['created_by'] = $this->session->userdata('userId');
				$slideInfo['modified'] = @date('Y-m-d H:i:s');
				
				for($i=1;$i<=16;$i++) {
					$x = 'col-'.$i;
					@$xxx = $this->input->post($x);
					if(isset($xxx)) {
						
						$slideInfo['col'.$i] = $this->input->post($x);
					} else {
						$slideInfo['col'.$i] = '';
					}
				}
				
               // print_r($slideInfo);die;
                $result = $this->slide_model->updateSlide($slideInfo, $slideId);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Slide has been updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Slide updation failed');
                }            				
                redirect('editSlide/'.$slideId);
            }
        
    }
	
	/**
     * This function is used to load the user list
     */
    function manageSlide()
    {
		//die('111');
          
			$data['cube_id'] = $this->input->post('cube_id');
			$data['cubes'] = $this->slide_model->getActiveCubes();
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->faqs_model->slideListingCount($searchText);
			
			$returns = $this->paginationCompress ( "manageSlide/", $count, 10 );
          // print_r($data);die;
			
			if(!empty($data['cube_id'])) {
				
			}
            $data['slideRecords'] = $this->slide_model->slideListing($searchText, $returns["page"], $returns["segment"], $data['cube_id']);
            
            $this->global['pageTitle'] = 'Indiatoday : Slide Listing';
            
            $this->loadViews("slides", $this->global, $data, NULL);
        
    }
	/**
     * This function is used load user edit information
     * @param number $slideId : Optional : This is user id
     */
    function editSlide($slideId = NULL)
    {
		
        
            if($slideId == null)
            {
                redirect('manageSlide');
            }
            $rows = array(1,2,3,4);
            $cols = array(1,2,3,4);
			$this->global['rows'] = $rows;
			$this->global['cols'] = $cols;
            $data['cubes'] = $this->slide_model->getActiveCubes();
            $data['slideInfo'] = $this->slide_model->getSlideInfo($slideId)[0];
			//echo '<pre>';print_r($data['slideInfo']);die;
            $this->global['pageTitle'] = 'Indiatoday : Edit Slide';
            
            $this->loadViews("editSlide", $this->global, $data, NULL);

    }
	
	/**
     * This function is used to delete slide
     */
    function deleteSlide($slideId=0)
    {
        $result = $this->slide_model->deleteSlide($slideId);
		
		if($result > 0) 
		{
			$this->session->set_flashdata('success', 'Slide has been deleted successfully');
		}
		else
		{
			$this->session->set_flashdata('error', 'Cube deletion failed');
		}                
		redirect('manageSlide');
    }
}

?>