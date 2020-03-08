# CodeIgniter RestServer
Referensi: https://www.codepolitan.com/rest-api-server-sederhana-dengan-codeigniter-58901f324a29f

Langkah 1: Download dan Install Codeignitiner dan Rest API, ekstrak dan tambahkan folder tersebut ke htdocs dengan nama rest_api
link download: https://github.com/ardisaurus/ci-restserver
link tersebut telah terinstall dengan Rest API nya.

Langkah 2: Membuat database dengan nama kontak, 

            ```php
            CREATE DATABASE kontak;

            USE kontak;
            CREATE TABLE IF NOT EXISTS `telepon` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `nama` varchar(50) NOT NULL,
            `nomor` varchar(13) NOT NULL,
            PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

            USE kontak;
            INSERT INTO `telepon` (`id`, `nama`, `nomor`) VALUES
            (1, 'Orion', '08576666762'),
            (2, 'Mars', '08576666770'),
            (7, 'Alpha', '08576666765');
            ```
        lalu config database pada ../config/database.php seperti berikut

            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'kontak',
            'dbdriver' => 'mysqli',

Langkah 3: Membuat file Controller pada application/controllers dengan nama kontak.php dan isi dengan code berikut

            ```php
            defined('BASEPATH') OR exit('No direct script access allowed');

            require APPPATH . '/libraries/REST_Controller.php';
            use Restserver\Libraries\REST_Controller;

            class Kontak extends REST_Controller {

                function __construct($config = 'rest') {
                    parent::__construct($config);
                    $this->load->database();
                }
            }
            ```
Langkah 4: Download dan Install Aplikasi Postman untuk menguji metode-metode
link: https://www.postman.com/downloads/

Langkat 5: Pengujian

## Metode-Metode

1. Metode GET
    Tambahkan function get berikut pada controllers kontak.php

    ```php
    function index_get() {
                $id = $this->get('id');
                if ($id == '') {
                    $kontak = $this->db->get('telepon')->result();
                } else {
                    $this->db->where('id', $id);
                    $kontak = $this->db->get('telepon')->result();
                }
                $this->response($kontak, 200);
    ```

    Untuk menguji kode yang telah dibuat buka Postman, Pilih metode GET, masukan http://127.0.0.1/rest_ci/index.php/kontak pada address bar lalu klik "Send"

2. Metode POST
    Metode POST digunakan untuk mengirimkan data baru dari client ke server REST API. Sebagai contohnya digunakan untuk menambahkan kontak baru yang terdiri dari id, nama, dan nomor. 
    Tambahkan function post berikut pada controllers kontak.php

    ```php
        function index_post() {
        $data = array(
                    'id'           => $this->post('id'),
                    'nama'          => $this->post('nama'),
                    'nomor'    => $this->post('nomor'));
        $insert = $this->db->insert('telepon', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    ```
    Untuk mengujinya buka Postman, pilih metode POST, masukan http://127.0.0.1/rest_ci/index.php/kontak pada address bar, klik "Body" pada menu dibawah address bar, pilih x-www-form-urlencoded, masukan key dan value yang diperlukan (id, nama, nomor), lalu klik "Send".

3. Metode PUT
    Metode PUT digunakan untuk memperbarui data yang telah ada di server REST API. Sebagai contohnya digunakan untuk memperbarui data dengan id 88 pada tabel telepon database kontak.
    Tambahkan function put berikut pada controllers kontak.php

    ```php
    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'nama'          => $this->put('nama'),
                    'nomor'    => $this->put('nomor'));
        $this->db->where('id', $id);
        $update = $this->db->update('telepon', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    ```
    Untuk mengujinya buka Postman, pilih metode PUT, masukan http://127.0.0.1/rest_ci/index.php/kontak pada address bar, klik "Body" pada menu dibawah address bar, pilih x-www-form-urlencoded, masukan key id dan value id yang akan diubah (8) diikuti key dan value selanjutnya, lalu klik "Send".

4. Metode DELETE
    Metode DELETE digunakan untuk menghapus data yang telah ada di server REST API. Sebagai contohnya digunakan untuk menghapus data dengan id 88 pada tabel telepon database kontak. 
    ```php
    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('telepon');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }
    ```
    Untuk mengujinya buka Postman, pilih metode DELETE, masukan http://127.0.0.1/rest_ci/index.php/kontak pada address bar, klik "Body" pada menu dibawah address bar, pilih x-www-form-urlencoded, masukan key id dan value id yang akan dihapus (88), lalu klik "Send".

Dan berikut adalah full code pada ../controllers/kontak.php

```php
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Kontak extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $kontak = $this->db->get('telepon')->result();
        } else {
            $this->db->where('id', $id);
            $kontak = $this->db->get('telepon')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() {
        $data = array(
                    'id'           => $this->post('id'),
                    'nama'          => $this->post('nama'),
                    'nomor'    => $this->post('nomor'));
        $insert = $this->db->insert('telepon', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'nama'          => $this->put('nama'),
                    'nomor'    => $this->put('nomor'));
        $this->db->where('id', $id);
        $update = $this->db->update('telepon', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('telepon');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>
```