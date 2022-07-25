<?php

class PokayokeKanban_model
{
    private
        $table = 'pokayoke_kanban',
        $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getVar()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->single();
    }

    public function resetVar()
    {
        $query = 'UPDATE ' . $this->table . " SET api = :api, cust = :cust, uniq = :uniq";
        $this->db->query($query);
        $this->db->bind('api', NULL);
        $this->db->bind('cust', NULL);
        $this->db->bind('uniq', NULL);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function resetAllVar()
    {
        $query = 'UPDATE ' . $this->table . " SET api = :api, cust = :cust, uniq = :uniq, ref = :ref";
        $this->db->query($query);
        $this->db->bind('api', NULL);
        $this->db->bind('cust', NULL);
        $this->db->bind('uniq', NULL);
        $this->db->bind('ref', NULL);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
