<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Add Profile Category
        <small>Add / Edit Profile Category</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Profile Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addSlide" action="<?php echo base_url() ?>addNewProfileCat" method="post" role="form" enctype='multipart/form-data' <?php if($this->session->userdata("role")== 3){ echo 'onSubmit="return false";';} ?>>
                        <div class="box-body">
                            
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="fname">Name</label>
                                        <input type="text" class="form-control required" value="" id="profile_name" name="profile_name" maxlength="128">
                                    </div>
                                    
                                </div>
                              </div>
                               <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="fname">Meta Title</label>
                                        <input type="text" class="form-control required" value="" id="meta_title" name="meta_title">
                                    </div>
                                    
                                </div>
                              </div>
                               <div class="row">  
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Meta Keywords</label>
                                        <textarea cols="20" rows="5" class="form-control" id="meta_keyword" name="meta_keyword"></textarea>
                                    </div>
                                </div>
                               </div> 
                               <div class="row">  
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="email">Meta Description</label>
                                        <textarea cols="20" rows="5" class="form-control" id="meta_description" name="meta_description"></textarea>
                                    </div>
                                </div>
                               </div> 

                               <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Published</label>
                                        <input type="checkbox" name="published" id="published" value="1" >
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                            <div class="col-md-5">
                                    <div class="form-group">
                                       <div class="box-footer" style="margin-top: 12px;">
                                            <input type="submit" class="btn btn-primary <?php if($this->session->userdata('role') == 3){ echo ' disabled';} ?>" value="Submit" />
                                            <a class="btn btn-default" href="<?php echo base_url() ?>manageProfile">Back</a>
                                        </div>
                                    </div>
                                </div> 
                             </div>   

                            </div>

                            
                           
                            
                        </div><!-- /.box-body -->
                    
                        
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <?php
                    $this->load->helper('form');
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
                <div class="alert alert-danger alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('error'); ?>                    
                </div>
                <?php } ?>
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
                <div class="alert alert-success alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $this->session->flashdata('success'); ?>
                </div>
                <?php } ?>
                
                <div class="row">
                    <div class="col-md-12">
                        <?php echo validation_errors('<div class="alert alert-danger alert-dismissable">', ' <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>'); ?>
                    </div>
                </div>
                


            </div>
        </div>    
    </section>
    
</div>

<style>

.fa-power-off:hover{cursor:pointer;color:green;}
.fa-power-off{color:green;}
 .swiper-container {
    padding: 5px;
    width: 130px;
    height: 119px;
    box-sizing: border-box;
}

body { margin:0px; padding:0px;}
#flip3dSlider table {width:100%;}
@import url("https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800");
#flip3dSlider table { border-radius:6px;-moz-border-radius:6px; width:120px; font-family: "Open Sans", sans-serif; /*border-spacing: 0px 5px;*/ box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);}
#flip3dSlider table tr td { font-family: "Open Sans", sans-serif; font-size:10px; color:#000; text-align:center;}
#flip3dSlider .heading { margin:0px auto; font-family: "Open Sans", sans-serif; font-size:14px; color:#fff; background-color:#54b635; text-align:center; }
#flip3dSlider .title {  margin:0px auto; font-family: "Open Sans", sans-serif; font-size:12px; font-weight:400; color:#000; text-align:center;  border-bottom:4px solid #fff; border-top:4px solid #fff;}
#flip3dSlider .party1 {background-color:#ff4300; font-weight:600; color:#fff; border-bottom:4px solid #fff; border-left:4px solid #fff; border-top:4px solid #fff; }
#flip3dSlider .party2 {background-color:#00a5ff; font-weight:600; color:#fff; border-bottom:4px solid #fff; border-left:4px solid #fff; }
#flip3dSlider .party3 {background-color:#00b500; font-weight:600; color:#fff; border-bottom:4px solid #fff; border-left:4px solid #fff; }


</style>
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/swiper.min.css">
<script src="<?php echo base_url(); ?>assets/js/swiper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/manageSlides.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/addSlide.js" type="text/javascript"></script>
<link href="<?php echo base_url(); ?>assets/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
<script src="<?php echo base_url(); ?>assets/dist/js/bootstrap-colorpicker.js"></script>
<script>$( document ).ready(function() {$('#cols').trigger('change');});</script>
 <script>
      $(function () {
          $('#header_background').colorpicker().on('changeColor', function (e) {
              $(this).css('background-color',e.color.toString('rgba'));
          });
          $('#header_textcolor').colorpicker().on('changeColor', function (e) {
              $('#header_background').css('color',e.color.toString('rgba'));
          });
      });
  </script> -->
  