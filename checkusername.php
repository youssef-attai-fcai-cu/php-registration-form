<?php

include __DIR__ . "/db.php";

$username = $_GET['username'];

// Make sure username is not used by another user

if ($database->user_exists($username)) {
  die('fail');
} else {
  die('success');
}
