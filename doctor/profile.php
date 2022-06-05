<?php

    session_start();
?>

<!DOCTYPE html>
<html>
<head>
 
    <title>Doctors Profile Page</title>
</head>
<body>
    
    <?php

        include("../include/header.php");
    ?>
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-2">
                    
                    <?php
                        include("sidenav.php");
                        include("../include/connection.php");
                    ?>
                </div>
                <div class="col-md-10">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-6">
                                    
                                    <?php

                                        $doc = $_SESSION['doctor'];

                                        $query = "SELECT * FROM doctors WHERE username='$doc'";

                                        $res = mysqli_query($connect,$query);

                                        $row = mysqli_fetch_array($res);

                                    ?>

                                    <form method="post">

                                        <?php
                                            echo "<img src = 'img/".$row['profile']."' style='height: 250px;' class='col-md-12 my-3'>";
                                        ?>

                                        <input type="file" name="img" class="form-control my-1">
                                        <input type="submit" name = "upload" class="btn btn-success" value="Update Profile">

                                    </form>
                                    
                                    <div class="my-3">
                                        <table class="table table-bordered">
                                            <tr>
                                                <th class="text-center">Details</th>
                                            </tr>
                                            <tr>
                                                <td>Firstname</td>
                                                <td><?php echo $row['firstname']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Surname</td>
                                                <td><?php echo $row['surname']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Username</td>
                                                <td><?php echo $row['username']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email</td>
                                                <td><?php echo $row['email']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Phone No</td>
                                                <td><?php echo $row['phone']; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Gender</td>
                                                <td><?php echo $row['gender']; ?></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-center my2">Change Username</h5>
                                    <form method="post">
                                        <label>Change Username</label>
                                        <input type="text" name="uname" class="form-control" autocomplete="off" placeholder="Enter Username">
                                        <br>
                                        <input type="submit" name="change_uname" class="btn btn-success" value="Change Username" >
                                    </form>
                                    <br><br>
                                    <h5 class="text-center my-2">Change Password</h5>
                                    <form method="post">
                                        <div class="form-group">
                                            <label>Old Password</label>
                                            <input type="text" name="old_pass" class="form-control" autocomplete="off" placeholder="Enter Old Password">
                                        </div>
                                        <div class="form-group">
                                            <label>New Password</label>
                                            <input type="text" name="new_pass" class="form-control" autocomplete="off" placeholder="Enter New Password">
                                        </div>
                                        <div class="form-group">
                                            <label>Confirm Password</label>
                                            <input type="text" name="con_pass" class="form-control" autocomplete="off" placeholder="Confirm Password">
                                        </div>
                                        <input type="submit" name="change_pass" class="btn btn-info" value="Change Password">  
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>