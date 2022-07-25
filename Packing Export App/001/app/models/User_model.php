<?php

class User_model
{
    private
        $table = 'user',
        $db;

    public function __construct()
    {
        $this->db = new Database_master;
    }

    public function checkUserPass($data)
    {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username = :username AND password = :password');
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', $data['password']);
        return $this->db->single();
    }

    public function getOpName($data)
    {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE npk = :npk';
        $this->db->query($query);
        $this->db->bind('npk', $data);

        return $this->db->single();
    }
}
