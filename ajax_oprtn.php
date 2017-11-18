<?php 
include_once("inc/db.php");
//print_r($_POST);
//print_r($_FILES);

//mysql_close($connection); // Connection Closed

function filterInsert($data){
$data=trim($data);	
$data=htmlspecialchars($data);	
$data=addslashes($data);	
$data=mysqli_real_escape_string($GLOBALS['con'], $data);	
return $data;	
}

function imageInsert($img_name,$img_path,$id,$tbl_name,$col_name){

if($_FILES[$img_name]["name"]!=''){
$allowed_ext=array('.jpg','.png','.jpeg','.gif');	
$ext=strtolower(strrchr($_FILES[$img_name]["name"],'.'));	
if(in_array($ext,$allowed_ext)){
$newfile=md5(rand(time(),2)).$ext;	

$mv=move_uploaded_file($_FILES[$img_name]["tmp_name"],$img_path.$newfile);	

if($mv){
	
	mysqli_query($GLOBALS['con'],"UPDATE $tbl_name SET $col_name='".$newfile."' WHERE id='".$id."'");
}
	
	
}else{echo "image must be in jpg,jpeg,png or gif format only";}	
}	
}


$allowed_ext=array('.jpg','.png','.jpeg','.gif');	
$ext=strtolower(strrchr($_FILES["resume"]["name"],'.'));

if(in_array($ext,$allowed_ext)){ $mv=true;}else{$mv=false;}

if($_POST && $_FILES){

if($mv){
if(trim($_POST['fullname'])!='' && trim($_POST['email'])!='' && trim($_POST['password'])!='' && trim($_POST['re_password'])!='' && trim($_POST['phone'])!='' && trim($_POST['gender'])!='' && trim($_POST['qualification'])!='' && trim($_POST['skill'][0])!='' && trim($_FILES['resume']['name'])!=''){


if(filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)){

if(is_numeric(trim($_POST['phone']))){	

if(
strlen(trim($_POST['password']))>=8 &&
preg_match("/[a-z]+/",trim($_POST['password'])) &&
preg_match("/[A-Z]+/",trim($_POST['password'])) &&
preg_match("/[0-9]+/",trim($_POST['password'])) &&
preg_match("/[\W]+/",trim($_POST['password'])) &&
preg_match("/^[\S]+$/",trim($_POST['password'])) 

){
if(count($_POST['skill'])>=2){
	
if(trim($_POST['password'])==trim($_POST['re_password'])){	
	
	
$sql="INSERT INTO `users` SET fullname='".filterInsert($_POST['fullname'])."',
email='".filterInsert($_POST['email'])."',
password='".trim(md5($_POST['password']))."',
phone='".filterInsert($_POST['phone'])."',
gender='".filterInsert($_POST['gender'])."',
qualification='".filterInsert($_POST['qualification'])."',
skill='".serialize($_POST['skill'])."'";
	
	
$sqli=mysqli_query($con,$sql) or die(mysqli_error($con));	
$idz=mysqli_insert_id($con);	
	

if($sqli){
imageInsert('resume','img/',$idz,'users','resume');	
echo 'registered!';}else{echo 'oh no!';}	
	
}else{echo"password doesn't match";}	
}else{echo "select atleast two skills";}
}else{echo "password is not valid";}
}else{echo "invalid phone number";}	
}else{echo "Invalid email";}
}else{echo "all fields are required";}
}else{echo "image must be in jpg,jpeg,png or gif format only";}	
}else{echo "error try again";}


?>
