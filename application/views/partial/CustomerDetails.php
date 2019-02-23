<div class="content-wrapper dashboard_wrapper"><!-- Main content -->
    <!-- Content area -->
    <div class="content">   
    
        <div class="col-md-12">
            <!-- Album Details starts -->
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h6 class="panel-title">Customer Details</h6>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <?php if ($customerData) { ?>
                       
                            <div class="panel-body">
                                <div class="col-md-12">
                                    <div class="panel panel-flat border-bottom-info">
                                        <div class="panel-heading">
                                            <h6 class="panel-title"></h6>
                                        </div>
                                        <div class="panel-body">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Customer Name</strong></label><span
                                                            class="text-danger"> *</span>                   
                                                    <input type="text"
                                                           class="form-control"
                                                           name="bookName"
                                                           placeholder="Enter Title Here"
                                                           value="<?php echo $customerData[0]['name'] ?>"
                                                           readonly
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Mail</strong></label><span
                                                            class="text-danger"> *</span>                   
                                                    <input type="text"
                                                           class="form-control"
                                                           name="bookName"
                                                           placeholder="Enter Title Here"
                                                           value="<?php echo $customerData[0]['email'] ?>"
                                                           readonly
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Phone</strong></label><span
                                                            class="text-danger"> *</span>                   
                                                    <input type="text"
                                                           class="form-control"
                                                           name="bookName"
                                                           placeholder="Enter Title Here"
                                                           value="+91 <?php echo $customerData[0]['phone'] ?>"
                                                           readonly
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Address</strong></label><span
                                                            class="text-danger"> *</span>                   
                                                    <input type="text"
                                                           class="form-control"
                                                           name="bookName"
                                                           placeholder="Enter Title Here"
                                                           value="<?php echo $customerData[0]['address'] ?>"
                                                           readonly
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>City</strong></label><span
                                                            class="text-danger"> *</span>                   
                                                    <input type="text"
                                                           class="form-control"
                                                           name="bookName"
                                                           placeholder="Enter Title Here"
                                                           value="<?php echo $customerData[0]['city'] ?>"
                                                           readonly
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>State</strong></label><span
                                                            class="text-danger"> *</span>                   
                                                    <input type="text"
                                                           class="form-control"
                                                           name="bookName"
                                                           placeholder="Enter Title Here"
                                                           value="<?php echo $customerData[0]['state'] ?>"
                                                           readonly
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Country</strong></label><span
                                                            class="text-danger"> *</span>                   
                                                    <input type="text"
                                                           class="form-control"
                                                           name="bookName"
                                                           placeholder="Enter Title Here"
                                                           value="<?php echo $customerData[0]['country'] ?>"
                                                           readonly
                                                           required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label"><strong>Zip</strong></label><span
                                                            class="text-danger"> *</span>                   
                                                    <input type="text"
                                                           class="form-control"
                                                           name="bookName"
                                                           placeholder="Enter Title Here"
                                                           value="<?php echo $customerData[0]['zip'] ?>"
                                                           readonly
                                                           required>
                                                </div>
                                            </div>
                                            </div>
                                        </div><!-- inner panel body ends -->
                                    </div><!--  panel ends -->
                                </div><!-- col md 12 -->
                            </div> <!-- outer panel body ends --> 
                <?php } ?>
            </div>
            <!-- Album details pasrt ends -->
	
            

            
        </div>
    </div><!-- content ends -->
</div>