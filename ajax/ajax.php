<?php

require 'connection.php';

$flag = $_POST['flag'];

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
            echo 'usersuc.php?id='.$uid.'';
        }
    } else {
        echo "invalid";
    }
} elseif ($flag == 2) {
    // echo"false"; 
    $upass = mysqli_escape_string($con, $_POST['upass']);
    $query = 'select upass from usertb where uid=11011 and upass="' . $upass . '"';

    $res = mysqli_query($con, $query);

    if (mysqli_num_rows($res) > 0) {
        echo "true";
    }
} elseif ($flag == 3) {
    $uname = mysqli_escape_string($con, $_POST['uname']);
    $uemail = mysqli_escape_string($con, $_POST['uemail']);
    $upass = mysqli_escape_string($con, $_POST['upass']);

    $query = "INSERT INTO `usertb`(`uname`, `upass`, `utype`, `uemail`) VALUES ('$uname','$upass','user','$uemail')";

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

    echo "true";
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

    $query = 'DELETE FROM `usertb` WHERE uid=' . $uid . '';

    $res = mysqli_query($con, $query);

    if (!$res) {
        echo 'fasle';
    } else {
        echo 'true';
    }
} elseif ($flag == 7) {//Admin Search

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
}
elseif($flag==8){//User Search


    $ucategory= mysqli_escape_string($con, $_POST['ucategory']);
    $uname = mysqli_escape_string($con, $_POST['uname']);
    $self = mysqli_escape_string($con, $_POST['self']);

    

    $query = 'select * from usertb where uname like "' . $uname . '%" and utype="user" and uid <> '.$self.' order by uid asc';

    

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
                            <button class="btn btn-primary" type="button" onclick="chat(' . $temp["uid"] . ')">Chat</button>
                        </div>
                    </div>
                </div>
            </div>';
    }

}
else if($flag==9)//Request for chat
{
   
}
else if($flag==10){
    $query='select * from activitytb';

    $res=mysqli_query($con,$query);

    while($temp=mysqli_fetch_assoc($res))
    {
        echo'<p class="card-text">'.$temp["aname"].'</p>';
    }

}
else if($flag==11){
    $txtcat=mysqli_escape_string($con,$_POST['txtcat']);

    $query="INSERT INTO `activitytb`(aname) VALUES ('$txtcat')";

    $res=mysqli_query($con,$query);

    if($res){
        echo "true";
    }
    else{
        echo"fasle";
    }
    
}
else if($flag==12){

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
}
else if($flag==13){
    $uid=$_POST['uid'];
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

    $query="UPDATE `useracttb` SET `aid1`=".$itemp1["aid"].",`aid2`=".$itemp2["aid"].",`aid3`=".$itemp3["aid"]." WHERE uid = $uid";

    $res2=mysqli_query($con,$query);

    if($res1&&$res2){
        echo "true";
    }


    

}
else if($flag==14){
    $query="INSERT INTO `friendstb`(`uid1`, `uid2`) VALUES (".$_POST["uid1"].",".$_POST["uid2"].")";

    $res=mysqli_query($con,$query);

    if($res){
        echo "done";
    }
    else{
        echo "error";
    }

}
else if($flag==15){

    $query='select * from friendstb where uid1='.$_POST["uid"].' OR uid2='.$_POST["uid"].'';

    $res=mysqli_query($con,$query);

    

    while($temp=mysqli_fetch_assoc($res)){

        if($temp['uid1']==$_POST['uid']){
            $uid=$temp['uid2'];
        }
        else{
            $uid=$temp['uid1'];

        }
        
        $iquery='select uname from usertb where uid='.$uid.'';

        $ires=mysqli_query($con,$iquery);

        $itemp=mysqli_fetch_assoc($ires);

        echo '<div class="col">
                <div class="card m-3">
                    <div class="card-header">
                        <h5 class="card-text" align="center">'.$itemp['uname'].'</h5>    
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

    
}
