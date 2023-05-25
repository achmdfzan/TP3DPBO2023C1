<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Developer.php');
include('classes/Publisher.php');
include('classes/Game.php');
include('classes/Template.php');

$game = new Game($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$game->open();

$developer = new Developer($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$developer->open();
$developer->getDeveloper();

$publisher = new Publisher($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$publisher->open();
$publisher->getPublisher();

$data = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        $game->getGameById($id);
        $row = $game->getResult();

        $listDeveloper = null;
        while ($div = $developer->getResult()) {
          $listDeveloper .= '<option value="'. $div["developer_id"] .'"';
          if ($row["developer_id"] == $div["developer_id"]) $listDeveloper .= 'selected';
          $listDeveloper .= '>'. $div["developer_nama"] .'</option>';
        }

        $listPublisher = null;
        while ($div = $publisher->getResult()) {
          $listPublisher .= '<option value="'. $div["publisher_id"] .'"';
          if ($row["publisher_id"] == $div["publisher_id"]) $listPublisher .= 'selected';
          $listPublisher .= '>'. $div["publisher_nama"] .'</option>';
        }

        $data .= '<div class="card-header text-center">
        <h3 class="my-0">Ubah Game '. $row["game_nama"] .'</h3>
        </div>
        <div class="card-body text-start">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/'. $row["game_foto"] .'" class="img-thumbnail" alt="'. $row["game_foto"] .'" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3 py-3">
                        <form action="update_game.php?id='. $row["game_id"] .'" method="post" enctype="multipart/form-data">
                          <div class="form-group">
                            <input type="hidden" id="foto_kosong" aria-describedby="fotoKosongHelp" name="foto_kosong" value="'. $row["game_foto"] .'">
                          </div>
                          <div class="form-group my-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="foto" accept="image/*" name="foto">
                          </div>
                          <div class="form-group my-3">
                            <label for="nama" class="mb-1">Nama</label>
                            <input type="text" class="form-control" id="nama" aria-describedby="namaHelp" placeholder="Masukkan nama" name="nama" value="'. $row["game_nama"] .'">
                          </div>
                          <div class="form-group my-3">
                            <label for="genre" class="mb-1">Genre</label>
                            <input type="text" class="form-control" id="genre" aria-describedby="GenreHelp" placeholder="Masukkan genre" name="genre" value="'. $row["game_genre"] .'">
                          </div>
                          <div class="form-group my-3">
                            <label for="platform" class="mb-1">Platform</label>
                            <input type="text" class="form-control" id="platform" aria-describedby="PlatformHelp" placeholder="Masukkan platform" name="platform" value="'. $row["game_platform"] .'">
                          </div>
                          <div class="form-group my-3">
                            <label for="developer" class="mb-1">Developer</label>
                            <select class="form-control" id="developer" name="developer">
                              '. $listDeveloper .'
                            </select>
                          </div>
                          <div class="form-group my-3">
                            <label for="publisher" class="mb-1">Publisher</label>
                            <select class="form-control" id="publisher" name="publisher">
                              '. $listPublisher .'
                            </select>
                          </div>
                          <button type="submit" value="Upload" class="btn btn-primary mt-3">Submit</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>';
    }
}
else {
    $listDeveloper = null;
    while ($div = $developer->getResult()) {
      $listDeveloper .= '<option value="'. $div["developer_id"] .'">'. $div["developer_nama"] .'</option>';
    }

    $listPublisher = null;
    while ($div = $publisher->getResult()) {
      $listPublisher .= '<option value="'. $div["publisher_id"] .'">'. $div["publisher_nama"] .'</option>';
    }

    $data .= '<div class="card-header text-center">
        <h3 class="my-0">Tambah Game</h3>
        </div>
        <div class="card-body text-start">
            <div class="row mb-5">
                <div class="col-3">
                    <div class="row justify-content-center">
                        <img src="assets/images/default-game.jpg" class="img-thumbnail" alt="default-game.jpg" width="60">
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="card px-3 py-3">
                        <form action="add_game.php" method="post" enctype="multipart/form-data">
                          <div class="form-group my-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control" type="file" id="foto" accept="image/*" name="foto">
                          </div>
                          <div class="form-group my-3">
                            <label for="nama" class="mb-1">Nama</label>
                            <input type="text" class="form-control" id="nama" aria-describedby="namaHelp" placeholder="Masukkan nama" name="nama">
                          </div>
                          <div class="form-group my-3">
                            <label for="genre" class="mb-1">Genre</label>
                            <input type="text" class="form-control" id="genre" aria-describedby="GenreHelp" placeholder="Masukkan genre" name="genre">
                          </div>
                          <div class="form-group my-3">
                            <label for="platform" class="mb-1">Platform</label>
                            <input type="text" class="form-control" id="platform" aria-describedby="PlatformHelp" placeholder="Masukkan platform" name="platform">
                          </div>
                          <div class="form-group my-3">
                            <label for="developer" class="mb-1">Developer</label>
                            <select class="form-control" id="developer" name="developer">
                              <option></option>
                              '. $listDeveloper .'
                            </select>
                          </div>
                          <div class="form-group my-3">
                            <label for="publisher" class="mb-1">Publisher</label>
                            <select class="form-control" id="publisher" name="publisher">
                              <option></option>
                              '. $listPublisher .'
                            </select>
                          </div>
                          <button type="submit" value="Upload" class="btn btn-primary mt-3">Submit</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>';
}

$game->close();
$detail = new Template('templates/skiniu.html');
$detail->replace('DATA_DETAIL_GAME', $data);
$detail->write();
