<div class="content-wrapper"><!-- Content wrapper -->
    <!-- Content area -->
    <div class="content">
        <div class="row">
            <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                    <?php if($this->session->flashdata('addFromValErr')){ ?>
                        <div class="alert bg-danger alert-styled-left">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                            <span class="text-semibold"> Opps! </span><?php echo $this->session->flashdata('addFromValErr'); ?>
<!--                            Name of the Vehicle and Vehicle Description should not be empty.-->
                        </div>
                    <?php }?>
                        <?php if($this->session->flashdata('addFromSucc')){ ?>
                            <div class="alert bg-success alert-styled-left">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                                <span class="text-semibold">Well done!</span> You successfully added a vehicle in the record.
                            </div>
                        <?php } ?>
                    </div>
            </div>
            <div class="panel panel-flat border-top-lg border-top-pink-600 border-bottom-pink-600">
                <div class="panel-heading">
                    <h5 class="panel-title">Search Record</h5>
                    <div class="heading-elements">
                        <ul class="icons-list">
                            <li><a data-action="collapse"></a></li>
                            <li><a data-action="reload"></a></li>
                            <li><a data-action="close"></a></li>
                        </ul>
                    </div>
                </div>

                <table class="table datatable-basic table-bordered table-striped table-hover">
                    <thead>
                    <tr>
                        <!--<th>Cover</th>-->
                        <th>Name</th>
                        <th>Price</th>  
                        <th>Quantity</th>  
                        <th>Customer</th>                      
                        <th>TOC</th>                      
                        <th class="text-center">Actions</th> 
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($bookDetails) {
                    foreach ($bookDetails as $row) { 
                        $salt="BOOK_SELLER";
                        $encrypted_id = base64_encode($row['customerid'] . $salt);?>
                    <tr>
                       <!-- <td><img src="<?php // echo base_url().$row['path'];?>" alt="" width="50px" height="80px"></td> -->
                        <td><a href="#"><?php echo $row['bookname'];?></a></td>
                        <td><?php echo $row['price'];?></td>
                        <td><?php echo $row['qty'];?></td>
                        <td><a href="<?php echo base_url()?>Dashboard/CustomerData/<?php echo $encrypted_id;?>"><?php echo $row['customerid'];?></a></td>
                        <td><?php echo $row['toc'];?></td>

                       

                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="icon-menu9"></i>
                                    </a>

                                  <!--  <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="<?php //echo base_url()?>Dashboard/EditAlbum/<?php //echo $row['productId']; ?>"><i class="icon-database-edit2"></i> Edit</a></li>
                                        <li><a href="<?php //echo base_url()?>Dashboard/remove/<?php //echo $row['productId']; ?>"><i class="icon-trash"></i> Remove</a></li>
                                    </ul>-->
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <?php } 
                        }
                    ?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

