<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH . '/libraries/BaseController.php';

/**
 * Class : Slide (UserController)
 * Slide class to control all slide related operations.
 * @author : Kishor Mali
 * @version : 1.1
 * @since : 12 April 2018
 */
class Programme extends BaseController
{
	private $TOTALBLOCKS;

    /**
     * This is default constructor of the class
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('programme_model');
        $this->isLoggedIn();   
    }

    private function getBlockNums(){
        return $this->TOTALBLOCKS = 7;
    }

   	public function index(){
   		$this->global['pageTitle'] = 'Manage Programme';
        
        $this->loadViews("dashboard", $this->global, NULL , NULL);
   	}

   	/**
     * This function is used to load the user list
     */
    function manageProgramme()
    {
		
          
			/*$data['cube_id'] = $this->input->post('cube_id');
			$data['cubes'] = $this->profile_model->getActiveProfile();*/
            $searchText = $this->security->xss_clean($this->input->post('searchText'));
            $data['searchText'] = $searchText;
            
            $this->load->library('pagination');
            
            $count = $this->programme_model->programmeListingCount($searchText);
			
			$returns = $this->paginationCompress ( "manageProgramme/", $count, 10 );
          // print_r($data);die;
			
			
            $data['slideRecords'] = $this->programme_model->programmeListing($searchText, $returns["page"], $returns["segment"], $data['cube_id']);
            
            
            $this->global['pageTitle'] = 'Indiatoday : Programme Listing';
            
            $this->loadViews("programme", $this->global, $data, NULL);
        
    }

    /**
     * This function is used load user edit information
     * @param number $slideId : Optional : This is user id
     */
    function editProgramme($slideId = NULL)
    {
		
        
            if($slideId == null)
            {
                redirect('manageProgramme');
            }
            $this->load->model('profile_model');
            $data['faculties'] = $this->profile_model->getActiveProfile();
            $data['cubes'] = $this->programme_model->getActiveProgrammeCat();
            $data['slideInfo'] = $this->programme_model->getProgrammeInfo($slideId);
            //$data['totalBlocks'] = $this->getBlockNums();
			//echo '<pre>';print_r($data['slideInfo']);die;
            $this->global['pageTitle'] = 'Indiatoday : Edit Programme';
            
            $this->loadViews("editProgramme", $this->global, $data, NULL);

    }

    /**
     * This function is used to add new user to the system
     */
    function updateProgramme($slideId)
    {
       		
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title','Profile Name','trim|required');
            $this->form_validation->set_rules('cat_id','Category','trim|required');
            $this->form_validation->set_rules('structure_info','Structure','trim|required');
            $this->form_validation->set_rules('meta_title','Meta Title','trim|required');
            $this->form_validation->set_rules('meta_keywords','Meta Keyword','trim|required');
            $this->form_validation->set_rules('meta_description','Meta Description','trim|required');
            
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            
            if($this->form_validation->run() == FALSE)
            {
                $this->newProgramme();
            }
            else
            {
              
                $profile_name = $this->security->xss_clean($this->input->post('title'));
                $cat_id = $this->security->xss_clean($this->input->post('cat_id'));
                $structure_info = $this->security->xss_clean($this->input->post('structure_info'));
                $faculty_ids = $this->security->xss_clean($this->input->post('faculty_id'));
                $career_opportunity = $this->security->xss_clean($this->input->post('career_opportunity'));
                $youtube_video = $this->security->xss_clean($this->input->post('youtube_video'));
                $meta_title = $this->security->xss_clean($this->input->post('meta_title'));
                $meta_keyword = $this->security->xss_clean($this->input->post('meta_keywords'));
                $meta_description = $this->security->xss_clean($this->input->post('meta_description'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
                $slideInfo = array();
                $slideInfo['title'] = $profile_name;
                $slideInfo['programme_category'] = $cat_id;
                $slideInfo['structure_info'] = $structure_info;       
                $slideInfo['career_opportunity'] = $career_opportunity;       
                $slideInfo['faculty'] = !empty($faculty_ids) ? implode(',', $faculty_ids) : '';       
                $slideInfo['youtube_video'] = $youtube_video;       
                $slideInfo['published'] = $published;       
                $slideInfo['meta_title'] = $meta_title;       
                $slideInfo['meta_keywords'] = $meta_keyword;       
                $slideInfo['meta_description'] = $meta_description;        
                $slideInfo['updatedby'] = $this->session->userdata('userId');
                $slideInfo['updated_datetime'] = @date('Y-m-d H:i:s');
                				
               // print_r($slideInfo);die;
                $result = $this->programme_model->updateProgramme($slideInfo, $slideId);

                //$this->programme_model->deleteProgrammeDetail($slideId);

                // Update or insert new blocks
                /*$blockDetails = array();
                for($i=0; $i<$this->getBlockNums(); $i++) {
                    // block variables
                    $block_title  = 'block_name_'.$i;
                    $block_order  = 'block_order_'.$i;
                    $published    = 'published_'.$i;
                    $career_block = 'career_block_'.$i;
                    $block_description  = 'block_description_'.$i;

                    $blockTitle = $this->security->xss_clean($this->input->post($block_title));
                    $blockOrder = $this->security->xss_clean($this->input->post($block_order));
                    $blockPublished = $this->security->xss_clean($this->input->post($published));
                    $careerBlock = $this->security->xss_clean($this->input->post($career_block));
                    $blockDescription = $this->security->xss_clean($this->input->post($block_description));

                    if(!empty($blockTitle)){
                        $blockDetailInfo = array();
                        $blockDetailInfo['block_name'] = $blockTitle;
                        $blockDetailInfo['block_description'] = $blockDescription;
                        $blockDetailInfo['block_order'] = $blockOrder;
                        $blockDetailInfo['published'] = $blockPublished;
                        $blockDetailInfo['is_career_block'] = $blockDescription;
                        $blockDetailInfo['programme_id'] = $slideId;

                        $blockDetails[] = $blockDetailInfo;
                    }
                

                }

                if(!empty($blockDetails)){
                    $result = $this->programme_model->insertProgrammeDetails($blockDetails);
                }*/

                
                if($result > 0)
                {
                    $this->session->set_flashdata('success', 'Programme has been updated successfully');
                }
                else
                {
                    $this->session->set_flashdata('error', 'Programme updation failed');
                }            				
                redirect('editProgramme/'.$slideId);
            }
        
    }


    /**
     * This function is used to load the add new form
     */
    function newProgramme()
    {
        	//die('Hi');
            
            //$data['roles'] = $this->user_model->getUserRoles();
            //$data['cubes'] = $this->faqs_model->getActiveCubes();
			//echo '<pre>';print_r($data['cubes']);die;
            $this->load->model('profile_model');

            $data['faculties'] = $this->profile_model->getActiveProfile();
            $data['cubes'] = $this->programme_model->getActiveProgrammeCat();
            
            $this->global['pageTitle'] = 'Indiatoday : Add New User';

            $this->loadViews("newProgramme",$this->global, $data, NULL);

    }

    /**
     * This function is used to add new user to the system
     */
    function addNewProgramme()
    {
     
            $this->load->library('form_validation');
            $this->form_validation->set_rules('title','Profile Name','trim|required');
            $this->form_validation->set_rules('cat_id','Category','trim|required');
            $this->form_validation->set_rules('structure_info','Structure','trim|required');
            $this->form_validation->set_rules('meta_title','Meta Title','trim|required');
            $this->form_validation->set_rules('meta_keywords','Meta Keyword','trim|required');
            $this->form_validation->set_rules('meta_description','Meta Description','trim|required');
            //$this->form_validation->set_rules('profile_image','Profile Image','trim|required');
           // $this->form_validation->set_rules('heading','Email','trim|required|max_length[28]');
            if($this->form_validation->run() == FALSE)
            {
                $this->newProfile();
            }
            else
            {

                $profile_name = $this->security->xss_clean($this->input->post('title'));
                $cat_id = $this->security->xss_clean($this->input->post('cat_id'));
                $structure_info = $this->security->xss_clean($this->input->post('structure_info'));
                $faculty_ids = $this->security->xss_clean($this->input->post('faculty_id'));
                $career_opportunity = $this->security->xss_clean($this->input->post('career_opportunity'));
                $youtube_video = $this->security->xss_clean($this->input->post('youtube_video'));
                $meta_title = $this->security->xss_clean($this->input->post('meta_title'));
                $meta_keyword = $this->security->xss_clean($this->input->post('meta_keywords'));
                $meta_description = $this->security->xss_clean($this->input->post('meta_description'));
                $published = $this->security->xss_clean($this->input->post('published'));
               
                
                $slideInfo = array();
                $slideInfo['title'] = $profile_name;
                $slideInfo['programme_category'] = $cat_id;
                $slideInfo['structure_info'] = $structure_info;       
                $slideInfo['career_opportunity'] = $career_opportunity;       
                $slideInfo['faculty'] = !empty($faculty_ids) ? implode(',', $faculty_ids) : '';       
                $slideInfo['youtube_video'] = $youtube_video;       
                $slideInfo['published'] = $published;       
                $slideInfo['meta_title'] = $meta_title;       
                $slideInfo['meta_keywords'] = $meta_keyword;       
                $slideInfo['meta_description'] = $meta_description;       
                $slideInfo['createdby'] = $this->session->userdata('userId');
                $slideInfo['created_datetime'] = @date('Y-m-d H:i:s');
                $slideInfo['updated_datetime'] = $slideInfo['created_datetime'];

                $result = $this->programme_model->addNewProgramme($slideInfo);

                
                if($result > 0)
                {
                    /*$insertedId = $result;

                    // Update or insert new blocks
                    $blockDetails = array();
                    for($i=0; $i<$this->getBlockNums(); $i++) {
                        // block variables
                        $block_title  = 'block_name_'.$i;
                        $block_order  = 'block_order_'.$i;
                        $published    = 'published_'.$i;
                        $career_block = 'career_block_'.$i;
                        $block_description  = 'block_description_'.$i;

                        $blockTitle = $this->security->xss_clean($this->input->post($block_title));
                        $blockOrder = $this->security->xss_clean($this->input->post($block_order));
                        $blockPublished = $this->security->xss_clean($this->input->post($published));
                        $careerBlock = $this->security->xss_clean($this->input->post($career_block));
                        $blockDescription = $this->security->xss_clean($this->input->post($block_description));

                        if(!empty($blockTitle)){
                            $blockDetailInfo = array();
                            $blockDetailInfo['block_name'] = $blockTitle;
                            $blockDetailInfo['block_description'] = $blockDescription;
                            $blockDetailInfo['block_order'] = $blockOrder;
                            $blockDetailInfo['published'] = $blockPublished;
                            $blockDetailInfo['is_career_block'] = $blockDescription;
                            $blockDetailInfo['programme_id'] = $insertedId;

                            $blockDetails[] = $blockDetailInfo;
                        }
                    

                    }

                    if(!empty($blockDetails)){
                        $result = $this->programme_model->insertProgrammeDetails($blockDetails);
                        
                    }*/

                    $this->session->set_flashdata('success', 'New Profile created successfully');
                    redirect('manageProgramme');
                    
                }
                else
                {
                    $this->session->set_flashdata('error', 'Profile creation failed');
                    redirect('newProgramme');
                }                
                
            }
        
    }


    /**
     * This function is used to delete slide
     */
    function deleteProgramme($slideId=0)
    {
           $result = $this->programme_model->deleteProgramme($slideId);
		
    		if($result > 0) 
    		{
    			$this->session->set_flashdata('success', 'Profile has been deleted successfully');
    		}
    		else
    		{
    			$this->session->set_flashdata('error', 'Profile deletion failed');
    		}                
    		redirect('manageProgramme');
        }


}