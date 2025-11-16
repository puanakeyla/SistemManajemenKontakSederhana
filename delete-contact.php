<?php
require_once 'config.php';
checkAuth();

$contacts = readContacts();
$id = $_GET['id'] ?? '';

if (isset($contacts[$id])) {
    unset($contacts[$id]);
    saveContacts($contacts);
}

header('Location: index.php');
exit();
?>