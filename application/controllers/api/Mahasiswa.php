<?php

use Restserver\Libraries\REST_Controller;

defined('BASEPATH') or exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
/** @noinspection PhpIncludeInspection */
//To Solve File REST_Controller not found
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

class Mahasiswa extends REST_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mahasiswa_model', 'mhs');
    }
    public function index_get()
    {
        $id = $this->get('id');
        if ($id === null) {

            $mahasiswa = $this->mhs->getMahasiswa();
        } else {
            $mahasiswa = $this->mhs->getMahasiswa($id);
        }

        if ($mahasiswa) {
            $this->response([
                'status' => true,
                'data' => $mahasiswa
            ], REST_Controller::HTTP_OK);
        } else {
            $this->response([
                'status' => false,
                'message' => 'user not found'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function index_delete()
    {
        $id = $this->delete('id');

        if ($id === null) {
            $this->response([
                'status' => false,
                'message' => 'provide no id'
            ], REST_Controller::HTTP_BAD_REQUEST);
        } else {
            if ($this->mhs->deleteMahasiswa($id) > 0) {
                //ok
                $this->response([
                    'status' => true,
                    'id' => $id,
                    'message' => "id telah terhapus"
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                //$id not found
                $this->response([
                    'status' => false,
                    'message' => ' id not found'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }
    public function index_post()
    {
        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')

        ];
        if ($this->mhs->createMahasiswa() > 0) {
            //$id not found
            $this->response([
                'status' => true,
                'message' => ' data has been created'
            ], REST_Controller::HTTP_CREATED);
        } else {
            //$id not found
            $this->response([
                'status' => false,
                'message' => ' data not created'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    public function index_put()
    {
        $id = $this->put('id');
        $data = [
            'nrp' => $this->post('nrp'),
            'nama' => $this->post('nama'),
            'email' => $this->post('email'),
            'jurusan' => $this->post('jurusan')

        ];
        if ($this->mhs->updateMahasiswa($data, $id) > 0) {
            //$id not found
            $this->response([
                'status' => true,
                'message' => ' data has been update'
            ], REST_Controller::HTTP_NO_CONTENT);
        } else {
            //$id not found
            $this->response([
                'status' => false,
                'message' => ' data not update'
            ], REST_Controller::HTTP_BAD_REQUEST);
        }
    }
}
