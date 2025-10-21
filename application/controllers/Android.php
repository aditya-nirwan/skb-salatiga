<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Android extends CI_Controller
{
    public function user()
    {
        $server = "localhost";
        $username = "root";
        $password = "";
        $database = "skb";

        $koneksi = mysqli_connect($server, $username, $password) or die("<h1>Koneksi Mysql Error : </h1>" . mysqli_error($koneksi));
        mysqli_select_db($koneksi, $database) or die("<h1>Koneksi Kedatabase Error : </h1>" . mysqli_error($koneksi));

        @$operasi = $_GET['operasi'];

        switch ($operasi) {
            case "view":
                /* Source code untuk menampilkan mahasiswa */
                $query_tampil_mahasiswa = mysqli_query($koneksi, "SELECT * FROM tb_user") or die(mysqli_error($koneksi));
                $data_array = array();
                while ($data = mysqli_fetch_assoc($query_tampil_mahasiswa)) {
                    $data_array[] = $data;
                }
                echo json_encode($data_array);

                break;

            case "insert":
                /* Source code untuk Insert data */
                @$id = $_GET['id'];
                @$npm = $_GET['npm'];
                @$nama = $_GET['nama'];
                @$kelas = $_GET['kelas'];
                @$gender = $_GET['gender'];

                $query_insert_data = mysqli_query($koneksi, "INSERT INTO tbmahasiswa (npm, nama, kelas, gender) VALUES('$npm', '$nama', '$kelas', '$gender')");
                if ($query_insert_data) {
                    echo "Data Berhasil Disimpan";
                } else {
                    echo "Error Insert pelanggan " . mysqli_error($koneksi);
                }

                break;

            case "get_mahasiswa_by_id":
                /* Source code untuk Edit data dan mengirim data berdasarkan id yang diminta */
                @$user_id = $_GET['user_id'];

                $query_tampil_mahasiswa  =  mysqli_query($koneksi, "SELECT * FROM tb_user WHERE user_id='$user_id'") or die(mysqli_error($koneksi));
                $data_array = array();
                $data_array = mysqli_fetch_assoc($query_tampil_mahasiswa);
                echo "[" . json_encode($data_array) . "]";

                break;

            case "update":
                /* Source code untuk Updatedata */
                @$id = $_GET['id'];
                @$npm = $_GET['npm'];
                @$nama = $_GET['nama'];
                @$kelas = $_GET['kelas'];
                @$gender = $_GET['gender'];

                $query_update_mahasiswa = mysqli_query($koneksi, "UPDATE tbmahasiswa SET id='$id', npm='$npm', nama='$nama', kelas='$kelas', gender='$gender' WHERE id='$id'");
                if ($query_update_mahasiswa) {
                    echo "Update Data Berhasil";
                } else {
                    echo mysqli_error($koneksi);
                }
                break;

            case "delete":
                /* Source code untuk Deletedata */
                @$id = $_GET['id'];

                $query_delete_mahasiswa = mysqli_query($koneksi, "DELETE FROM tbmahasiswa WHERE id='$id'");
                if ($query_delete_mahasiswa) {
                    echo "Delete Data Berhasil";
                } else {
                    echo mysqli_error($koneksi);
                }
                break;
            default:
                break;
        }
    }
}
