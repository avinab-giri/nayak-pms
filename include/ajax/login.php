<?php

include ('../constant.php');
include (SERVER_INCLUDE_PATH.'db.php');
include (SERVER_INCLUDE_PATH.'function.php');

if(isset($_POST['type'])){
    $type = $_POST['type'];
}else{
    $type = '';
}


if($type == 'checkLogin'){
    $username = $_POST['username'];
    $password = $_POST['pass'];
    $submit = $_POST['submit'];
    $ipAddres = get_IP_address();
    
    if(!empty($username) || !empty($password)){
        
        $sql = mysqli_query($conDB, "select * from hoteluser where ( userId='$username' OR email = '$username' OR phone = '$username') ");
            if(mysqli_num_rows($sql)>0){
            $userArray = mysqli_fetch_assoc($sql);
            $getUserId = $userArray['id'];
            $userBlock = $userArray['block'];

            if($userBlock == 1){
                $sql = mysqli_query($conDB, "select * from hoteluser where ( userId='$username' OR email = '$username' OR phone = '$username') and password = '$password'");
            
                if($password != ''){
                    if(mysqli_num_rows($sql)>0){
                        $sql = mysqli_query($conDB, "select * from hoteluser where ( userId='$username' OR email = '$username' OR phone = '$username') and password = '$password' and status='1'");
                        if(mysqli_num_rows($sql) > 0){
                            $row = mysqli_fetch_assoc($sql);
                            $id = $row['id'];
                            $hotelMainId = $row['hotelMainId'];
                            $hotelId = $row['hotelId'];
                            
                            $_SESSION['ADMIN_ID']= $id;
                            $_SESSION['HOTEL_ID']= $hotelId ;
                            
                            $alert = "<b>$username</b> username is login.";
                            
                            $addBy = dataAddBy();
                            setActivityFeed($_SESSION['HOTEL_ID'],'1','','','','',$ipAddres,'success',$alert,$addBy);    
                              $query = mysqli_query($conDB,"SELECT status from hotel where hCode = '$hotelId'" );
                              $row2 = mysqli_fetch_assoc($query);
                              $status = $row2['status'];
                              if($status != 1){
                                $_SESSION['active']='true';
                                $data = [
                                    'error'=>'yes',
                                    'target'=>'no',
                                    'msg'=>'Your account is Deactivate!'
                                ];
                                echo json_encode($data);
                                die(); 
                              }
    
                            $data = [
                                'error'=>'no',
                                'target'=>'success',
                                'msg'=>''
                            ];
            
                        }else{
                            setActivityFeed('','1','','','','',$ipAddres,'failed','Deactivate account','');
                            $data = [
                                'error'=>'yes',
                                'target'=>'no',
                                'msg'=>'Deactivate your account!'
                            ];
                        }
                    }else{
                        setActivityFeed('','1','','','','',$ipAddres,'failed','Password not match','');
                        $activityArray = getActiveFeed('',1, '','', '' ,'', date('Y-m-d'),$ipAddres);
                        $attent = count($activityArray);
                        $remainAttent = 3 - $attent;
    
                        
                        $msg = "Invalid credentials. You are left with $remainAttent more attempt";
    
                        if($remainAttent <= 0){
                            mysqli_query($conDB, "update hoteluser set block = '0' where id = '$getUserId'");
                            $msg = "Your account has been blocked, Contact to support team.";
                        }
    
                        $data = [
                            'error'=>'yes',
                            'target'=>'password',
                            'msg'=>$msg,
                        ];
                    }
    
    
                }
            }else{
                setActivityFeed('','1','','','','',$ipAddres,'failed','User is blocked.','');
                $data = [
                    'error'=>'yes',
                    'target'=>'username',
                    'msg'=>'User is blocked, Contact to support team.'
                ];
            }            

        }else{
            setActivityFeed('','1','','','','',$ipAddres,'failed','Username not exist','');
            $data = [
                'error'=>'yes',
                'target'=>'username',
                'msg'=>'Username not exist!'
            ];
        }

    }else{
        $data = [
            'error'=>'yes',
            'target'=>'no',
            'msg'=>'All Fields Are Required'
        ];
    }




    echo json_encode($data);
}

if($type == 'checkEmail'){
    $username = $_POST['email'];
    $sql = mysqli_query($conDB, "select * from hoteluser where ( userId='$username' OR email = '$username' OR phone = '$username') ");
    if(mysqli_num_rows($sql) > 0){
        $row = mysqli_fetch_assoc($sql);
        $emailId = $row['email'];
        $name = $row['name'];
        $forgotOtp = rand(100000,999999);
        $_SESSION['FOTP'] = $forgotOtp;
        $html = "Your OTP is $forgotOtp";
        $subject = "Forgot Password Verification.";
        send_email($emailId,$name,$emailId,$emailId,$html,$subject);       
        $data = [
            'error'=>'no',
        ];
    }else{
        $data = [
            'error'=>'yes',
        ];
    }

    echo json_encode($data);
}


if($type == 'checkotp'){
    $otp = $_POST['otp'];
    $email = $_POST['email'];
    $_SESSION['forgotPswEmail']=$email;
    $existOtp = $_SESSION['FOTP'];
    $html = '<div class="form-group">

                <div class="input-group mb-2"> 
                    <input type="password" id="psw" name="psw" placeholder="Enter Password" class="form-control" required>
                </div>

                <div class="input-group">
                    <input type="password" id="cpsw" name="cpsw" placeholder="Enter Confirm Password" class="form-control" required>
                </div>

            </div>

            <div class="form-group">
                <input id="changePsw" name="confirmSubmit" class="btn btn-lg btn-primary btn-block" value="Change Password" type="submit">
            </div>';
    if($otp == $existOtp){
        $data = [
            'error'=>'no',
            'html'=>$html
        ];
    }else{
        $data = [
            'error'=>'no',
            'html'=>''
        ];
    }

    echo json_encode($data);
}


if($type == 'changePsw'){
    $psw = $_POST['psw'];
    $email = $_SESSION['forgotPswEmail'];

    $sql = "update hoteluser set password = '$psw' where email = '$email'";
    if(mysqli_query($conDB, $sql)){
        $data = [
            'error'=>'no'
        ];
    }
    

    echo json_encode($data);
}



?>