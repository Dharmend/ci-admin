<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Slide (UserController)
 * Slide class to control all slide related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 12 April 2018
 */
class Staticpages extends BaseController
{
	/**
     * This is default constructor of the class
     */
    protected $page_types ; 
    public function __construct()
    {
        parent::__construct();
        $this->page_types = array('1'=>'About Us', '2'=>'Faqs');
        $this->load->model('user_model');
        $this->load->model('staticpages_model');
        $this->isLoggedIn();   
    }

   	public function index(){
   		$this->global['pageTitle'] = 'Manage Static Pages';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
   	}

   	/**
     * This function is used to load the user list
     */
    function manageStaticpages()
    {
		
          
			/*$data['cube_id'] = $this->input->post('cube_id');
			$data['cubes'] = $this->profile_model->getActiveProfile();*/
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->staticpages_model->staticpagesListingCount($searchText);
			
			$returns = $this->paginationCompress ( "manageStaticpages/", $count, 10 );
          // print_r($data);die;
			
			$data['page_types'] = $this->page_types;
            $data['slideRecords'] = $this->staticpages_model->staticpagesListing($searchText, $returns["page"], $returns["segment"], $data['cube_id']);
            
            $this->global['pageTitle'] = 'Indiatoday : Static Pages Listing';
            
            $this->loadViews("staticpages", $this->global, $data, NULL);
        
    }

    /**
     * This function is used load user edit information
     * @param number $slideId : Optional : This is user id
     */
    function editStaticpages($slideId = NULL)
    {
		
        
            if($slideId == null)
            {
                redirect('manageStaticpages');
            }
            //$data['cubes'] = $this->faqs_model->getActiveCubes();
            $data['page_types'] = $this->page_types;
            $data['slideInfo'] = $this->staticpages_model->getStaticpageInfo($slideId);
			//echo '<pre>';print_r($data['slideInfo']);die;
            $this->global['pageTitle'] = 'Indiatoday : Edit Staticpage';
            
            $this->loadViews("editStaticpage", $this->global, $data, NULL);

    }

    /**
     * This function is used to add new user to the system
     */
    function updateStaticpages($slideId)
    {
        //die('Hello');
       		
            $this->load->library('form_validation');
            $this->form_validation->set_rules('profile_name','Profile Name','trim|required');
            $this->form_validation->set_rules('page_type','Page Type','trim|required');
            $this->form_validation->set_rules('description','Profile Description','trim|required');
            $this->form_validation->set_rules('meta_title','Meta Title','trim|required');
            $this->form_validation->set_rules('meta_keyword','Meta Keyword','trim|required');
            $this->form_validation->set_rules('meta_description','Meta Description','trim|required');
            
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->newProfile();
            }
            else
            {
              
                $profile_name = $this->security->xss_clean($this->input->post('profile_name'));
                $page_type = $this->security->xss_clean($this->input->post('page_type'));
                $description = $this->security->xss_clean($this->input->post('description'));
                $meta_title = $this->security->xss_clean($this->input->post('meta_title'));
                $meta_keyword = $this->security->xss_clean($this->input->post('meta_keyword'));
                $meta_description = $this->security->xss_clean($this->input->post('meta_description'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
                $slideInfo = array();
                $slideInfo['page_title'] = $profile_name;
                $slideInfo['page_type'] = $page_type;
                $slideInfo['published'] = $published;       
                $slideInfo['body_content'] = $description;       
                $slideInfo['meta_title'] = $meta_title;       
                $slideInfo['meta_keywords'] = $meta_keyword;       
                $slideInfo['meta_description'] = $meta_description;             
                $slideInfo['updatedby'] = $this->session->userdata('userId');
                $slideInfo['updated_datetime'] = @date('Y-m-d H:i:s');
                
                
                //print_r($slideInfo);die;
                $result = $this->staticpages_model->updateStaticpages($slideInfo, $slideId);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Profile has been updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Profile updation failed');
                }            				
                redirect('editStaticpages/'.$slideId);
            }
        
    }


    /**
     * This function is used to load the add new form
     */
    function newStaticpage()
    {
        	//die('Hi');
            
            //$data['roles'] = $this->user_model->getUserRoles();
            //$data['cubes'] = $this->faqs_model->getActiveCubes();
			//echo '<pre>';print_r($data['cubes']);die;
            $data['page_types'] = $this->page_types;
            $this->global['pageTitle'] = 'Indiatoday : Add New Static Page';

            $this->loadViews("newStaticpage", $this->global, $data, NULL);

    }

    /**
     * This function is used to add new user to the system
     */
    function addNewStaticpage()
    {
     
            $this->load->library('form_validation');
            $this->form_validation->set_rules('profile_name','Profile Name','trim|required');
            $this->form_validation->set_rules('page_type','Page Type','trim|required');
            $this->form_validation->set_rules('description','Body Content','trim|required');
            $this->form_validation->set_rules('meta_title','Meta Title','trim|required');
            $this->form_validation->set_rules('meta_keyword','Meta Keyword','trim|required');
            $this->form_validation->set_rules('meta_description','Meta Description','trim|required');
            //$this->form_validation->set_rules('profile_image','Profile Image','trim|required');
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            if($this->form_validation->run() == FALSE)
            {
                $this->newStaticpage();
            }
            else
            {

                $profile_name = $this->security->xss_clean($this->input->post('profile_name'));
                $page_type = $this->security->xss_clean($this->input->post('page_type'));
                $description = $this->security->xss_clean($this->input->post('description'));
                $meta_title = $this->security->xss_clean($this->input->post('meta_title'));
                $meta_keyword = $this->security->xss_clean($this->input->post('meta_keyword'));
                $meta_description = $this->security->xss_clean($this->input->post('meta_description'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
				$slideInfo = array();
				$slideInfo['page_title'] = $profile_name;
                $slideInfo['page_type'] = $page_type;
				$slideInfo['published'] = $published;       
                $slideInfo['body_content'] = $description;       
                $slideInfo['meta_title'] = $meta_title;       
                $slideInfo['meta_keywords'] = $meta_keyword;       
				$slideInfo['meta_description'] = $meta_description;				
				$slideInfo['createdby'] = $this->session->userdata('userId');
				$slideInfo['created_datetime'] = @date('Y-m-d H:i:s');
				$slideInfo['updated_datetime'] = $slideInfo['created_datetime'];
                
                $result = $this->staticpages_model->addNewStaticpage($slideInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Static page created successfully');
                    redirect('manageStaticpages');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Profile creation failed');
                    redirect('newStaticpage');
                }                
                
            }
        
    }


    /**
     * This function is used to delete slide
     */
    function deleteStaticpage($slideId=0)
    {
              
             $result = $this->staticpages_model->deleteStaticpage($slideId);
		
    		if($result > 0) 
    		{
    			$this->session->set_flashdata('success', 'Staticpage has been deleted successfully');
    		}
    		else
    		{
    			$this->session->set_flashdata('error', 'Staticpage deletion failed');
    		}                
    		redirect('manageStaticpages');
        }


}