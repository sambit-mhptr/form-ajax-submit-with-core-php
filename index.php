<?php include_once("inc/db.php");?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP Ajax Form</title>

	<link rel="stylesheet" href="css/bootstrap.min.css">

	<script src="js/jquery-3.1.1.min.js" type="text/javascript"></script>

	<script src="js/jquery.validate.min.js" type="text/javascript"></script>

	<script src="js/bootstrap.min.js" type="text/javascript"></script>

</head>

<body>

	<style type="text/css">
		.error {
			color: red;
			font-style: italic
		}
		
		#msg{text-align: center;text-transform: capitalize}
	</style>

	<div class="container">
		<h2>PHP Ajax Form:</h2>
<div id="msg"></div> <br/>
<form class="form-horizontal" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label class="control-label col-sm-2" for="fullname">Name:</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" id="fullname" placeholder="Enter Name" name="fullname">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="email">Email:</label>
				<div class="col-sm-10">
					<input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="phone">Phone:</label>
				<div class="col-sm-10">
					<input type="tel" class="form-control" id="phone" placeholder="Enter Phone" name="phone" maxlength="10">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="password">Password:</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="re_password">Re-type Password:</label>
				<div class="col-sm-10">
					<input type="password" class="form-control" id="re_password" placeholder="Enter Password Again" name="re_password">
				</div>
			</div>
			<!---->

			<div class="form-group">
				<label class="control-label col-sm-2" for="resume">Resume:</label>
				<div class="col-sm-10">
					<input type="file" class="form-control" id="resume" name="resume">
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Gender :</label>
				<div class="col-sm-10">

					<label class="radio-inline"><input type="radio"  name="gender" value="male">male</label>
					<label class="radio-inline"><input type="radio" name="gender" value="female">Female</label>
					<br> <label id="gender-error" class="error" for="gender"></label>

				</div>

			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="qualification">Qualification:</label>
				<div class="col-sm-10">


					<select class="form-control" name="qualification" id="qualification">
						<option value="">Select One</option>
						<option value="B.tech">B.tech</option>
						<option value="M.tech">M.tech</option>
						<option value="mca">mca</option>
						<option value="Bca">Bca</option>
					</select>

				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2">Skills:</label>
				<div class="col-sm-10">

					<div class="checkbox">
						<label><input type="checkbox" value="php" name="skill[]"  >php</label>

					</div>
					<div class="checkbox">
						<label><input type="checkbox" value="mysql" name="skill[]"  >mysql</label>
					</div>

					<label><input type="checkbox" value="jquery" name="skill[]"  >jquery</label>
					<label><input type="checkbox" value="bootstrap" name="skill[]"  >bootstrap</label>

					<br/><label id="skill[]-error" class="error" for="skill[]"></label>
				</div>
			</div>

			<div class="form-group">
				<label class="control-label col-sm-2" for="description">Description:</label>
				<div class="col-sm-10">
					<textarea class="form-control" rows="5" name="description" id="description" placeholder="description" maxlength="170"></textarea>
				</div>

			</div>


			<div class="form-group">
				<div class="col-sm-offset-2 col-sm-1">
					<button type="submit" class="btn btn-default" name="submit"  id="submit" >Submit</button>
				</div>
				<div class="">
					<button type="reset" class="btn" id="reset">Reset</button>
				</div>
			</div>



		</form>

	</div>




</body>

<script type="text/javascript">
	$( document ).ready( function () {

        $( "form" ).validate( {

			rules: {

				fullname: {
					required: true,
					minlength: 2
				},

				password: {
					pwcheck0: true,
					pwcheck1: true,
					pwcheck2: true,
					pwcheck3: true,
					required: true,
					pwcheck4: true,
					minlength: 8
				},

				email: {
					required: true,
					email: true
				},

				phone: {
					required: true,
					digits: true,
					minlength: 10
				},

				re_password: {
					required: true,
					equalTo: "#password"
				},

				resume: {
					required: true
				},

				gender: {
					required: true
				},

				qualification: {
					required: true,
				},



				description: {
					required: true,
					rangelength: [ 50, 180 ]
				},

				"skill[]": {
					required: true,
					minlength: 2
				},
			},


			messages: {

				fullname: {
					required: "name is required",
					minlength: "2 charecters atleast"
				},

				password: {
					required: "password is required",
					pwcheck0: "password must cotain no white space",
					pwcheck1: "password must cotain one lowercase letter",
					pwcheck2: "password must cotain one uppercase letter",
					pwcheck3: "password must cotain one number",
					pwcheck4: "password must cotain one special charecter",
					minlength: "8 charecters atleast",



				},

				"skill[]": {
					minlength: "select atleast two skills"
				},



			}


		} );

		$.validator.addMethod( "pwcheck1", function ( value ) {
			return /[a-z]+/.test( value );
		} );

		$.validator.addMethod( "pwcheck2", function ( value ) {
			return /[A-Z]+/.test( value );
		} );


		$.validator.addMethod( "pwcheck3", function ( value ) {
			return /[0-9]+/.test( value )
		} );


		$.validator.addMethod( "pwcheck4", function ( value ) {
			return /[\W]+/.test( value )
		} );


		$.validator.addMethod( "pwcheck0", function ( value ) {
			return /^[\S]+$/.test( value )
		} );


		/*// To check all
						$.validator.addMethod("pwcheck", function(value) {
		    return /[A-Z]+/.test(value) && /[a-z]+/.test(value) && 
		    /[\d\W]+/.test(value) && /\S{7,}/.test(value);
		});	*/

$("form").submit(function(event){

event.preventDefault();
	
//var srlz = $(this).serializeArray();
var formData = new FormData(this);
	
$.ajax({
url: "ajax_oprtn.php",	
method: "POST",	
data: formData,	
contentType: false,	
processData: false,	
success: function(data){
alert(data);}
});

	/*
$("form#data").submit(function() {

    var formData = new FormData(this);

    $.post($(this).attr("action"), formData, function(data) {
        alert(data);
    });

    return false;
});
	
	*/
	
	
});
		
		

	
	} ); 
</script>


</html>