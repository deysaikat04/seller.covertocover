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

            <?php if ($this->session->flashdata('addSellerErr')) { ?>
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
            
        </div>

        <!--Notification Area Ends-->

        <div class="col-md-12">
            <div class="panel panel-flat border-bottom-info">
                <div class="panel-heading">
                    <h6 class="panel-title">Welcome <?php echo $user->first_name; echo "&nbsp;"; echo $user->last_name; ?>.</h6>
                    <span class="help-block">Please fill the details below to continue with  <code>Cover To Cover</code> .</span>

                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>
                <form action="<?php echo base_url(); ?>FormController/registerSeller" method="POST"
                      enctype="multipart/form-data">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <div class="panel panel-flat ">
                                <div class="panel-heading">
                                    <h6 class="panel-title">Add Basic Details</h6>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Name </label>
                                            <input type="text"
                                                   class="form-control"
                                                   name="name"
                                                   placeholder="Name of the seller"
                                                   maxlength="150"
                                                   value="<?php echo $user->first_name; echo "&nbsp;"; echo $user->last_name; ?>"
                                                   readonly="readonly"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Email</label><span
                                                    class="text-danger"> *</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="mail"
                                                   value="<?php echo $user->email; ?>"
                                                   readonly="readonly"
                                                   required>
                                        </div>
                                    </div>                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Phone</label><span
                                                    class="text-danger"> *</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="phone"
                                                   placeholder="Phone"
                                                   value="<?php echo $user->phone; ?>"
                                                   maxlength="10"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Address</label><span
                                                    class="text-danger"> *</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="address"
                                                   placeholder="Address"
                                                   maxlength="200"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">City</label><span
                                                    class="text-danger"> *</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="city"
                                                   placeholder="City"
                                                   maxlength="20"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">State</label><span
                                                    class="text-danger"> *</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="state"
                                                   placeholder="State"
                                                   maxlength="20"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Zip</label><span
                                                    class="text-danger"> *</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="zip"
                                                   placeholder="Zip"
                                                   maxlength="6"
                                                   required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Country</label><span
                                                    class="text-danger"> *</span>
                                            <input type="text"
                                                   class="form-control"
                                                   name="country"
                                                   placeholder="Country"
                                                   maxlength="20"
                                                   required>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div><!-- col md 12 -->
                        
                        <input type="hidden" name="ionid" value="<?php echo $user->id; ?>" />
			
                        <div class="col-md-12 text-center mt-20">
                            <button type="submit" class="btn btn-success btn-raised "><i
                                        class="icon-folder-upload3 position-left"></i> Continue
                            </button>
                        </div>
                    </div> <!-- Main panel body ends -->
                </form>

            </div><!--  panel panel-flat ends-->
        </div>
    </div>
</div>