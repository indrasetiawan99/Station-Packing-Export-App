<?php

class UniqCode_model
{
    private
        $table = 'uniq_code',
        $db;

    public function __construct()
    {
        $this->db = new Database_master;
    }

    public function getVar()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $this->db->query($query);

        return $this->db->single();
    }

    public function setVar($cycle, $date)
    {
        $query = 'UPDATE ' . $this->table . ' SET cycle = :cycle, date = :date';
        $this->db->query($query);
        $this->db->bind('cycle', $cycle);
        $this->db->bind('date', $date);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function incVar()
    {
        $query = 'UPDATE ' . $this->table . " SET cycle = cycle + 1";
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
