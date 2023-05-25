<?php

include('config/db.php');
include('classes/DB.php');
include('classes/Developer.php');
include('classes/Template.php');

$developer = new Developer($DB_HOST, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
$developer->open();
$developer->getDeveloper();

if (!isset($_GET['id'])) {
    if (isset($_POST['submit'])) {
        if ($developer->addDeveloper($_POST) > 0) {
            echo "<script>
                alert('Data berhasil ditambah!');
                document.location.href = 'developer.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal ditambah!');
                document.location.href = 'developer.php';
            </script>";
        }
    }

    $btn = 'Tambah';
    $title = 'Tambah';
}

$view = new Template('templates/skintabel.html');

$mainTitle = 'Developer';
$header = '<tr>
<th scope="row">No.</th>
<th scope="row">Nama Developer</th>
<th scope="row">Aksi</th>
</tr>';
$data = null;
$no = 1;
$formLabel = 'developer';

while ($div = $developer->getResult()) {
    $data .= '<tr>
    <th scope="row">' . $no . '</th>
    <td>' . $div['developer_nama'] . '</td>
    <td style="font-size: 22px;">
        <a href="developer.php?id=' . $div['developer_id'] . '" title="Edit Data"><i class="bi bi-pencil-square text-warning"></i></a>&nbsp;<a href="developer.php?hapus=' . $div['developer_id'] . '" title="Delete Data"><i class="bi bi-trash-fill text-danger"></i></a>
        </td>
    </tr>';
    $no++;
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if ($id > 0) {
        if (isset($_POST['submit'])) {
            if ($developer->updateDeveloper($id, $_POST) > 0) {
                echo "<script>
                alert('Data berhasil diubah!');
                document.location.href = 'developer.php';
            </script>";
            } else {
                echo "<script>
                alert('Data gagal diubah!');
                document.location.href = 'developer.php';
            </script>";
            }
        }

        $developer->getDeveloperById($id);
        $row = $developer->getResult();

        $dataUpdate = $row['developer_nama'];
        $btn = 'Simpan';
        $title = 'Ubah';

        $view->replace('DATA_VAL_UPDATE', $dataUpdate);
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    if ($id > 0) {
        if ($developer->deletedeveloper($id) > 0) {
            echo "<script>
                alert('Data berhasil dihapus!');
                document.location.href = 'developer.php';
            </script>";
        } else {
            echo "<script>
                alert('Data gagal dihapus!');
                document.location.href = 'developer.php';
            </script>";
        }
    }
}

$developer->close();

$view->replace('DATA_MAIN_TITLE', $mainTitle);
$view->replace('DATA_TABEL_HEADER', $header);
$view->replace('DATA_TITLE', $title);
$view->replace('DATA_BUTTON', $btn);
$view->replace('DATA_FORM_LABEL', $formLabel);
$view->replace('DATA_TABEL', $data);
$view->write();
