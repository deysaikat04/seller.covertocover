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
            <div class="panel panel-flat  border-bottom-blue-600">
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
                        <th>Category</th>  
                        <th>Author</th>
                        <th>Publisher</th>
                        <th>MRP</th>
                        <th>Discount</th>                   
                        <th>My Price</th>                   
                        <th>Ratings</th>                    
                        <th>Status</th>     
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if ($bookDetails) {
                    foreach ($bookDetails as $row) { ?>
                    <tr>
                       <!-- <td><img src="<?php // echo base_url().$row['path'];?>" alt="" width="50px" height="80px"></td> -->
                        <td><a href="#"><?php echo $row['bookname'];?></a></td>
                        <td>
                            <?php foreach (unserialize(PCATEGORY) as $cats) {
                                if ($cats['id'] == $row['category']) { ?>
                                    <option value="<?php echo $cats['id']; ?>"><?php echo $cats['name']; ?></option>
                                <?php }
                            } ?>
                        </td>
                        
                        <td><?php echo $row['authorname'];?></td>
                        <td><?php echo $row['publishername'];?></td>
                        <td><?php echo $row['mrp'];?></td>
                        <td><?php echo $row['discount'];?></td>
                        <td><?php echo $row['price'];?></td>
                        <td><?php echo $row['rating'];?></td>

                        
                        <td>

													<?php if($row['status']==1){
																	echo "<span class=\"label label-success\">Active </span>";}
																	else { echo "<span class=\"label label-default\">Inactive </span>";}
													?>
												</td>


                        <td class="text-center">
                            <ul class="icons-list">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> 
                                        <i class="icon-menu9"></i>
                                    </a>

                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li><a href="<?php echo base_url()?>Dashboard/EditBook/<?php echo $row['bookid'];?>"><i class="icon-database-edit2"></i> Edit</a></li>
                                        
                                        <!--<li><a href="<?php // echo base_url()?>Dashboard/remove/<?php // echo $row['productId']; ?>/<?php // echo $this->session->userdata('id'); ?>"><i class="icon-trash"></i> Remove</a></li> -->
                                        
                                        <li><a href="#"><i class="icon-trash"></i> Remove</a></li>
                                    </ul>
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

