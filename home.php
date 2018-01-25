<?php 

$title=':: Home ::';

include('header.php');

include('sidebar.php');


$date=date('Y-m-d');

/////// ADMISSION REPORT OVERVIEW ///////////////////

$conn = mssql_connect("216.158.234.108\SQLEXPRESS","Report","Charles111");
          mssql_select_db("AdmissionPortal_Database",$conn);



  $sql1="SELECT  
                          
                                   
                                        sum(CAST(a.Amount-CAST(e.Commission_amount AS INT) AS INT))as sum,count(*) as countt
                                                     
                                        FROM TransactionLog a
                                        INNER JOIN StudentApplications b ON a.StudentID = b.UserID
                                        INNER JOIN ProgramsTable c ON b.ProgramID =c.ID
                                        INNER JOIN CoursesTable d ON b.FirstCourse =d.ID
                    				    INNER JOIN Type_of_Fee e ON a.FeeType =e.FeeType
                                   
                    
                                        where ResponseCode='00' AND e.Academic_year='2017' AND CAST(a.TransactionDate AS DATE) = '$date' ";


//mssql_close($conn);

/////// MISCELLANEOUS REPORT OVERVIEW ///////////////////


$conn1 = mssql_connect("216.158.234.108\SQLEXPRESS","Report","Charles111",true);
            mssql_select_db("studentDb",$conn1);

 $sql2="SELECT SUM(CAST(a.Amount AS INT)) as sum, count(*) as counts
                
                                FROM TransactionLog a
                                
                                
                                 INNER JOIN StudentFee_Mapping b ON a.TransactionNumber = b.TxRef
                                 INNER JOIN StudentData c ON b.StudentNumber =c.StudentNumber
								
                                 
                                where ResponseCode='00' AND CAST(a.TransactionDate AS DATE) = '$date' ";

//mssql_close($conn1);


/////// STUDENT FEE REPORT OVERVIEW ///////////////////


$database="Student_Portal";
 

$conn2 = mssql_connect("162.246.23.253\MSSQLSERVE_08_R2","Report","Charles111",true);
             mssql_select_db($database,$conn2);


  $sql3="SELECT 
                            SUM(CAST(Amount AS INT)) as summ,SUM(CAST(d.commission_amount AS INT)) as com, count(*) as countt


                            FROM StudentInfo a
                            INNER JOIN StudentFee_Mapping b ON a.[Form Number] = b.FormNumber
                            INNER JOIN TransactionLog c ON b.TransactionNumber =c.TransactionNumber
                            INNER JOIN Fee_Category d ON b.FeeCatID =d.ID

                            where Paid = 'Yes' AND CAST(c.TransactionDate AS DATE) = '$date' ";

//mssql_close($conn2);

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
			<center><strong>THE POLYTECHNIC IBADAN</strong></center> 
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="#">Home</a>
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
								<i class="fa fa-globe"></i>Overview
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
						<div class="portlet-body">
                <div class="row">
				<div class="col-md-4">
					<!-- BEGIN POLYGONS PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Student Fee Report
							</div>
							
						</div>
						<div class="portlet-body">
						  <center><strong><h4>TOTAL PAYMENTS TODAY</strong></h4></center>
						    
						    <h3><center>&#8358; <?php $result3 = mssql_query($sql3,$conn2);

                         while($result33 = mssql_fetch_array($result3)) { echo  number_format($result33['summ'] - $result33['com'], 2, '.', ','); } ?></center></h3>
						    
						    <br>
							
							<center><a href="student.php" class="btn btn-lg btn-success"> View Report</a></center>
						</div>
					</div>
					<!-- END POLYGONS PORTLET-->
				</div>
                <div class="col-md-4">
					<!-- BEGIN POLYGONS PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Admission Fee Report
							</div>
							
						</div>
						<div class="portlet-body">
						     <center><strong><h4>TOTAL PAYMENTS TODAY</strong></h4></center>
						    
						    <h3><center>&#8358; <?php $result1 = mssql_query($sql1,$conn);

                         while($result11 = mssql_fetch_array($result1)) { echo  number_format($result11['sum'], 2, '.', ','); } ?></center></h3>
						    
						    <br>
						    
							<center><a href="admission.php" class="btn btn-lg btn-danger"> View Report</a></center>
							
								
						</div>
					</div>
					<!-- END POLYGONS PORTLET-->
				</div>
                <div class="col-md-4">
					<!-- BEGIN POLYGONS PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-reorder"></i>Miscellaneous Fee Report
							</div>
							
						</div>
						<div class="portlet-body">
						    
						     <center><strong><h4>TOTAL PAYMENTS TODAY</strong></h4></center>
						    
						    <h3><center>&#8358; <?php $result2 = mssql_query($sql2,$conn1);

                         while($result22 = mssql_fetch_array($result2)) { echo  number_format($result22['sum'], 2, '.', ','); } ?></center></h3>
						    
						    <br>
						 
						 
                         	<center><a href="miscellaneous.php" class="btn btn-lg btn-primary">View Report </a></center>
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