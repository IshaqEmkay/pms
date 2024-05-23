<?php
include('includes/dbconnection.php');
error_reporting(0);
if(isset($_POST['submit']))
  {

    $target="uploads/".basename($_FILES['image']['name']);
    $image=$_FILES['image']['name'];
    $image_tmp=$_FILES['image']['tmp_name'];



        if(move_uploaded_file($image_tmp, $target))
        {

            // echo "<script>alert('image Successfully Added');</script>";

        }
        else{

            // echo "<script>alert('image failed to add');</script>";



        }

    $FName=$_POST['FirstName'];
    $LName=$_POST['LastName'];
    $gender=$_POST['gender'];
    $Email=$_POST['Email'];
    $phone=$_POST['phone'];
    $designation=$_POST['designation'];
    // $cv=$_POST['image'];
    //$RPassword=$_POST['RepeatPassword'];
    $ret=mysqli_query($con, "select email from empapply where email='$Email'");
    $result=mysqli_fetch_array($ret);
    if($result>0){
$msg="This email already associated with another account";
    }
    else{
        $ret1=mysqli_query($con, "select phone from empapply where phone='$phone'");
        $result1=mysqli_fetch_array($ret1);
        if($result1>0){
    $msg="This phone number already associated with another account";
        }
        else{
    $query=mysqli_query($con, "insert into empapply(fname, lname, gender, email, phone, designation, cv, status) value('$FName', '$LName', '$gender', '$Email', '$phone', '$designation', '$image', 'Pending' )");
      if ($query) {
    $msg="You have successfully Applied";
  }
  else
    {
      $msg="Something Went Wrong. Please try again";
    }  }
    

  }
}
  ?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Alliance Employee portal</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
<script type="text/javascript">
function checkpass()
{
if(document.register.Password.value!=document.register.RepeatPassword.value)
{
alert('New Password and Confirm Password field does not match');
document.register.RepeatPassword();
return false;
}
return true;
} 

</script>
</head>

<body class="bg-gradient-primary">
 

  <div class="container">
  
    <h3 align="center" style="color: black; padding-top: 1%">Job Application Portal</h3>

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5"><div align="right"><a href="index.php" class="btn btn-info" >HOME</a></div>
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Apply Now</h1>
              </div>
              <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>
              <form class="user" name="register" method="post" onsubmit="return checkpass();" enctype="multipart/form-data">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control form-control-user" id="FirstName" name="FirstName" placeholder="First Name" pattern="[A-Za-z]+" required="true">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" class="form-control form-control-user" id="LastName" name="LastName" placeholder="Last Name" pattern="[A-Za-z]+" required="true">
                  </div>
                </div>
                 <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="" name="gender" placeholder="Gender" pattern="[A-Za-z]+" required="true">
                </div>
                <div class="form-group">
                  <input type="email" class="form-control form-control-user" id="" name="Email" placeholder="Email Address" required="true">
                </div>
                <div class="form-group">
                <input type="text" class="form-control form-control-user" id="" name="phone" placeholder="Contact Number" required="true">
                </div>
                <div class="form-group">
                  <input type="text" class="form-control form-control-user" id="" name="designation" placeholder="Applying for" required="true">
                </div>
                  <div class="form-group">
                  <label for="">Upload CV</label>
                  <input type="file" name="image" id="image"  class="form-control" placeholder="UPLOAD CV" onfocus="this.placeholder = ''" onblur="this.placeholder = 'CV'">
                  </div>
                


              <input type="submit" name="submit" value="Apply Now" class="btn btn-primary btn-user btn-block">
                
                
                </form>
                <hr>
             
              <div class="text-center">
                <!-- <a class="small" href="loginerms.php">Already have an account? Login!</a> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>

</html>
