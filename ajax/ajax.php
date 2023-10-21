<?php
header('content-type:image/jpeg');
session_start();
require 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function smtp_mailer($to, $subject, $msg)
{
    $mail = new PHPMailer(true);
    //$mail->SMTPDebug=3;
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'type';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = "587";
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    $mail->Username = "alvfcoc@gmail.com";
    $mail->Password = 'xnyiqzjjavnlkhwp';
    $mail->SetFrom("alvfcoc@gmail.com");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if (!$mail->Send()) {
        return 0;
    } else {
        return 1;
    }
}

function validateimage()
{
    $target_dir = '../images/';
    $result = array();

    // Check if the file was uploaded without errors
    if (isset($_FILES['imgfile']) && $_FILES['imgfile']['error'] === UPLOAD_ERR_OK) {
        $target_file = $target_dir . basename($_FILES['imgfile']['name']);
        $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filesize = $_FILES['imgfile']['size'];

        // Check file type
        if ($image_type != 'jpg' && $image_type != 'jpeg' && $image_type != 'png') {
            $result['status'] = 2; // file type is not PNG, JPG, or JPEG
            $result['message'] = 'File type is not PNG, JPG, or JPEG';
        } elseif ($filesize > 512000) {
            $result['status'] = 3; // file size is greater than 5 MB
            $result['message'] = 'File is too large';
        } else {
            $upload_path = $target_dir . uniqid() . '.' . $image_type;
            $result['status'] = 1; // file is valid
            $result['message'] = 'File is valid';
        }
    } else {
        $result['status'] = 0; // no file was uploaded or there was an error
        $result['message'] = 'No file was uploaded';
    }

    echo json_encode($result);
}





$flag = $_POST['flag'];


//login request 
if ($flag == 1) {
    $uid = mysqli_escape_string($con, $_POST['uid']);
    $upass = mysqli_escape_string($con, $_POST['upass']);

    $query = 'select utype from usertb where uid = ' . $uid . ' and upass = "' . $upass . '"';

    // echo $query;

    $res = mysqli_query($con, $query);

    if (mysqli_num_rows($res) > 0) {
        $temp = mysqli_fetch_assoc($res);
        if ($temp['utype'] == 'admin') {
            echo 'adminsuc.php';
        } else {
            echo 'chat.php?uid=' . $uid . '';
        }
    } else {
        echo "invalid";
    }
} elseif ($flag == 2) { //admin
    // echo"false"; 
    $upass = mysqli_escape_string($con, $_POST['upass']);
    $query = 'select upass from usertb where uid=11011 and upass="' . $upass . '"';

    $res = mysqli_query($con, $query);

    if (mysqli_num_rows($res) > 0) {
        echo "true";
    }
} elseif ($flag == 3) { //insert data for user
    $uname = mysqli_escape_string($con, $_POST['uname']);
    $uemail = mysqli_escape_string($con, $_POST['uemail']);
    $upass = mysqli_escape_string($con, $_POST['upass']);

    $flag = false; // Flag variable to track execution

    if (!empty($_FILES['imgfile']['name'])) {
        $target_dir = '../images/';
        $target_file = $target_dir . basename($_FILES['imgfile']['name']);
        $image_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $filesize = $_FILES['imgfile']['size'];
        $uniqueid = uniqid();
        $upload_path = $target_dir . $uniqueid . '.' . $image_type;

        if (move_uploaded_file($_FILES['imgfile']['tmp_name'], $upload_path)) {
            $path = 'images/' . $uniqueid . '.' . $image_type;

            $query = "INSERT INTO `usertb`(`uname`, `upass`, `utype`, `uemail`,`uimage`) VALUES ('$uname','$upass','user','$uemail','$path')";

            $res = mysqli_query($con, $query);

            $act1 = mysqli_escape_string($con, $_POST['act1']);
            $act2 = mysqli_escape_string($con, $_POST['act2']);
            $act3 = mysqli_escape_string($con, $_POST['act3']);

            $query = 'select aid from activitytb where aname="' . $act1 . '"';

            $res = mysqli_query($con, $query);

            $temp = mysqli_fetch_assoc($res);

            $uid1 = $temp['aid'];

            $query = 'select aid from activitytb where aname="' . $act2 . '"';

            $res = mysqli_query($con, $query);

            $temp = mysqli_fetch_assoc($res);

            $uid2 = $temp['aid'];

            $query = 'select aid from activitytb where aname="' . $act3 . '"';

            $res = mysqli_query($con, $query);

            $temp = mysqli_fetch_assoc($res);

            $uid3 = $temp['aid'];

            $query = 'select uid from usertb order by uid desc';

            $res = mysqli_query($con, $query);

            $temp = mysqli_fetch_assoc($res);

            $uid = $temp["uid"];

            $query = "INSERT INTO `useracttb`(`uid`, `aid1`, `aid2`, `aid3`) VALUES ($uid,$uid1,$uid2,$uid3)";

            $res = mysqli_query($con, $query);

            $flag = true; // Set the flag to true after execution
        }
    }

    if ($flag) {
        echo "true";
    }
} elseif ($flag == 4) {
    $query = 'select * from activitytb';

    $res = mysqli_query($con, $query);

    if (mysqli_num_rows($res) > 0) {
        $try = array();
        while ($temp = mysqli_fetch_assoc($res)) {
            array_push($try, $temp['aname']);
        }
        $response = json_encode($try);
        echo $response;
    }
} elseif ($flag == 5) {
    $query = 'select * from usertb where utype="user"';

    $res = mysqli_query($con, $query);

    while ($temp = mysqli_fetch_assoc($res)) {

        $uid = $temp["uid"];

        $iquery1 = 'select * from useracttb where uid=' . $uid . '';

        $ires1 = mysqli_query($con, $iquery1);

        $iarr = array();

        $itemp1 = mysqli_fetch_assoc($ires1);

        array_push($iarr, $itemp1["aid1"]);
        array_push($iarr, $itemp1["aid2"]);
        array_push($iarr, $itemp1["aid3"]);


        //Activity - 1 
        $iquery2 = 'select aname from activitytb where aid=' . $iarr[0] . '';

        $ires2 = mysqli_query($con, $iquery2);

        $itemp2 = mysqli_fetch_assoc($ires2);

        //Activity - 2
        $iquery3 = 'select aname from activitytb where aid=' . $iarr[1] . '';

        $ires3 = mysqli_query($con, $iquery3);

        $itemp3 = mysqli_fetch_assoc($ires3);

        //Activity - 3
        $iquery4 = 'select aname from activitytb where aid=' . $iarr[2] . '';

        $ires4 = mysqli_query($con, $iquery4);

        $itemp4 = mysqli_fetch_assoc($ires4);


        echo '<div class="col">
                <div class="card m-3">
                    <div class="card-header">
                        <img src="images/defcard.jpg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                    <!--<h5 class="card-title">Card title</h5>-->
                        <p class="card-text" align="center">User Id : ' . $temp["uid"] . '</p>
                        <p class="card-text" align="center">User Name : ' . $temp["uname"] . '</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text" align="center">Interest 1 : ' . $itemp2["aname"] . '</p>
                        <p class="card-text" align="center">Interest 2 : ' . $itemp3["aname"] . '</p>
                        <p class="card-text" align="center">Interest 3 : ' . $itemp4["aname"] . '</p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="button" onclick="updateacc(' . $temp["uid"] . ')">Update</button>
                            <button class="btn btn-danger" type="button" onclick="del(' . $temp["uid"] . ')">Delete</button>
                        </div>
                    </div>
                </div>
            </div>';
    }
} elseif ($flag == 6) {

    $uid = mysqli_escape_string($con, $_POST['uid']);

    $query='DELETE FROM `useracttb` WHERE uid='.$uid.'';    

    $res = mysqli_query($con, $query);

    $query = 'DELETE FROM `usertb` WHERE uid=' . $uid . '';

    $res = mysqli_query($con, $query);

    if (!$res) {
        echo 'fasle';
    } else {
        echo 'true';
    }
} elseif ($flag == 7) { //Admin Search

    $uname = mysqli_escape_string($con, $_POST['uname']);

    $query = 'select * from usertb where uname like "' . $uname . '%" and utype="user" order by uid asc';

    // echo $query;

    $res = mysqli_query($con, $query);

    while ($temp = mysqli_fetch_assoc($res)) {

        $uid = $temp["uid"];

        $iquery1 = 'select * from useracttb where uid=' . $uid . '';

        $ires1 = mysqli_query($con, $iquery1);

        $iarr = array();

        $itemp1 = mysqli_fetch_assoc($ires1);

        array_push($iarr, $itemp1["aid1"]);
        array_push($iarr, $itemp1["aid2"]);
        array_push($iarr, $itemp1["aid3"]);


        //Activity - 1 
        $iquery2 = 'select aname from activitytb where aid=' . $iarr[0] . '';

        $ires2 = mysqli_query($con, $iquery2);

        $itemp2 = mysqli_fetch_assoc($ires2);

        //Activity - 2
        $iquery3 = 'select aname from activitytb where aid=' . $iarr[1] . '';

        $ires3 = mysqli_query($con, $iquery3);

        $itemp3 = mysqli_fetch_assoc($ires3);

        //Activity - 3
        $iquery4 = 'select aname from activitytb where aid=' . $iarr[2] . '';

        $ires4 = mysqli_query($con, $iquery4);

        $itemp4 = mysqli_fetch_assoc($ires4);


        echo '<div class="col">
                <div class="card m-3">
                    <div class="card-header">
                        <img src="images/defcard.jpg" class="card-img-top" alt="...">
                    </div>
                    <div class="card-body">
                    <!--<h5 class="card-title">Card title</h5>-->
                        <p class="card-text" align="center">User Id : ' . $temp["uid"] . '</p>
                        <p class="card-text" align="center">User Name : ' . $temp["uname"] . '</p>
                    </div>
                    <div class="card-footer">
                        <p class="card-text" align="center">Interest 1 : ' . $itemp2["aname"] . '</p>
                        <p class="card-text" align="center">Interest 2 : ' . $itemp3["aname"] . '</p>
                        <p class="card-text" align="center">Interest 3 : ' . $itemp4["aname"] . '</p>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="button" onclick="updateacc(' . $temp["uid"] . ')">Update</button>
                            <button class="btn btn-danger" type="button" onclick="del(' . $temp["uid"] . ')">Delete</button>
                        </div>
                    </div>
                </div>
            </div>';
    }
} elseif ($flag == 8) { //User Search


    $ucategory = mysqli_escape_string($con, $_POST['ucategory']);
    $uname = mysqli_escape_string($con, $_POST['uname']);
    $self = mysqli_escape_string($con, $_POST['self']);



    $query = 'select * from usertb where  utype="user" and uid in(select uid from useracttb where aid1 in(select aid from activitytb where aname like "' . $ucategory . '%") and uid <> ' . $self . '  and uname like "' . $uname . '%") or uid in(select uid from useracttb where aid2 in(select aid from activitytb where aname like "' . $ucategory . '%") and uid <> ' . $self . '  and uname like "' . $uname . '%" ) or uid in(select uid from useracttb where aid3 in(select aid from activitytb where aname like "' . $ucategory . '%") and uid <> ' . $self . '  and uname like "' . $uname . '%") order by uid asc;';


    // echo $query;

    $res = mysqli_query($con, $query);

    while ($temp = mysqli_fetch_assoc($res)) {

        $uid = $temp["uid"];

        $iquery1 = 'select * from useracttb where uid=' . $uid . '';
        // echo $iquery1;    
        $ires1 = mysqli_query($con, $iquery1);

        $iarr = array();

        $itemp1 = mysqli_fetch_assoc($ires1);

        array_push($iarr, $itemp1["aid1"]);
        array_push($iarr, $itemp1["aid2"]);
        array_push($iarr, $itemp1["aid3"]);


        //Activity - 1 
        $iquery2 = 'select aname from activitytb where aid=' . $iarr[0] . '';

        $ires2 = mysqli_query($con, $iquery2);

        $itemp2 = mysqli_fetch_assoc($ires2);

        //Activity - 2
        $iquery3 = 'select aname from activitytb where aid=' . $iarr[1] . '';

        $ires3 = mysqli_query($con, $iquery3);

        $itemp3 = mysqli_fetch_assoc($ires3);

        //Activity - 3
        $iquery4 = 'select aname from activitytb where aid=' . $iarr[2] . '';

        $ires4 = mysqli_query($con, $iquery4);

        $itemp4 = mysqli_fetch_assoc($ires4);


        echo '<li class="clearfix" onclick=chat(' . $temp['uid'] . ')>
                    <img src="' . $temp['uimage'] . '" alt="avatar">
                    <div class="about">
                        <div class="name">' . $temp['uname'] . '</div>
                        <div class="status">' . $itemp2['aname'] . ',' . $itemp3['aname'] . ',' . $itemp4['aname'] . '</div>
                    </div>
                </li>';
    }
} else if ($flag == 9) //Request for captcha
{
    // genCaptcha();

    $tArr = array('captcha' => $_SESSION['captcha']);

    $response = json_encode($tArr);

    echo $response;
} else if ($flag == 10) {
    $query = 'select * from activitytb';

    $res = mysqli_query($con, $query);

    while ($temp = mysqli_fetch_assoc($res)) {
        echo '<p class="card-text">' . $temp["aname"] . '</p>';
    }
} else if ($flag == 11) {
    $txtcat = mysqli_escape_string($con, $_POST['txtcat']);

    $query = "INSERT INTO `activitytb`(aname) VALUES ('$txtcat')";

    $res = mysqli_query($con, $query);

    if ($res) {
        echo "true";
    } else {
        echo "fasle";
    }
} else if ($flag == 12) {

    $uid = $_POST['uid'];

    $query = 'SELECT * FROM usertb WHERE uid="' . $uid . '"';
    $res = mysqli_query($con, $query);
    $temp = mysqli_fetch_assoc($res);

    $iquery1 = 'SELECT * FROM useracttb WHERE uid=' . $uid;
    $ires1 = mysqli_query($con, $iquery1);
    $itemp1 = mysqli_fetch_assoc($ires1);

    $iarr = array(
        $itemp1["aid1"],
        $itemp1["aid2"],
        $itemp1["aid3"]
    );

    $iquery2 = 'SELECT aname FROM activitytb WHERE aid=' . $iarr[0];
    $ires2 = mysqli_query($con, $iquery2);
    $itemp2 = mysqli_fetch_assoc($ires2);

    $iquery3 = 'SELECT aname FROM activitytb WHERE aid=' . $iarr[1];
    $ires3 = mysqli_query($con, $iquery3);
    $itemp3 = mysqli_fetch_assoc($ires3);

    $iquery4 = 'SELECT aname FROM activitytb WHERE aid=' . $iarr[2];
    $ires4 = mysqli_query($con, $iquery4);
    $itemp4 = mysqli_fetch_assoc($ires4);

    $temparr = array(
        'uname' => $temp['uname'],
        'uemail' => $temp['uemail'],
        'upass' => $temp['upass'],
        'a1' => $itemp2['aname'],
        'a2' => $itemp3['aname'],
        'a3' => $itemp4['aname']
    );

    $olddata = json_encode($temparr);

    echo $olddata;
} else if ($flag == 13) {
    $uid = $_POST['uid'];
    $uname = mysqli_escape_string($con, $_POST['uname']);
    $uemail = mysqli_escape_string($con, $_POST['uemail']);
    $upass = mysqli_escape_string($con, $_POST['upass']);

    $query = "UPDATE `usertb` SET `uname`='$uname',`uemail`='$uemail',`upass`='$upass'  WHERE uid=$uid";

    $res1 = mysqli_query($con, $query);

    $act1 = mysqli_escape_string($con, $_POST['act1']);
    $act2 = mysqli_escape_string($con, $_POST['act2']);
    $act3 = mysqli_escape_string($con, $_POST['act3']);

    $iquery1 = 'select * from activitytb where aname="' . $act1 . '"';

    $ires1 = mysqli_query($con, $iquery1);

    $itemp1 = mysqli_fetch_assoc($ires1);


    $iquery2 = 'select * from activitytb where aname="' . $act2 . '"';

    $ires2 = mysqli_query($con, $iquery2);

    $itemp2 = mysqli_fetch_assoc($ires2);


    $iquery3 = 'select * from activitytb where aname="' . $act3 . '"';

    $ires3 = mysqli_query($con, $iquery3);

    $itemp3 = mysqli_fetch_assoc($ires3);

    $query = "UPDATE `useracttb` SET `aid1`=" . $itemp1["aid"] . ",`aid2`=" . $itemp2["aid"] . ",`aid3`=" . $itemp3["aid"] . " WHERE uid = $uid";

    $res2 = mysqli_query($con, $query);

    if ($res1 && $res2) {
        echo "true";
    }
} else if ($flag == 14) {
    $query = "INSERT INTO `friendstb`(`uid1`, `uid2`) VALUES (" . $_POST["uid1"] . "," . $_POST["uid2"] . ")";

    $res = mysqli_query($con, $query);

    if ($res) {
        echo "done";
    } else {
        echo "error";
    }
} else if ($flag == 15) {

    $query = 'select * from friendstb where uid1=' . $_POST["uid"] . ' OR uid2=' . $_POST["uid"] . '';

    $res = mysqli_query($con, $query);



    while ($temp = mysqli_fetch_assoc($res)) {

        if ($temp['uid1'] == $_POST['uid']) {
            $uid = $temp['uid2'];
        } else {
            $uid = $temp['uid1'];
        }

        $iquery = 'select uname from usertb where uid=' . $uid . '';

        $ires = mysqli_query($con, $iquery);

        $itemp = mysqli_fetch_assoc($ires);

        echo '<div class="col">
                <div class="card m-3">
                    <div class="card-header">
                        <h5 class="card-text" align="center">' . $itemp['uname'] . '</h5>    
                    </div>
                    <div class="card-body">
                    <!--<h5 class="card-title">Card title</h5>-->
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="button" onclick="remove(' . $temp["uid1"] . ',' . $temp["uid2"] . ')">Remove</button>
                        </div>
                    </div>
                </div>
            </div>';
    }
} else if ($flag == 16) {
    $email = mysqli_escape_string($con, $_POST['email']);

    $query = 'select * from usertb where uemail="' . $email . '"';


    $res = mysqli_query($con, $query);

    if (mysqli_num_rows($res) > 0) {
        $temp = mysqli_fetch_assoc($res);
        $subject = 'Account Recovery';
        $msg = 'An account recover and update has been requested for this email ' . '<br/>' . 'Update link = http://localhost/chatwithfriends/update.php?id=' . $temp['uid'] . '?=' . $_POST['accessType'] . ' ';
        $req = smtp_mailer($email, $subject, $msg);
        echo $req;
    } else {
        echo "wrong";
    }
} else if ($flag == 17) {
    $iquery1 = "select * from friendstb where uid1=" . $_POST["uid1"] . " and uid2= " . $_POST["uid2"] . "";

    $iquery2 = "select * from friendstb where uid1=" . $_POST["uid2"] . " and uid2= " . $_POST["uid1"] . "";

    $query = "";

    $ires1 = mysqli_query($con, $iquery1);

    $ires2 = mysqli_query($con, $iquery2);

    if (mysqli_num_rows($ires1) > 0) {
        $query = "delete from friendstb where uid1=" . $_POST["uid1"] . " and uid2= " . $_POST["uid2"] . "";
    } else {
        $query = "delete from friendstb where uid1=" . $_POST["uid1"] . " and uid2= " . $_POST["uid2"] . "";
    }

    $res = mysqli_query($con, $query);

    if (!$res) {
        echo 'failed';
    } else {
        echo 'done';
    }
} else if ($flag == 18) {
    $uid = $_POST['uid'];

    $query = 'select * from usertb where uid=' . $_POST['uid'] . '';

    // echo $query;

    $res = mysqli_query($con, $query);

    $temp = mysqli_fetch_assoc($res);

    $iquery1 = 'select * from useracttb where uid=' . $uid . '';

    $ires1 = mysqli_query($con, $iquery1);

    $iarr = array();

    $itemp1 = mysqli_fetch_assoc($ires1);

    array_push($iarr, $itemp1["aid1"]);
    array_push($iarr, $itemp1["aid2"]);
    array_push($iarr, $itemp1["aid3"]);


    //Activity - 1 
    $iquery2 = 'select aname from activitytb where aid=' . $iarr[0] . '';

    $ires2 = mysqli_query($con, $iquery2);

    $itemp2 = mysqli_fetch_assoc($ires2);

    //Activity - 2
    $iquery3 = 'select aname from activitytb where aid=' . $iarr[1] . '';

    $ires3 = mysqli_query($con, $iquery3);

    $itemp3 = mysqli_fetch_assoc($ires3);

    //Activity - 3
    $iquery4 = 'select aname from activitytb where aid=' . $iarr[2] . '';

    $ires4 = mysqli_query($con, $iquery4);

    $itemp4 = mysqli_fetch_assoc($ires4);


    $temparr = array(
        'uname' => $temp['uname'],
        'a1' => $itemp2['aname'],
        'a2' => $itemp3['aname'],
        'a3' => $itemp4['aname'],
        'imgPath' => $temp['uimage']
    );

    $olddata = json_encode($temparr);

    echo $olddata;
} else if ($flag == 19) {
    $query = 'select * from chattb where sdid in(' . $_POST['sdid'] . ',' . $_POST['rcid'] . ') and rcid in(' . $_POST['sdid'] . ',' . $_POST['rcid'] . ')';
    // echo $query;
    $res = mysqli_query($con, $query);

    if(!isset($_SESSION['chatcount'])){
        $_SESSION["chatcount"] = mysqli_num_rows($res);
    }
    else{
        if($_SESSION['chatcount']!= mysqli_num_rows($res)){
            $_SESSION["chatcount"] = mysqli_num_rows($res);

        }
        else{
            // echo 'same';
        }
        while ($temp = mysqli_fetch_assoc($res)) {
            if ($temp['sdid'] == $_POST['sdid']) {
                echo '<li class="clearfix">
                <div class="message other-message float-right">' . $temp['msgtext'] . '</div>
            </li>';
            } else {
                // echo"2222";
                echo '<li class="clearfix">
                <div class="message my-message">' . $temp['msgtext'] . '</div>
            </li>';
            }
        }
    }


} else if ($flag == 20) {
    $sdid = $_POST['sdid'];
    $rcid = $_POST['rcid'];
    $txtMsg = mysqli_escape_string($con, $_POST['txtMsg']);

    $query = 'INSERT INTO `chattb`(`sdid`, `rcid`, `msgtext`) VALUES (' . $sdid . ',' . $rcid . ',"' . $txtMsg . '")';

    // echo $query;
    $res = mysqli_query($con, $query);

    if ($res) {
        echo 'sent';
    } else {
        echo 'failed';
    }
} else if ($flag == 21) {
    validateimage();
}
else if($flag==22){
    $query="select * from friendstb";

    $res=mysqli_query($con,$query);

    if(mysqli_num_rows($res)>0){
        while($temp=mysqli_fetch_assoc($res)){
            
        }
    }
}
