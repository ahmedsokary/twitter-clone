<?php
//main action page
//my sql called twitter

include("functions.php");
include("views/header.php");
if(isset($_GET['page']))//if the action in header timeline is pressed 
{
    if($_GET['page']=='timeline')//check if the recieved data 
    include("views/timeline.php");

else if($_GET['page']=='yourtweets')
    include("views/yourtweets.php");

else if($_GET['page']=='search')//we will call it in the display function in function.php
    include("views/search.php");

else if($_GET['page']=='publicprofiles')
    include("views/publicprofiles.php");
}
else
include("views/home.php");
include("views/footer.php");


?>