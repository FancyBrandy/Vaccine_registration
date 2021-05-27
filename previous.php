<?php
// Include init code
require_once("utils/_init.php");

$topics = $topicStorage->findAll(); // Array of topics
$posts= $postStorage->findAll();
$users=$userStorage->findAll();

$count=true;// keep track whether the user who logged in have an appointment or not (true for dont have an appointment)
$booked=false;
$app=null;

?>
<?php require("partials/header.inc.php") ?>



<h1>Booking page</h1>

<html>
<?php if ($auth->is_authenticated()): ?>
  <?php foreach ($posts as $post): ?>  
                  <?php if($post["fullname"]==($auth->authenticated_user()["fullname"])): ?>
                      <?php if($post["booked"]==true):?>
                            
                      <h1 style="color:Red;background-color=Brown">Your already booked an appointment:</h1>
                              <h2><?= $post["date"] ?></h2>
                              <h2><?= $post["time"] ?></h2>
                            
                                <?php $booked=true;
                                $app["date"]=$post["date"];
                                $app["time"]=$post["time"];
                                ?>

                              <?php endif;?>
                          <?php $count=false  ?>
                    <?php endif; ?>
           
      

            <?php if($post["fullname"]==($auth->authenticated_user()["fullname"]) and $post["booked"]==false): ?>
            <?php echo "debug"?>
                    <h1 style="color:Red">No available appointment yet</h1>
                  <?php  $booked=false ?>
              <?php endif; ?>

           <?php endforeach; ?>
     
      <?php endif; ?>
     
      <?php if(($count==true) and($auth->is_authenticated()) ):?>
      <h1 style="color:Red">No available appointment yet</h1>
      <?php endif;?>


      <br>
<br>


</html>

<?php require("partials/errors.inc.php") ?>



<table class="table table-bordered">
    <thead  style="background-color:yellow">
    <th scope="row" style="background-color:yellow">W/D</th>
        
            <th scope="col">Monday</th>
            <th scope="col">Tuesday</th>
            <th scope="col">Wednesday</th>
            <th scope="col">Thursday</th>
            <th scope="col">Friday</th>
            <th scope="col">Saturday</th>
            <th scope="col">Sunday</th>

        </tr>
    </thead>
    </table>

<div class="list-group mt-4" >

<table class="table table-hover">

</th>
<tr>
<th scope="row" style="background-color:pink">Week1</th>
<th>
</th>
<th>
</th>
<th>
</th>
<th>
</th>
<th>
</th>

        <?php for($i=60;$i<62;$i++): ?>
          <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]!=1): ?>

                      <th scope="col" style="background-color:green;">
                      <?= $topics[$i]["date"] ?><br>
                      <?= $topics[$i]["time"] ?><br>
                      <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
                    <br>
                    
                
                    <?php if ($auth->is_authenticated()): ?> 
                          <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                           
                            <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                          
                            <?php elseif ($booked==false or $count==true ):?>
                              <a href="bookingdetail.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Book this date(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                            <?php endif;?>
                    <?php else: ?>
                      <a class="btn btn-primary" href="login.php">Book this date</a>
                    <?php endif; ?>
                    <?php endif; ?>
                
    

                    <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]==1): ?>
          
          <th scope="col" style="background-color:red;" >
          <?= $topics[$i]["date"] ?><br>
          <?= $topics[$i]["time"] ?><br>
          <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
        <br>
        <?php if ($auth->is_authenticated()): ?> 
                <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                 
                  <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                
                  <?php elseif ($booked==false or $count==true ):?>
                    <a href="nomore.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Not Available(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                  <?php endif;?>
          <?php else: ?>
            <a class="btn btn-primary" href="login.php">Not Available</a>
          <?php endif; ?>
          <?php endif; ?>

         <?php endfor; ?>

         </tr>
         <tr>
         <th scope="row"  style="background-color:pink">Week2</th>
         <?php for($i=62;$i<69;$i++): ?>
            
      
           
          <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]!=1): ?>

                      <th scope="col" style="background-color:green;">
                      <?= $topics[$i]["date"] ?><br>
                      <?= $topics[$i]["time"] ?><br>
                      <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
                    <br>
                    
                    <?php if ($auth->is_authenticated()): ?> 
                          <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                           
                            <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                          
                            <?php elseif ($booked==false or $count==true ):?>
                              <a href="bookingdetail.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Book this date(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                            <?php endif;?>
                    <?php else: ?>
                      <a class="btn btn-primary" href="login.php">Book this date</a>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]==1): ?>
          
          <th scope="col" style="background-color:red;" >
          <?= $topics[$i]["date"] ?><br>
          <?= $topics[$i]["time"] ?><br>
          <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
        <br>
        <?php if ($auth->is_authenticated()): ?> 
                <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                 
                  <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                
                  <?php elseif ($booked==false or $count==true ):?>
                    <a href="nomore.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Not Available(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                  <?php endif;?>
          <?php else: ?>
            <a class="btn btn-primary" href="login.php">Not Available</a>
          <?php endif; ?>
          <?php endif; ?>



         <?php endfor; ?>

         </tr>

  
         <tr>
<th scope="row"  style="background-color:pink">Week3</th>
        <?php for($i=69;$i<76;$i++): ?>
            
          
         
           
          <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]!=1): ?>

                      <th scope="col" style="background-color:green;">
                      <?= $topics[$i]["date"] ?><br>
                      <?= $topics[$i]["time"] ?><br>
                      <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
                    <br>
                    <?php if ($auth->is_authenticated()): ?> 
                          <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                           
                            <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                          
                            <?php elseif ($booked==false or $count==true ):?>
                              <a href="bookingdetail.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Book this date(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                            <?php endif;?>
                    <?php else: ?>
                      <a class="btn btn-primary" href="login.php">Book this date</a>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]==1): ?>
          
          <th scope="col" style="background-color:red;" >
          <?= $topics[$i]["date"] ?><br>
          <?= $topics[$i]["time"] ?><br>
          <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
        <br>
        <?php if ($auth->is_authenticated()): ?> 
                <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                 
                  <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                
                  <?php elseif ($booked==false or $count==true ):?>
                    <a href="nomore.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Not Available(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                  <?php endif;?>
          <?php else: ?>
            <a class="btn btn-primary" href="login.php">Not Available</a>
          <?php endif; ?>
          <?php endif; ?>


         <?php endfor; ?>

         </tr>

         <tr>
<th scope="row" style="background-color:pink">Week4</th>
        <?php for($i=76;$i<83;$i++): ?>
            
          
         
           
          <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]!=1): ?>

                      <th scope="col" style="background-color:green;">
                      <?= $topics[$i]["date"] ?><br>
                      <?= $topics[$i]["time"] ?><br>
                      <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
                    <br>
                    <?php if ($auth->is_authenticated()): ?> 
                          <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                           
                            <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                          
                            <?php elseif ($booked==false or $count==true ):?>
                              <a href="bookingdetail.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Book this date(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                            <?php endif;?>
                    <?php else: ?>
                      <a class="btn btn-primary" href="login.php">Book this date</a>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]==1): ?>
          
          <th scope="col" style="background-color:red;" >
          <?= $topics[$i]["date"] ?><br>
          <?= $topics[$i]["time"] ?><br>
          <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
        <br>
        <?php if ($auth->is_authenticated()): ?> 
                <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                 
                  <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                
                  <?php elseif ($booked==false or $count==true ):?>
                    <a href="nomore.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Not Available(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                  <?php endif;?>
          <?php else: ?>
            <a class="btn btn-primary" href="login.php">Not Available</a>
          <?php endif; ?>
          <?php endif; ?>

         <?php endfor; ?>

              
         </tr>
         <tr>
<th scope="row" style="background-color:pink">Week5</th>
        <?php for($i=83;$i<90;$i++): ?>
            
          
         
           
          <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]!=1): ?>

                      <th scope="col" style="background-color:green;">
                      <?= $topics[$i]["date"] ?><br>
                      <?= $topics[$i]["time"] ?><br>
                      <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
                    <br>
                   
                    <?php if ($auth->is_authenticated()): ?> 
                          <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                           
                            <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                          
                            <?php elseif ($booked==false or $count==true ):?>
                              <a href="bookingdetail.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Book this date(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                            <?php endif;?>
                    <?php else: ?>
                      <a class="btn btn-primary" href="login.php">Book this date</a>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]==1): ?>
          
          <th scope="col" style="background-color:red;" >
          <?= $topics[$i]["date"] ?><br>
          <?= $topics[$i]["time"] ?><br>
          <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
        <br>
        <?php if ($auth->is_authenticated()): ?> 
                <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                 
                  <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                
                  <?php elseif ($booked==false or $count==true ):?>
                    <a href="nomore.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Not Available(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                  <?php endif;?>
          <?php else: ?>
            <a class="btn btn-primary" href="login.php">Not Available</a>
          <?php endif; ?>
          <?php endif; ?>

         <?php endfor; ?>

        
         </tr>

         <th scope="row" style="background-color:pink">Week6</th>
        <?php for($i=90;$i<91;$i++): ?>
            
          
         
           
          <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]!=1): ?>

                      <th scope="col" style="background-color:green;">
                      <?= $topics[$i]["date"] ?><br>
                      <?= $topics[$i]["time"] ?><br>
                      <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
                    <br>
                   
                    <?php if ($auth->is_authenticated()): ?> 
                          <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                           
                            <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                          
                            <?php elseif ($booked==false or $count==true ):?>
                              <a href="bookingdetail.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Book this date(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                            <?php endif;?>
                    <?php else: ?>
                      <a class="btn btn-primary" href="login.php">Book this date</a>
                    <?php endif; ?>
                    <?php endif; ?>

                    <?php if($topics[$i]["people_registered"]/$topics[$i]["people_allowed"]==1): ?>
          
          <th scope="col" style="background-color:red;" >
          <?= $topics[$i]["date"] ?><br>
          <?= $topics[$i]["time"] ?><br>
          <?= $topics[$i]["people_registered"] ."/".$topics[$i]["people_allowed"]?>
        <br>
        <?php if ($auth->is_authenticated()): ?> 
                <?php if ($count==false and $booked==true and $app["date"]==$topics[$i]["date"] and $app["time"]==$topics[$i]["time"]):?>
                 
                  <a href="cancel.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">cancel booking</a>
                
                  <?php elseif ($booked==false or $count==true ):?>
                    <a href="nomore.php?id=<?= $topics[$i]["id"] ?>" class="btn btn-primary">Not Available(<?= $auth->authenticated_user()["fullname"] ?>)</a>
                  <?php endif;?>
          <?php else: ?>
            <a class="btn btn-primary" href="login.php">Not Available</a>
          <?php endif; ?>
          <?php endif; ?>
            
         <?php endfor; ?>

        
         </tr>
       
         </table>

        


<br>
<br>

<div class="d-grid gap-2 d-md-block">

  <button class="btn btn-primary" type="button" style="float:right" id="Next">Next</button>
</div>
<script src="previous.js"></script>
<?php if ($auth->authorize(["admin"])): ?>
  <h2 style="color:green;">The users who already booked an appointment:</h2>    
  <table class="table table-hover">
  <tr class="table-info">
                    <td class="table-primary">User name</td>
                    <td class="table-secondary">Social security number</td>
                    <td class="table-success">Email</td>
                    <td class="table-danger">Booked date</td>
                    <td class="table-warning">Booked time</td>
                </tr>
          <?php foreach($users as $user):?>
            <?php foreach($posts as $post):?>
                <?php if($post["fullname"]==$user["fullname"]):?>
                <tr>
                    <td class="table-primary"><?= $user["fullname"] ?></td>
                    <td class="table-secondary"><?= $user["SSN"] ?></td>
                    <td class="table-success"><?= $user["email"] ?></td>
                    <td class="table-danger"><?= $post["date"] ?></td>
                    <td class="table-warning"><?= $post["time"] ?></td>
                </tr>
                <br>
                <br>
                <?php endif;?>
            <?php endforeach;?>            
<?php endforeach;?>
</table>
<a href="postnewdate.php?" class="btn btn-primary stretched-link" style="position: relative;">Post a new date</a>
<?php endif;?>

<?php require("partials/footer.inc.php") ?>