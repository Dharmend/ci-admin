<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Slide (UserController)
 * Slide class to control all slide related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 12 April 2018
 */
class Profile extends BaseController
{
	/**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('profile_model');
        $this->isLoggedIn();   
    }

   	public function index(){
   		$this->global['pageTitle'] = 'Manage Profile';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
   	}

   	/**
     * This function is used to load the user list
     */
    function manageProfile()
    {
		
          
			$data['cube_id'] = $this->input->post('cube_id');
			$data['cubes'] = $this->profile_model->getActiveProfile();
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->profile_model->profileListingCount($searchText);
			
			$returns = $this->paginationCompress ( "manageProfile/", $count, 10 );
          // print_r($data);die;
			
			
            $data['slideRecords'] = $this->profile_model->profileListing($searchText, $returns["page"], $returns["segment"], $data['cube_id']);
            
            $this->global['pageTitle'] = 'Indiatoday : Profile Listing';
            
            $this->loadViews("profile", $this->global, $data, NULL);
        
    }

    /**
     * This function is used load user edit information
     * @param number $slideId : Optional : This is user id
     */
    function editProfile($slideId = NULL)
    {
		
        
            if($slideId == null)
            {
                redirect('manageProfile');
            }
            $data['cubes'] = $this->profile_model->getActiveProfileCat();
            $data['slideInfo'] = $this->profile_model->getProfileInfo($slideId)[0];
			//echo '<pre>';print_r($data);die;
            $this->global['pageTitle'] = 'Indiatoday : Edit profile';
            
            $this->loadViews("editProfile", $this->global, $data, NULL);

    }

    /**
     * This function is used to add new user to the system
     */
    function updateProfile($slideId)
    {

       		
            $this->load->library('form_validation');
            $this->form_validation->set_rules('profile_name','Profile Name','trim|required');
            $this->form_validation->set_rules('profile_title','Profile Title','trim|required');
            $this->form_validation->set_rules('cat_id','Category','trim|required');
            $this->form_validation->set_rules('short_description','Profile Short Description','trim|required');
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
                $profile_title = $this->security->xss_clean($this->input->post('profile_title'));
                $cat_id = $this->security->xss_clean($this->input->post('cat_id'));
                $short_description = $this->security->xss_clean($this->input->post('short_description'));
                $description = $this->security->xss_clean($this->input->post('description'));
                $meta_title = $this->security->xss_clean($this->input->post('meta_title'));
                $meta_keyword = $this->security->xss_clean($this->input->post('meta_keyword'));
                $meta_description = $this->security->xss_clean($this->input->post('meta_description'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
                $slideInfo = array();
                $slideInfo['profile_name'] = $profile_name;
                $slideInfo['profile_title'] = $profile_title;
                $slideInfo['profile_category'] = $cat_id;
                $slideInfo['published'] = $published;       
                $slideInfo['profile_long_description'] = $description;       
                $slideInfo['profile_short_description'] = $short_description;       
                $slideInfo['meta_title'] = $meta_title;       
                $slideInfo['meta_keywords'] = $meta_keyword;       
                $slideInfo['meta_description'] = $meta_description;       
                $slideInfo['updatedby'] = $this->session->userdata('userId');
                $slideInfo['updated_datetime'] = @date('Y-m-d H:i:s');
                
                if(!empty($_FILES['profile_image']['name'])){
                  $fileUpload = $this->do_upload('profile_image','profile/');
                  if($fileUpload['success'] == 1){
                     $uploadedFile = base_url().'assets/uploads/profile/'.$fileUpload['upload_data']['file_name'];
                     $slideInfo['profile_image'] = $uploadedFile;   
                  }
                }
				
               // print_r($slideInfo);die;
                $result = $this->profile_model->updateProfile($slideInfo, $slideId);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Profile has been updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Profile updation failed');
                }            				
                redirect('editProfile/'.$slideId);
            }
        
    }


    /**
     * This function is used to load the add new form
     */
    function newProfile()
    {
        	//die('Hi');
            
            //$data['roles'] = $this->user_model->getUserRoles();
            //$data['cubes'] = $this->faqs_model->getActiveCubes();
			//echo '<pre>';print_r($data['cubes']);die;
            $data['cubes'] = $this->profile_model->getActiveProfileCat();
            
            $this->global['pageTitle'] = 'Indiatoday : Add New User';

            $this->loadViews("newProfile",$this->global, $data, NULL);

    }

    /**
     * This function is used to add new user to the system
     */
    function addNewProfile()
    {
     
            $this->load->library('form_validation');
            $this->form_validation->set_rules('profile_name','Profile Name','trim|required');
            $this->form_validation->set_rules('profile_title','Profile Title','trim|required');
            $this->form_validation->set_rules('cat_id','Category','trim|required');
            $this->form_validation->set_rules('short_description','Profile Short Description','trim|required');
            $this->form_validation->set_rules('description','Profile Description','trim|required');
            $this->form_validation->set_rules('meta_title','Meta Title','trim|required');
            $this->form_validation->set_rules('meta_keyword','Meta Keyword','trim|required');
            $this->form_validation->set_rules('meta_description','Meta Description','trim|required');
            //$this->form_validation->set_rules('profile_image','Profile Image','trim|required');
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            if($this->form_validation->run() == FALSE)
            {
                $this->newProfile();
            }
            else
            {

                $profile_name = $this->security->xss_clean($this->input->post('profile_name'));
                $profile_title = $this->security->xss_clean($this->input->post('profile_title'));
                 $cat_id = $this->security->xss_clean($this->input->post('cat_id'));
                $short_description = $this->security->xss_clean($this->input->post('short_description'));
                $description = $this->security->xss_clean($this->input->post('description'));
                $meta_title = $this->security->xss_clean($this->input->post('meta_title'));
                $meta_keyword = $this->security->xss_clean($this->input->post('meta_keyword'));
                $meta_description = $this->security->xss_clean($this->input->post('meta_description'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
				$slideInfo = array();
				$slideInfo['profile_name'] = $profile_name;
				$slideInfo['profile_title'] = $profile_title;
                $slideInfo['profile_category'] = $cat_id;
                $slideInfo['published'] = $published;       
                $slideInfo['profile_long_description'] = $description;       
                $slideInfo['profile_short_description'] = $short_description;       
                $slideInfo['meta_title'] = $meta_title;       
                $slideInfo['meta_keywords'] = $meta_keyword;       
				$slideInfo['meta_description'] = $meta_description;				
				$slideInfo['createdby'] = $this->session->userdata('userId');
				$slideInfo['created_datetime'] = @date('Y-m-d H:i:s');
				$slideInfo['updated_datetime'] = $slideInfo['created_datetime'];
                
                $fileUpload = $this->do_upload('profile_image','profile/');
                if($fileUpload['success'] == 1){
                   $uploadedFile = base_url().'assets/uploads/profile/'.$fileUpload['upload_data']['file_name'];
                   $slideInfo['profile_image'] = $uploadedFile;   
                   $result = $this->profile_model->addNewProfile($slideInfo);
                }
                // print_r($slideInfo);die;
                
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Profile created successfully');
                    redirect('manageProfile');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Profile creation failed');
                    redirect('newProfile');
                }                
                
            }
        
    }


    /**
     * This function is used to delete slide
     */
    function deleteProfile($slideId=0)
    {
        $result = $this->profile_model->deleteProfile($slideId);
		
    		if($result > 0) 
    		{
    			$this->session->set_flashdata('success', 'Profile has been deleted successfully');
    		}
    		else
    		{
    			$this->session->set_flashdata('error', 'Profile deletion failed');
    		}                
    		redirect('manageProfile');
        }


        /*************************************  

            Profile category 


        ***********************************/
     /**
     * This function is used to load the user list
     */
    function manageProfileCat()
    {
            
            $data['cube_id'] = $this->input->post('cube_id');
            /*$data['cubes'] = $this->profile_model->getActiveProfile();*/
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->profile_model->profileCatListingCount($searchText);
            
            $returns = $this->paginationCompress ( "manageProfileCat/", $count, 10 );
                    
            

            $data['slideRecords'] = $this->profile_model->profileCatListing($searchText, $returns["page"], $returns["segment"], $data['cube_id']);
            
            $this->global['pageTitle'] = 'Indiatoday : Profile Listing';
            
            $this->loadViews("profileCat", $this->global, $data, NULL);
        
    }

    /**
     * This function is used load user edit information
     * @param number $slideId : Optional : This is user id
     */
    function editProfileCat($slideId = NULL)
    {
        
        
            if($slideId == null)
            {
                redirect('manageProfileCat');
            }
            //$data['cubes'] = $this->faqs_model->getActiveCubes();
            $data['slideInfo'] = $this->profile_model->getProfileCatInfo($slideId)[0];
            //echo '<pre>';print_r($data['slideInfo']);die;
            $this->global['pageTitle'] = 'Indiatoday : Edit profile';
            
            $this->loadViews("editProfileCat", $this->global, $data, NULL);

    }

    /**
     * This function is used to add new user to the system
     */
    function updateProfileCat($slideId)
    {

            
            $this->load->library('form_validation');
            $this->form_validation->set_rules('profile_name','Profile Name','trim|required');
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
                $meta_title = $this->security->xss_clean($this->input->post('meta_title'));
                $meta_keyword = $this->security->xss_clean($this->input->post('meta_keyword'));
                $meta_description = $this->security->xss_clean($this->input->post('meta_description'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
                $slideInfo = array();
                $slideInfo['cat_name'] = $profile_name;
                $slideInfo['published'] = $published;       
                $slideInfo['meta_title'] = $meta_title;       
                $slideInfo['meta_keywords'] = $meta_keyword;       
                $slideInfo['meta_description'] = $meta_description;       
                $slideInfo['updatedby'] = $this->session->userdata('userId');
                $slideInfo['updated_datetime'] = @date('Y-m-d H:i:s');
                
                /*if(!empty($_FILES['profile_image']['name'])){
                  $fileUpload = $this->do_upload('profile_image','profile/');
                  if($fileUpload['success'] == 1){
                     $uploadedFile = base_url().'assets/uploads/profile/'.$fileUpload['upload_data']['file_name'];
                     $slideInfo['profile_image'] = $uploadedFile;   
                  }
                }*/
                
               // print_r($slideInfo);die;
                $result = $this->profile_model->updateProfileCat($slideInfo, $slideId);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Profile has been updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Profile updation failed');
                }                           
                redirect('editProfileCat/'.$slideId);
            }
        
    }


    /**
     * This function is used to load the add new form
     */
    function newProfileCat()
    {
            //die('Hi');
            
            //$data['roles'] = $this->user_model->getUserRoles();
            //$data['cubes'] = $this->faqs_model->getActiveCubes();
            //echo '<pre>';print_r($data['cubes']);die;
            
            $this->global['pageTitle'] = 'Indiatoday : Add New User';

            $this->loadViews("newProfileCat");

    }

    /**
     * This function is used to add new user to the system
     */
    function addNewProfileCat()
    {
     
            $this->load->library('form_validation');
            $this->form_validation->set_rules('profile_name','Profile Name','trim|required');
            $this->form_validation->set_rules('meta_title','Meta Title','trim|required');
            $this->form_validation->set_rules('meta_keyword','Meta Keyword','trim|required');
            $this->form_validation->set_rules('meta_description','Meta Description','trim|required');
            //$this->form_validation->set_rules('profile_image','Profile Image','trim|required');
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            if($this->form_validation->run() == FALSE)
            {
                $this->newProfile();
            }
            else
            {

                $profile_name = $this->security->xss_clean($this->input->post('profile_name'));
                $meta_title = $this->security->xss_clean($this->input->post('meta_title'));
                $meta_keyword = $this->security->xss_clean($this->input->post('meta_keyword'));
                $meta_description = $this->security->xss_clean($this->input->post('meta_description'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
                $slideInfo = array();
                $slideInfo['cat_name'] = $profile_name;
                $slideInfo['published'] = $published;       
                $slideInfo['meta_title'] = $meta_title;       
                $slideInfo['meta_keywords'] = $meta_keyword;       
                $slideInfo['meta_description'] = $meta_description;             
                $slideInfo['createdby'] = $this->session->userdata('userId');
                $slideInfo['created_datetime'] = @date('Y-m-d H:i:s');
                $slideInfo['updated_datetime'] = $slideInfo['created_datetime'];
                
                /*$fileUpload = $this->do_upload('profile_image','profile/');
                if($fileUpload['success'] == 1){
                   $uploadedFile = base_url().'assets/uploads/profile/'.$fileUpload['upload_data']['file_name'];
                   $slideInfo['profile_image'] = $uploadedFile;   
                   
                }*/
                // print_r($slideInfo);die;
                $result = $this->profile_model->addNewProfileCat($slideInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Profile created successfully');
                    redirect('manageProfileCat');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Profile creation failed');
                    redirect('newProfileCat');
                }                
                
            }
        
    }


    /**
     * This function is used to delete slide
     */
    function deleteProfileCat($slideId=0)
    {
        $result = $this->profile_model->deleteProfileCat($slideId);
        
            if($result > 0) 
            {
                $this->session->set_flashdata('success', 'Profile has been deleted successfully');
            }
            else
            {
                $this->session->set_flashdata('error', 'Profile deletion failed');
            }                
            redirect('manageProfileCat');
        }   





}