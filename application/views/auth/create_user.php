<?php $this->load->view('common/auth_header'); ?>

 <!-- Page container -->
    <div class="page-container">

        <!-- Page content -->
        <div class="page-content">

            <!-- Main content -->
            <div class="content-wrapper">

                <!-- Content area -->
                <div class="content">
                    <div class="text-center">
                        <div id="infoMessage">
                            <div id="infoMessage" class="text-danger-400"><?php echo $message;?></div>
                        </div>
                    </div>
                    <!-- Simple login form -->
										<?php echo form_open("auth/create_user");?>
										<div class="panel panel-body login-form">
                            <div class="text-center">
                                <div class="login_logo_wrapper">
                                  <!--  <img src="<?php // echo base_url();?>assets/images/2d.png" class="login_logo" alt=""> -->
                                </div>
                                <h5 class="content-group">Register <small class="display-block">Enter your credentials below</small></h5>
                            </div>
                            <div class="form-group has-feedback has-feedback-left">
                                 <input type="text" name="first_name" value="" id="first_name" placeholder="First Name" class="form-control"/>
                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>
                            
                            <div class="form-group has-feedback has-feedback-left">
                                <input type="text" name="last_name" value="" id="last_name"  placeholder="Last Name" class="form-control"/>

                                <div class="form-control-feedback">
                                    <i class="icon-user text-muted"></i>
                                </div>
                            </div>            
                            
													<?php
													if($identity_column!=='email') {
															echo '<p>';
															echo lang('create_user_identity_label', 'identity');
															echo '<br />';
															echo form_error('identity');
															echo form_input($identity);
															echo '</p>';
													}
													?>
													
													<div class="form-group has-feedback has-feedback-left">
														 <input type="text" name="company" value="" id="company" placeholder="Company Name"  class="form-control"/>

															<div class="form-control-feedback">
																	<i class=" text-muted"></i>
															</div>
													</div>  
													
													<div class="form-group has-feedback has-feedback-left">
														 <input type="text" name="email" value="" id="email"  placeholder="Email" class="form-control"/>

															<div class="form-control-feedback">
																	<i class="icon-email text-muted"></i>
															</div>
													</div>

													<div class="form-group has-feedback has-feedback-left">
														 <input type="text" name="phone" value="" id="phone" placeholder="Phone"  class="form-control"/>

															<div class="form-control-feedback">
																	<i class="icon-phone2 text-muted"></i>
															</div>
													</div>
													
													<div class="form-group has-feedback has-feedback-left">
														 <input type="password" name="password" value="" id="password" placeholder="Passwrod" class="form-control"/>

															<div class="form-control-feedback">
																	<i class="icon-lock2 text-muted"></i>
															</div>
													</div>
													
													<div class="form-group has-feedback has-feedback-left">
														 <input type="password" name="password_confirm" value="" id="password_confirm" placeholder="Confirm Password" class="form-control"/>
															<div class="form-control-feedback">
																	<i class="icon-lock2 text-muted"></i>
															</div>
													</div>
													
													<div class="form-group">
                                <button type="submit" class="btn bg-pink-400 btn-block">Sent <i class="icon-circle-right2 position-right"></i></button>
                            </div>
                            
													
			

													<p><?php //echo form_submit('submit', lang('create_user_submit_btn'));?></p>
										</div>
										<?php echo form_close();?>


                    <!-- Footer -->
                    <div class="footer text-muted text-center copyright">
                        &copy; <script>document.write((new Date()).getFullYear());</script> Cover To Cover. All right reserved. <a href="#"></a>
                    </div>
                    <!-- /footer -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

<?php $this->load->view('common/auth_footer'); ?>