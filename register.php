<?php 

$title=':: Register ::';

include('header.php');

include('sidebar.php');



?>
    

	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">Modal title</h4>
						</div>
						<div class="modal-body">
							 Widget settings form goes here
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success">Save changes</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
					<i class="fa fa-gear"></i>
				</div>
				
			</div>
			<!-- END BEGIN STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			<center>THE POLYTECHNIC IBADAN</center> 
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="home.php">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					
					<li>
						<a href="#"></a>
					</li>
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
            
            
            
			<!-- BEGIN PAGE CONTENT-->
       
       
     
            
            
            <div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>Registration
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
								<a href="javascript:;" data-toggle="modal" class="config">
								</a>
								<a href="javascript:;" class="reload">
								</a>
								<a href="javascript:;" class="remove">
								</a>
							</div>
						</div>
                        <?php if(isset($_COOKIE['msg'])){?>
       <h4 class="alert alert-danger"><?php echo $_COOKIE['msg'];setcookie("msg","",time()-5,"/");?></h4> 
    <?php }?>
						<div class="portlet-body">
                <div class="row">
				<div class="col-md-6 col-md-offset-3">
					<!-- BEGIN POLYGONS PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Create New User
							</div>
							
						</div>
				<div class="portlet-body">
							
                    <form class="form-horizontal" role="form" method="POST" action="access.php">
                      
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="uname" placeholder="Username"  required autofocus><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email Address"  required><br>

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="pword" placeholder="Password" required><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="cpword" placeholder="Confirm Password" required><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" name="signup">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
             		</div>
				</div>
					<!-- END POLYGONS PORTLET-->
                    
            </div>
               
                    
                       
                </div>
			         </div>
		          </div>
					<!-- END EXAMPLE TABLE PORTLET-->
	           </div>
            </div>
            
            
            
		
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT --> 
    
</div>
    
    
<!-- END CONTAINER -->
<?php include('footer.php'); ?>