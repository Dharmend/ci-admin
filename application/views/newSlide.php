<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> New Slide
        <small>Add / Edit Side</small>
      </h1>
    </section>
    
    <section class="content">
    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Slide Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addSlide" action="<?php echo base_url() ?>addNewSlide" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-4">                                
                                    <div class="form-group">
                                        <label for="fname">Title</label>
                                        <input type="text" class="form-control required" value="<?php echo set_value('title'); ?>" id="title" name="title" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Heading</label>
                                        <input type="text" class="form-control" id="heading" value="<?php echo set_value('heading'); ?>" name="heading" maxlength="128">
                                    </div>
                                </div>
								<div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">Cube Name</label>
                                        <select class="form-control required" id="cube_id" name="cube_id" required>
                                            <option value="">Select Cube</option>
                                            <?php
											
                                            if(!empty($cubes)) {
                                                foreach ($cubes as $cube) {
                                            ?>
												<option value="<?php echo $cube->cube_id ?>" <?php if($cube->cube_id == set_value('cube_id')) {echo "selected=selected";} ?>><?php echo $cube->cube_title ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="mobile">No of Rows</label>
                                       <select class="form-control required" id="rows" name="rows">
                                            <option value="">Select Row</option>
                                            <?php
                                            if(!empty($rows))
                                            {
                                                foreach ($rows as $row)
                                                {
                                                    ?>
                                                    <option value="<?php echo $row ?>" <?php if($row == set_value('rows')) {echo "selected=selected";} ?>><?php echo $row ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>   
								<div class="col-md-3">
                                    <div class="form-group">
                                        <label for="mobile">No of Columns</label>
                                       <select class="form-control required" id="cols" name="cols">
                                            <option value="">Select Col</option>
                                            <?php
                                            if(!empty($cols))
                                            {
                                                foreach ($cols as $col)
                                                {
                                                    ?>
                                                    <option value="<?php echo $col ?>" <?php if($col == set_value('cols')) {echo "selected=selected";} ?>><?php echo $col ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>  
								<div class="col-md-5">
                                    <div class="form-group">
                                       <div class="box-footer" style="margin-top: 12px;">
											<input type="submit" class="btn btn-primary" value="Submit" />
											<input type="button" class="btn btn-default" value="Generate Preview" onclick="validatePreview()"/>
										</div>
                                    </div>
                                </div> 
								
                            </div>
							 <div class="row">
                                
                                <div class="col-md-8" style="display:none;background:#d2d6de;padding-bottom:20px;" id="grid" >
									<div class="row">
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-1" id="col-1" class="form-control grid-input-text required"><i class="fa fa-spin" aria-hidden="true"></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-2" id="col-2" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="2" ></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-3" id="col-3" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="3" ></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-4" id="col-4" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="4" ></i></div>
									 </div>
									 <div class="row">
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-5" id="col-5" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="5" ></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-6" id="col-6" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="6" ></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-7" id="col-7" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="7" ></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-8" id="col-8" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="8" ></i></div>
									 </div>
									 <div class="row">
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-9" id="col-9" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="9" ></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-10" id="col-10" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="10" ></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-11" id="col-11" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="11" ></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-12" id="col-12" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="12" ></i></div>
									 </div>
									 <div class="row">
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-13" id="col-13" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="13" ></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-14" id="col-14" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="14" ></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-15" id="col-15" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="15" ></i></div>
										<div class="col-md-3"><label>&nbsp;</label><input type="text" name="col-16" id="col-16" class="form-control grid-input-text required"><i class="fa fa-power-off" rel="16" ></i></div>
									 </div>
								</div>
                                <div class="col-md-4">
									<div class="swiper-container" id="flip3dSlider">
									<ul class="swiper-wrapper">
									</ul>
								</div
								</div>
							 </div>
                        </div><!-- /.box-body -->
					
                        
                    </form>
                </div>
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
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/swiper.min.css">
<script src="<?php echo base_url(); ?>assets/js/swiper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/manageSlides.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/addSlide.js" type="text/javascript"></script>