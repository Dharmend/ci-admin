<?php 
error_reporting(E_ALL);
ini_set('display_errors',1);
$envMode = "production";
@$HTTP_HOST = $_SERVER['HTTP_HOST'];
if(("devcmscube.intoday.in" == $HTTP_HOST)){
	$envMode = "development";
}
if("localhost" == $HTTP_HOST){
	$envMode = "testing";
}
if("alphacmscube.intoday.in" == $HTTP_HOST){
	$envMode = "alpha";
}
define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : $envMode);


class Cron 
{
    /**
     * This is default constructor of the class
     */
    public function __construct()
    {      
    }
    
   
    
    /**
     * This function is used to load the add new form
     */
    public function generateCubeJson()
    {

       $cubes = $this->getActiveCubeSlides();
	   $json_array =array();
	   foreach($cubes as $key=>$cubes) {
		   $cube = (object)$cubes;
		   $json_array[$cube->cube_id]['cube_id'] = $cube->cube_id;
		   $json_array[$cube->cube_id]['cube_title'] = $cube->cube_title;
		   
		   $slide_array = array();
		   $slide_array['slide_id'] = $cube->slide_id;
		   $slide_array['slide_title'] = $cube->slide_title;
		   $slide_array['slide_heading'] = $cube->slide_heading;
		   $slide_array['col1'] = $cube->col1;
		   $slide_array['col2'] = $cube->col2;
		   $slide_array['col3'] = $cube->col3;
		   $slide_array['col4'] = $cube->col4;
		   $slide_array['col5'] = $cube->col5;
		   $slide_array['col6'] = $cube->col6;
		   $slide_array['col7'] = $cube->col7;
		   $slide_array['col8'] = $cube->col8;
		   $slide_array['col9'] = $cube->col9;
		   $slide_array['col10'] = $cube->col10;
		   $slide_array['col11'] = $cube->col11;
		   $slide_array['col12'] = $cube->col12;
		   $slide_array['col13'] = $cube->col13;
		   $slide_array['col14'] = $cube->col14;
		   $slide_array['col15'] = $cube->col15;
		   $slide_array['col16'] = $cube->col16;
		   
		   $json_array[$cube->cube_id]['slides'][] = $slide_array;
	   }
	   json_encode($json_array);
	   //echo '<pre>';print_r($json_array);
	   foreach($json_array as $id => $json) {
			$jsonData =  json_encode($json);
			$filename = md5('cube'.$id).'.json';
			if('testing'==ENVIRONMENT) {
				$filepath =  'C:\xampp\htdocs\newtwister\cube\data\/'.$filename;
			} else {
				//$filepath =  $_SERVER['DOCUMENT_ROOT'].'cube/data/'.$filename;
				$filepath =  '/opt/httpd/vhosts/intoday.in/subdomains/cmscube/httpdocs/cube/data/'.$filename;
			}
			//echo '<pre>';print_r($result);die;
			
			$file = fopen($filepath, 'w');
			fwrite($file, $jsonData);
			if('production'==ENVIRONMENT) {
				$result = $this->sendFileToAws($filepath);
				//echo 'Uploaded on Production <pre>';print_r($result);
			}
			echo 'Generated '.@date('Y-m-d H:i:s')."/n";
	   }	   
    }
	
	public function sendFileToAws($filename, $aws_folder_name='cube/data'){
		$url = 'http://feeds.intoday.in/s3_uploader/';

		if($this->checkFilePath($filename)){
			//$folderPath = realpath(BASE_PATH);
			//$filePath =  $folderPath.'/'.$filename;
			$filePath = $filename;
			
			$fileData = $this->read_file($filename);
			
			
			$base64File = (!empty($fileData)) ? base64_encode($fileData) : '';
			
		//	echo $fileData.'<br>'.$base64File;die;
			
			if(!empty($base64File)){
				$filesize = filesize($filePath);           
				$post = array(
					'site' => 'common',
					'is_public' => 'Y',
					'type' => 'story',
					'folder' => $aws_folder_name,
					'added_by' => '1',
					'file_name' => basename($filename),
					'size' => $filesize,
					'file' => $base64File
				);
				$res = $this->postData($url, $post);
				//echo '<pre>';print_r($res);die;
			} else {
				echo $base64File.' base64File not found';
			}
		} else {
			echo  $filename.' Not found for S3';
		}

	}

	public function postData($url, $post){
		//echo '<pre>'.$url;print_r($post);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_POST,1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		$result=curl_exec ($ch);
		if($errno = curl_errno($ch)) {
			$error_message = curl_strerror($errno);
			return "cURL error ({$errno}):\n {$error_message}";
		}
		curl_close ($ch);
		return  json_decode($result, true); 
	}

	public function read_file($filename) {

			$fp = '';
			/*$filePath = realpath(BASE_PATH);
			$file_name = $filePath . "/" . $filename;*/
			$file_name = $filename;
			if (file_exists($file_name)) {
				ob_start();
				include ("$file_name");
				$fp = ob_get_contents();
				ob_end_clean();
				ob_clean();
			} else {
				echo $filename.' read_file not exists';
			}
			return $fp;
		}


	public function checkFilePath($filename) {
	  $fileFound = false;
	 // $filePath = realpath(BASE_PATH);  
	  if(file_exists($filename)){
		$fileFound = true;    
	  }   
		return $fileFound;
	}
	
	function getActiveCubeSlides($userId=0)
    {
		if('testing'==ENVIRONMENT) {
			define('DBHOST','localhost');
			define('DBUSER','root');
			define('DBPASS','');
			define('DBNAME','newtwister');
		}
		elseif('development'==ENVIRONMENT) {
			define('DBHOST','10.5.0.189');
			define('DBUSER','itgd_newscube');
			define('DBPASS','!tgd@NewS@605');
			define('DBNAME','newtwister');
		}elseif('alpha'==ENVIRONMENT) {
			define('DBHOST','10.5.0.110');
			define('DBUSER','newscube_read');
			define('DBPASS','R0@Cube@110');
			define('DBNAME','newtwister');
		} else {
			define('DBHOST','itgd_miscdb1');
			define('DBUSER','itgd_newscube');
			define('DBPASS','!+gd@Tw!S+@1190');
			define('DBNAME','newtwister');
		}
		
		$db_handle = mysqli_connect(DBHOST, DBUSER, DBPASS);
		mysqli_select_db($db_handle,DBNAME);
		$sql = "SELECT c.cube_title, s.* FROM tbl_cube c, tbl_slides s WHERE c.cube_id=s.cube_id AND c.status=1 AND c.isDeleted=0 AND s.status=1 AND s.isDeleted=0 ORDER BY s.cube_id DESC, s.slide_id ASC";

        $result = mysqli_query($db_handle,$sql) ;
        //echo '<pre>';print_r($result);die;
		mysqli_close($db_handle);
		return $result;
    }
}
$cron = new Cron();
$cron->generateCubeJson();
?>