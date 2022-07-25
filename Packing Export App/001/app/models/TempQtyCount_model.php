<?php

class TempQtyCount_model
{
    private
        $table = 'temp_qty_count',
        $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function setVar($qty)
    {
        $query = 'UPDATE ' . $this->table . " SET qty = :qty";
        $this->db->query($query);
        $this->db->bind('qty', $qty);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function countdownVar()
    {
        $query = 'UPDATE ' . $this->table . " SET qty = qty - 1";
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

    public function resetVar()
    {
        $query = 'UPDATE ' . $this->table . " SET qty = :qty";
        $this->db->query($query);
        $this->db->bind('qty', 0);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
