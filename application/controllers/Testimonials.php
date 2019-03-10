<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Slide (UserController)
 * Slide class to control all slide related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 12 April 2018
 */
class Testimonials extends BaseController
{
	/**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('testimonials_model');
        $this->isLoggedIn();   
    }

   	public function index(){
   		$this->global['pageTitle'] = 'Manage Testimonials';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
   	}

   	/**
     * This function is used to load the user list
     */
    function manageTestimonials()
    {
		
          
			$data['cube_id'] = $this->input->post('cube_id');
			//$data['cubes'] = $this->profile_model->getActiveProfile();
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->testimonials_model->testimonialsListingCount($searchText);
			
			$returns = $this->paginationCompress ( "manageTestimonials/", $count, 10 );
          // print_r($data);die;
			
			
            $data['slideRecords'] = $this->testimonials_model->testimonialsListing($searchText, $returns["page"], $returns["segment"], $data['cube_id']);
            
            $this->global['pageTitle'] = 'Indiatoday : Testimonials Listing';
            
            $this->loadViews("testimonials", $this->global, $data, NULL);
        
    }

    /**
     * This function is used load user edit information
     * @param number $slideId : Optional : This is user id
     */
    function editTestimonials($slideId = NULL)
    {
		
        
            if($slideId == null)
            {
                redirect('manageTestimonials');
            }
            //$data['cubes'] = $this->profile_model->getActiveProfileCat();
            $data['slideInfo'] = $this->testimonials_model->getTestimonialsInfo($slideId)[0];
			//echo '<pre>';print_r($data);die;
            $this->global['pageTitle'] = 'Indiatoday : Edit Testimonials';
            
            $this->loadViews("editTestimonials", $this->global, $data, NULL);

    }

    /**
     * This function is used to add new user to the system
     */
    function updateTestimonials($slideId)
    {
       		
            $this->load->library('form_validation');
            $this->form_validation->set_rules('profile_name','Name','trim|required');
            $this->form_validation->set_rules('youtube_url','Testimonial URL','trim|required');
            $this->form_validation->set_rules('short_description','Profile Short Description','trim|required');
            $this->form_validation->set_rules('meta_title','Meta Title','trim|required');
            $this->form_validation->set_rules('meta_keyword','Meta Keyword','trim|required');
            $this->form_validation->set_rules('meta_description','Meta Description','trim|required');
            
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->newTestimonials();
            }
            else
            {
              
                $profile_name = $this->security->xss_clean($this->input->post('profile_name'));
                $video_url = $this->security->xss_clean($this->input->post('youtube_url'));
                $short_description = $this->security->xss_clean($this->input->post('short_description'));
                $meta_title = $this->security->xss_clean($this->input->post('meta_title'));
                $meta_keyword = $this->security->xss_clean($this->input->post('meta_keyword'));
                $meta_description = $this->security->xss_clean($this->input->post('meta_description'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
                
                $slideInfo = array();
                $slideInfo['name'] = $profile_name;
                //$slideInfo['profile_title'] = $profile_title;
                $slideInfo['video_url'] = $video_url;
                $slideInfo['published'] = $published;       
                $slideInfo['intro'] = $short_description;       
                $slideInfo['meta_title'] = $meta_title;       
                $slideInfo['meta_keywords'] = $meta_keyword;       
                $slideInfo['meta_description'] = $meta_description;       
                $slideInfo['updatedby'] = $this->session->userdata('userId');
                $slideInfo['updated_datetime'] = @date('Y-m-d H:i:s');
                
                if(!empty($_FILES['profile_image']['name'])){
                  $fileUpload = $this->do_upload('profile_image','testimonials/');
                  if($fileUpload['success'] == 1){
                     $uploadedFile = base_url().'assets/uploads/testimonials/'.$fileUpload['upload_data']['file_name'];
                     $slideInfo['image_path'] = $uploadedFile;   
                  }
                }
				
               // print_r($slideInfo);die;
                $result = $this->testimonials_model->updateTestimonials($slideInfo, $slideId);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Testimonial has been updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Testimonial updation failed');
                }            				
                redirect('editTestimonials/'.$slideId);
            }
        
    }


    /**
     * This function is used to load the add new form
     */
    function newTestimonials()
    {
        	//die('Hi');
            
            //$data['roles'] = $this->user_model->getUserRoles();
            //$data['cubes'] = $this->faqs_model->getActiveCubes();
			//echo '<pre>';print_r($data['cubes']);die;
            //$data['cubes'] = $this->testimonials_model->getActiveProfileCat();
            
            $this->global['pageTitle'] = 'Indiatoday : Add New User';

            $this->loadViews("newTestimonials");

    }

    /**
     * This function is used to add new user to the system
     */
    function addNewTestimonials()
    {
     
            $this->load->library('form_validation');
            $this->form_validation->set_rules('profile_name','Name','trim|required');
            $this->form_validation->set_rules('youtube_url','Testimonial URL','trim|required');
            $this->form_validation->set_rules('short_description','Profile Short Description','trim|required');
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
                $video_url = $this->security->xss_clean($this->input->post('youtube_url'));
                $short_description = $this->security->xss_clean($this->input->post('short_description'));
                $meta_title = $this->security->xss_clean($this->input->post('meta_title'));
                $meta_keyword = $this->security->xss_clean($this->input->post('meta_keyword'));
                $meta_description = $this->security->xss_clean($this->input->post('meta_description'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
				$slideInfo = array();
				$slideInfo['name'] = $profile_name;
				//$slideInfo['profile_title'] = $profile_title;
                $slideInfo['video_url'] = $video_url;
                $slideInfo['published'] = $published;       
                $slideInfo['intro'] = $short_description;       
                $slideInfo['meta_title'] = $meta_title;       
                $slideInfo['meta_keywords'] = $meta_keyword;       
				$slideInfo['meta_description'] = $meta_description;				
				$slideInfo['createdby'] = $this->session->userdata('userId');
				$slideInfo['created_datetime'] = @date('Y-m-d H:i:s');
				$slideInfo['updated_datetime'] = $slideInfo['created_datetime'];
                
                if(!empty($_FILES['profile_image']['name'])){
                    $fileUpload = $this->do_upload('profile_image','testimonials/');
                    if($fileUpload['success'] == 1){
                       $uploadedFile = base_url().'assets/uploads/testimonials/'.$fileUpload['upload_data']['file_name'];
                       $slideInfo['image_path'] = $uploadedFile;   
                       
                    }
                }

                $result = $this->testimonials_model->addNewTestimonials($slideInfo);
                // print_r($slideInfo);die;
                
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Profile created successfully');
                    redirect('manageTestimonials');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Profile creation failed');
                    redirect('newTestimonials');
                }                
                
            }
        
    }


    /**
     * This function is used to delete slide
     */
    function deleteTestimonials($slideId=0)
    {
        $result = $this->testimonials_model->deleteTestimonials($slideId);
		
    		if($result > 0) 
    		{
    			$this->session->set_flashdata('success', 'Testimonial has been deleted successfully');
    		}
    		else
    		{
    			$this->session->set_flashdata('error', 'Testimonial deletion failed');
    		}                
    		redirect('manageTestimonials');
    }



}