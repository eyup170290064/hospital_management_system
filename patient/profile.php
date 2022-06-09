<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Patient Profile</title>


</head>
<body>
    
    <?php
        include("../include/header.php");
        include("../include/connection.php");
    ?>

    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div id="side" class="col-md-2">

                    <?php

                        include("sidenav.php");
                        
                        $patient = $_SESSION['patient'];

                        $query = "SELECT * FROM patient WHERE username='$patient'";

                        $res = mysqli_query($connect,$query);
                          
                        $row = mysqli_fetch_array($res);


                         
                    ?>
                </div>
                <div class="col-md-10">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">

                                <h5>My Profile</h5>

                                <?php
                                    if(isset($_POST['upload'])){

                                        $img = $_FILES['img']['name'];

                                        if(empty($img)){

                                        }else{
                                            $query = "UPDATE patient SET profile='$img' WHERE username='$patient'";

                                            $res = mysqli_query($connect,$query);

                                            if($res){
                                                move_uploaded_file($_FILES['img']['tmp_name'],"img/$img");
                                            }

                                        }
                                    }
                                ?>

                                <form action="" method="post" enctype="multipart/form-data">

                                    <?php
                                        
                                        echo "<img src='img/".$row['profile']."' class='col-md-12' style='height:250px;'>";
                                    ?>

                                    <input type="file" name="img" class="form-control my-2">
                                    <input type="submit" name="upload" class="btn btn-info" value="Update Profile">

                                </form>

                                <table class="table table-bordered">
                                    <tr>
                                        <th colspan="2" class="text-center">My Details</th>
                                    </tr>
                                    <tr>
                                        <td>Firstname</td>
                                        <td><?php echo $row['firstname']; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Surname</td>
                                        <td><?php echo $row['surname'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Username</td>
                                        <td><?php echo $row['username'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td><?php echo $row['email'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Phone Number</td>
                                        <td><?php echo "+".$row['phone'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Gender</td>
                                        <td><?php echo $row['gender'];?></td>
                                    </tr>
                                    <tr>
                                        <td>Country</td>
                                        <td><?php echo $row['country'];?></td>
                                    </tr>

                                </table>
                            </div>
                            <div class="col-md-6">

                                  <h5 class="text-center">Change Username</h5>
                                      
                                      <?php

                                            if(isset($_POST['update'])){

                                                $uname = $_POST['uname'];

                                                if(empty($uname)){

                                                }else{
                                                    $query = "UPDATE patient SET username='$uname' WHERE username='$patient'";

                                                    $res = mysqli_query($connect,$query);

                                                    if($res){

                                                        $_SESSION['patient'] = $uname;

                                                    }
                                                }
                                            } 
                                      ?>
                                  <form action="" method="post">
                                      <label for="">Enter Username</label>
                                      <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                                      <input type="submit" name="update" class="btn btn-info my-2" value="Update Username">
                                  </form>
                                       
                                      <?php
                                            if(isset($_POST['change'])) {

                                                $old = $_POST['old_pass'];
                                                $new = $_POST['new_pass'];
                                                $con = $_POST['con_pass'];

                                                $q = "SELECT * FROM patient WHERE username='$patient'";

                                                $re = mysqli_query($connect,$q);

                                                $row = mysqli_fetch_array($re);

                                                if(empty($old)){

                                                    echo "<script>alert('Enter old password!')</script>";
                                                }else if(empty($new)){

                                                    echo "<script>alert('Enter new password!')</script>";
                                                }else if($con != $new){

                                                    echo "<script>alert('Both passwords do not match!')</script>";
                                                
                                                }else if($old != $row['password']){

                                                    echo "<script>alert('Check the old password! Did you forget it?')</script>";
                                                
                                                }else{

                                                    $query = "UPDATE patient SET password='$new' WHERE username='$patient'";

                                                    mysqli_query($connect,$query);

                                                }


                                          }
                                       ?>
                                  <h5 class="my-4 text-center">Change Password</h5>
                                  <form action="" method="post">
                                      <label for="">Old Password</label>
                                      <input type="password" name="old_pass" class="form-control" autocomplete="off" placeholder="Enter Old Password">
                                      <label for="">New Password</label>
                                      <input type="password" name="new_pass" class="form-control" autocomplete="off" placeholder="Enter New Password">
                                      <label for="">Confirm Password</label>
                                      <input type="password" name="con_pass" class="form-control" autocomplete="off" placeholder="Confirm Password">

                                      <input type="submit" name="change" class="btn btn-info my-2" value="Change Password">
                                  </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>