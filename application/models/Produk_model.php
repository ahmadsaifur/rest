<?php

class Produk_model extends CI_Model
{
    public function getProduk($id = null)
    {
        if ($id === null) {

            return $this->db->get('produk')->result_array();
        } else {
            return  $this->db->get_where('produk', ['id' => $id])->result_array();
        }
    }
    public function deleteProduk($id)
    {
        $this->db->delete('produk', ['id' => $id])->result_array();
        return $this->db->affected_row();
    }
    public function createdProduk($data)
    {
        $this->db->insert('produk', $data);
        return $this->db->affected_row();
    }
    public function updateProduk($data, $id)
    {
        $this->db->update('produk', $data, ['id' => $id]);
        return $this->db->affected_row();
    }
}
