<?php session_start();

include "config/config.php";

// Check user login or not
if(!isset($_SESSION['logged'])){
    header('Location: index.php');
}

// logout
if(isset($_POST['but_logout'])){
    session_destroy();
    header('Location: index.php');}

    /*--=========================DB==============================*/ 
    $db= $con;
    $tableName="subject";
    $columns= ['*'];
    $fetchData = fetch_data($db, $tableName, $columns);
    function fetch_data($db, $tableName, $columns){
     if(empty($db)){
      $msg= "Database connection error";
     }elseif (empty($columns) || !is_array($columns)) {
      $msg="columns Name must be defined in an indexed array";
     }elseif(empty($tableName)){
       $msg= "Table Name is empty";
    }else{
    $columnName = implode(", ", $columns);
    $query = "SELECT ".$columnName." FROM $tableName"." ORDER BY cid";
    $result = $db->query($query);
    if($result== true){ 
     if ($result->num_rows > 0) {
        $row= mysqli_fetch_all($result, MYSQLI_ASSOC);
        $msg= $row;
     } else {
        $msg= "No Data Found"; 
     }
    }else{
      $msg= mysqli_error($db);
    }
    }
    return $msg;
    }
     /*--=========================DB==============================*/ 
?>
<!DOCTYPE html>
<html lang="en">

<head>
<script>
function myFunction() {
  let ccid = prompt("Please enter your CID");
  if (ccid != null) {
    
  }
}
</script>
    <!--
     - Roxy: Bootstrap template by GettTemplates.com
     - https://gettemplates.co/roxy
    -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIMS | View Subjects</title>
    <meta name="description" content="Roxy">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- External CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/lightcase/lightcase.css">
     <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400|Work+Sans:300,400,700" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Modernizr JS for IE8 support of HTML5 elements and media queries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

</head>
<body data-spy="scroll" data-target="#navbar" class="static-layout">
    
<!--=========================HEADER==============================-->
<?php include 'header.php';?>
<!--=========================HEADER==============================-->

	<section id="who-we-are" class="overlay text-white">
    <div class="">
        <div class="section-content">
            <div class="col text-center" data-aos="fade-up">
                <br>
                <br>
                <br>
                <h2 class="section-title"><b>View Subjects</b></h2>    
            </div>
 <!--=========================TABLE==============================-->           
            <div class="row" data-aos="fade-up">
                <div class="col-md-8 offset-md-1">
                    <div class="panel panel-default">
                        
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Course ID</th>
                                            <th>Course Short Name</th>
                                            <th>Course Full Name</th>
                                            <th>Subject 1</th>
                                            <th>Subject 2</th>
                                            <th>Subject 3</th>
                                            <th>Subject 4</th>
                                            <th>Subject 5</th>
                                            <th>Subject 6</th>
                                            <th>Subject 7</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
      if(is_array($fetchData)){      
      $sn=1;
      
      foreach($fetchData as $data){
          
    ?>
    <tr>
      <td><?php echo $data['cid']??''; ?></td>
      <td><?php echo $data['cshort']??''; ?></td>
      <td><?php echo $data['cfull']??''; ?></td>
      <td><?php echo $data['sub1']??''; ?></td>
      <td><?php echo $data['sub2']??''; ?></td>
      <td><?php echo $data['sub3']??''; ?></td>
      <td><?php echo $data['sub4']??''; ?></td>
      <td><?php echo $data['sub5']??''; ?></td>
      <td><?php echo $data['sub6']??''; ?></td>
      <td><?php echo $data['sub7']??''; ?></td>
      <td><?php echo $data['sdate']??''; ?></td>
      <td>&nbsp;&nbsp;<a href="editsubject.php" <p class="fa fa-edit btn-outline-primary"></p></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                             <a href="deletesubject.php"> <p class="fa fa-times-circle btn-outline-primary"></p></td>
      
     </tr>
     <?php
      $sn++;}}
      else{ ?>
      <tr>
        <td colspan="8">
    <?php echo $fetchData; ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
   </div>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <br>
             <!--=========================TABLE==============================-->
             
                <!--=========================ADD SUBJECT BUTTON==============================-->
             <div class="col-md-12 col-sm-12 text-center " data-aos="fade-up" data-aos-delay="200">
                    
                    <p><a class="btn btn-outline-primary" href="addsubject.php" role="button">Add Subjects</a></p>
                </div>
                <!--=========================ADD SUBJECT BUTTON==============================-->
        </div>
        
    </div>
    
</section>		</div>
<!--=========================FOOTER==============================-->
<?php include 'footer.php';?>
<!--=========================FOOTER==============================-->
<!-- External JS -->
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
	<script src="vendor/bootstrap/popper.min.js"></script>
	<script src="vendor/bootstrap/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js "></script>
	<script src="vendor/owlcarousel/owl.carousel.min.js"></script>
	<script src="vendor/stellar/jquery.stellar.js" type="text/javascript" charset="utf-8"></script>
	<script src="vendor/isotope/isotope.min.js"></script>
	<script src="vendor/lightcase/lightcase.js"></script>
	<script src="vendor/waypoints/waypoint.min.js"></script>
	 <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
	 
	<!-- Main JS -->
	<script src="js/app.min.js "></script>
	<script src="//localhost:35729/livereload.js"></script>
</body>
</html>
