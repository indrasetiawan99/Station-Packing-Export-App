<?php

class QtyType_model
{
    private
        $table = 'qty_type',
        $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getVar()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $this->db->query($query);

        return $this->db->single();
    }

    public function resetVar()
    {
        $query = 'UPDATE ' . $this->table . " SET data_part = :data_part, part_name_1L = :part_name_1L, part_name_1N = :part_name_1N, barcode_1L = :barcode_1L, barcode_1N = :barcode_1N";
        $this->db->query($query);
        $this->db->bind('data_part', NULL);
        $this->db->bind('part_name_1L', NULL);
        $this->db->bind('part_name_1N', NULL);
        $this->db->bind('barcode_1L', NULL);
        $this->db->bind('barcode_1N', NULL);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
