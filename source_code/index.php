<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Developer.php');
include('classes/Publisher.php');
include('classes/Game.php');
include('classes/Template.php');

// buat instance Game
$listGame = new Game($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);

// buka koneksi
$listGame->open();
// tampilkan data Game
$listGame->getGameJoin();

$order = "game.game_id";
if (isset($_POST["btn-sort"])) {
    $order = "game." . $_POST["dropdown"];
}
// cari Game
if (isset($_POST["btn-cari"])) {
    // methode mencari data Game
    $listGame->searchGame($_POST["cari"], $order);
} else {
    // method menampilkan data Game
    $listGame->getGameJoin($order);
}

$data = null;

// ambil data Game
// gabungkan dgn tag html
// untuk di passing ke skin/template
while ($row = $listGame->getResult()) {
    $data .= '<div class="col-3 gy-4 justify-content-center">' .
        '<div class="card rounded shadow-sm pt-4 px-2 game-thumbnail">
        <a href="detail.php?id=' . $row['game_id'] . '">
            <div class="row justify-content-center">
                <img src="assets/images/' . $row['game_foto'] . '" class="card-img-top rounded" alt="' . $row['game_foto'] . '">
            </div>
            <div class="card-body">
                <p class="card-text game-nama">' . $row['game_nama'] . '</p>
                <p class="card-text developer-nama my-0">' . $row['developer_nama'] . '</p>
                <p class="card-text publisher-nama my-0">' . $row['publisher_nama'] . '</p>
            </div>
        </a>
    </div>    
    </div>';
}

// tutup koneksi
$listGame->close();

// buat instance template
$home = new Template('templates/skin.html');

// simpan data ke template
$home->replace('DATA_GAME', $data);
$home->write();
