<?php

class Station_model
{
    private
        $table = 'station',
        $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getVar()
    {
        $query = 'SELECT * FROM ' . $this->table;
        $this->db->query($query);

        return $this->db->resultSet();
    }

    public function checkUser($npk)
    {
        $query = 'SELECT * FROM ' . $this->table . " WHERE user LIKE '%$npk%'";
        $this->db->query($query);

        return $this->db->single();
    }
}
