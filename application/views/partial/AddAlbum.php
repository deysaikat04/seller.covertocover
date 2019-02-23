<div class="content-wrapper"><!-- Main content -->
    <!-- Content area -->
    <div class="content">
        <!--Notification Area-->
        <div class="row pt-10">
            <?php if ($this->session->flashdata('addAlbumSucc')) { ?>
                <div class="col-md-offset-1 col-md-10">
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span>
                        </button>
                        <div class="alert_wrapper"><span
                                    class="text-semibold">Success!&nbsp;&nbsp;</span> <?php echo $this->session->flashdata('addAlbumSucc'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('addFromValErr')) { ?>
                <div class="col-md-offset-1 col-md-10">
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span>
                        </button>
                        <div class="alert_wrapper"><span
                                    class="text-semibold">Oh snap1!&nbsp;&nbsp;</span> <?php echo $this->session->flashdata('addFromValErr'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('addAlbumErr')) { ?>
                <div class="col-md-offset-1 col-md-10">
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span>
                        </button>
                        <div class="alert_wrapper"><span
                                    class="text-semibold">Oh snap!&nbsp;&nbsp;</span> <?php echo $this->session->flashdata('addAlbumErr'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('cvrImageNotFound')) { ?>
                <div class="col-md-offset-1 col-md-10">
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span>
                        </button>
                        <div class="alert_wrapper"><span
                                    class="text-semibold">Oh snap!&nbsp;&nbsp;</span> <?php echo $this->session->flashdata('cvrImageNotFound'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('errUploadCoverImg')) { ?>
                <div class="col-md-offset-1 col-md-10">
                    <div class="alert alert-warning no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span>
                        </button>
                        <div class="alert_wrapper"><span
                                    class="text-semibold">Failed!&nbsp;&nbsp;</span> <?php echo $this->session->flashdata('errUploadCoverImg'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('errInsertCoverImg')) { ?>
                <div class="col-md-offset-1 col-md-10">
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span>
                        </button>
                        <div class="alert_wrapper"><span class="text-semibold">Opps!&nbsp;&nbsp;</span>
                            <?php echo $this->session->flashdata('errInsertCoverImg'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('errAlbumImg')) { ?>
                <div class="col-md-offset-1 col-md-10">
                    <div class="alert alert-warning no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span>
                        </button>
                        <div class="alert_wrapper"><span
                                    class="text-semibold"></span> <?php echo $this->session->flashdata('errAlbumImg'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('errAlbumInsertImg')) { ?>
                <div class="col-md-offset-1 col-md-10">
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span>
                        </button>
                        <div class="alert_wrapper"><span
                                    class="text-semibold">Opps!&nbsp;&nbsp;</span> <?php echo $this->session->flashdata('errAlbumInsertImg'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            
            <?php if ($this->session->flashdata('coverResErr')) { ?>
                <div class="col-md-offset-1 col-md-10">
                    <div class="alert alert-danger no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span>
                        </button>
                        <div class="alert_wrapper"><span
                                    class="text-semibold">Opps!&nbsp;&nbsp;</span> <?php echo $this->session->flashdata('coverResErr'); ?>
                        </div>
                    </div>
                </div>
            <?php } ?>

            
        </div>

        <!--Notification Area Ends-->

        <div class="col-md-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Add Books</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <form action="<?php echo base_url(); ?>FormController/addBook" method="POST"
                      enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="panel panel-flat border-bottom-info">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Add Basic Details</h6>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
																					<label class="control-label"><strong>Title of the Book</strong></label><span
                                                    class="text-danger"> *</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="bookName"
                                                   placeholder="Name of the Book"
                                                   maxlength="150"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
																					<label><strong>Book Category</strong></label><span class="text-danger"> *</span>
                                            <select name="category" class="selectpicker" data-width="100%" required>
                                                <option value="0">Select a Category</option>
                                                <?php foreach (unserialize(PCATEGORY) as $cats) { ?>
                                                    <option value="<?php echo $cats['id']; ?>"><?php echo $cats['name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>                                                                      
                                    <div class="col-md-6">
                                        <div class="form-group">
																					<label class="control-label"><strong>Description</strong></label><span
                                                    class="text-danger"> *</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="desc"
                                                   placeholder="Description"
                                                   maxlength="150"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
																					<label class="control-label"><strong>Publisher</strong></label><span
                                                    class="text-danger"> *</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="publisher"
                                                   placeholder="Publisher"
                                                   maxlength="250"                                                   
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
																					<label class="control-label"><strong>Edition</strong></label><span
                                                    class="text-danger"> *</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="edition"
                                                   placeholder="Edition"
                                                   maxlength="250"                                                   
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
																					<label class="control-label"><strong>Pages</strong></label><span
                                                    class="text-danger"> *</span>
                                            <input type="number"
                                                   class="form-control"
                                                   name="page"
                                                   placeholder="Page"
                                                   maxlength="250"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label"><strong>MRP</strong></label><span
                                                    class="text-danger"> *</span>
                                            <input type="number"
                                                   class="form-control"
                                                   name="price"
                                                   placeholder="Book Price"
                                                   maxlength="10"
                                                   required>
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="form-group">
																					<label class="control-label"><strong>Discount</strong></label><span
                                                    class="text-danger"> *</span>
                                            <input type="number"
                                                   class="form-control"
                                                   name="discount"
                                                   placeholder="Discount"
                                                   maxlength="10"
                                                   required>
                                        </div>
                                    </div>  
                                    <div class="col-md-6">
                                        <div class="form-group">
																					<label class="control-label"><strong>How many</strong></label><span
                                                    class="text-danger"> *</span>
                                            <input type="number"
                                                   class="form-control"
                                                   name="qty"
                                                   placeholder="No of Books"
                                                   maxlength="10"                                                   
                                                   required>
                                        </div>
                                    </div>                                   
                                    
                                    
                                    <!--<table class="table">
																			<tbody class="tbd">
																				<tr>
																					<td class="no">1</td>
																					<td><input type="text" name="qnty[]" class="form-control qnty"></td>

																					<td><button type="button" class="btn btn-danger btn-raised btn-xs dltRow"><b><i class="glyphicon glyphicon-trash"></i></b></button></td>								

																				</tr>

																			</tbody>
																		</table>-->
															</div>
                              <div class="panel-body pt-40">
                               <div class="input_fields_wrap">
                               		<button type="button" class="btn btn-inverse btn-raised btn-xs legitRipple addRow" 		name="no[]n">Add <b><i class="icon-add-to-list"></i></b></button>														
                               		<div class="col-md-10">
																		<div class="form-group">
																			<label class="control-label"><strong>Author Name</strong></label><span
																						class="text-danger"> *</span>
																			<input type="text"
																					 class="form-control"
																					 name="authorName[]"
																					 placeholder="Author Name"
																					 maxlength="100"
																					 required>
																		</div>
																		<span class="help-block">To add more than one <code>Author</code> click teh <code>Add</code> button .</span>
                                   </div>
															</div>
                                </div>
                            </div>
                        </div><!-- col md 12 -->
                        <div class="col-md-12">
                            <div class="panel panel-flat border-bottom-info">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Add Cover photo.</h6>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input type="file"
                                               name="coverImage"
                                               id="file-input-cover"
                                               
                                               data-show-caption="true"
                                               data-main-class="input-group-lg"
                                               
                                               required>
                                        <span class="help-block">Upload images under <code>500kb</code> and of <code>.jpg</code>, <code>.png</code> formats only and resolution should be <code>1:1</code>.</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- col md 12 -->
                        <div class="col-md-12">
                            <div class="panel panel-flat  border-bottom-info">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Add other photos.</h6>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group">
                                        <input type="file"
                                               multiple="multiple"
                                               name="portfolioImage[]"
                                               id="file-input-portfolio"
                                               class="file-input"
                                               data-show-caption="true"
                                               data-main-class="input-group-lg"
                                               >
                                        <span class="help-block">Upload images under <code>500kb</code> and of <code>.jpg</code>, <code>.png</code> formats only.</span>
                                    </div>
                                </div>
                            </div>
                        </div><!-- col md 12 -->

                       	<input type="hidden" value="<?php echo $this->session->userdata('id'); ?>" name="sellerId" />
                       	
                        <div class="col-md-12 text-center mt-20">
                            <button type="submit" class="btn btn-success btn-raised "><i
                                        class="icon-folder-upload3 position-left"></i> Save
                            </button>
                        </div>
                    </div> <!-- Main panel body ends -->
                </form>

            </div><!--  panel panel-flat ends-->
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
	var max_fields      = 10; //maximum input boxes allowed
	var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
	var add_button      = $(".addRow"); //Add button ID
	
	var x = 1; //initlal text box count
	$(add_button).click(function(e){ //on add input button click
		e.preventDefault();
		if(x < max_fields){ //max input box allowed
			x++; //text box increment
			$(wrapper).append('<div>	<div class="col-md-4"><div class="form-group"><label class="control-label"><strong>Author Name</strong></label><spanclass="text-danger"> *</span><input type="text"class="form-control" name="authorName[]" placeholder="Author Name" maxlength="100" required> </div></div><div class="col-md-2">	<button type="button" class="btn btn-danger btn-raised btn-xs remove_field"><b><i class="glyphicon glyphicon-trash"></i></b></button></div></div>');
			//$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
		}
	});
	
	$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
		e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
	})
});
</script>