<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Slide (UserController)
 * Slide class to control all slide related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 12 April 2018
 */
class Faqs extends BaseController
{
	/**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('faqs_model');
        $this->isLoggedIn();   
    }

   	public function index(){
   		$this->global['pageTitle'] = 'Manage Faqs';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
   	}

   	/**
     * This function is used to load the user list
     */
    function manageFaqs()
    {
		
          
			$data['cube_id'] = $this->input->post('cube_id');
			$data['cubes'] = $this->faqs_model->getActiveFaqs();
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->faqs_model->faqsListingCount($searchText);
			
			      $returns = $this->paginationCompress ( "manageFaqs/", $count, 10 );
            // print_r($data);die;
			
			if(!empty($data['cube_id'])) {
				
			}
            $data['slideRecords'] = $this->faqs_model->faqsListing($searchText, $returns["page"], $returns["segment"], $data['cube_id']);
            
            $this->global['pageTitle'] = 'Indiatoday : Faqs Listing';
            
            $this->loadViews("faqs", $this->global, $data, NULL);
        
    }

    /**
     * This function is used load user edit information
     * @param number $slideId : Optional : This is user id
     */
    function editFaqs($slideId = NULL)
    {
		
        
            if($slideId == null)
            {
                redirect('manageFaqs');
            }
            //$data['cubes'] = $this->faqs_model->getActiveCubes();
            $data['slideInfo'] = $this->faqs_model->getFaqsInfo($slideId)[0];
			//echo '<pre>';print_r($data['slideInfo']);die;
            $this->global['pageTitle'] = 'Indiatoday : Edit Faqs';
            
            $this->loadViews("editFaqs", $this->global, $data, NULL);

    }

    /**
     * This function is used to add new user to the system
     */
    function updateFaqs($slideId)
    {

       		
            $this->load->library('form_validation');
           

            
            $this->form_validation->set_rules('question','Question','trim|required');
            $this->form_validation->set_rules('answer','Naswer','trim|required');
            
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->newFaqs();
            }
            else
            {
              
              $quetion = $this->security->xss_clean($this->input->post('question'));
              $answer = $this->security->xss_clean($this->input->post('answer'));
              $published = $this->security->xss_clean($this->input->post('published'));
            
				$slideInfo = array();
				$slideInfo['question'] = $quetion;
				$slideInfo['answer'] = $answer;
				$slideInfo['published'] = $published;				
				$slideInfo['updatedby'] = $this->session->userdata('userId');
				$slideInfo['updated_datetime'] = @date('Y-m-d H:i:s');				
				
				
               // print_r($slideInfo);die;
                $result = $this->faqs_model->updateFaqs($slideInfo, $slideId);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Slide has been updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Slide updation failed');
                }            				
                redirect('editFaqs/'.$slideId);
            }
        
    }


    /**
     * This function is used to load the add new form
     */
    function newFaqs()
    {
        	//die('Hi');
            
            //$data['roles'] = $this->user_model->getUserRoles();
            //$data['cubes'] = $this->faqs_model->getActiveCubes();
			//echo '<pre>';print_r($data['cubes']);die;
            
            $this->global['pageTitle'] = 'Indiatoday : Add New User';

            $this->loadViews("newFaqs");

    }

    /**
     * This function is used to add new user to the system
     */
    function addNewFaqs()
    {
        
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('question','Question','trim|required');
            $this->form_validation->set_rules('answer','Answer','trim|required');
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            if($this->form_validation->run() == FALSE)
            {
                $this->newFaqs();
            }
            else
            {

                $title = $this->security->xss_clean($this->input->post('question'));
                $heading = $this->security->xss_clean($this->input->post('answer'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
				$slideInfo = array();
				$slideInfo['question'] = $title;
				$slideInfo['answer'] = $heading;
				$slideInfo['published'] = $published;				
				$slideInfo['createdby'] = $this->session->userdata('userId');
				$slideInfo['created_datetime'] = @date('Y-m-d H:i:s');
				$slideInfo['updated_datetime'] = $slideInfo['created_datetime'];				
				
               // print_r($slideInfo);die;
                $result = $this->faqs_model->addNewFaqs($slideInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Slide created successfully');
                    redirect('manageFaqs');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Slide creation failed');
                    redirect('newFaqs');
                }                
                
            }
        
    }


    /**
     * This function is used to delete slide
     */
    function deleteFaqs($slideId=0)
    {
        $result = $this->faqs_model->deleteFaqs($slideId);
		
		if($result > 0) 
		{
			$this->session->set_flashdata('success', 'Slide has been deleted successfully');
		}
		else
		{
			$this->session->set_flashdata('error', 'Cube deletion failed');
		}                
		redirect('manageFaqs');
    }


}