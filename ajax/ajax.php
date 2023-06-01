<?php

require 'connection.php';

$flag=$_POST['flag'];

if($flag==1){
    $uid=mysqli_escape_string($con,$_POST['uid']);
    $upass=mysqli_escape_string($con,$_POST['upass']);

    $query='select utype from usertb where uid = '.$uid.' and upass = "'.$upass.'"';

    // echo $query;

    $res=mysqli_query($con,$query);

    if(mysqli_num_rows($res)>0){
        $temp=mysqli_fetch_assoc($res);
        if($temp['utype']=='admin'){
            echo 'admin';
        }
        else{
            echo 'user';
        }
    }
    else{
        echo"invalid";
    }
}
elseif($flag==2){
    // echo"false"; 
    $upass=mysqli_escape_string($con,$_POST['upass']);
    $query='select upass from usertb where uid=11011 and upass="'.$upass.'"';

    $res=mysqli_query($con,$query);

    if(mysqli_num_rows($res)>0){
        echo "true";
    }

}
elseif ($flag==3){

}
elseif($flag==4){
    $query='select * from activitytb';

    $res=mysqli_query($con,$query);

    if(mysqli_num_rows($res)>0){
        $try=array();
        while($temp=mysqli_fetch_assoc($res)){
            array_push($try,$temp['aname']);
        }
        $response = json_encode($try);
        echo $response;
    }



}
