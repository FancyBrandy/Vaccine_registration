<?php 
  
  require_once("utils/_init.php");

  $timing=$topicStorage->findAll();
  $index=$auth->authenticated_user()["fullname"];
  $posts=$postStorage->findAll();
  foreach($posts as $arr)
  {
      if($arr["fullname"]==$index)
      {
        $temp=$arr;
        $temp = [
            "date" => $arr["date"],
            "time" => $arr["time"],
            "fullname"=> $arr["fullname"],
            "email"=> $arr["email"],
            "SSN"=> $arr["SSN"],
            "booked"=>false,
            "id"=>$arr["id"]
          ];
         
          $postStorage->update($arr["id"],$temp);
          foreach($timing as $datetime)
          {
            if($datetime["date"]==$arr["date"])
            {
              $temp = [
                "date" => $datetime["date"],
                "time" => $datetime["time"],
                "people_allowed"=>$datetime["people_allowed"],
                "people_registered"=>(string)(intval($datetime["people_registered"])-1),
                "id"=>$datetime["id"]
              ];
              
              $topicStorage->update($datetime["id"],$temp);
            }
          }
      }
  }
 
  echo "Booking canceled";
  ?>
  <a href="index.php" class="btn btn-primary">Back to home page</a>