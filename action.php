<?php
function checkemail($str) {
    return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}
include("functions.php");//to access all the func
$msg="";
//geting all the information from footer.php
if($_GET['action']=="loginSignup")
{

if(!$_POST['email'])
{
$msg="The email field is empty";
}
else if(!$_POST['password'])
{
    $msg="The password field is empty";
}

else if(!checkemail($_POST['email']))
{
    $msg="Please enter a valid email address";
}


if($msg!=="")//all error messages will be recived in the footer and be displayed as div of id errormessage
{
    echo $msg ;
    exit();

}

if($_POST['loginActive']=="0")//signup
{
$query="select * from twitter where email='".mysqli_real_escape_string($conn,$_POST['email'])."'";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0)
$msg="This email is already signed up";
else
{
    
    $sign="insert into twitter(email,password) values('".mysqli_real_escape_string($conn,$_POST['email'])."','".mysqli_real_escape_string($conn,$_POST['password'])."')";
    mysqli_query($conn,$sign);
    $_SESSION['id']=mysqli_insert_id($conn);//set my session here to keep the value sessionstart in function


//to give my query a strong password
 $query="update twitter set password='".md5(md5(mysqli_insert_id($conn)).$_POST['password']). "'where id=".mysqli_insert_id($conn)." limit 1";

 mysqli_query($conn,$query);
echo 1;//the one will be read in the footer and direct to index page

}

if($msg!=="")
{
    echo $msg ;
    exit();

}





}
if($_POST['loginActive']=="1")//log in
{

    //to get the row id for md5 (not by insert id like in signup)
    $query="select * from twitter where email='".mysqli_real_escape_string($conn,$_POST['email'])."'";
    $result=mysqli_query($conn,$query);
$row=mysqli_fetch_assoc( $result);
    $query="select * from twitter where email='".mysqli_real_escape_string($conn,$_POST['email'])."' and password='".mysqli_real_escape_string($conn,md5(md5($row['id']).$_POST['password']))."' ";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0)
    {
     $_SESSION['id']=$row['id'];//set my session here to keep the value sessionstart in function
        echo 1;//the one will be read in the footer and direct to index page
    }
    else{

        $msg="the user is not found check enail and password again";
    }
    if($msg!=="")
    {
        echo $msg ;
        exit();
    
    }


}
   
}



if($_GET['action']=="togglefollow")//when follow botton is clicked in footer.php
{
//follwersis the id of the person logged in(current user) and following is person we checking who wrote the tweet
    $query="select * from isfollowing where followers='".mysqli_real_escape_string($conn,$_SESSION['id'])."' and following='".mysqli_real_escape_string($conn,$_POST['userid'])."' limit 1";
    $result=mysqli_query($conn,$query);
    if(mysqli_num_rows($result)>0)//here i am unfollowing removing from isfollowing database
    {
        $row=mysqli_fetch_assoc( $result);
        $delete="delete from isfollowing where id='".mysqli_real_escape_string($conn,$row['id'])."'";
        mysqli_query($conn,$delete);
        echo 1;

    }
    else{//here i am following adding to isfo;;owing database
$newQuery="insert into isfollowing(followers,following) values('".mysqli_real_escape_string($conn,$_SESSION['id'])."','".mysqli_real_escape_string($conn,$_POST['userid'])."') limit 1";
mysqli_query($conn,$newQuery);
echo 2;


    }
}

if($_GET['action']=="posttweetbutton")
{
    
if(!$_POST['tweetcontent'])
{
    echo "Your tweet is Empty";
}
else if(strlen($_POST["tweetcontent"])>150)
{
    echo "sorry can't post that tweet is too long";
}
else{

    $newQuery="insert into tweets(userid,tweet,datetime) values('".mysqli_real_escape_string($conn,$_SESSION['id'])."','".mysqli_real_escape_string($conn,$_POST['tweetcontent'])."',NOW()) limit 1";
mysqli_query($conn,$newQuery);

echo 1;
}


}

?>