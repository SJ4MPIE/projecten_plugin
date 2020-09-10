<?php
class Mail_to_user{

$msg = "Uw project is afgewezen";

// use wordwrap() if lines are longer than 70 characters
// $msg = wordwrap($msg,70);

// send email
mail("someone@example.com","My subject",$msg);

}


?>