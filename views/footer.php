<footer class="footer">
    <div class="container">
<p>&copy;sokarys website</p><!-- container to display in middle -->
</div>
<!-- the footer tag mark -->
</footer>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
 <!-- model for the sign and login we will set activate button in header -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title">login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <!-- we will put the modal body(login)here-->

           <!-- we will put here the error message of signup and login modal -->
           <div class="alert alert-danger" role="alert" id="errormessage"></div>
      <form>
          <!-- this input to know if i am in login or signup-->
          <input type="hidden" id="loginActive" name="loginActive" value=1>
  <div class="form-group">
      
       <label for="email">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Email">
    
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="password">
  </div>
</form>

      </div>
      <div class="modal-footer">
          <a id="toggleLogin" href="#  " >Sign up</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button id="login-signup" type="button" class="btn btn-primary">Login</button>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script>
    //must inclide the jquery above to use ajax 
   //toggle the buttons
$("#toggleLogin").click(function(){
    if($("#loginActive").val()=="1")
   {//if log turn to sigbup
        $("#loginActive").val("0");//change the value of input we set above
        $("#title").html("sign up");//change the title of the model
        $("#login-signup").html("sign up");//change the button itself
        $("#toggleLogin").html("log in");//change the toggling button
        }
        else{
            $("#loginActive").val("1");//change the value of input we set above
        $("#title").html("log in");//change the title of the model
        $("#login-signup").html("log in");//change the button itself
        $("#toggleLogin").html("sign up");//change the toggling button



        }
    
});
    

$("#login-signup").click(function(){
//ajax to send to action.php
//with ajax doen't need to refresh page every time automatically updated
$.ajax({
type:"post",//method i will get this data in action.php
url:"action.php?action=loginSignup",//name loginsignup is the nam ecatched in action.php
data:"email="+$("#email").val() +"&password=" //data sent
+$("#password").val() +"&loginActive=" + $("#loginActive").val(),
success:function(result)//get the result of action.php
{
    if(result==1)
window.location.assign("index.php");//set u to the home page
    else
  $("#errormessage").html(result).show();
    //here set the content to the html of the div above and show it
}

})

});

$(".togglefollow").click(function(){//the botton is in function.php
    var id=$(this).attr("data-userId");
$.ajax({
type:"post",//method i will get this data in action.php
url:"action.php?action=togglefollow",//name loginsignup is the nam catched in action.php
data:"userid="+id,
success:function(result)//get the result of action.php
{
    if(result==1)
    {
//will cahnge the content of word follow in function .php
$("a[data-userId='"+id+"']").html("Follow");
//this to get the value of what follow have been clicked with a specefic id
    }
    else if(result==2){

        $("a[data-userId='"+id+"']").html("UnFollow");
    }
}
})  
})
//post the tweet
//take care in ajax an extra space will make the variable unreadable 
$("#posttweetbutton").click(function(){
  $.ajax({
type:"post",//method i will get this data in action.php
url:"action.php?action=posttweetbutton",//name posttweetbutton is the nam catched in action.php
data:"tweetcontent=" +$("#tweetcontent").val(),
success:function(result)//get the result of action.php
{
  if(result==1)
  {$("#tweetsuccess").show();
  $("#tweetfail").hide();} 
  else 
  {$("#tweetfail").html(result).show();
  $("#tweetsuccess").hide();
}
}
})
})
  
    </script>

</body>
</html>