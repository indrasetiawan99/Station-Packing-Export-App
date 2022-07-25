<?php

class PokayokeDataPart_model
{
    private
        $table = 'pokayoke_data_part',
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

    public function setVar()
    {
        $query = 'UPDATE ' . $this->table . " SET local = :local, shopping = :shopping";

        $this->db->query($query);
        $this->db->bind('local', NULL);
        $this->db->bind('shopping', NULL);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function setLocal($local)
    {
        $query = 'UPDATE ' . $this->table . " SET local = :local";
        $this->db->query($query);
        $this->db->bind('local', $local);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function setShopping($shopping)
    {
        $query = 'UPDATE ' . $this->table . " SET shopping = :shopping";
        $this->db->query($query);
        $this->db->bind('shopping', $shopping);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
