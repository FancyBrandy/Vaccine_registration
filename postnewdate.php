<?php
// Include init code
require_once("utils/_init.php");
$topics = $topicStorage->findAll(); // Array of topics
$posts= $postStorage->findAll();
$users=$userStorage->findAll();
// Restricting access to admins
if (!$auth->authorize(["admin"])) {
  $errors[] = "You have no permission to access this page";
  save_to_flash("errors", $errors);
  redirect("index.php");
}

// Process the input
// 1: Check if input exists
if (verify_post("date", "time","people")) {
  // 2: Read/preprocess the input
  $date = trim($_POST["date"]);
  $time = trim($_POST["time"]);
  $people = trim($_POST["people"]);

  // 3: Validate input / check for errors
  if (empty($date)) {
    $errors[] = "Date must not be empty";
  }

  foreach($topics as $topic)

  {
      if($topic["date"]==$date)
      {
          $errors[]="the date has already been published";
      }
  }
  // the validity of the date

  if (empty($time)) {
    $errors[] = "Time must not be empty";
  }
  if (empty($people)) {
    $errors[] = "You must give the number of people allowed";
  }

  if ($people<=0) {
    $errors[] = "The number of people cannot be smaller than 0";
  }
  // 4: If there are no errors then process input
  if (empty($errors)) {
    // 5: Add the new record to the data file
   
    $newDate = [
        "date"=>$date,
        "time"=>$time,
        "people_allowed"=> $people,
        "people_registered"=>"0"
    
    ];
    $topicStorage->add($newDate);
  }
}

?>
<?php require("partials/header.inc.php") ?>
<h1>New Date</h1>
<form class="col-md-6 col-xs-12" method="post">
  <div class="form-group">
    <label for="title">Date</label>
    <input class="form-control" type="text" name="date" id="date" value="<?= $date ?? "" ?>">
  </div>
  <div class="form-group">
    <label for="time">Time</label>
    <input class="form-control" type="text" name="time" id="time" value="<?= $time ?? "" ?>">
  </div>
  <div class="form-group">
    <label for="title">People allowed</label>
    <input class="form-control" type="text" name="people" id="people" value="<?= $people ?? "" ?>">
  </div>
  <button class="btn btn-primary">Submit</button>

  

  <?php require("partials/errors.inc.php") ?>
</form>
<br>
<br>
<br>
<a href="index.php" class="btn btn-primary" style="float:right;">Back to home page</a>
<?php require("partials/footer.inc.php") ?>