<?php
use GuzzleHttp\Client;

class Mahasiswa_model extends CI_model {
    private $_client;

    public function __construct()
    {
        $this->_client = new Client([
            'base_uri' => 'http://localhost/restserver/api/',
            'auth' => ['admin', 'Psw1234']
        ]);
    }

    public function getAllMahasiswa()
    {
        //  return $this->db->get('mahasiswa')->result_array();

        //  use guzzle api
        $response = $this->_client->request('GET', 'mahasiswa', [
            //  key pindah ke variable
            'query' => [
                'keyapi' => '01234'
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'];
    }

    public function getMahasiswaById($id)
    {
        //  return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();

        //  use guzzle api
        $response = $this->_client->request('GET', 'mahasiswa', [
            'query' => [
                'keyapi' => '01234',
                'id'        => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result['data'][0];
    }

    public function tambahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "keyapi" => '01234'
        ];

        //  $this->db->insert('mahasiswa', $data);

        //  use guzzle api
        $response = $this->_client->request('POST', 'mahasiswa', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function ubahDataMahasiswa()
    {
        $data = [
            "nama" => $this->input->post('nama', true),
            "nrp" => $this->input->post('nrp', true),
            "email" => $this->input->post('email', true),
            "jurusan" => $this->input->post('jurusan', true),
            "id" => $this->input->post('id', true),
            "keyapi" => '01234'
        ];

        //  $this->db->where('id', $this->input->post('id'));
        //  $this->db->update('mahasiswa', $data);

        //  use guzzle api
        $response = $this->_client->request('PUT', 'mahasiswa', [
            'form_params' => $data
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function hapusDataMahasiswa($id)
    {
        //  $this->db->delete('mahasiswa', ['id' => $id]);

        //  use guzzle api
        $response = $this->_client->request('delete', 'mahasiswa', [
            'form_params' => [
                'keyapi' => '01234',

                'id' => $id
            ]
        ]);

        $result = json_decode($response->getBody()->getContents(), true);
        return $result;
    }

    public function cariDataMahasiswa()
    {
        $keyword = $this->input->post('keyword', true);
        $this->db->like('nama', $keyword);
        $this->db->or_like('jurusan', $keyword);
        $this->db->or_like('nrp', $keyword);
        $this->db->or_like('email', $keyword);
        return $this->db->get('mahasiswa')->result_array();
    }
}