<?php 

$title=':: Check payment ::';

include('header.php');

include('sidebar.php');



?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
 
   

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
		        Check Payment
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="home.php">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#"> Check Payment</a>
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
          <!--<div class="row">
                    <div class="form-group col-md-4">
                      <label for="email">Report From</label>
                      <input type="text" class="form-control" id="from" placeholder="REPORT FROM" name="from">
                    </div>
                    <div class="form-group  col-md-4">
                      <label for="pwd">Report To</label>
                      <input type="text" class="form-control" id="to" placeholder="REPORT TO" name="to">
                    </div>
                     
        </div>-->
         <div class="row">
                      <div class="form-group  col-md-3">
                      <label for="pwd">Matric Number :</label>
                        <input type="text" name="matric" class="form-control" placeholder="Matric Number">
                    </div>  
                      <div class="form-group  col-md-3">
                      <label for="pwd">Transaction Number :</label>
                        <input type="text" name="transaction" class="form-control" placeholder="Transaction Number">
                    </div> 
                    <div class="form-group  col-md-3">
                      <label for="pwd">Payment Category :</label>
                      <select class="form-control" name="category">
                            <option value="">--- Select Payment Type ----</option>
                          <option value="student">Student Fee</option>  
                            <option value="admission">Admission Fee</option> 
                            <option value="miscellaneous">Miscellaneous Fee</option> 
                      </select>
                    </div>
                   
           
                    <div class="form-group col-md-3">
                     
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
								<i class="fa fa-globe"></i>Check Payment
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
                            
                            
<?php  if(isset($_POST['generate']) && ($_POST['category']=='student')&& (!empty($_POST['transaction']) || ($_POST['matric']))){     
   

$conn = mssql_connect("162.246.23.253\MSSQLSERVE_08_R2","Report","Charles111");
             mssql_select_db( "Student_Portal",$conn);
             
 $matric=$_POST['matric'];
 $transaction=$_POST['transaction'];             

?> 
                            
                    <div class="row">
                        <center><strong><h3>THE POLYTECHNIC IBADAN</strong></h3></center>
                                <br>
                                <center><strong><h3>STUDENT FEE REPORT DETAIL</strong></h3></center>
                                <?php  

                                    if(!empty($matric) ){ echo '<center><strong><h4> Matric Number Is   '.$matric.'</strong></h4> </center>' ;}
                                    if(!empty($transaction)  ){ echo '<center><strong><h4> Transaction Number Is ' .$transaction.  '</strong></h4> </center>' ;}         

                                ?>
                            
                    </div>
				   
                
				    <table class="table table-striped table-bordered table-hover" >
							<thead>
							<tr>
                                <th >S/N</th>
                                <th >SURNAME</th>
    							<th >FIRSTNAME</th>
                                <th>FORM NUMBER</th>
                                 <th>DEPARTMNENT</th>
    						    <th>ACADEMIC YEAR</th>
    							<th >AMOUNT PAID</th>
							
                            </tr>
							</thead>
							<tbody>
                                
   <?php 
 
   
  $sql0="SELECT 
               a.[Form Number],a.Department,a.Surname,a.[First Name],d.Academic_Year,c.Amount,d.commission_amount
                 
                    FROM StudentInfo a
                    INNER JOIN StudentFee_Mapping b ON a.[Form Number] = b.FormNumber
                    INNER JOIN TransactionLog c ON b.TransactionNumber =c.TransactionNumber
                    INNER JOIN Fee_Category d ON b.FeeCatID =d.ID
                   
    				where Paid = 'Yes' ";

  
 
      if (!empty($transaction)) {
        $sql0 .= " AND c.TransactionNumber = '$transaction'";
    }
      if (!empty($matric)) {
        $sql0 .= " AND a.[Form Number] = '$matric'";
    }

         $result0 = mssql_query($sql0);
    
     $num=1;
         while($result00 = mssql_fetch_array($result0)){
       
?>                  
                <tr >
                   <td class="hidden-xs" ><?php  echo $num++ ?></td>
                   <td class="hidden-xs" ><?php  echo $result00['Surname']; ?></td>
                   <td class="hidden-xs" ><?php  echo $result00['First Name']; ?></td>
                   <td class="hidden-xs"><?php  echo $result00['Form Number']; ?></td>
                   <td class="hidden-xs" ><?php  echo $result00['Department']; ?></td>
                   <td class="hidden-xs" ><?php  echo $result00['Academic_Year']; ?></td>
                   <td class="hidden-xs" >&#8358;<?php  echo number_format($result00['Amount'] - $result00['commission_amount']); ?></td>
                  
              </tr>
			<?php }
 ?>
            <tfoot>
                
                <?php 
 
   
  $sql0="SELECT 
               SUM(CAST(Amount AS INT)) as summ,SUM(CAST(d.commission_amount AS INT)) as com
                 
                    FROM StudentInfo a
                    INNER JOIN StudentFee_Mapping b ON a.[Form Number] = b.FormNumber
                    INNER JOIN TransactionLog c ON b.TransactionNumber =c.TransactionNumber
                    INNER JOIN Fee_Category d ON b.FeeCatID =d.ID
                   
    				where Paid = 'Yes' ";

  
 
      if (!empty($transaction)) {
        $sql0 .= " AND c.TransactionNumber = '$transaction'";
    }
      if (!empty($matric)) {
        $sql0 .= " AND a.[Form Number] = '$matric'";
    }

         $result0 = mssql_query($sql0);
    
     $num=1;
         while($result00 = mssql_fetch_array($result0)){
       
?>                  
                <tr >
                   <td class="hidden-xs"></td>
                   <td class="hidden-xs" ></td>
                   <td class="hidden-xs"></td>
                   <td class="hidden-xs" ></td>
                   <td class="hidden-xs"></td>
                   <td class="hidden-xs" ></td>
                   <th class="hidden-xs">&#8358;<?php  echo number_format($result00['summ'] - $result00['com'] ); ?></th>
                  
              </tr>
			<?php }
 ?>
                
                
            </tfoot>
            
                
				</tbody> 
                       
				</table>
	       <?php } ?>			
<!--------------------------------------------------- END OF STUDENT FEE-------------------------------------------------->

	


<!---------------------------------------------------ADMISSION FEE-------------------------------------------------->	
			
<?php  if(isset($_POST['generate']) && ($_POST['category']=='admission') && (!empty($_POST['transaction']) || ($_POST['matric']))){ 

$conn = mssql_connect("216.158.234.108\SQLEXPRESS","Report","Charles111");
          mssql_select_db("AdmissionPortal_Database");		        
		
		
 $matric=$_POST['matric'];
 $transaction=$_POST['transaction'];
 
?>

        <div class="row">
                        <center><strong><h3>THE POLYTECHNIC IBADAN</strong></h3></center>
                                <br>
                                <center><strong><h3>ADMISSION FEE REPORT DETAIL</strong></h3></center>
                                <?php  

                                    if(!empty($matric) ){ echo '<center><strong><h4> Matric Number Is   '.$matric.'</strong></h4> </center>' ;}
                                    if(!empty($transaction)  ){ echo '<center><strong><h4> Transaction Number Is ' .$transaction.  '</strong></h4> </center>' ;}         

                                ?>
                            
                    </div>		
		
		<table class="table table-striped table-bordered table-hover" id="projectSpreadsheet" >
							<thead>
							<tr>
                                <th>S/N</th> 
    						    <th>FEE TYPE</th>
    						    <th>PROGRAM</th>
    							<th>AMOUNT PAID</th>
							     
							</tr>
							</thead>
							<tbody id="tbodyid">
							<?php 
  
       
 
   $sql0="SELECT  

                 c.ProgramName,e.FeeType,a.Amount,e.Commission_amount
                                                     
                 FROM TransactionLog a
                 INNER JOIN StudentApplications b ON a.StudentID = b.UserID
                 INNER JOIN ProgramsTable c ON b.ProgramID =c.ID
                 INNER JOIN CoursesTable d ON b.FirstCourse =d.ID
                 INNER JOIN Type_of_Fee e ON a.FeeType =e.FeeType
                                   
                    
                 where ResponseCode='00' AND e.Academic_year='2017'";
  

                
             if (!empty($transaction)) {
                $sql0 .= " AND a.TransactionNumber = '$transaction'";
                 }
            if (!empty($matric)) {
                 $sql0 .= " AND b.FormNumber = '$matric'";
                }
               
            	
                //order the list 
             
                   
                $result0 = mssql_query($sql0);
            $num=1;
                  while($result00 = mssql_fetch_array($result0)){
            	   
?>
                <tr >
                     <td class="hidden-xs"><?php  echo $num++; ?></td>
                     <td class="hidden-xs" ><?php  echo $result00['FeeType']; ?></td>
                     <td class="hidden-xs"><?php  echo $result00['ProgramName']; ?></td>
                    <td class="hidden-xs"><?php  echo number_format($result00['Amount'] - $result00['Commission_amount'], 2, '.', ','); ?></td>
                   
               
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
                                                       
                                        
                                     where ResponseCode='00' AND e.Academic_year='2017'";


                    
                         if (!empty($transaction)) {
                     $sql1 .= " AND a.TransactionNumber = '$transaction'";
                             }
                        if (!empty($matric)) {
                             $sql1 .= "AND b.FormNumber = '$matric'";
                            }
               

                        // for pdo //
                         $result1 = mssql_query($sql1);

                         while($result11 = mssql_fetch_array($result1)) {


                    ?>
                                <tr>
                                     
                                       <th class="hidden-xs"></th>
                                       <th class="hidden-xs"></th>
                                       <td class="hidden-xs"><?php  echo $result00['ProgramName']; ?></td>
                                       <th class="hidden-xs" > <?php  echo number_format($result11['sum'], 2, '.', ','); ?></th>
                                </tr>
                                  
			<?php }
 ?>
     
                      
                  </tfoot>        
                            
				</table>
		
		
		

		
		
<?php } ?>	



		
<!--------------------------------------------------- END OF ADMISSION FEE-------------------------------------------------->






<!--------------------------------------------------- MISCELLANEOUS FEE-------------------------------------------------->
		
<?php  if(isset($_POST['generate']) && ($_POST['category']=='miscellaneous') && (!empty($_POST['transaction']) || ($_POST['matric']))){

$conn1 = mssql_connect("216.158.234.108\SQLEXPRESS","Report","Charles111",true);
            mssql_select_db("studentDb",$conn1);

 $matric=$_POST['matric'];
 $transaction=$_POST['transaction'];
 
?>

        <div class="row">
                        <center><strong><h3>THE POLYTECHNIC IBADAN</strong></h3></center>
                                <br>
                                <center><strong><h3>MISCELLANEOUS FEE REPORT DETAIL</strong></h3></center>
                                <?php  

                                    if(!empty($matric) ){ echo '<center><strong><h4> Matric Number Is   '.$matric.'</strong></h4> </center>' ;}
                                    if(!empty($transaction)  ){ echo '<center><strong><h4> Transaction Number Is ' .$transaction.  '</strong></h4> </center>' ;}         

                                ?>
                            
                    </div>

			 <table class="table table-striped table-bordered table-hover" >
				<thead>
							<tr>	
							    <th>S/N</th> 
                               <th>SURNAME</th>
    							<th>FIRSTNAME</th>
                                <th>STUDENT NUMBER</th>
    						    <th>FEE TYPE</th>
    							<th>AMOUNT PAID</th>
                            </tr>
				</thead>
				<tbody >
<?php 
 
 
 
   /// for mysqli //
  //$sql0="select * from employees where first_name like '%{$search}%' || last_name like '%{$search}%' ";
  //$sql0="select * from bulkorder where  date >= '" . $from . "' AND date <= '" . $to . "'" ;
     

     // for pdo //
   $sql0="SELECT   
                
                c.Surname,c.First_Name,c.StudentNumber,d.FeeText,a.Amount
                
                   FROM TransactionLog a
                   INNER JOIN StudentFee_Mapping b ON a.TransactionNumber = b.TxRef
                   INNER JOIN StudentData c ON b.StudentNumber =c.StudentNumber
    			   INNER JOIN StudentBills d ON d.ID =b.FeeCatID
                 
                where ResponseCode='00'
                
   ";
    
  
     
     if (!empty($transaction)) {
        $sql0 .= " AND a.TransactionNumber = '$transaction'";
    }
      if (!empty($matric)) {
        $sql0 .= " AND c.StudentNumber = '$matric'";
    }
  
	
       
    // for pdo //
    $result0 = mssql_query($sql0);
     $num=1;
    
      while($result00 = mssql_fetch_array($result0)){
	 
    
?>
                <tr >
                  <td class="hidden-xs" ><?php  echo $num++ ?></td>
                  <td class="hidden-xs"><?php  echo $result00['Surname']; ?></td>
                  <td class="hidden-xs" ><?php  echo $result00['First_Name']; ?></td>
                  <td class="hidden-xs" ><?php  echo $result00['StudentNumber']; ?></td>
                  <td class="hidden-xs" ><?php  echo $result00['FeeText']; ?></td>
                  <td class="hidden-xs" >&#8358; <?php  echo number_format($result00['Amount']); ?></td>
                
                 
              </tr>
	
 <?php }
 ?>
				
	<tfoot>		
  <?php 

 
   $sql0="SELECT SUM(CAST(a.Amount AS INT)) as summ1
                
               FROM TransactionLog a
               INNER JOIN StudentFee_Mapping b ON a.TransactionNumber = b.TxRef
               INNER JOIN StudentData c ON b.StudentNumber =c.StudentNumber
			   INNER JOIN StudentBills d ON d.ID =b.FeeCatID
             
                where ResponseCode='00'
                
   ";
    
  
     
     if (!empty($transaction)) {
        $sql0 .= " AND a.TransactionNumber = '$transaction'";
    }
      if (!empty($matric)) {
        $sql0 .= " AND c.StudentNumber = '$matric'";
    }
  
	
       
    // for pdo //
    $result0 = mssql_query($sql0);
    
    
      while($result00 = mssql_fetch_array($result0)){
	 
    
?>
                <tr >
                  <th class="hidden-xs"></th>
                  <td class="hidden-xs"></td>
                  <td class="hidden-xs" ></td>
                  <td class="hidden-xs" ></td>
                  <td class="hidden-xs" ></td>
                  <th class="hidden-xs" >&#8358; <?php  echo number_format($result00['summ1']); ?></th>
                
                 
              </tr>
	
 <?php }
 ?>
 
 </tfoot>
				
				
				
							
				</tbody >
                           
			</table>




<?php } ?>	

	<!--------------------------------------------------- END OF MISCELLANEOUS FEE-------------------------------------------------->





	<!--------------------------------------------------- IF EMPTY MATRIC INPUT FIELD AND EMPTY TRANSACTION NUMBER INPUT FIELD-------------------------------------------------->


<?php  if(isset($_POST['generate']) && (empty($_POST['matric'])) && (empty($_POST['transaction']))){ ?>

        <div class="row">
                        <center><strong><h5 style="color:red">ENTER A MATRIC NUMBER OR A TRANSACTION NUMBER</strong></h5></center>
                             
                            
         </div>	
<?php } ?>




	<!--------------------------------------------------- END OF MISCELLANEOUS FEE-------------------------------------------------->
	
	<?php  if(isset($_POST['generate']) && ($_POST['category']=="")){ ?>

        <div class="row">
                        <center><strong><h5 style="color:red">SELECT A PAYMENT CATEGORY</strong></h5></center>
                             
                            
         </div>	
<?php } ?>
	
	



	</div>		
			
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