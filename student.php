<?php 

$title='::Student Fee Report ::';

include('header.php');

include('sidebar.php');

$database="Student_Portal";
 

$conn = mssql_connect("162.246.23.253\MSSQLSERVE_08_R2","Report","Charles111");
             mssql_select_db($database,$conn);

  

if( $conn ) {
      "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
    
}



 $sql2="SELECT DISTINCT Academic_Year from Fee_Category ";
    $results1 = mssql_query($sql2);
     

$sqla="SELECT DISTINCT bank_name from Fee_Category ";
     $resultsa1 = mssql_query($sqla);
      
$sqll="SELECT DISTINCT StudentLevel from StudentInfo ";
     $resultsl1 = mssql_query($sqll);


?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
 <script>

    function PrintDiv() {    
           var print_form = document.getElementById('print_form');
           var popupWin = window.open('', '_blank', 'width=980,height=400');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + print_form.innerHTML + '</html>');
            popupWin.document.close();
                }
                
function PrintDiv1() {    
           var print_form = document.getElementById('print_form');
           var popupWin = window.open('', '_blank', 'width=980,height=400');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + print_form.innerHTML + '</html>');
            popupWin.document.close();
                }
</script> 
   

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
			Student Fee Report <small>Report System</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="home.php">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Student Fee Report</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#"></a>
					</li>
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
            
            
            
			<!-- BEGIN PAGE CONTENT-->
       
       
     <form  action="" method="POST">
          <div class="row">
                    <div class="form-group col-md-4">
                      <label for="email">Report From</label>
                      <input type="text" class="form-control" id="from" placeholder="REPORT FROM" name="from">
                    </div>
                    <div class="form-group  col-md-4">
                      <label for="pwd">Report To</label>
                      <input type="text" class="form-control" id="to" placeholder="REPORT TO" name="to">
                    </div>
                     
        </div>
         <div class="row">
                      <div class="form-group  col-md-3">
                      <label for="pwd">Sort By Bank</label>
                      <select class="form-control" name="bank">
                            <option value="">ALL</option>
                            <?php while( $resultsa2 = mssql_fetch_assoc($resultsa1) ){ ?>
                            <option value="<?php echo  $resultsa2['bank_name']?>"><?php echo  $resultsa2['bank_name']?></option>  
                         <?php } ?>
                      </select>
                    </div>  
                      <div class="form-group  col-md-3">
                      <label for="pwd">Sort By Academic Year</label>
                      <select class="form-control" name="acad_year">
                            <option value="">ALL</option>
                            <?php while( $results2 = mssql_fetch_assoc($results1) ){ ?>
                            <option value="<?php echo  $results2['Academic_Year']?>"><?php echo  $results2['Academic_Year']?></option>  
                         <?php } ?>
                      </select>
                    </div> 
                    <div class="form-group  col-md-2">
                      <label for="pwd">Sort By Semester</label>
                      <select class="form-control" name="semester">
                            <option value="">ALL</option>
                          <option value="1st">1st Semester</option>  
                            <option value="2nd">2nd Semester</option>  
                      </select>
                    </div>
                    <div class="form-group  col-md-2">
                      <label for="pwd">Sort By Student Level</label>
                      <select class="form-control" name="level">
                           <option value="">ALL</option>
                            <?php while( $resultsl2 = mssql_fetch_assoc($resultsl1) ){ ?>
                            <option value="<?php echo  $resultsl2['StudentLevel']?>"><?php echo  $resultsl2['StudentLevel']?></option>  
                         <?php } ?>  
                      </select>
                    </div>
           
                    <div class="form-group col-md-2">
                     
                        <button type="submit" class="btn btn-primary pull-right" style="margin-top:25px;" name="generate">Submit</button>
                
                    </div>
             
            </div>
         <br>
         <br>
    </form>
            
            
        
            <div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>Student Fee Report
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
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-6">
										<div class="btn-group">
											<a class="btn btn-md btn-info hidden-print" onclick="PrintDiv();">Print <i class="fa fa-print"></i></a>
										</div>
                                       <!-- <div class="btn-group">
											<button id="cmd" class="btn btn-warning">
											Download Pdf </i>
											</button>
										</div>-->
									</div>
								
								</div>
                            </div>
                        
                        <div id="print_form">
                            <div class="row">
                                <center><strong><h3>THE POLYTECHNIC IBADAN</strong></h3></center>
                                <br>
                                <?php  
                                    if(isset($_POST['generate'])){
                                        
                                        $from=$_POST['from'];
                                        $to=$_POST['to'];
                                        $bank=$_POST['bank'];
                                        $acad_year=$_POST['acad_year'];
                                        $semester=$_POST['semester'];
                                        $level=$_POST['level'];
                                        
                     if(!empty($from) && !empty($to)){ echo '<center><strong><h4> Report From ' .$from.  '   To   '   .$to. '</strong></h4> </center><br>' ;}
                    if(!empty($bank) ){ echo '<center><strong><h4> Payments Into '.$bank.'</strong></h4> </center>' ;}         
                    if(!empty($acad_year) ){ echo '<center><strong><h4> Academic Year  '.$acad_year.'</strong></h4> </center>' ;}
                     if(!empty($level) ){ echo '<center><strong><h4> Student Level  '.$level.'</strong></h4> </center>' ;}
                    if(!empty($semester)  ){ echo '<center><strong><h4> ' .$semester.  '  Semester </strong></h4> </center>' ;}         
                            
                                        
                                    }
                                ?>
                            
                            </div>
				   
                
				    <table class="table table-striped table-bordered table-hover" >
							<thead>
							<tr>
                            <th width="20%">DEPARTMENTS</th>
							<th width="20%">TOTAL STUDENTS</th>
                            <th width="20%">ACADEMIC YEAR</th>
							<th width="20%">TOTAL AMOUNT PAID</th>
							<!--<th>TOTAL FEE</th>-->
							
                            </tr>
							</thead>
							<tbody>
                                
   <?php 
   
 
  //$dept=$_POST['department'];
  
   
  $sql0="SELECT 
               a.Department,d.Academic_Year,d.commission_amount,SUM(CAST(d.commission_amount AS INT)) as com,SUM(CAST(Amount AS INT)) as sum, count(*) as count
             
               
                FROM StudentInfo a
                INNER JOIN StudentFee_Mapping b ON a.[Form Number] = b.FormNumber
                INNER JOIN TransactionLog c ON b.TransactionNumber =c.TransactionNumber
                INNER JOIN Fee_Category d ON b.FeeCatID =d.ID
               
				
				where Paid = 'Yes' ";

   if(isset($_POST['generate'])){    //trigger button click

 
  $from=$_POST['from'];
  $to=$_POST['to'];
  $bank=$_POST['bank'];
  $acad_year=$_POST['acad_year'];
  $semester=$_POST['semester'];
  $level=$_POST['level'];
       
    if (!empty($from) && !empty($to)) {
        $sql0 .= " AND CAST(c.TransactionDate AS DATE) >= '" . $from . "' AND CAST(c.TransactionDate AS DATE) <= '" . $to . "'";
    }
     if (!empty($bank)) {
        $sql0 .= " AND d.bank_name = '$bank'";
    }
      if (!empty($acad_year)) {
        $sql0 .= " AND d.Academic_Year = '$acad_year'";
    }
      if (!empty($semester)) {
        $sql0 .= " AND d.semester = '$semester'";
    }
      if (!empty($level)) {
        $sql0 .= " AND a.StudentLevel = '$level'";
    }
}
       $sql0 .= " GROUP BY a.Department,d.Academic_Year,d.commission_amount ORDER BY Department ASC ";
   
         $result0 = mssql_query($sql0);
    
    
         while($result00 = mssql_fetch_array($result0)){
       
?>                  
                <tr >
                   <td class="hidden-xs" width="20%"><?php  echo $result00['Department']; ?></td>
                   <td class="hidden-xs" width="20%"><?php  echo number_format($result00['count']); ?></td>
                   <td class="hidden-xs" width="20%"><?php  echo $result00['Academic_Year']; ?></td>
                 
                   <td class="hidden-xs" width="20%">&#8358; <?php  echo number_format($result00['sum'] - $result00['com'], 2, '.', ','); ?></td>
                                   
                   <!--<td class="hidden-xs"></td>-->
                  
              </tr>
			<?php }
 ?>
				</tbody>
                         <tfoot>
                    
                      
                      <?php
                      
                            $sql1="SELECT 
                            SUM(CAST(Amount AS INT)) as summ,SUM(CAST(d.commission_amount AS INT)) as com, count(*) as countt


                            FROM StudentInfo a
                            INNER JOIN StudentFee_Mapping b ON a.[Form Number] = b.FormNumber
                            INNER JOIN TransactionLog c ON b.TransactionNumber =c.TransactionNumber
                            INNER JOIN Fee_Category d ON b.FeeCatID =d.ID

                            where Paid = 'Yes' ";
                            
                        if(isset($_POST['generate'])){    //trigger button click

                          $from=$_POST['from'];
                          $to=$_POST['to'];
                          $bank=$_POST['bank'];
                          $acad_year=$_POST['acad_year'];
                          $semester=$_POST['semester'];
                          $level=$_POST['level'];

                            if (!empty($from) && !empty($to)) {
                                $sql1 .= " AND CAST(c.TransactionDate AS DATE) >= '" . $from . "' AND CAST(c.TransactionDate AS DATE) <= '" . $to . "'";
                            }
                             if (!empty($bank)) {
                                $sql1 .= " AND d.bank_name = '$bank'";
                            }
                              if (!empty($acad_year)) {
                                $sql1 .= " AND d.Academic_Year = '$acad_year'";
                            }
                              if (!empty($semester)) {
                                $sql1 .= "AND d.semester = '$semester'";
                            }
                             if (!empty($level)) {
                                $sql1 .= " AND a.StudentLevel = '$level'";
                            }

                        }

                         $result1 = mssql_query($sql1);
                      
                         while($result11 = mssql_fetch_array($result1)){
                            
                            
                  
?>                  
                <tr >
                   <th class="hidden-xs">TOTAL</th>
                   <th class="hidden-xs"><?php  echo number_format($result11['countt']); ?></th>
                    <th class="hidden-xs"></th>
                   <th class="hidden-xs">&#8358; <?php  echo number_format($result11['summ'] - $result11['com'], 2, '.', ','); ?></th>
                                   
                   <!--<td class="hidden-xs"></td>-->
                  
              </tr>
			<?php }
 ?>
     
                      
                  </tfoot>        
				</table>
			
	
	<!-- ------------------------------- STUDENT DETAILS FOR DOWNLOAD ---------------------------- -->
			
			
			
<a href="" id="xx" class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> Download To Excel</a>				
			
			
<div id="print_for">	<!------------------------------ PRINT STUDENT DETAIL ----------------------->
<div style="display:none;">
				<br><br>
				<hr>
			 <center><strong><h3>STUDENT DETAILS</strong></h3></center>
				
				<hr>
				<br>
				 <table class="table table-striped table-bordered table-hover" id="projectSpreadsheet">
							<thead>
							<tr>
                                <th width="15%">S/N</th>
                                <th width="15%">SURNAME</th>
    							<th width="15%">FIRSTNAME</th>
                                <th width="10%">FORM NUMBER</th>
    						    <th width="10%">ACADEMIC YEAR</th>
    						    <th width="15%">DEPARTMNENT</th>
    							<th width="10%">AMOUNT PAID</th>
    							
                            </tr>
							</thead>
							<tbody id="tbodyid">
                                
   <?php 
   
 
  //$dept=$_POST['department'];
  
   
  $sql0="SELECT
                   a.[Form Number],a.Department,a.Surname,a.[First Name],d.Academic_Year,c.Amount,d.commission_amount
                 
                    FROM StudentInfo a
                    INNER JOIN StudentFee_Mapping b ON a.[Form Number] = b.FormNumber
                    INNER JOIN TransactionLog c ON b.TransactionNumber =c.TransactionNumber
                    INNER JOIN Fee_Category d ON b.FeeCatID =d.ID
                   
    				where Paid = 'Yes' ";
				

   if(isset($_POST['generate'])){    //trigger button click

 
  $from=$_POST['from'];
  $to=$_POST['to'];
  $bank=$_POST['bank'];
  $acad_year=$_POST['acad_year'];
  $semester=$_POST['semester'];
  $level=$_POST['level'];
       
    if (!empty($from) && !empty($to)) {
        $sql0 .= " AND CAST(c.TransactionDate AS DATE) >= '" . $from . "' AND CAST(c.TransactionDate AS DATE) <= '" . $to . "'";
    }
     if (!empty($bank)) {
        $sql0 .= " AND d.bank_name = '$bank'";
    }
      if (!empty($acad_year)) {
        $sql0 .= " AND d.Academic_Year = '$acad_year'";
    }
      if (!empty($semester)) {
        $sql0 .= " AND d.semester = '$semester'";
    }
      if (!empty($level)) {
        $sql0 .= " AND a.StudentLevel = '$level'";
    }
}
      
   
         $result0 = mssql_query($sql0);
    
    $num=1;
         while($result00 = mssql_fetch_array($result0)){
       
?>                  
              <tr>
                   <td class="hidden-xs" width="20%"><?php  echo $num++ ?></td>
                   <td class="hidden-xs" width="20%"><?php  echo $result00['Surname']; ?></td>
                   <td class="hidden-xs" width="20%"><?php  echo $result00['First Name']; ?></td>
                   <td class="hidden-xs" width="20%">'<?php  echo $result00['Form Number']; ?>'</td>
                   <td class="hidden-xs" width="20%"><?php  echo $result00['Department']; ?></td>
                   <td class="hidden-xs" width="20%"><?php  echo $result00['Academic_Year']; ?></td>
                   <td class="hidden-xs" width="20%"><?php  echo number_format($result00['Amount'] - $result00['commission_amount']); ?></td>
                 
              </tr>
			<?php }
 ?>
				</tbody>
                         <tfoot>
                    
                      
                      <?php
                      
                            $sql1="SELECT SUM(CAST(Amount AS INT)) as summ,SUM(CAST(d.commission_amount AS INT)) as com, count(*) as countt

                                FROM StudentInfo a
                                INNER JOIN StudentFee_Mapping b ON a.[Form Number] = b.FormNumber
                                INNER JOIN TransactionLog c ON b.TransactionNumber =c.TransactionNumber
                                INNER JOIN Fee_Category d ON b.FeeCatID =d.ID

                            where Paid = 'Yes' ";
                            
                        if(isset($_POST['generate'])){    //trigger button click

                          $from=$_POST['from'];
                          $to=$_POST['to'];
                          $bank=$_POST['bank'];
                          $acad_year=$_POST['acad_year'];
                          $semester=$_POST['semester'];
                          $level=$_POST['level'];

                            if (!empty($from) && !empty($to)) {
                                $sql1 .= " AND CAST(c.TransactionDate AS DATE) >= '" . $from . "' AND CAST(c.TransactionDate AS DATE) <= '" . $to . "'";
                            }
                             if (!empty($bank)) {
                                $sql1 .= " AND d.bank_name = '$bank'";
                            }
                              if (!empty($acad_year)) {
                                $sql1 .= " AND d.Academic_Year = '$acad_year'";
                            }
                              if (!empty($semester)) {
                                $sql1 .= "AND d.semester = '$semester'";
                            }
                             if (!empty($level)) {
                                $sql1 .= " AND a.StudentLevel = '$level'";
                            }

                        }

                         $result1 = mssql_query($sql1);
                      
                         while($result11 = mssql_fetch_array($result1)){
                            
                            
                  
?>                  
                <tr >
                   <th class="hidden-xs">TOTAL : <?php  echo number_format($result11['countt']); ?></th>
                   <th class="hidden-xs"></th>
                    <th class="hidden-xs"></th>
                     <th class="hidden-xs"></th>
                      <th class="hidden-xs"></th>
                      <th class="hidden-xs"></th>
                   <th class="hidden-xs"> <?php  echo number_format($result11['summ'] - $result11['com'], 2, '.', ','); ?></th>
                                   
                   <!--<td class="hidden-xs"></td>-->
                  
              </tr>
			<?php }
 ?>
     
                      
                  </tfoot>        
				</table>
	</div>		
			
</div>		
			
			
			
			
			
			
			
			
				
		
				
				
			
				
				

		<!-- ----------------------------  SECOND TABLE FOR THE FEE TYPE  ---------------------------- -->
				

				<br><br>
				<hr>
			 <center><strong><h3>FEE TYPE</strong></h3></center>
				
				<hr>
				<br>
				 <table class="table table-striped table-bordered table-hover" >
							<thead>
							<tr>
                            <th width="20%">FEE TYPE</th>
							<th width="20%">TOTAL STUDENTS</th>
                            <th width="20%">ACADEMIC YEAR</th>
							<th width="20%">TOTAL AMOUNT PAID</th>
							<!--<th>TOTAL FEE</th>-->
							
                            </tr>
							</thead>
							<tbody>
                                
   <?php 
   
 
  //$dept=$_POST['department'];
  
   
  $sql0="SELECT 
               b.Fee_Type,d.Academic_Year,d.commission_amount,SUM(CAST(d.commission_amount AS INT)) as com,SUM(CAST(Amount AS INT)) as sum, count(*) as count
             
               
                FROM StudentInfo a
                INNER JOIN StudentFee_Mapping b ON a.[Form Number] = b.FormNumber
                INNER JOIN TransactionLog c ON b.TransactionNumber =c.TransactionNumber
                INNER JOIN Fee_Category d ON b.FeeCatID =d.ID
               
				
				where Paid = 'Yes' ";

   if(isset($_POST['generate'])){    //trigger button click

 
  $from=$_POST['from'];
  $to=$_POST['to'];
  $bank=$_POST['bank'];
  $acad_year=$_POST['acad_year'];
  $semester=$_POST['semester'];
  $level=$_POST['level'];
       
    if (!empty($from) && !empty($to)) {
        $sql0 .= " AND CAST(c.TransactionDate AS DATE) >= '" . $from . "' AND CAST(c.TransactionDate AS DATE) <= '" . $to . "'";
    }
     if (!empty($bank)) {
        $sql0 .= " AND d.bank_name = '$bank'";
    }
      if (!empty($acad_year)) {
        $sql0 .= " AND d.Academic_Year = '$acad_year'";
    }
      if (!empty($semester)) {
        $sql0 .= " AND d.semester = '$semester'";
    }
      if (!empty($level)) {
        $sql0 .= " AND a.StudentLevel = '$level'";
    }
}
       $sql0 .= " GROUP BY b.Fee_Type,d.Academic_Year,d.commission_amount ORDER BY b.Fee_Type ASC ";
   
         $result0 = mssql_query($sql0);
    
    
         while($result00 = mssql_fetch_array($result0)){
       
?>                  
                <tr >
                   <td class="hidden-xs" width="20%"><?php  echo $result00['Fee_Type']; ?></td>
                   <td class="hidden-xs" width="20%"><?php  echo number_format($result00['count']); ?></td>
                   <td class="hidden-xs" width="20%"><?php  echo $result00['Academic_Year']; ?></td>
                 
                   <td class="hidden-xs" width="20%">&#8358; <?php  echo number_format($result00['sum'] - $result00['com'], 2, '.', ','); ?></td>
                                   
                   <!--<td class="hidden-xs"></td>-->
                  
              </tr>
			<?php }
 ?>
				</tbody>
                         <tfoot>
                    
                      
                      <?php
                      
                            $sql1="SELECT 
                            SUM(CAST(Amount AS INT)) as summ,SUM(CAST(d.commission_amount AS INT)) as com, count(*) as countt


                            FROM StudentInfo a
                            INNER JOIN StudentFee_Mapping b ON a.[Form Number] = b.FormNumber
                            INNER JOIN TransactionLog c ON b.TransactionNumber =c.TransactionNumber
                            INNER JOIN Fee_Category d ON b.FeeCatID =d.ID

                            where Paid = 'Yes' ";
                            
                        if(isset($_POST['generate'])){    //trigger button click

                          $from=$_POST['from'];
                          $to=$_POST['to'];
                          $bank=$_POST['bank'];
                          $acad_year=$_POST['acad_year'];
                          $semester=$_POST['semester'];
                          $level=$_POST['level'];

                            if (!empty($from) && !empty($to)) {
                                $sql1 .= " AND CAST(c.TransactionDate AS DATE) >= '" . $from . "' AND CAST(c.TransactionDate AS DATE) <= '" . $to . "'";
                            }
                             if (!empty($bank)) {
                                $sql1 .= " AND d.bank_name = '$bank'";
                            }
                              if (!empty($acad_year)) {
                                $sql1 .= " AND d.Academic_Year = '$acad_year'";
                            }
                              if (!empty($semester)) {
                                $sql1 .= "AND d.semester = '$semester'";
                            }
                             if (!empty($level)) {
                                $sql1 .= " AND a.StudentLevel = '$level'";
                            }

                        }

                         $result1 = mssql_query($sql1);
                      
                         while($result11 = mssql_fetch_array($result1)){
                            
                            
                  
?>                  
                <tr >
                   <th class="hidden-xs">TOTAL</th>
                   <th class="hidden-xs"><?php  echo number_format($result11['countt']); ?></th>
                    <th class="hidden-xs"></th>
                   <th class="hidden-xs">&#8358; <?php  echo number_format($result11['summ'] - $result11['com'], 2, '.', ','); ?></th>
                                   
                   <!--<td class="hidden-xs"></td>-->
                  
              </tr>
			<?php }
 ?>
     
                      
                  </tfoot>        
				</table>
				
				
				
				
				
				
				
		<!-- ----------------------------  THIRD  TABLE FOR THE BANK PAID INTO  ---------------------------- -->
				

				<br><br>
				<hr>
			 <center><strong><h3>BANKS</strong></h3></center>
				
				<hr>
				<br>
				 <table class="table table-striped table-bordered table-hover" >
							<thead>
							<tr>
                            <th width="20%">BANK</th>
                            <th width="20%">ACCOUNT NUMBER</th></th>
							<th width="20%">TOTAL STUDENTS</th>
                            <th width="20%">ACADEMIC YEAR</th>
							<th width="20%">TOTAL AMOUNT PAID</th>
							<!--<th>TOTAL FEE</th>-->
							
                            </tr>
							</thead>
							<tbody>
                                
   <?php 
   
 
  //$dept=$_POST['department'];
  
   
  $sql0="SELECT 
               d.bank_account_number,d.bank_name,d.Academic_Year,d.commission_amount,SUM(CAST(d.commission_amount AS INT)) as com,SUM(CAST(Amount AS INT)) as sum, count(*) as count
             
               
                FROM StudentInfo a
                INNER JOIN StudentFee_Mapping b ON a.[Form Number] = b.FormNumber
                INNER JOIN TransactionLog c ON b.TransactionNumber =c.TransactionNumber
                INNER JOIN Fee_Category d ON b.FeeCatID =d.ID
               
				
				where Paid = 'Yes' ";

   if(isset($_POST['generate'])){    //trigger button click

 
  $from=$_POST['from'];
  $to=$_POST['to'];
  $bank=$_POST['bank'];
  $acad_year=$_POST['acad_year'];
  $semester=$_POST['semester'];
  $level=$_POST['level'];
       
    if (!empty($from) && !empty($to)) {
        $sql0 .= " AND CAST(c.TransactionDate AS DATE) >= '" . $from . "' AND CAST(c.TransactionDate AS DATE) <= '" . $to . "'";
    }
     if (!empty($bank)) {
        $sql0 .= " AND d.bank_name = '$bank'";
    }
      if (!empty($acad_year)) {
        $sql0 .= " AND d.Academic_Year = '$acad_year'";
    }
      if (!empty($semester)) {
        $sql0 .= " AND d.semester = '$semester'";
    }
      if (!empty($level)) {
        $sql0 .= " AND a.StudentLevel = '$level'";
    }
}
       $sql0 .= " GROUP BY d.bank_account_number,d.bank_name,d.Academic_Year,d.commission_amount ORDER BY d.bank_name ASC ";
   
         $result0 = mssql_query($sql0);
    
    
         while($result00 = mssql_fetch_array($result0)){
       
?>                  
                <tr >
                   <td class="hidden-xs" width="20%"><?php  echo $result00['bank_name']; ?></td>
                   <td class="hidden-xs" width="20%"><?php  echo $result00['bank_account_number']; ?></td>
                   <td class="hidden-xs" width="20%"><?php  echo number_format($result00['count']); ?></td>
                   <td class="hidden-xs" width="20%"><?php  echo $result00['Academic_Year']; ?></td>
                 
                   <td class="hidden-xs" width="20%">&#8358; <?php  echo number_format($result00['sum'] - $result00['com'], 2, '.', ','); ?></td>
                                   
                   <!--<td class="hidden-xs"></td>-->
                  
              </tr>
			<?php }
 ?>
				</tbody>
                         <tfoot>
                    
                      
                      <?php
                      
                            $sql1="SELECT 
                            SUM(CAST(Amount AS INT)) as summ,SUM(CAST(d.commission_amount AS INT)) as com, count(*) as countt


                            FROM StudentInfo a
                            INNER JOIN StudentFee_Mapping b ON a.[Form Number] = b.FormNumber
                            INNER JOIN TransactionLog c ON b.TransactionNumber =c.TransactionNumber
                            INNER JOIN Fee_Category d ON b.FeeCatID =d.ID

                            where Paid = 'Yes' ";
                            
                        if(isset($_POST['generate'])){    //trigger button click

                          $from=$_POST['from'];
                          $to=$_POST['to'];
                          $bank=$_POST['bank'];
                          $acad_year=$_POST['acad_year'];
                          $semester=$_POST['semester'];
                          $level=$_POST['level'];

                            if (!empty($from) && !empty($to)) {
                                $sql1 .= " AND CAST(c.TransactionDate AS DATE) >= '" . $from . "' AND CAST(c.TransactionDate AS DATE) <= '" . $to . "'";
                            }
                             if (!empty($bank)) {
                                $sql1 .= " AND d.bank_name = '$bank'";
                            }
                              if (!empty($acad_year)) {
                                $sql1 .= " AND d.Academic_Year = '$acad_year'";
                            }
                              if (!empty($semester)) {
                                $sql1 .= "AND d.semester = '$semester'";
                            }
                             if (!empty($level)) {
                                $sql1 .= " AND a.StudentLevel = '$level'";
                            }

                        }

                         $result1 = mssql_query($sql1);
                      
                         while($result11 = mssql_fetch_array($result1)){
                            
                            
                  
?>                  
                <tr >
                   <th class="hidden-xs">TOTAL</th>
                   <th class="hidden-xs"></th>
                   <th class="hidden-xs"><?php  echo number_format($result11['countt']); ?></th>
                    <th class="hidden-xs"></th>
                   <th class="hidden-xs">&#8358; <?php  echo number_format($result11['summ'] - $result11['com'], 2, '.', ','); ?></th>
                                   
                   <!--<td class="hidden-xs"></td>-->
                  
              </tr>
			<?php }
 ?>
     
                      
                  </tfoot>        
				</table>
				
				
				
				
				
				
				
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



<script>

    $(document).ready(function () {

	function exportTableToCSV($table, filename) {
    
        var $rows = $table.find('tr:has(td),tr:has(th)'),
    
            // Temporary delimiter characters unlikely to be typed by keyboard
            // This is to avoid accidentally splitting the actual contents
            tmpColDelim = String.fromCharCode(11), // vertical tab character
            tmpRowDelim = String.fromCharCode(0), // null character
    
            // actual delimiter characters for CSV format
            colDelim = '","',
            rowDelim = '"\r\n"',
    
            // Grab text from table into CSV formatted string
            csv = '"' + $rows.map(function (i, row) {
                var $row = $(row), $cols = $row.find('td,th');
    
                return $cols.map(function (j, col) {
                    var $col = $(col), text = $col.text();
    
                    return text.replace(/"/g, '""'); // escape double quotes
    
                }).get().join(tmpColDelim);
    
            }).get().join(tmpRowDelim)
                .split(tmpRowDelim).join(rowDelim)
                .split(tmpColDelim).join(colDelim) + '"',
    
            
    
            // Data URI
            csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
            
            console.log(csv);
            
        	if (window.navigator.msSaveBlob) { // IE 10+
        		//alert('IE' + csv);
        		window.navigator.msSaveOrOpenBlob(new Blob([csv], {type: "text/plain;charset=utf-8;"}), "csvname.csv")
        	} 
        	else {
        		$(this).attr({ 'download': filename, 'href': csvData, 'target': '_blank' }); 
        	}
    }
    
    // This must be a hyperlink
    $("#xx").on('click', function (event) {
    	
        exportTableToCSV.apply(this, [$('#projectSpreadsheet'), 'StudentFeeReport.csv']);
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });

});
    
</script>



<!--<script>
$(function () {
    var doc = new jsPDF();
    var specialElementHandlers = {
        '#editor': function (element, renderer) {
            return true;
        }
    };

    $('#cmd').click(function () {
        doc.fromHTML($('#print_for').html(), 15, 15, {
            'width': 170,
                'elementHandlers': specialElementHandlers
        });
        doc.save('studentDetails.pdf');
    });
});
</script>-->
    
    
<!-- END CONTAINER -->
<?php include('footer.php'); ?>