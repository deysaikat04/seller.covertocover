<div class="content-wrapper dashboard_wrapper"><!-- Main content -->
    <!-- Content area -->
    <div class="content">
    <div class="row pt-10">
        <div class="col-md-10 col-md-offset-1">
            <?php if ($this->session->flashdata('albumImageDeleteFailed')) { ?>
                <div class="alert alert-danger no-border">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span>
                    </button>
                    <div class="alert_wrapper">
                        <span class="text-semibold"> Opps! </span><?php echo $this->session->flashdata('albumImageDeleteFailed'); ?>
                    </div>
                    <!--                            Name of the Vehicle and Vehicle Description should not be empty.-->
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('albumImageDeleteSuccess')) { ?>
                <div class="alert alert-primary no-border">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span>
                    </button>
                    <div class="alert_wrapper">
                        <span class="text-semibold"></span> <?php echo $this->session->flashdata('albumImageDeleteSuccess'); ?>
                    </div>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('errCoverImg')) { ?>
                <div class="alert alert-danger no-border">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span>
                    </button>
                    <div class="alert_wrapper">
                        <span class="text-semibold">Opps!  </span> <?php echo $this->session->flashdata('errCoverImg'); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('SuccsInsCvImg')) { ?>
                <div class="alert alert-success no-border">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span>
                    </button>
                    <div class="alert_wrapper">
                        <span class="text-semibold">Well done!  </span> <?php echo $this->session->flashdata('SuccsInsCvImg'); ?>
                    </div>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('updateAlbumSucc')) { ?>
                <div class="alert alert-success no-border">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span>
                    </button>
                    <div class="alert_wrapper">
                        <span class="text-semibold">Well done!  </span> <?php echo $this->session->flashdata('updateAlbumSucc'); ?>
                    </div>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('updateAlbumErr')) { ?>
                <div class="alert alert-danger no-border">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span>
                    </button>
                    <div class="alert_wrapper">
                        <span class="text-semibold">Opps!  </span> <?php echo $this->session->flashdata('updateAlbumErr'); ?>
                    </div>
                </div>
            <?php } ?>



        </div>
    </div>
    
        <div class="col-md-12">
            <!-- Album Details starts -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Edit Album</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <?php if ($album) {
                    foreach ($album as $row) { ?>
                        <form action="<?php echo base_url(); ?>Dashboard/updateBookDetail/<?php echo $row['id'] ?>/<?php echo $this->session->userdata('id'); ?>" method="POST">
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="panel panel-flat border-bottom-info">
                                        <div class="panel-heading">
                                            <h6 class="panel-title">Edit Details</h6>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Book Name</label><span
                                                            class="text-danger"> *</span>                                                   
                                                    <input type="text"
                                                           class="form-control"
                                                           name="bookName"
                                                           placeholder="Enter Title Here"
                                                           value="<?php echo $row['name'] ?>"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Category</label><span class="text-danger"> *</span>
                                                    <select name="category" class="selectpicker" data-width="100%">
                                                        <?php foreach (unserialize(PCATEGORY) as $cats) {
                                                            if ($cats['id'] == $row['category']) { ?>
                                                                <option value="<?php echo $cats['id']; ?>"><?php echo $cats['name']; ?></option>
                                                            <?php }
                                                        } ?>
                                                        <option value="">Select a Category</option>
                                                        <?php foreach (unserialize(PCATEGORY) as $cats) { ?>
                                                            <option value="<?php echo $cats['id']; ?>"><?php echo $cats['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Author</label><span
                                                            class="text-danger"> *</span>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="author"
                                                           placeholder="Enter Author name Here"
                                                           value="<?php echo $row['author'] ?>"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Description</label><span
                                                            class="text-danger"> *</span>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="desc"
                                                           placeholder="Description"
                                                           value="<?php echo $row['description'] ?>"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Publisher</label><span
                                                            class="text-danger"> *</span>
                                                    <input type="text"
                                                           class="form-control"
                                                           name="publisher"
                                                           placeholder="Enter Price Here"
                                                           value="<?php echo $row['publisher'] ?>"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Price</label><span
                                                            class="text-danger"> *</span>
                                                    <input type="number"
                                                           class="form-control"
                                                           name="price"
                                                           placeholder="Enter Price Here"
                                                           value="<?php echo $row['price'] ?>"
                                                           required>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Pages</label><span
                                                            class="text-danger"> *</span>
                                                    <input type="number"
                                                           class="form-control"
                                                           name="pages"
                                                           placeholder="Enter Stock"
                                                           value="<?php echo $row['pages'] ?>"
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">No of Books</label><span
                                                            class="text-danger"> *</span>
                                                    <input type="number"
                                                           class="form-control"
                                                           name="noOfBooks"
                                                           placeholder="Enter Stock"
                                                           value="<?php echo $noOfBooks; ?>"
                                                           readonly="readonly">
                                                </div>
                                            </div>
																						<input type="hidden" name="toc" value="<?php echo $row['toc']; ?>" hidden>
																						<input type="hidden" name="sellerId" value="<?php echo $this->session->userdata('id'); ?>" hidden>
                                            <div class="col-md-12 text-right mt-20">
                                                <button type="submit" class="btn btn-success btn-raised "><i
                                                            class="icon-folder-upload3 position-left"></i> Save
                                                </button>
                                            </div>
                                        </div><!-- inner panel body ends -->
                                    </div><!--  panel ends -->
                                </div><!-- col md 12 -->
                            </div> <!-- outer panel body ends --> 
                        </form>
                    <?php } ?>
                <?php } ?>
            </div>
            <!-- Album details pasrt ends -->
	
            <!-- Album Details starts -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Update Cover</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <?php if ($album) { 
                    foreach ($album as $row) { ?>
                        <form action="<?php echo base_url(); ?>FormController/updateCover/<?php echo $row['id']; ?>" method="POST" enctype="multipart/form-data">
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="panel panel-flat border-bottom-info">
                                        <div class="panel-heading">
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <?php if ($count == 1) {
                                                    if ($coverImage) {
                                                        foreach ($coverImage as $img_row) { ?>
                                                            <div class="col-lg-3 col-md-6">
                                                                <div class="thumbnail no-padding">
                                                                    <div class="thumb">
                                                                        <img src="<?php echo base_url() . $img_row['path']; ?>"
                                                                             alt="img">
                                                                        <div class="caption-overflow">
                                                                     <span>
                                                                       <a href="<?php echo base_url() . $img_row['path']; ?>"
                                                                          class="btn btn-flat border-white text-white btn-rounded btn-icon"
                                                                          data-popup="lightbox"><i
                                                                                   class="icon-zoomin3"></i></a>
                                                                     <a href="<?php echo base_url(); ?>FormController/removeAlbumImage/<?php echo $img_row['productId']; ?>/<?php echo $img_row['id']; ?>/<?php echo $this->session->userdata('id'); ?>/<?php echo $img_row['file_name']; ?>"
                                                                        class="btn btn-flat border-white text-white btn-rounded btn-icon"><i class="icon-trash"></i></a>
                                                                    </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    <?php }
                                                } else { ?>
                                                    <div class="form-group">
                                                        <input type="hidden" name="toc" value="<?php echo $row['toc']; ?>" hidden>
                                                        <input type="file"
                                                               name="coverImage"
                                                               id="file-input-cover"
                                                               
                                                               data-show-caption="true"
                                                               data-main-class="input-group-lg"
                                                               required>
                                                        <span class="help-block">Upload images under <code>500kb</code> and of <code>.jpg</code>, <code>.png</code> formats only.</span>
                                                    </div>
                                                    <input type="hidden" name="sellerId" value="<?php echo $this->session->userdata('id'); ?>" hidden>
                                                    <div class="col-md-2 pull-right">
                                                       
                                                        <button type="submit" class="btn btn-success btn-raised "><i
                                                                    class="icon-folder-upload3 position-left"></i> Save
                                                        </button>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <!-- inner panel body ends -->
                                    </div><!--  panel ends -->
                                </div><!-- col md 12 -->
                            </div> <!-- outer panel body ends -->
                        </form>
                    <?php } ?>
                <?php } ?>
            </div>
            <!-- Album details pasrt ends -->

            <!-- Album Details starts -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Update Album Images</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="panel panel-flat border-bottom-info">
                                <div class="panel-heading">
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-12">
                                        <div class="panel-flat">
                                            <?php if ($album) {
                                                foreach ($album as $row) { ?>
                                                    <div class="panel-body">
                                                        <form action="<?php echo base_url(); ?>FormController/updateAlbumImage/<?php echo $row['id'];?>"
                                                              method="POST" enctype="multipart/form-data">
                                                            <input type="hidden"
                                                                   name="toc"
                                                                   value="<?php echo $row['toc']; ?>"
                                                                   hidden>
                                                            <div class="form-group">
                                                                <input type="file"
                                                                       multiple="multiple"
                                                                       name="portfolioImage[]"
                                                                       id="file-input-portfolio"
                                                                       class="file-input"
                                                                       data-show-caption="true"
                                                                       data-main-class="input-group-lg"
                                                                        required/>
                                                                <span class="help-block">Upload images under <code>500kb</code> and of <code>.jpg</code>, <code>.png</code> formats only.</span>
                                                            </div>
                                                            <input type="hidden" name="sellerId" value="<?php echo $this->session->userdata('id'); ?>" hidden>
                                                            <button type="submit"
                                                                    class="btn btn-danger btn-raised pull-right"><i
                                                                        class="icon-folder-upload3 position-left"></i>
                                                                Upload
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <?php if ($albumImage) {
                                            foreach ($albumImage as $img_row) { ?>
                                                <div class="col-md-4">
                                                    <div class="thumbnail no-padding">
                                                        <div class="thumb">
                                                            <img src="<?php echo base_url().$img_row['path']; ?>"
                                                                 alt="img">
                                                            <div class="caption-overflow">
                                                                <span>
                                                                     <a href="<?php echo base_url().$img_row['path'];?>" class="btn btn-flat border-white text-white btn-rounded btn-icon" data-popup="lightbox"><i class="icon-zoomin3"></i></a>
                                                                     <a href="<?php echo base_url(); ?>FormController/removeAlbumImage/<?php echo $img_row['productId']; ?>/<?php echo $img_row['id']; ?>/<?php echo $this->session->userdata('id'); ?>/<?php echo $img_row['file_name']; ?>" class="btn btn-flat border-white text-white btn-rounded btn-icon"><i class="icon-trash"></i></a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                             </div>
                        </div>
                    </div><!--  panel ends -->
            </div>
            <!-- Album details pasrt ends -->
        </div>
    </div><!-- content ends -->
</div>