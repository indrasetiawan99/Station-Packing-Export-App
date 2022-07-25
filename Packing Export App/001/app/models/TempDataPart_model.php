<?php

class TempDataPart_model
{
    private
        $table = 'temp_data_part',
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

    public function getVarWithId($id)
    {
        $query = 'SELECT * FROM ' . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);

        return $this->db->single();
    }

    public function delVar($data)
    {
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $this->db->query($query);
        $this->db->bind('id', $data);
        $this->db->execute();

        $query = "ALTER TABLE " . $this->table . " AUTO_INCREMENT = 0";
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
