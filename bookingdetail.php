<?php
// Include init code
require_once("utils/_init.php");

  if (verify_get("id")) {
    $id = $_GET["id"];
    // Query the data source
    $app = $topicStorage->findById($id);

  }

  
?>

<?php
// Echo session variables that were set on previous page
echo "Booking information". ".<br>";
echo "The email of the patient is: ". $_SESSION["email"]. ".<br>";
echo "The social security number of the patient is: ". $_SESSION["SSN"]. ".<br>";
echo "The fullname of the patient is: ". $_SESSION["fullname"]. ".<br>";
echo "the date and time of the booking is: ". $app["date"] .", and the time is: ". $app["time"] ." ."


?>

<html>

<br><br>
<input type="checkbox" id="Versicherung" >
  <label id="check" for="confirm">By clicking the checkbox I hereby declare that I understand that there are side effects of the vaccine</label><br><br>
  <button id="confirm" disabled="true">Comfirm booking</button>
  <p id="error" >You need to check the check box in order to book</p>
  <script src="./booking.js"></script>
</html>

