<div class="content-wrapper dashboard_wrapper"><!-- Content wrapper -->
    <!-- Content area -->
    <div class="content">
        <!-- simple statistics -->
        <div class="row">
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-body  bg-success-400 has-bg-image">
                    <div class="media no-margin">
                        <div class="media-body">
                            <h3 class="no-margin">
                            	<?php echo $countAll['allAlbum']; ?>
                           </h3>
                            <span class="text-uppercase text-size-mini">total books</span>
                        </div>

                        <div class="media-right media-middle">
                            <i class="icon-image5 icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4">
                <div class="panel panel-body bg-danger-400 has-bg-image">
                    <div class="media no-margin">
                        <div class="media-body">
                            <h3 class="no-margin"><?php echo $countAll['allImages']; ?></h3>
                            <span class="text-uppercase text-size-mini">Total images</span>
                        </div>

                        <div class="media-right media-middle">
                            <i class="icon-images3 icon-3x opacity-75"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-6 col-md-4">
                <div class="panel panel-body bg-indigo-400 has-bg-image">
                    <div class="media no-margin">
                        <div class="media-left media-middle">
                            <i class="fa fa-cart fa-4x opacity-75"></i>
                        </div>

                        <div class="media-body text-right">
                            <h3 class="no-margin"><?php echo $countAll['allVideo']; ?></h3>
                            <span class="text-uppercase text-size-mini">Orders</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /simple statistics -->
    </div><!-- Content area -->
</div><!-- Content wrapper -->