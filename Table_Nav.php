<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="Number2.css">
<script src="insert.js"></script>
</head>
<body>
  <div id="left_side">
    <div class="img_frame">
	 <img src="bless4.jpg" width="100%" height="100%"/>
	</div>
	<div class="user_log">
	<h4>ADMINISTRATION</h4>
	</div>
    <div id="frame">
    <ul>
    <li><a class="tablinks" onclick="openCity(event,'HOME')" id="defaultOpen">HOME</a></li>
    <li onclick="dlgUpload()"><a  class="tablinks">UPLOAD</a></li>
    <li onclick="getEmail()"><a  class="tablinks">PAYMENT</a></li>
    <li><a href="Login.php" class="tablinks">SIGN OUT</a></li>
   </ul>
   </div>
 </div>
 
 <div class="main_portion">
  
    <div class="body_top">
	<img src="pollo.png" id="logo_ump"/>
	  <span>
	   <form action="#" method="POST">
	    <input type="text" name="search"/>
		<button name="submit">S</i></button>
	   </form>
	  </span>
	</div>
	
	<?php
  
  if(isset($_POST['submit'])){
  $id = $_POST['search'];
  include 'C:\xampp\htdocs\phpmongodb\vendor\autoload.php';
  $collection = (new MongoDB\Client)->Vendor->rec_impo;
 
  $display = $collection->findOne(['_id'=>$id]);
  if($display != null){
  ?>
  <script>
    window.location.href="Profile.php?username="+0+<?php echo $id?>;
  </script>
  <?php
  }
  ?>
  
  <script>
  alert("Unable to Find that tenant");
  </script>
  <?php
    }
  ?>
  
	<div id="HOME" class="tabcontent">
	<div class="all_tenants">
    <?php
  
    include 'C:\xampp\htdocs\phpmongodb\vendor\autoload.php';
    $collection = (new MongoDB\Client)->Vendor->rec_impo; 
    $filter = [];
    $options = ['$project' => ['tenant' =>1, '_id'=>1, 'contact.email'=>1 ,'location.room'=>1,'location.building'=>1],
  	'sort' => ['inDate' =>	-1]];
    $cursor = $collection->find($filter, $options);
    $array = iterator_to_array($cursor);
    ?>
    <div class="rows_h">
    <div class="col_h" id="text">Name</div>
    <div class="col_h" id="text">Cell number</div>
    <div class="col_h" id="text">Registration date</div>
    <div class="col_h" id="text">Room number</div>
    <div class="col_h" id="text">Building</div>
    </div>
  
    <div id="ten_list">
    <?php
    foreach($array as $doc){
    ?> 
    <div class="rows_ins">
    <div class="col" job="<?php echo $doc['_id']?>"><?php echo $doc['tenant']?></div>
    <div class="col" job="<?php echo $doc['_id']?>"><?php echo $doc['_id']?></div>
    <div class="col" job="<?php echo $doc['_id']?>"><?php echo $doc['inDate']?></div>
    <div class="col" job="<?php echo $doc['_id']?>"><?php echo $doc['location']['room'];?></div>
    <div class="col" job="<?php echo $doc['_id']?>"><?php echo $doc['location']['building'];?></div>
    </div>
    <?php
    }
    ?>
	</div>
    </div>
	<script>
    const row_hold = document.getElementsByClassName('col');
    for (var z =0; z < row_hold.length; z++){
	row_hold[z].addEventListener('click',function(event){
		const rep = event.target.attributes.job.value;
		window.location.href="Profile.php?username="+rep;	
	});
    }
</script>
	<div class="b_bottom">
	<?php
    include 'C:\xampp\htdocs\phpmongodb\vendor\autoload.php';
    $collection = (new MongoDB\Client)->Vendor->rec_impo;
    $filter = [];
    $yell = $collection->count();
    $low = $collection->count($filter);
    ?>
	 <div id="ten_num">
	  <h5>Total Number of tenants:  <?php echo $yell; ?></h5>
	 </div>
	 
	 <?php
     include 'C:\xampp\htdocs\phpmongodb\vendor\autoload.php';
     $collection = (new MongoDB\Client)->Vendor->rec_impo;
     $filter = ['Status'=> ['$nin'=>['Paid']]];
     $yell = $collection->count();
     $low = $collection->count($filter);
     ?>
	 <div id="Owing_ten">
	  <h5>Tenants Owing rent: <a href="http://localhost/Zhakata/Paid.php"><?php echo $low; ?></a></h5>
	 </div>
	</div>
	</div>
	
    <div id="white-add">
    </div>
    <div id="dlgbox-add">
    <div id="dlg-add"><h4 align="center" class="header-text">Add Tenant</h4></div>
    <div class="dlg-bodyAdd">
    <form method="post" action="Table_Nav.php" enctype="multipart/form-data">                
    <br>Name: <input type="text" maxlength="100" name="tenant_name" class="input_size"></br>               
    <br>Phone number-1: <input type="number" maxlength="10" name="option1" class="input_size"></br>                       
    <br>Phone number-2: <input type="number" maxlength="10" name="option2" class="input_size"></br>
    <br>Building Number: <input type="number" maxlength="16" name="bNum" class="input_size"></br>
    <br>Room Number: <input type="number" maxlength="16" name="roomNum" class="input_size"></br>
    <br>Email: <input type="email" maxlength="64" name="email" class="input_size"></br>  
    <br>Move in Date: <input type="date" maxlength="64" name="movein" class="input_size"></br>                               
    </br> <div id="dlg-footerAdd">
    <button onclick="cancel_function()">CANCEL</button>
    <button name="upload">Add</button>
    </form>
    </div>
    </div>
    </div>
<?php
  include 'C:\xampp\htdocs\phpmongodb\vendor\autoload.php';
  $collection = (new MongoDB\Client)->Vendor->rec_impo;
  
  
  if(isset($_POST['upload'])){
	  if($_POST['option2'] == ""){}
	 $insertOneResult = $collection ->insertOne([
	  '_id' => $_POST['option1'],
	  'tenant' => $_POST['tenant_name'],
	  'location' => ([
		'building' => $_POST['bNum'],
		'room' => $_POST['roomNum'],  
	  ]),
	  'inDate' => $_POST['movein'],
	  'contact' => ([
	  'email' => $_POST['email'],
	  'mobile' => [$_POST['option1'],$_POST['option2']],
	  ]),	
	  
	 ]);
	 
  }
  
?>
 </div>
 </div>
 <div id="white-email">
 </div>
 <div id="dlgbox-email" >
 <div id="dlg-header"><h4 align="center" class="header-text">PAYMENTS</h4></div>
 <div class="dlg-body">
 <form method="post" action="Table_Nav.php" enctype="multipart/form-data">               
 <br>Phone number: <input type="number" maxlength="10" name="phonenumber" class="input_size"></br>               
 <br>Paid Amount: <input type="double" maxlength="10" name="amount_price" class="input_size"></br>                       
 <br>Payment date: <input type="date" maxlength="16" name="pdate" class="input_size"></br>
 <br>Status: <input type="text" maxlength="16" name="status" class="input_size"></br>
 <br>Proof of Payment: <input type="file" maxlength="16" name="roomNum" class="input_size"></br>                               
 </br> <div id="dlg-footer">
 <button onclick=" dlgContinue()">CANCEL</button>
 <button name="upload_upd">PAY</button>
 </form>
 </div>
 </div>
 </div>
  
</table> 
</div>
<?php
  include 'C:\xampp\htdocs\phpmongodb\vendor\autoload.php';
  $collection = (new MongoDB\Client)->Vendor->rec_impo;
  if(isset($_POST['upload_upd'])){
    $hellno = $_POST['phonenumber'];
	$status = $_POST['status'];
	$paidAmount = $_POST['amount_price'];
	
	
    $cursor=$collection->updateOne(['_id'=>$hellno],['$set'=>['Payments'=>([
		'Amount' => $_POST['amount_price'],	
		'PDate' => $_POST['pdate'],
	  ])]],['upsert'=>true]); 
	$cur=$collection->updateOne(['_id'=>$hellno],['$set'=>['Status'=>$status]],['upsert'=>true]);
 }

 ?>



</body>
</html>

<style>
 .header-text{
	position: absolute;
	top: 0%;
	left: 40%;
 }
 #ten_num{
	 width: 30%;
	 height: 98%;
	 position: relative;
	 border: 1px solid blue;
 }
 #Owing_ten{
	width: 30%;
	height: 98%;
	position: relative;
	left: 69.9%;
	top: -103%;
	border: 1px solid blue; 
 }
 body{
	 width: 100%;
	 height: 100%;
	 overflow-x: hidden;
	 overflow-y: hidden;
 }
 #HOME{
	position: relative;
	width: 99.8%;
    height: 91.8%;
    border: 1px solid black;	
 }
 #PROFILE{
	position: relative;
	width: 99.8%;
    height: 91.8%;
    border: 1px solid black;	
 }
 .body_top span{
	position: relative;
	left: 77%;
	top: -80%;
	height: 0px;
 }
 .body_top{
	position: relative;
    width: 99.8%;
    height: 7%;
    border: 1px solid black;	
 }
 .main_portion{
	position: absolute;
	left: 25.3%;
	top: 0px;
    width: 74.4%;
    height: 100%;
    border: 1px solid black;	
 }
 .user_log{
	position: relative;
    height: 5%;
    width: 99.1%;
 }
 .user_log h4{
	 color: rgb(0,0,100);
	 margin-left: 25%;
 }
 .img_frame{
	width: 99.1%;
    height: 30%;	
	background: red;
	border: 1px solid blue;
 }
 #frame{
	 position: relative;
	 left: -14%;
	 top: 0%;
	 width: 100%;
	 height: 50%;
 }
 #left_side{
	width: 25%;
	height: 100%;
	position: absolute;
	top: 0px;
	left: 0px;
	background: rgb(220,220,220);
	border: 1px solid black;
 }
 #left_side ul{
	 width: 99%;
 }
 #left_side ul li{
	background: rgb();
	border: 1px solid black;
	list-style: none;
	width: 100%;
	height: 15%;
	cursor: pointer;
 }
 #left_side ul li:hover{
	 background: rgb(100,100,250);
 }
  #left_side ul li a{
	  margin-left: 5%;
	  text-decoration: none;
	  position: relative;
	  top: 25%;
	  color: black;
  }
  #logo_ump{
	position: relative;
    width: 10%;
    height: 100%;	
  }
  #white-email{
	  display: none;
	  width: 100%;
	  height: 100%;
	  position: fixed;
	  top: 0px;
	  left: 0px;
	  background-color: #fefefe;
	  opacity: 0.7;
	  z-index: 9999;
  }
  #dlgbox-email{
	 display: none;
	position: fixed;
	width: 480px;
	 z-index: 9999;
	 border-radius: 3px;
	 background-color: #7c7d7e;
  }
   #dlg-header{
	  background-color: rgb(200,200,200);
	  color: black;
	  font-size: 20px;
	  padding: 10px;
	  align: center;
	  height: 30px;
	  margin: 10px 10px 0px 10px;
  }
  .dlg-body{
	 background-color: white;
     color: black;
     font-size: 14px;
     padding: 10px;
	 height: 40%;
     margin: 0px 10px 0px 10px;	 
  }
  #dlg-footer{
	 background-color: rgb(200,200,200);
     text-align: right;
     padding: 10px;
	 width: 100%;
     position: relative;
	 left: -10px;
	 top: 13px;
	 
  }
  #ten_list{
	width: 100%;
	height: 90%;
	overflow-y: scroll;
	overflow-x: hidden;
  }
</style>