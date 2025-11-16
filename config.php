<?php
session_start();

// Konfigurasi
define('CONTACTS_FILE', 'contacts.json');
define('USERNAME', 'Akeyla');
define('PASSWORD', 'TA4');

// Fungsi untuk membaca kontak dari file JSON
function readContacts() {
    if (!file_exists(CONTACTS_FILE)) {
        return [];
    }
    $data = file_get_contents(CONTACTS_FILE);
    return json_decode($data, true) ?: [];
}

// Fungsi untuk menyimpan kontak ke file JSON
function saveContacts($contacts) {
    file_put_contents(CONTACTS_FILE, json_encode($contacts, JSON_PRETTY_PRINT));
}

// Redirect jika belum login
function checkAuth() {
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        header('Location: login.php');
        exit();
    }
}
?>