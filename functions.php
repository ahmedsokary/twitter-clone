
<?php

session_start();//start my session here and give the values in action.php



//where controller functions
//will put the connection of my database
// Create connection
$conn = mysqli_connect("localhost","root","","twitter");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_GET['function']))

{if ($_GET['function'] == "logout") 
    session_unset();}
  //function el logout bydene error undefined function rest in header.php  
  //in the last first video



//to put 2 min ago etc...
function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'min'),
        array(1 , 'sec')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}

function displayTweets($type)
{
    global $conn;//as to be able to access inside this function
if($type=="public")
{
    $tweets=""; 

}
else if($type=="isfollowing"){
    $query="select * from isfollowing where followers='".mysqli_real_escape_string($conn,$_SESSION['id'])."'";
    $result=mysqli_query($conn,$query);
     $tweets="";
        while($row=mysqli_fetch_assoc($result))
        {
            if($tweets=="")
            $tweets.="where";
            else
            $tweets.=" or";

            $tweets.=" userid = ".$row['following'];
        }

}
else if($type=="yourtweets") 
        {
            $tweets="where userid= ".mysqli_real_escape_string($conn,$_SESSION['id']) ;  
        }
else if($type=="search")
    {
        echo "<p>showing resulys for ' ".mysqli_real_escape_string($conn,$_GET['entereddata'])." '";
        $tweets="where tweet like'%".mysqli_real_escape_string($conn,$_GET['entereddata'])."%'" ;  //here i use get to get the data entered in th search bar 
    }
else if(is_numeric($type))
   {
        $tweets="where userid= ".mysqli_real_escape_string($conn,$type) ;  
   }
   
 $query="select * from tweets ". $tweets." order by datetime desc limit 10 ";
$result=mysqli_query($conn,$query);
if(mysqli_num_rows($result)==0)
{
    echo"no tweets to display";
}
else
{
    while($row=mysqli_fetch_assoc($result))
    {

        $userquery="select*from twitter where id='".mysqli_real_escape_string($conn,$row['userid'])."'";
        $userResult=mysqli_query($conn,$userquery);
        $user=mysqli_fetch_assoc($userResult);//user have all the info 
        
        echo"<div class='tweet'><p>".$user['email']." <span style=' color: lightgrey;'>".time_since(time()-strtotime($row['datetime']))." ago</span> </p>";
     //time slice get the time from when u last wrote a tweet strtotime get the cuurent date from database as atime value so can sub from current time

        echo"<p>".$row['tweet']."</p>";
        echo"<p><a href='#' class='togglefollow' data-userId='".$row['userid']."'>";
        //i added this part as not to refresh every time follow and unfollow and make a mistake in my data base remain unfollow even if i refresh
        $isfollowingquery="select * from isfollowing where followers='".mysqli_real_escape_string($conn,$_SESSION['id'])."' and following='".mysqli_real_escape_string($conn,$row['userid'])."' ";
        $isfollowingresult=mysqli_query($conn,$isfollowingquery);
        if(mysqli_num_rows($isfollowingresult)>0)//here i am unfollowing removing from isfollowing database
        {
         echo"unfollow";
        }
        else echo"follow";
        echo "</a></p></div>";

        


//datauserId get the id by jqury
//when togglefollow clicked will modify in footer

    }
   

}

}
//display the search box as a form and tweet form
 function displayfunction()
 {//can be a div will be submitted with ajax
echo'
<form class="form-inline">
<input name="page" type="hidden" value="search">
 <input type="text" name="entereddata" class="form-control mb-2 mr-sm-2" id="search" placeholder="search">

 <button   class="btn btn-primary mb-2">searchtweets</button>
</form>
';
 }
//we will make the get function be called when the form submits this is the first time with value search and name page



function displayTweetbox()
{
if($_SESSION['id']>0)//should set the logout button as to unset session when out
{//this div to alert if you posted successfully
    echo'
    <div  id="tweetsuccess"  class="alert alert-success">Your message was posted successfully</div>
    <div id="tweetfail" class="alert alert-danger"></div>
    <div>
    <form class="form">
     <textarea class="form-control mb-2 mr-sm-2" id="tweetcontent"></textarea>
    
     <button id="posttweetbutton" class="btn btn-primary mb-2">post tweet</button>
    </form>
    </div>';

}
     
}

//the button functions in footer.php

function displayusers(){
global $conn;
    $query="select * from twitter limit 10 ";
    $result=mysqli_query($conn,$query);
    while($row=mysqli_fetch_assoc($result))
    {

echo"<div class='tweet'><a href='?page=publicprofiles&userid=".$row['id']."'>".$row['email']."</a></div>";
    }
//here i made a list of all the users i have and made  alink to public profile with each of them id when u click

}
?>