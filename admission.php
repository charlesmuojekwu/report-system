<?php 

$title=':: Admission Fee Report ::';

include('header.php');

include('sidebar.php');



  $conn = mssql_connect("216.158.234.108\SQLEXPRESS","Report","Charles111");
          mssql_select_db("AdmissionPortal_Database");

if( $conn ){
      "Connection established.<br />";
}else{
     echo "Connection could not be established.<br />";
    
}

$sql3="SELECT DISTINCT FeeType from Type_of_Fee where Academic_year='2017' ";
    $result33 = mssql_query($sql3);
    

?>

<script>

    function PrintDiv() {    
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
			Admission Fee Report <small>Report System</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="home.php">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Admission Fee Report</a>
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
			<form  action="" method="POST">
                    <div class="form-group col-md-3">
                      <label for="email">Report From</label>
                      <input type="text" class="form-control" id="from" placeholder="REPORT FROM" name="from">
                    </div>
                    <div class="form-group  col-md-3">
                      <label for="pwd">Report To</label>
                      <input type="text" class="form-control" id="to" placeholder="REPORT TO" name="to">
                    </div>
                    <div class="form-group  col-md-3">
                      <label for="pwd">Sort By Fee Type</label>
                       <select class="form-control" name="feetype">
                            <option value="">ALL</option>
                            <?php  while($results3 = mssql_fetch_assoc($result33)){ ?>
                            <option value="<?php echo $results3['FeeType']?>"><?php echo $results3['FeeType']?></option>  
                         <?php } ?>
                      </select>
                    </div>
                <div class="form-group col-md-3">
                    <button type="submit" class="btn btn-primary" style="margin-top:25px;" name="generate">Submit</button>
                </div>
                </form>
			
		</div>
            
            
            
            
           
            
            <div class="row">
             
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-globe"></i>Admission Fee Report
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
                                        <!--<div class="btn-group">
											<button  id="cmm" class="btn btn-warning">
											     Download Pdf </i>
											</button>
										</div>-->
									</div>
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
                                        $feetype=$_POST['feetype'];
                                        
                                        if(!empty($from) && !empty($to)){ echo '<center><strong><h4> Report From '.$from. ' To ' .$to. '</strong></h4> </center>' ;}
                                        if(!empty($feetype)){ echo '<center><strong><h4>  '.$feetype. '</strong></h4> </center>' ;}
                                     
                                    }
                                ?>
                            
                            </div>
							
				            <table class="table table-striped table-bordered table-hover" >
							<thead>
							<tr>
                                <th width="20%">FEE TYPE</th>
				                 <th width="25%">NUMBER OF STUDENTS</th>
							     <!--<th width="20%">BANK NAME</th>-->
							     <th width="20%">TOTAL AMOUNT</th>
							     
							     <!--<th>ProgramName</th>
							     <th>CourseDescription</th>-->
							</tr>
							</thead>
							<tbody>
							<?php 
  
       
 
   $sql0="SELECT  
                          
                                   
                    e.FeeType,sum(CAST(a.Amount-CAST(e.Commission_amount AS INT) AS INT))as sum,count(*) as countt
                                 
                    FROM TransactionLog a
                    INNER JOIN StudentApplications b ON a.StudentID = b.UserID
                    INNER JOIN ProgramsTable c ON b.ProgramID =c.ID
                    INNER JOIN CoursesTable d ON b.FirstCourse =d.ID
				    INNER JOIN Type_of_Fee e ON a.FeeType =e.FeeType
               

                    where ResponseCode='00' AND e.Academic_year='2017' ";

  
    
if(isset($_POST['generate'])){    //trigger button click

 
              $from=$_POST['from'];
              $to=$_POST['to'];
              $feetype=$_POST['feetype'];
                
             
                if (!empty($feetype)) {
                    $sql0 .= " AND e.FeeType = '$feetype'";
                }
                 if (!empty($from) && !empty($to)) {
                    $sql0 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
                }
            }
               
            	
                //order the list 
                $sql0 .= "GROUP BY e.FeeType ORDER BY e.FeeType ASC"; 
                   
                $result0 = mssql_query($sql0);
            
                  while($result00 = mssql_fetch_array($result0)){
            	   
                   
                /// for mysqli //
            	/*$result0=$conn -> query($sql0);
                if (mysqli_num_rows($result0) > 0) {
                while ($row0=$result0 ->fetch_assoc())
                {*/
                
?>
                <tr>
                   <td class="hidden-xs" width="25%"><?php  echo $result00['FeeType']; ?></td>
                   <td class="hidden-xs" width="30%"><?php echo number_format($result00['countt']); ?></td>
                   <!--<td class="hidden-xs" width="25%"><?php  echo $result00['Bank_name']; ?></td>-->
                   <td class="hidden-xs"  width="25%">&#8358; <?php  echo number_format($result00['sum'], 2, '.', ','); ?></td>
                   
               
              </tr>
			<?php	}  ?>
				</tbody>
                        
            <tfoot>
                    
                      
            <?php
                      
                    $sql1="SELECT  
                          
                                   
                    sum(CAST(a.Amount-CAST(e.Commission_amount AS INT) AS INT))as sum,count(*) as countt
                                 
                    FROM TransactionLog a
                    INNER JOIN StudentApplications b ON a.StudentID = b.UserID
                    INNER JOIN ProgramsTable c ON b.ProgramID =c.ID
                    INNER JOIN CoursesTable d ON b.FirstCourse =d.ID
				    INNER JOIN Type_of_Fee e ON a.FeeType =e.FeeType
               

                    where ResponseCode='00' AND e.Academic_year='2017' ";



                        if(isset($_POST['generate'])){    //trigger button click


                      $from=$_POST['from'];
                      $to=$_POST['to'];
                      $feetype=$_POST['feetype'];


                        if (!empty($feetype)) {
                            $sql1 .= " AND e.FeeType = '$feetype'";
                        }
                         if (!empty($from) && !empty($to)) {
                            $sql1 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
                        }
                    }


                        //order the list 
                       
                        // for pdo //
                         $result1 = mssql_query($sql1);

                         while($result11 = mssql_fetch_array($result1)) {


                    ?>
                                   <tr>
                                       <th class="hidden-xs">TOTAL</th>
                                       <th class="hidden-xs"> <?php echo number_format($result11['countt']);  ?></th>
                                       <th class="hidden-xs" >&#8358; <?php  echo number_format($result11['sum'], 2, '.', ','); ?></th>
                                  </tr>
                                  
			<?php } ?>
     
                      
                  </tfoot>        
                            
				</table>
		
			
			
			
		<!--<a href="" id="xx"  class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span>Download To Excel</a>-->	
			
			
<!----------------------------------------------- STUDENT DETAILS TABLE ---------------------------------------------->


<div style="display:none;">
				<br><br>
				<hr>
			 <center><strong><h3>STUDENT DETAILS</strong></h3></center>
				
				<hr>
				<br>
			
			
			
			 <table class="table table-striped table-bordered table-hover" id="projectSpreadsheet" >
							<thead>
							<tr>
                                <th>S/N</th> 
                                <th>SURNAME</th>
    							<th>FIRSTNAME</th>
                                <th>STUDENT NUMBER</th>
    						    <th>FEE TYPE</th>
    						    <th>PROGRAM</th>
    							<th>AMOUNT PAID</th>
							</tr>
							</thead>
							<tbody id="tbodyid">
							<?php 
  
       
 
   $sql0="SELECT TOP 5 
                          
                                   
                    sum(CAST(a.Amount-CAST(e.Commission_amount AS INT) AS INT))as sum,count(*) as countt
                                 
                    FROM TransactionLog a
                    INNER JOIN StudentApplications b ON a.StudentID = b.UserID
                    INNER JOIN ProgramsTable c ON b.ProgramID =c.ID
                    INNER JOIN CoursesTable d ON b.FirstCourse =d.ID
				    INNER JOIN Type_of_Fee e ON a.FeeType =e.FeeType
               

                    where ResponseCode='00' AND e.Academic_year='2017' ";

  
    
if(isset($_POST['generate'])){    //trigger button click

 
              $from=$_POST['from'];
              $to=$_POST['to'];
              $feetype=$_POST['feetype'];
                
             
                if (!empty($feetype)) {
                    $sql0 .= " AND e.FeeType = '$feetype'";
                }
                 if (!empty($from) && !empty($to)) {
                    $sql0 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
                }
            }
               
            	
                //order the list 
             
                   
                $result0 = mssql_query($sql0);
            $num=1;
                  while($result00 = mssql_fetch_array($result0)){
            	   
?>
                <tr >
                     <td class="hidden-xs"><?php  echo $num++; ?></td>
                     <td class="hidden-xs" ><?php echo $result00['Surname']; ?></td>
                     <td class="hidden-xs" ><?php  echo $result00['Firstname']; ?></td>
                     <td class="hidden-xs" ><?php  echo $result00['RegNo']; ?></td>
                     <td class="hidden-xs" ><?php  echo $result00['FeeType']; ?></td>
                      <td class="hidden-xs"><?php  echo $result00['Program_Admitted']; ?></td>
                    <td class="hidden-xs"><?php  echo number_format($result00['Amount']-$result00['Commission_amount'], 2, '.', ','); ?></td>
                   
               
              </tr>
			<?php	
          }
         ?>
				</tbody>
                        
            <tfoot>
                    
                      
                      <?php
                      
                            $sql1="SELECT  
                          
                                   
                                        sum(CAST(a.Amount-CAST(e.Commission_amount AS INT) AS INT))as sum,count(*) as countt
                                                     
                                        FROM TransactionLog a
                                        INNER JOIN StudentApplications b ON a.StudentID = b.UserID
                                        INNER JOIN ProgramsTable c ON b.ProgramID =c.ID
                                        INNER JOIN CoursesTable d ON b.FirstCourse =d.ID
                    				    INNER JOIN Type_of_Fee e ON a.FeeType =e.FeeType
                                   
                    
                                        where ResponseCode='00' AND e.Academic_year='2017' ";



                        if(isset($_POST['generate'])){    //trigger button click


                      $from=$_POST['from'];
                      $to=$_POST['to'];
                      $feetype=$_POST['feetype'];


                        if (!empty($feetype)) {
                            $sql1 .= " AND e.FeeType = '$feetype'";
                        }
                         if (!empty($from) && !empty($to)) {
                            $sql1 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
                        }
                    }


                        //order the list 
                       
                        // for pdo //
                         $result1 = mssql_query($sql1);

                         while($result11 = mssql_fetch_array($result1)) {


                    ?>
                                    <tr>
                                       <th class="hidden-xs">TOTAL : <?php echo number_format($result11['countt']); ?></th>
                                       <th class="hidden-xs"></th>
                                       <th class="hidden-xs"></th>
                                        <th class="hidden-xs"></th>
                                         <th class="hidden-xs"></th>
                                       <th class="hidden-xs"> </th>
                                        <th class="hidden-xs" > <?php  echo number_format($result11['sum'], 2, '.', ','); ?></th>
                                  </tr>
                                  
			<?php }
 ?>
     
                      
                  </tfoot>        
                            
				</table>
			
</div>			
			
			
			
				
				
				
				
			
			
			
			
<!--- -------------------------------------------- PROGRAMS TABLE -------------------------------------------->
			
				<br><br>
				<hr>
			 <center><strong><h3>PROGRAMS</strong></h3></center>
				
				<hr>
				<br>
			
			
			
			 <table class="table table-striped table-bordered table-hover" >
							<thead>
							<tr>
                                <th width="20%">PROGRAMS</th>
                                <!--<th width="20%">ACCOUNT NUMBER</th>-->
				                 <th width="25%">NUMBER OF STUDENTS</th>
							     <th width="20%">TOTAL AMOUNT</th>
							     
							     <!--<th>ProgramName</th>
							     <th>CourseDescription</th>-->
							</tr>
							</thead>
							<tbody>
							<?php 
  
       
 
   $sql0="SELECT  
                          
                                   
                    c.ProgramName,sum(CAST(a.Amount-CAST(e.Commission_amount AS INT) AS INT))as sum,count(*) as countt
                                 
                    FROM TransactionLog a
                    INNER JOIN StudentApplications b ON a.StudentID = b.UserID
                    INNER JOIN ProgramsTable c ON b.ProgramID =c.ID
                    INNER JOIN CoursesTable d ON b.FirstCourse =d.ID
				    INNER JOIN Type_of_Fee e ON a.FeeType =e.FeeType
               

                    where ResponseCode='00' AND e.Academic_year='2017' ";

  
    
if(isset($_POST['generate'])){    //trigger button click

 
              $from=$_POST['from'];
              $to=$_POST['to'];
              $feetype=$_POST['feetype'];
                
             
                if (!empty($feetype)) {
                    $sql0 .= " AND a.FeeType = '$feetype'";
                }
                 if (!empty($from) && !empty($to)) {
                    $sql0 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
                }
            }
               
            	
                //order the list 
                $sql0 .= "GROUP BY c.ProgramName ORDER BY c.ProgramName ASC"; 
                   
                $result0 = mssql_query($sql0);
            
                  while($result00 = mssql_fetch_array($result0)){
            	   
                   
                /// for mysqli //
            	/*$result0=$conn -> query($sql0);
                if (mysqli_num_rows($result0) > 0) {
                while ($row0=$result0 ->fetch_assoc())
                {*/
                
?>
              <tr>
                 <td class="hidden-xs" width="25%"><?php  echo $result00['ProgramName']; ?></td>
                     
                    <td class="hidden-xs" width="30%"><?php echo number_format($result00['countt']); ?></td>
                  
                     <td class="hidden-xs"  width="25%">&#8358; <?php  echo number_format($result00['sum'], 2, '.', ','); ?></td>
                   
               
              </tr>
			<?php	
          }
         ?>
				</tbody>
                        
            <tfoot>
                    
                      
                      <?php
                      
                            $sql1="SELECT  
                          
                                   
                                            sum(CAST(a.Amount-CAST(e.Commission_amount AS INT) AS INT))as sum,count(*) as countt
                                                         
                                            FROM TransactionLog a
                                            INNER JOIN StudentApplications b ON a.StudentID = b.UserID
                                            INNER JOIN ProgramsTable c ON b.ProgramID =c.ID
                                            INNER JOIN CoursesTable d ON b.FirstCourse =d.ID
                        				    INNER JOIN Type_of_Fee e ON a.FeeType =e.FeeType
                                       
                        
                                            where ResponseCode='00' AND e.Academic_year='2017' ";



                        if(isset($_POST['generate'])){    //trigger button click


                      $from=$_POST['from'];
                      $to=$_POST['to'];
                      $feetype=$_POST['feetype'];


                        if (!empty($feetype)) {
                            $sql1 .= " AND e.FeeType = '$feetype'";
                        }
                         if (!empty($from) && !empty($to)) {
                            $sql1 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
                        }
                    }


                        //order the list 
                       
                        // for pdo //
                         $result1 = mssql_query($sql1);

                         while($result11 = mssql_fetch_array($result1)) {


                    ?>
                                    <tr>
                                       <th class="hidden-xs">TOTAL</th>
                                       <th class="hidden-xs"> <?php echo number_format($result11['countt']);  ?></th>
                                       <th class="hidden-xs" >&#8358; <?php  echo number_format($result11['sum'], 2, '.', ','); ?></th>
                                  </tr>
                                  
			<?php }
 ?>
     
                      
                  </tfoot>        
                            
				</table>
			
			
				
				
				
				
				
				
				
				
				
				
				
	
				
	<!---=----------------------------------------------- TABLE FOR BANK NAME ---------------------------------------------------------------->
			
				<br><br>
				<hr>
			 <center><strong><h3>BANKS</strong></h3></center>
				
				<hr>
				<br>
			
			
			
			 <table class="table table-striped table-bordered table-hover" >
							<thead>
							<tr>
                                <th width="20%">BANK</th>
                                <th width="20%">ACCOUNT NUMBER</th>
				                 <th width="25%">NUMBER OF STUDENTS</th>
							     <th width="20%">TOTAL AMOUNT</th>
							    
							</tr>
							</thead>
							<tbody>
							<?php 
  
       
 
   $sql0="SELECT  
                          
                                   
                    e.Bank_account_number,e.Bank_name,sum(CAST(a.Amount-CAST(e.Commission_amount AS INT) AS INT))as sum,count(*) as countt
                                 
                    FROM TransactionLog a
                    INNER JOIN StudentApplications b ON a.StudentID = b.UserID
                    INNER JOIN ProgramsTable c ON b.ProgramID =c.ID
                    INNER JOIN CoursesTable d ON b.FirstCourse =d.ID
				    INNER JOIN Type_of_Fee e ON a.FeeType =e.FeeType
               

                    where ResponseCode='00' AND e.Academic_year='2017' ";

  
    
if(isset($_POST['generate'])){    //trigger button click

 
              $from=$_POST['from'];
              $to=$_POST['to'];
              $feetype=$_POST['feetype'];
                
             
                if (!empty($feetype)) {
                    $sql0 .= " AND a.FeeType = '$feetype'";
                }
                 if (!empty($from) && !empty($to)) {
                    $sql0 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
                }
            }
               
            	
                //order the list 
                $sql0 .= "GROUP BY e.Bank_account_number, e.Bank_name ORDER BY  e.Bank_name ASC"; 
                   
                $result0 = mssql_query($sql0);
            
                  while($result00 = mssql_fetch_array($result0)){
            	   
                   
                /// for mysqli //
            	/*$result0=$conn -> query($sql0);
                if (mysqli_num_rows($result0) > 0) {
                while ($row0=$result0 ->fetch_assoc())
                {*/
                
?>
                <tr >
                     <td class="hidden-xs" width="25%"><?php  echo $result00['Bank_name']; ?></td>
                      <td class="hidden-xs" width="25%"><?php  echo $result00['Bank_account_number']; ?></td>
                   <td class="hidden-xs" width="30%"><?php echo number_format($result00['countt']); ?></td>
                  
                    <td class="hidden-xs"  width="25%">&#8358; <?php  echo number_format($result00['sum'], 2, '.', ','); ?></td>
                   
               
              </tr>
			<?php	
          }
         ?>
				</tbody>
                        
            <tfoot>
                    
                      
                      <?php
                      
                            $sql1="SELECT  
                          
                                   
                                            sum(CAST(a.Amount-CAST(e.Commission_amount AS INT) AS INT))as sum,count(*) as countt
                                                         
                                            FROM TransactionLog a
                                            INNER JOIN StudentApplications b ON a.StudentID = b.UserID
                                            INNER JOIN ProgramsTable c ON b.ProgramID =c.ID
                                            INNER JOIN CoursesTable d ON b.FirstCourse =d.ID
                        				    INNER JOIN Type_of_Fee e ON a.FeeType =e.FeeType
                                       
                        
                                            where ResponseCode='00' AND e.Academic_year='2017' ";



                        if(isset($_POST['generate'])){    //trigger button click


                      $from=$_POST['from'];
                      $to=$_POST['to'];
                      $feetype=$_POST['feetype'];


                        if (!empty($feetype)) {
                            $sql1 .= " AND e.FeeType = '$feetype'";
                        }
                         if (!empty($from) && !empty($to)) {
                            $sql1 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
                        }
                    }


                        //order the list 
                       
                        // for pdo //
                         $result1 = mssql_query($sql1);

                         while($result11 = mssql_fetch_array($result1)) {


                    ?>
                                    <tr>
                                       <th class="hidden-xs">TOTAL</th>
                                       <th class="hidden-xs"></th>
                                       <th class="hidden-xs"> <?php echo number_format($result11['countt']);  ?></th>
                                        <th class="hidden-xs" >&#8358; <?php  echo number_format($result11['sum'], 2, '.', ','); ?></th>
                                  </tr>
                                  
			<?php }
 ?>
     
                      
                  </tfoot>        
                            
				</table>
			
			
			
			
				
				
				
			</div>
		</div>
					<!-- END EXAMPLE TABLE PORTLET-->
	</div>
</div>
            
            
            
            
            
            
            
			<!-- END PAGE CONTENT-->
            </div>
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
    	
     exportTableToCSV.apply(this, [$('#projectSpreadsheet'), 'AdmissionFeeReport.csv']);
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });

});
    
</script>


 
   
    
<!-- END CONTAINER -->
<?php include('footer.php'); ?>