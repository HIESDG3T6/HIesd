<?php
    $error = '';
    $userid = '';
    $password ='';

    if ( isset($_GET['error']) ) {
        $error = $_GET['error'];
    } elseif ( isset($_POST['userid']) && isset($_POST['password']) ) {
        $userid = $_POST['userid'];
        $password = $_POST['password'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Patient Panel </title>
<!-- for-mobile-apps -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
	</script>
	
	
	<!-- css files -->
	<link href="../css/css_slider.css" type="text/css" rel="stylesheet" media="all"><!-- slider css -->
    <link href="../css/bootstrap.css" rel='stylesheet' type='text/css' /><!-- bootstrap css -->
    <link href="../css/style.css" rel='stylesheet' type='text/css' /><!-- custom css -->
   
	<!-- //css files -->
	
	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext,greek,greek-ext,latin-ext,vietnamese" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800&amp;subset=latin-ext" rel="stylesheet">
    <!-- //google fonts -->
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script 
				src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
				
				<script
				src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
				integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
				crossorigin="anonymous"></script>
	
</head>
<body>
<section class="mail pt-lg-5 pt-4">
	<div class="container pt-lg-5">
        <h2 class="heading text-center mb-sm-5 mb-4">Welcome to Health Insurance!</h2>
        <div class="row agileinfo_mail_grids">
			<div class="col-lg-8 agileinfo_mail_grid_right">
                <form method="post" action="login.php">
					<div class="row">
						<div class="col-md-6 wthree_contact_left_grid pr-md-0">
							<div class="form-group">
								<input type="text" name="userid" id="userid" class="form-control" placeholder="User Name" >
							</div>
                        </div>
                        <div class="col-md-6 wthree_contact_left_grid">
							<div class="form-group">
                                <input type="text" name="password" id="password" class="form-control" placeholder="Password" >
							</div>
						</div>
                        <div class="col-md-6 wthree_contact_left_grid pr-md-0">
							<div class="form-group">
                                <button type="submit" id="searchBtn" class="btn">Submit</button>
							</div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

        <script>
            $('#searchBtn').click(async(event) => {  
                event.preventDefault();
                var userid = "<?php echo $userid; ?>";
                var password = "<?php echo $password; ?>";
                console.log(userid);

                var serviceURL = "http://localhost:5000/patient/" + userid;
                try {
                    const response =
                    await fetch(
                    serviceURL, { method: 'GET' }
                    );
                    const data = await response.json();

                    // array or array.length are falsy
                    if (response.ok) {
                        var returnedPassword = data.password;
                        if (password == returnedPassword){
                            $_SESSION['userid'] = $userid; 
                            window.location.replace("http://localhost/patient/index.html");
                        }
                        else{
                            alert('Username or Password is wrong.')
                        }
                    }
                }
                catch{

                }
            });
        </script>
    </body>
</html>

<?php
    if(isset($error)){
        echo '<div align="center" span style="color:#FF0000;" ><b>' . $error ." </div>";
    }
?>