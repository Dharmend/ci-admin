<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Slide Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>newSlide"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        
		
               
                <?php  
                    $success = $this->session->flashdata('success');
                    if($success)
                    {
                ?>
				<div class="row">
					<div class="col-xs-12">
						<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo $this->session->flashdata('success'); ?>
						</div>
					</div>
				</div>
                <?php } ?>
				<?php  
                    $error = $this->session->flashdata('error');
                    if($error)
                    {
                ?>
				<div class="row">
					<div class="col-xs-12">
						<div class="alert alert-error alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							<?php echo $this->session->flashdata('error'); ?>
						</div>
					</div>
				</div>
                <?php } ?>
                
        
           
		
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Slide List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>manageSlide" method="POST" id="searchList">
                            <div class="input-group">
							   <select class="form-control input-sm pull-right" style="width: 150px;margin-left:10px;" style="text-align:right;" id="cube_id" name="cube_id" >
                                            <option value="">Select Cube</option>
                                            <?php
											
                                            if(!empty($cubes)) {
                                                foreach ($cubes as $cube) {
                                            ?>
												<option value="<?php echo $cube->cube_id ?>" <?php 
												if(!empty($cube_id) && $cube_id== $cube->cube_id) {echo "selected=selected";} ?>><?php echo $cube->cube_title ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                              <input type="text" name="searchText" value="<?php echo $searchText; ?>" class="form-control input-sm pull-right" style="width: 150px;" placeholder="Search"/>
                              <div class="input-group-btn">
                                <button class="btn btn-sm btn-default searchList"><i class="fa fa-search"></i></button>
                              </div>
                            </div>
                        </form>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>Id</th>
                      <th>Title</th>
                      <th>Heading</th>                      
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($slideRecords))
                    {
                        foreach($slideRecords as $record)
                        {
                    ?>
                    <tr>
                      <td><?php echo $record->slide_id ?></td>
                      <td><?php echo $record->slide_title ?></td>
                      <td><?php echo $record->slide_heading ?></td>
                     <td class="text-center">
                      
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'editSlide/'.$record->slide_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteSlide" href="javascript:;" data-userid="<?php echo $record->slide_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
                      </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                  </table>
                  
                </div><!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->pagination->create_links(); ?>
                </div>
              </div><!-- /.box -->
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
    jQuery(document).ready(function(){
		jQuery('.deleteSlide').on('click', function(){
			if(confirm('Are you sure, want to delete this slide?')) {
				var slideId = jQuery(this).attr('data-userid');
				if(slideId!='') {
					window.location.href= "<?php echo site_url().'deleteSlide/'?>"+slideId;
				}
			}
		});
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "manageSlide/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
