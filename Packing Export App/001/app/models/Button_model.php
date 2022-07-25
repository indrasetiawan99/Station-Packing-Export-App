<?php

class Button_model
{
    private
        $table = 'button',
        $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function insertVal()
    {
        $query = 'INSERT INTO ' . $this->table . " (action) VALUES ('print')";
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getVar()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $this->db->query($query);

        return $this->db->single();
    }

    public function delVar($id)
    {
        $query = 'DELETE FROM ' . $this->table . " WHERE id = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
