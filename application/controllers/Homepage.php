<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Slide (UserController)
 * Slide class to control all slide related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 12 April 2018
 */
class Homepage extends BaseController
{
	/**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('homepage_model');
        $this->isLoggedIn();   
    }

   	public function index(){
   		$this->global['pageTitle'] = 'Manage HomePage';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
   	}

   	/**
     * This function is used to load the user list
     */
    function manageHPSlider()
    {
		
          
			     $data['cube_id'] = $this->input->post('cube_id');
			     /*$data['cubes'] = $this->faqs_model->getActiveFaqs();*/
           $searchText = $this->security->xss_clean($this->input->post('searchText'));
           $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->homepage_model->imageListingCount($searchText);
			
			      $returns = $this->paginationCompress ( "manageHPSlider/", $count, 10 );
            // print_r($data);die;
			
			/*if(!empty($data['cube_id'])) {
				
			}*/
            $data['slideRecords'] = $this->homepage_model->imageListing($searchText, $returns["page"], $returns["segment"], $data['cube_id']);
            
            $this->global['pageTitle'] = 'Indiatoday : Slider Listing';
            
            $this->loadViews("slider_image", $this->global, $data, NULL);
        
    }

    /**
     * This function is used load user edit information
     * @param number $slideId : Optional : This is user id
     */
    function editAccordianImage($slideId = NULL)
    {
		
        
            if($slideId == null)
            {
                redirect('manageHPSlider');
            }
            //$data['cubes'] = $this->faqs_model->getActiveCubes();
            $data['slideInfo'] = $this->homepage_model->getAccordianImageInfo($slideId)[0];
			//echo '<pre>';print_r($data['slideInfo']);die;
            $this->global['pageTitle'] = 'Indiatoday : Edit Image';
            
            $this->loadViews("editAccordianImage", $this->global, $data, NULL);

    }

    /**
     * This function is used to add new user to the system
     */
    function updateAccordianImage($slideId)
    {

       		
            $this->load->library('form_validation');
           

            
             $this->form_validation->set_rules('image_order','Order ','trim|required');
            
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->newFaqs();
            }
            else
            {
              
              $image_order = $this->security->xss_clean($this->input->post('image_order'));
              $published = $this->security->xss_clean($this->input->post('published'));
            
      				$slideInfo = array();
      				$slideInfo['image_order'] = $image_order;
              $slideInfo['published'] = $published; 
      				$slideInfo['published'] = $published;				
      				$slideInfo['updatedby'] = $this->session->userdata('userId');
      				$slideInfo['updated_datetime'] = @date('Y-m-d H:i:s');

              if(!empty($_FILES['profile_image']['name'])){
                  $fileUpload = $this->do_upload('profile_image','hp_slider/');
                  if($fileUpload['success'] == 1){
                     $uploadedFile = base_url().'assets/uploads/hp_slider/'.$fileUpload['upload_data']['file_name'];
                     $slideInfo['image_path'] = $uploadedFile;   
                  }
                }

				
				
               // print_r($slideInfo);die;
                $result = $this->homepage_model->updateAccordianImage($slideInfo, $slideId);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Image has been updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Image updation failed');
                }            				
                redirect('editAccordianImage/'.$slideId);
            }
        
    }


    /**
     * This function is used to load the add new form
     */
    function newAccordianImage()
    {
        	//die('Hi');
            
            //$data['roles'] = $this->user_model->getUserRoles();
            //$data['cubes'] = $this->faqs_model->getActiveCubes();
			//echo '<pre>';print_r($data['cubes']);die;
            
            $this->global['pageTitle'] = 'Indiatoday : Add New User';

            $this->loadViews("newAccordianImage");

    }

    /**
     * This function is used to add new user to the system
     */
    function addNewAccordianImage()
    {
        
            $this->load->library('form_validation');
            
            $this->form_validation->set_rules('image_order','Order ','trim|required');
            //$this->form_validation->set_rules('answer','Answer','trim|required');
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            if($this->form_validation->run() == FALSE)
            {
                $this->newAccordianImage();
            }
            else
            {

                $image_order = $this->security->xss_clean($this->input->post('image_order'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
        				$slideInfo = array();
        				$slideInfo['image_order'] = $image_order;
        				$slideInfo['published'] = $published;				
        				$slideInfo['createdby'] = $this->session->userdata('userId');
        				$slideInfo['created_datetime'] = @date('Y-m-d H:i:s');
        				$slideInfo['updated_datetime'] = $slideInfo['created_datetime'];

                $fileUpload = $this->do_upload('profile_image','hp_slider/');
                if($fileUpload['success'] == 1){
                   $uploadedFile = base_url().'assets/uploads/hp_slider/'.$fileUpload['upload_data']['file_name'];
                   $slideInfo['image_path'] = $uploadedFile;   
                   $result = $this->homepage_model->addNewAccordianImage($slideInfo);
                }				
				
               // print_r($slideInfo);die;
                //$result = $this->faqs_model->addNewFaqs($slideInfo);
                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'New Image created successfully');
                    redirect('manageHPSlider');
                }
                else
                {
                    $this->session->set_flashdata('error', 'New Image creation failed');
                    redirect('newAccordianImage');
                }                
                
            }
        
    }


    /**
     * This function is used to delete slide
     */
    function deleteAccordianImage($slideId=0)
    {
        $result = $this->homepage_model->deleteAccordianImage($slideId);
		
		if($result > 0) 
		{
			$this->session->set_flashdata('success', 'Slide has been deleted successfully');
		}
		else
		{
			$this->session->set_flashdata('error', 'Cube deletion failed');
		}                
		redirect('manageHPSlider');
    }


}