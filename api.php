<?php
// koneksi ke database
error_reporting(0);
$host = "localhost";
$user = "root";
$pass = "";
$db = "react_native";

$koneksi = mysqli_connect($host, $user, $pass, $db);

$action = $_GET['action'];

switch ($action) {
    case '':
        read();
        break;
    case 'create':
        create();
        break;
    case 'update':
        update();
        break;
    case 'delete':
        delete();
        break;
    case 'detail':
        detail();
        break;
}

function read()
{
    global $koneksi;
    $query = "SELECT * FROM tb_ruang order by id asc";
    $result = mysqli_query($koneksi, $query);

    while ($row = mysqli_fetch_array($result)) {
        $hasil[] = array(
            'id' => $row['id'],
            'gedung' => $row['gedung'],
            'ruang' => $row['ruang'],
            'kapasitas' => $row['kapasitas'],
        );
    }
    $data['data']['result'] = $hasil;
    echo json_encode($data);
}

function create()
{
    global $koneksi;
    $gedung = $_POST['gedung'];
    $ruang = $_POST['ruang'];
    $kapasitas = $_POST['kapasitas'];

    $query = "INSERT INTO tb_ruang (gedung, ruang, kapasitas) VALUES ('$gedung', '$ruang', '$kapasitas')";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $data['data']['result'] = "Data berhasil disimpan";
    } else {
        $data['data']['result'] = "Data gagal disimpan";
    }
    echo json_encode($data);
}

function update()
{
    global $koneksi;
    $id = $_GET['id'];
    $gedung = $_POST['gedung'];
    $ruang = $_POST['ruang'];
    $kapasitas = $_POST['kapasitas'];

    if ($gedung != '') {
        $query = "UPDATE tb_ruang SET gedung = '$gedung' WHERE id = '$id'";
        $result = mysqli_query($koneksi, $query);
    }
    if ($ruang != '') {
        $query = "UPDATE tb_ruang SET ruang = '$ruang' WHERE id = '$id'";
        $result = mysqli_query($koneksi, $query);
    }
    if ($kapasitas != '') {
        $query = "UPDATE tb_ruang SET kapasitas = '$kapasitas' WHERE id = '$id'";
        $result = mysqli_query($koneksi, $query);
    }

    if ($result) {
        $data['data']['result'] = "Data berhasil disimpan";
    } else {
        $data['data']['result'] = "Data gagal disimpan";
    }
    echo json_encode($data);
}

function delete()
{
    global $koneksi;
    $id = $_GET['id'];

    $query = "DELETE FROM tb_ruang WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        $data['data']['result'] = "Data berhasil dihapus";
    } else {
        $data['data']['result'] = "Data gagal dihapus";
    }
    echo json_encode($data);
}

function detail()
{
    global $koneksi;
    $id = $_GET['id'];

    $query = "SELECT * FROM tb_ruang WHERE id='$id'";
    $result = mysqli_query($koneksi, $query);

    while ($row = mysqli_fetch_array($result)) {
        $hasil[] = array(
            'id' => $row['id'],
            'gedung' => $row['gedung'],
            'ruang' => $row['ruang'],
            'kapasitas' => $row['kapasitas'],
        );
    }
    $data['data']['result'] = $hasil;
    echo json_encode($data);
}
