<?php
require_once("../utils/_init.php");
header("Content-Type: application/json; charset=UTF-8");



if (!verify_post("topicId")) {
  // No text was recieved
  http_response_code(400); // Bad request
  print("{ \"error\" => \"wrong patient id\" }");
  exit();
}

  $dateId  = $_POST["topicId"];
  $index=$auth->authenticated_user()["fullname"];
  $timing=$topicStorage->findAll();
  $posts=$postStorage->findAll();
  $count="one";
  foreach($posts as $arr)
  {
      if($arr["fullname"]==$index)
      {
        $dateId  = $_POST["topicId"];
        $app = $topicStorage->findById($dateId);
        $temp=$arr;
        $temp = [
            "date" => $app["date"],
            "time" => $app["time"],
            "fullname"=> $_SESSION["fullname"],
            "email"=> $_SESSION["email"],
            "SSN"=> $_SESSION["SSN"],
            "booked"=>true,
            "id"=>$arr["id"]
          ];
          
          $postStorage->update($arr["id"],$temp);
          $count="zero";
      }
  }



if($count=="one")
{
   
  $app = $topicStorage->findById($dateId);
  $newapp = [
      "date" => $app["date"],
      "time" => $app["time"],
      "fullname"=> $_SESSION["fullname"],
      "email"=> $_SESSION["email"],
      "SSN"=> $_SESSION["SSN"],
      "booked"=>true
    ];
    $postStorage->add($newapp);
    $_SESSION["id"]=$dateId;
    $_SESSION["booked"]=true;
   
    
}
foreach($timing as $datetime)
{
  if($datetime["date"]==$app["date"])
  {
    $temp = [
      "date" => $datetime["date"],
      "time" => $datetime["time"],
      "people_allowed"=>$datetime["people_allowed"],
      "people_registered"=>(string)(intval($datetime["people_registered"])+1),
      "id"=>$datetime["id"]
    ];
    
    $topicStorage->update($datetime["id"],$temp);
  }
}
 
// this php file is for creating the new patient information after clicking on the booking