<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <i class="fa fa-users"></i> Cube Management
        <small>Add, Edit, Delete</small>
      </h1>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12 text-right">
                <div class="form-group">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>newCube"><i class="fa fa-plus"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Cube List</h3>
                    <div class="box-tools">
                        <form action="<?php echo base_url() ?>manageCube" method="POST" id="searchList">
                            <div class="input-group">
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
                      <th>Preview</th>                      
                                        
                      <th>Status</th>                      
                      <th class="text-center">Actions</th>
                    </tr>
                    <?php
                    if(!empty($slideRecords))
                    {
                        foreach($slideRecords as $record)
                        {
							if(ENVIRONMENT == 'production') {
								$cubelink = 'https://akm-img-a-in.tosshub.com/sites/common/cube/cube.html?id='.md5('cube'.$record->cube_id);
							} else 
							$cubelink = site_url('cube/cube.html?id='.md5('cube'.$record->cube_id));
                    ?>
                    <tr>
                      <td><?php echo $record->cube_id ?></td>
                      <td><?php echo $record->cube_title ?></td>
					
                    <td><a href="<?php echo $cubelink?>" target="_blank">Click Here</a></td>
                    <td><?php if(!empty($record->status)) {echo 'Active';} else {echo 'Inactive';} ?></td>
	
					<td class="text-center">
                      
                          <a class="btn btn-sm btn-info" href="<?php echo base_url().'editCube/'.$record->cube_id; ?>" title="Edit"><i class="fa fa-pencil"></i></a>
                          <a class="btn btn-sm btn-danger deleteSlide" href="javascript:;" data-userid="<?php echo $record->cube_id; ?>" title="Delete"><i class="fa fa-trash"></i></a>
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
			if(confirm('Are you sure, want to delete this cube?')) {
				var cubeId = jQuery(this).attr('data-userid');
				if(cubeId!='') {
					window.location.href= "<?php echo site_url().'deleteCube/'?>"+cubeId;
				}
			}
		});
		
        jQuery('ul.pagination li a').click(function (e) {
            e.preventDefault();            
            var link = jQuery(this).get(0).href;            
            var value = link.substring(link.lastIndexOf('/') + 1);
            jQuery("#searchList").attr("action", baseURL + "manageCube/" + value);
            jQuery("#searchList").submit();
        });
    });
</script>
