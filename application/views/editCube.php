<?php
$userId = '';
$name = '';
$email = '';
$mobile = '';
$roleId = '';
$siteId = '';
//echo '<pre>';print_r($slideInfo);die;
if(!empty($slideInfo))
{
    
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Edit Cube
        <small>Add / Edit Cube</small>
      </h1>
    </section>
    <section class="content">    
        <div class="row">
            <!-- left column -->
            <div class="col-md-8">
              <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Enter Cube Details</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <?php $this->load->helper("form"); ?>
                    <form role="form" id="addCube" action="<?php echo base_url() ?>updateCube/<?php echo $slideInfo->cube_id?>" method="post" role="form">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">                                
                                    <div class="form-group">
                                        <label for="cube_title">Title</label>
                                        <input type="text" class="form-control required"value="<?php 
										if(!empty($slideInfo->cube_title)) {
											echo $slideInfo->cube_title;
										} else {
											echo set_value('cube_title');
										} ?>" id="cube_title" name="cube_title" maxlength="128">
                                    </div>
                                    
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea  class="form-control required editor" id="description" name="description" ><?php 
										if(!empty($slideInfo->description)) {
											echo $slideInfo->description;
										} else {
											echo set_value('description');
										} ?></textarea>
                                    </div>
                                </div>
								<div class="col-md-12">
                                    <div class="form-group">
                                       <div class="box-footer" style="margin-top: 12px;">
											<input type="submit" class="btn btn-primary" value="Submit" />
											
										</div>
                                    </div>
                                </div> 
                            </div><!-- /.box-body -->
                    </form>
                </div>
            </div>
            <div class="col-md-12">
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
<script src="<?php echo base_url(); ?>assets/js/addCube.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
window.onload = function(e) {
   CKEDITOR.replace('description');
};
</script>