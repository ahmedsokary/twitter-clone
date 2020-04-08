
<div class="container maincontainer">
  <div class="row">
  <?php 
 
  if($_GET['page']=='userid') { ?>
   
    <?php displayTweets($_GET['userid']); ?>

<?php }else{ ?>

 <div class="col-sm"> <h2>active users</h2>
 
 <?php

displayusers();    ?>
  </div>
  <?php } ?>

    </div>
   
  </div>
</div>