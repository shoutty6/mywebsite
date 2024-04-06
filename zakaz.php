<?php
session_start();

$FROM = $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);

$name = stripslashes(htmlspecialchars($_POST['name']));
$phone = stripslashes(htmlspecialchars($_POST['phone']));
$product_price = stripslashes(htmlspecialchars($_POST['s1']));
$product_id = stripslashes(htmlspecialchars($_POST['s2']));
$product_name = stripslashes(htmlspecialchars($_POST['s3']));
$email = stripslashes(htmlspecialchars($_POST['email']));
$country = 'UA';
if (stripslashes(htmlspecialchars($_POST['country']))) {
    $country = stripslashes(htmlspecialchars($_POST['country']));
}

$ip_mail = $_SERVER['REMOTE_ADDR'];
$source_mail = $_SESSION['utms']['utm_source'];
$medium_mail = $_SESSION['utms']['utm_medium'];
$term_mail = $_SESSION['utms']['utm_term'];
$content_mail = $_SESSION['utms']['utm_content'];
$campaign_mail = $_SESSION['utms']['utm_campaign'];
$agent_mail = $_SERVER ['HTTP_USER_AGENT'];
$ga = $_POST['ga'];

$subject = 'Нова заявка';
$message = "ПІБ: {$name}\nКонтактний телефон: {$phone}\nСайт: {$FROM}\nIP: {$ip_mail}\nutm_source: {$source_mail}\nutm_medium: {$medium_mail}\nutm_term: {$term_mail}\nutm_content: {$content_mail}\nutm_campaign: {$campaign_mail}";
$addressat = "miocabinet@gmail.com";
mail($addressat, $subject, $message, "Content-type:text/plain;charset=utf-8\r\n");

$FROM = $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
if( $FROM[strlen($FROM) - 1] != "/" ){

    $FROM .= "/" ;
    
}
$success_url = "https://{$FROM}form-ok.php?name=$name&phone=$phone";
header('Location: '.$success_url);

?>