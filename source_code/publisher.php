<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Publisher.php');
include('classes/Template.php');

$publisher = new Publisher($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$publisher->open();
$publisher->getPublisher();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($publisher->addPublisher($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'publisher.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'publisher.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Publisher';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Publisher</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'publisher';

while ($div = $publisher->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['publisher_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="publisher.php?id=' . $div['publisher_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="publisher.php?hapus=' . $div['publisher_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($publisher->updatePublisher($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'publisher.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'publisher.php';
            </script>";
            }
        }

        $publisher->getPublisherById($id);
        $row = $publisher->getResult();

        $dataUpdate = $row['publisher_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($publisher->deletePublisher($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'publisher.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'publisher.php';
            </script>";
        }
    }
}

$publisher->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
