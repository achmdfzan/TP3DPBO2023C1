<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Game.php');
include('classes/Template.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $game = new Game($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
        $game->open();
        $game->deleteData($id);

        header("Location: index.php");
    }
}