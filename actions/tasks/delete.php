<?php
require_once __DIR__ . "/../../utils/init.php";
if(!Auth::is_logged_in()) {
    header("Location: ../../index.php?page=login");
    die;
}

$connection = DBConnection::get_connection();
$isGroupTask = isset($_GET['group_id']);

if($isGroupTask) {
    $sql = "DELETE FROM group_tasks WHERE task_id = ?";
    $location = "../../index.php?page=group&group_id=" . $_GET['group_id'];   
}
else {
    $sql = "DELETE FROM tasks WHERE task_id = ?";
    $location = "../../index.php?page=manage_personal";
}
$stmt = $connection->prepare($sql);
$stmt->execute([$_GET['task_id']]);
header("Location: $location");
?>