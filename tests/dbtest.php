<?php
include '../db.php';
$db = new Database();
$db->create_table();
$db->insert_data('ashraf mohamed', 'noobmaster', 'ashraf@gmail','thor', '01000000', 'cairo', 'noobmaster123');
?>