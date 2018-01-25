<?php 

$title=':: Miscellaneous Fee Report ::';                                                 

include('header.php');                                               

include('sidebar.php');                                              


    $conn = mssql_connect("216.158.234.108\SQLEXPRESS","Report","Charles111");
            mssql_select_db("studentDb");

if($conn) {                                                
      "Connection established.<br />";                                               
}else{                                               
     echo "Connection could not be established.<br />";                                              
                                               
}

$sql1="SELECT DISTINCT FeeText from StudentBills";                                                 
    $results = mssql_query($sql1);
                                                  


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
			Miscellaneous Report <small>Report System</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="home.php">Home</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">Miscellaneous Report</a>
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
                        <option value="">All</option>  
                           <?php  while($results1 = mssql_fetch_array($results)){ ?>
                        <option value="<?php echo $results1['FeeText']?>"><?php echo $results1['FeeText']?></option>  
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
								<i class="fa fa-globe"></i>Miscellaneous Report
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
											<button id="cnn" class="btn btn-warning">
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
                                        $feetype=$_POST['feetype'];
                                        
                                        if(!empty($from) && !empty($to)){ echo '<center><strong><h4> Report From '.$from. ' To ' .$to. '</strong></h4> </center>' ;}
                                          if(!empty($feetype)){ echo '<center><strong><h4>  '.$feetype. '</strong></h4> </center>' ;}
                                     
                                        
                                    }
                                ?>
                                 
                                
                            
                            </div>
							
				    <table class="table table-striped table-bordered table-hover">
							<thead>
							<tr>
                               
                                
							     <th>FEE TYPE</th>
							     <th>TOTAL STUDENTS</th>
							     <th>TOTAL AMOUNT</th>
                            </tr>
							</thead>
							<tbody>
<?php 
 
 
 
   /// for mysqli //
  //$sql0="select * from employees where first_name like '%{$search}%' || last_name like '%{$search}%' ";
  //$sql0="select * from bulkorder where  date >= '" . $from . "' AND date <= '" . $to . "'" ;
     

     // for pdo //
   $sql0="SELECT d.FeeText,SUM(CAST(a.Amount AS INT)) as sum,count(*) as countt
                
               FROM TransactionLog a
               INNER JOIN StudentFee_Mapping b ON a.TransactionNumber = b.TxRef
               INNER JOIN StudentData c ON b.StudentNumber =c.StudentNumber
			   INNER JOIN StudentBills d ON d.ID =b.FeeCatID
             
                where ResponseCode='00'
                
   ";
    
   if(isset($_POST['generate'])){    //trigger button click

 
  $from=$_POST['from'];
  $to=$_POST['to'];
  $feetype=$_POST['feetype'];
	   //d.AcademicYear,d.Department
        //INNER JOIN StudentBills d ON c.Academic_Year =d.AcademicYear
     
    if (!empty($feetype)) {
        $sql0 .= " AND d.FeeText = '$feetype'";
    }
    if (!empty($from) && !empty($to)) {
        $sql0 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
    }
   }
    //order the list 
    $sql0 .= "GROUP BY d.FeeText ORDER BY d.FeeText ASC"; 
	
       
    // for pdo //
    $result0 = mssql_query($sql0);
    
    
      while($result00 = mssql_fetch_array($result0)){
	   
       
    /// for mysqli //
	/*$result0=$conn -> query($sql0);
    if (mysqli_num_rows($result0) > 0) {
    while ($row0=$result0 ->fetch_assoc())
    
    INNER JOIN StudentFee_Mapping b ON a.StudentID = b.StudentNumber
    INNER JOIN StudentData c ON a.StudentID =c.StudentNumber
    
    {*/
    
?>
                <tr >
                  <td class="hidden-xs" width="25%"><?php  echo $result00['FeeText']; ?></td>
                    <td class="hidden-xs" width="20%"> <?php  echo number_format($result00['countt']); ?></td>
                    <td class="hidden-xs" width="20%">&#8358; <?php  echo number_format($result00['sum'], 2, '.', ','); ?></td>
                 
              </tr>
	
 <?php }
 ?>
							
							</tbody>
                             <tfoot>
                    
                      
                      <?php
                       $sql1="SELECT SUM(CAST(a.Amount AS INT)) as sum, count(*) as counts
                
                                FROM TransactionLog a
                                
                                 INNER JOIN StudentFee_Mapping b ON a.TransactionNumber = b.TxRef
                                 INNER JOIN StudentData c ON b.StudentNumber =c.StudentNumber
            			         INNER JOIN StudentBills d ON d.ID =b.FeeCatID
								 
                                 
                                where ResponseCode='00'

                   ";

                   if(isset($_POST['generate'])){    //trigger button click


                  $from=$_POST['from'];
                  $to=$_POST['to'];
                  $feetype=$_POST['feetype'];
                       
                       //d.AcademicYear,d.Department
                        //INNER JOIN StudentBills d ON c.Academic_Year =d.AcademicYear

                    if (!empty($feetype)) {
                        $sql1 .= " AND d.FeeText = '$feetype'";
                    }
                    if (!empty($from) && !empty($to)) {
                        $sql1 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
                    }
                   }
                    //order the list 
                  


                    // for pdo //
                   $result1 = mssql_query($sql1);

                      while($result11 = mssql_fetch_array($result1)){


                    /// for mysqli //
                    /*$result0=$conn -> query($sql0);
                    if (mysqli_num_rows($result0) > 0) {
                    while ($row0=$result0 ->fetch_assoc())
                    {*/

                ?>
                              <tr>
                                   <th class="hidden-xs">TOTAL</th>
                                   <th class="hidden-xs"><?php  echo number_format($result11['counts']); ?></th>
                                    <th class="hidden-xs">&#8358; <?php  echo number_format($result11['sum'], 2, '.', ','); ?></th>
                              </tr>
			<?php }
 ?>
     
                      
                  </tfoot>     
							</table>
							
			
			
			
			
		<a href="" id="xx"  class="btn btn-warning"><span class="glyphicon glyphicon-download-alt"></span> Download To Excel</a>		
			
	
	
			
	<!--------------------------------------------------  TABLE FOR STUDENT DETAILS  ----------------------------------------------->
<div style="display:none;">
				<br><br>
				<hr>
			 <center><strong><h3>STUDENT DETAILS</strong></h3></center>
				
				<hr>
				<br>
				
				
					
			
			
			 <table class="table table-striped table-bordered table-hover" id="projectSpreadsheet">
			<thead>
			<tr>	
				<th>S/N</th> 
                <th>SURNAME</th>
    			<th>FIRSTNAME</th>
                <th>STUDENT NUMBER</th>
    			<th>DEPARTMNENT</th>
    			<th>AMOUNT PAID</th>
            </tr>
			</thead>
			<tbody id="tbodyid">
<?php 
 
 
 
   /// for mysqli //
  //$sql0="select * from employees where first_name like '%{$search}%' || last_name like '%{$search}%' ";
  //$sql0="select * from bulkorder where  date >= '" . $from . "' AND date <= '" . $to . "'" ;
     

     // for pdo //
   $sql0="SELECT  c.Surname,c.First_Name,c.StudentNumber,c.Department,a.Amount
                
               FROM TransactionLog a
               INNER JOIN StudentFee_Mapping b ON a.TransactionNumber = b.TxRef
               INNER JOIN StudentData c ON b.StudentNumber =c.StudentNumber
			   INNER JOIN StudentBills d ON d.ID =b.FeeCatID
             
                where ResponseCode='00'
                
   ";
    
   if(isset($_POST['generate'])){    //trigger button click

 
  $from=$_POST['from'];
  $to=$_POST['to'];
  $feetype=$_POST['feetype'];
	  
    if (!empty($feetype)) {
        $sql0 .= " AND d.FeeText = '$feetype'";
    }
    if (!empty($from) && !empty($to)) {
        $sql0 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
    }
   }
    //order the list 
 
	
       
    // for pdo //
    $result0 = mssql_query($sql0);
     $num=1;
    
      while($result00 = mssql_fetch_array($result0)){
	 
    
?>
                <tr >
                  <td class="hidden-xs" ><?php  echo $num++ ?></td>
                  <td class="hidden-xs"><?php  echo $result00['Surname']; ?></td>
                  <td class="hidden-xs" ><?php  echo $result00['First_Name']; ?></td>
                  <td class="hidden-xs" >'<?php  echo $result00['StudentNumber']; ?>'</td>
                  <td class="hidden-xs" ><?php  echo $result00['Department']; ?></td>
                  <td class="hidden-xs" > <?php  echo number_format($result00['Amount']); ?></td>
              </tr>
	
 <?php }
 ?>
							
							</tbody >
                             <tfoot>
                    
                      
                      <?php
                       $sql1="SELECT SUM(CAST(a.Amount AS INT)) as sum, count(*) as counts
                
                                FROM TransactionLog a
                                
                                 INNER JOIN StudentFee_Mapping b ON a.TransactionNumber = b.TxRef
                                 INNER JOIN StudentData c ON b.StudentNumber =c.StudentNumber
            			         INNER JOIN StudentBills d ON d.ID =b.FeeCatID
								 
                                 
                                where ResponseCode='00'

                   ";

                   if(isset($_POST['generate'])){    //trigger button click


                  $from=$_POST['from'];
                  $to=$_POST['to'];
                  $feetype=$_POST['feetype'];
                       
                       

                    if (!empty($feetype)) {
                        $sql1 .= " AND d.FeeText = '$feetype'";
                    }
                    if (!empty($from) && !empty($to)) {
                        $sql1 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
                    }
                   }
                    //order the list 
                  


                    // for pdo //
                   $result1 = mssql_query($sql1);

                      while($result11 = mssql_fetch_array($result1)){


                    /// for mysqli //
                    /*$result0=$conn -> query($sql0);
                    if (mysqli_num_rows($result0) > 0) {
                    while ($row0=$result0 ->fetch_assoc())
                    {*/

                ?>
                              <tr>
                                   <th class="hidden-xs">TOTAL : <?php  echo number_format($result11['counts']); ?></th>
                                   <th class="hidden-xs"></th>
                                   <th class="hidden-xs"></th>
                                   <th class="hidden-xs"></th>
                                   <th class="hidden-xs"></th>
                                    <th class="hidden-xs"><?php  echo number_format($result11['sum'], 2, '.', ','); ?></th>
                              </tr>
			<?php }
 ?>
     
                      
                  </tfoot>     
			</table>
</div>						
			
			
			
			
			
			
					
				
				
				
				
	<!-------------------------------------------------- TABLE FOR BANK NAME ----------------------------------------------->
			
				<br><br>
				<hr>
			 <center><strong><h3>BANKS</strong></h3></center>
				
				<hr>
				<br>
				
				
					
			
			
			 <table class="table table-striped table-bordered table-hover">
							<thead>
							<tr>
                               
                                
							     <th>BANK</th>
							      <th>ACCOUNT NUMBER</th>
							     <th>TOTAL STUDENTS</th>
							     <th>TOTAL AMOUNT</th>
                            </tr>
							</thead>
							<tbody>
<?php 
 
 
 
   /// for mysqli //
  //$sql0="select * from employees where first_name like '%{$search}%' || last_name like '%{$search}%' ";
  //$sql0="select * from bulkorder where  date >= '" . $from . "' AND date <= '" . $to . "'" ;
     

     // for pdo //
   $sql0="SELECT d.Bank,d.AccountNumber,SUM(CAST(a.Amount AS INT)) as sum,count(*) as countt
                
               FROM TransactionLog a
               INNER JOIN StudentFee_Mapping b ON a.TransactionNumber = b.TxRef
               INNER JOIN StudentData c ON b.StudentNumber =c.StudentNumber
			   INNER JOIN StudentBills d ON d.ID =b.FeeCatID
             
                where ResponseCode='00'
                
   ";
    
   if(isset($_POST['generate'])){    //trigger button click

 
  $from=$_POST['from'];
  $to=$_POST['to'];
  $feetype=$_POST['feetype'];
	   //d.AcademicYear,d.Department
        //INNER JOIN StudentBills d ON c.Academic_Year =d.AcademicYear
     
    if (!empty($feetype)) {
        $sql0 .= " AND d.FeeText = '$feetype'";
    }
    if (!empty($from) && !empty($to)) {
        $sql0 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
    }
   }
    //order the list 
    $sql0 .= "GROUP BY d.Bank,d.AccountNumber ORDER BY d.Bank ASC"; 
	
       
    // for pdo //
    $result0 = mssql_query($sql0);
    
    
      while($result00 = mssql_fetch_array($result0)){
	   
       
    /// for mysqli //
	/*$result0=$conn -> query($sql0);
    if (mysqli_num_rows($result0) > 0) {
    while ($row0=$result0 ->fetch_assoc())
    
    INNER JOIN StudentFee_Mapping b ON a.StudentID = b.StudentNumber
    INNER JOIN StudentData c ON a.StudentID =c.StudentNumber
    
    {*/
    
?>
                <tr >
                  <td class="hidden-xs" width="25%"><?php  echo $result00['Bank']; ?></td>
                  <td class="hidden-xs" width="25%"><?php  echo $result00['AccountNumber']; ?></td>
                    <td class="hidden-xs" width="20%"> <?php  echo number_format($result00['countt']); ?></td>
                    <td class="hidden-xs" width="20%">&#8358; <?php  echo number_format($result00['sum'], 2, '.', ','); ?></td>
                 
              </tr>
	
 <?php }
 ?>
							
							</tbody>
                             <tfoot>
                    
                      
                      <?php
                       $sql1="SELECT SUM(CAST(a.Amount AS INT)) as sum, count(*) as counts
                
                                FROM TransactionLog a
                                
                                 INNER JOIN StudentFee_Mapping b ON a.TransactionNumber = b.TxRef
                                 INNER JOIN StudentData c ON b.StudentNumber =c.StudentNumber
            			         INNER JOIN StudentBills d ON d.ID =b.FeeCatID
								 
                                 
                                where ResponseCode='00'

                   ";

                   if(isset($_POST['generate'])){    //trigger button click


                  $from=$_POST['from'];
                  $to=$_POST['to'];
                  $feetype=$_POST['feetype'];
                       
                       //d.AcademicYear,d.Department
                        //INNER JOIN StudentBills d ON c.Academic_Year =d.AcademicYear

                    if (!empty($feetype)) {
                        $sql1 .= " AND d.FeeText = '$feetype'";
                    }
                    if (!empty($from) && !empty($to)) {
                        $sql1 .= " AND CAST(a.TransactionDate AS DATE) >= '" . $from . "' AND CAST(a.TransactionDate AS DATE) <= '" . $to . "'";
                    }
                   }
                    //order the list 
                  


                    // for pdo //
                   $result1 = mssql_query($sql1);

                      while($result11 = mssql_fetch_array($result1)){


                    /// for mysqli //
                    /*$result0=$conn -> query($sql0);
                    if (mysqli_num_rows($result0) > 0) {
                    while ($row0=$result0 ->fetch_assoc())
                    {*/

                ?>
                              <tr>
                                   <th class="hidden-xs">TOTAL</th>
                                   <th class="hidden-xs"></th>
                                   <th class="hidden-xs"><?php  echo number_format($result11['counts']); ?></th>
                                    <th class="hidden-xs">&#8358; <?php  echo number_format($result11['sum'], 2, '.', ','); ?></th>
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
    	
        exportTableToCSV.apply(this, [$('#projectSpreadsheet'), 'MiscellaneousFeeReport.csv']);
        
        // IF CSV, don't do event.preventDefault() or return false
        // We actually need this to be a typical hyperlink
    });

});
    
</script>


    
    
<!-- END CONTAINER -->
<?php include('footer.php'); ?>