<?php
require_once("utils/_init.php");
if (verify_post("fullname", "password", "confirm-password", "email","address","SSN") ){
  
  $password = $_POST["password"];
  $confirm_password = $_POST["confirm-password"];
  $fullname = trim($_POST["fullname"]);
  $address=trim($_POST["address"]);
  $email=trim($_POST["email"]);
  $SSN=trim($_POST["SSN"]);
  $users=$userStorage->findAll();

  // Password length
  if (strlen($password) < 5) {
    $errors[] = "Password must be at least 5 characters long";
  }

  if (strlen($SSN) < 9) {
    $errors[] = "Social security number must be at least 9 numbers";
  }
  if (!empty($SSN) && !is_numeric($SSN)) {
    $errors[] = "SSN must be numbers";
}
if (empty($address)) {
  $errors[] = "Address must not be empry";
}
  // Passwords match
  if ($password !== $confirm_password) {
    $errors[] = "Passwords do not match";
  }

  // Name is not empty
  if (empty($fullname)) {
    $errors[] = "Full name must not be empty";
  }
   // address is not empty
   if (empty($address)) {
    $errors[] = "Address must not be empty";
  }
// email cannot be empty
  if (empty($email)) {
    $errors[] = "email address must not be empty";
  }
  // the form of the email address must be right
  if (!empty($_POST["email"])) {

    $email = trim(htmlspecialchars($_POST['email']));
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
  
    if ($email == false) {
      $errors[]="invalid Email address";
    }
    
     foreach($users as $user)
     {
       if($email==$user["email"])
       {
        $errors[] = "email address already taken";
       }
     }
  
  }
  //checking whether the email address has been taken or not
  
  // If there were no errors...
  if (empty($errors)) {
    $successes[] = "Registration successful. Please log in.";
    save_to_flash("successes", $successes);
    
    // Register the new user
    $auth->register([
      "address"=>$address,
      "password" => $password,
      "fullname" => $fullname,
      "email"=>$email,
      "SSN"=>$SSN

    ]);
    redirect("login.php");
  }
}

?>
<?php require("partials/header.inc.php") ?>
<?php require("partials/errors.inc.php") ?>
<h1>Sign up</h1>

<form class="col-md-6 col-xs-12" method="post">
  <div class="form-group">
    <label for="fullname">Fullname</label>
    <input class="form-control" type="text" name="fullname" id="fullname" value="<?= $fullname ?? "" ?>">
  </div>
  
 

  <div class="form-group">
    <label for="SSN">SSN number</label>
    <input class="form-control" type="text" name="SSN" id ="SSN" value="<?= $SSN ?? "" ?>">
  </div>
  <div class="form-group">
    <label for="address">Address</label>
    <input class="form-control" type="text" name="address" id="address" value="<?= $address ?? "" ?>">
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" type="text" name="email" id="email" value="<?= $email ?? "" ?>">
  </div>


  <div class="form-group">
    <label for="password">password</label>
    <input class="form-control" type="password" name="password" id="password" >
  </div>
  <div class="form-group">
    <label for="confirm-password">Confirm password</label>
    <input class="form-control" type="password" name="confirm-password" id="confirm-password">
  </div>
  <button class="btn btn-primary">Submit</button>
  <a href="login.php">If you already have a user yet, you can log in here</a>

 
</form>

<?php require("partials/footer.inc.php") ?>