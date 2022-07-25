<?php

class ProductBoxingExp_model
{
    private
        $table = 'product_boxing_exp',
        $db;

    public function __construct()
    {
        $this->db = new Database_master;
    }

    public function getPartName($data)
    {
        $this->db->query('SELECT part_name FROM ' . $this->table . " WHERE pn_cust = :pn_cust");
        $this->db->bind('pn_cust', $data);

        return $this->db->oneValue();
    }

    public function getPartNumber($part_name)
    {
        $this->db->query('SELECT pn_cust FROM ' . $this->table . " WHERE part_name = :part_name");
        $this->db->bind('part_name', $part_name);

        return $this->db->oneValue();
    }

    public function getPartNumberWithPic($pic)
    {
        $this->db->query('SELECT barcode FROM ' . $this->table . " WHERE barcode = :barcode");
        $this->db->bind('barcode', $pic);

        return $this->db->oneValue();
    }

    public function getDataProduct($part_name)
    {
        $query = 'SELECT * FROM ' . $this->table . " WHERE part_name = :part_name";
        $this->db->query($query);
        $this->db->bind('part_name', $part_name);

        return $this->db->single();
    }

    public function getDataWithBarcode($barcode)
    {
        $query = 'SELECT * FROM ' . $this->table . " WHERE barcode = :barcode";
        $this->db->query($query);
        $this->db->bind('barcode', $barcode);

        return $this->db->single();
    }

    public function getVarWithPic($pic)
    {
        $query = 'SELECT * FROM ' . $this->table . " WHERE barcode = :barcode";
        $this->db->query($query);
        $this->db->bind('barcode', $pic);

        return $this->db->single();
    }

    public function getVarWithPncust($pn_cust)
    {
        $query = 'SELECT * FROM ' . $this->table . " WHERE pn_cust = :pn_cust";
        $this->db->query($query);
        $this->db->bind('pn_cust', $pn_cust);

        return $this->db->single();
    }

    public function getDataSpare($part_name)
    {
        $query = 'SELECT * FROM ' . $this->table . " WHERE part_name = :part_name AND type = :type";
        $this->db->query($query);
        $this->db->bind('part_name', $part_name);
        $this->db->bind('type', 'sparepart');

        return $this->db->single();
    }
}
