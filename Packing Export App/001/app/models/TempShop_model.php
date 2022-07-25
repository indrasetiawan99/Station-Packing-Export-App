<?php

class TempShop_model
{
    private
        $table = 'temp_shop',
        $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function setVar($data)
    {
        $query = 'UPDATE ' . $this->table . " SET name = :name, npk = :npk";
        $this->db->query($query);
        $this->db->bind('name', $data['name']);
        $this->db->bind('npk', $data['npk']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getVar()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $this->db->query($query);

        return $this->db->single();
    }

    public function resetVar()
    {
        $query = 'UPDATE ' . $this->table . " SET name = :name, npk = :npk";
        $this->db->query($query);
        $this->db->bind('name', NULL);
        $this->db->bind('npk', NULL);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
