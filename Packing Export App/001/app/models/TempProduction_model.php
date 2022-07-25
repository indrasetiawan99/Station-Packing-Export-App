<?php

class TempProduction_model
{
    private
        $table = 'temp_production',
        $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function setNpk($data)
    {
        $query = 'UPDATE ' . $this->table . " SET npk_op = :npk_op";
        $this->db->query($query);
        $this->db->bind('npk_op', $data);
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
        $query = 'UPDATE ' . $this->table . " SET npk_op = :npk_op, pic = :pic, pn_cust = :pn_cust, pn_api_exp = :pn_api_exp, part_name = :part_name, dock = :dock, pos = :pos, job_num = :job_num, address = :address, qty_exp = :qty_exp, count_qty_oem = :count_qty_oem, count_qty_exp = :count_qty_exp";
        $this->db->query($query);
        $this->db->bind('npk_op', NULL);
        $this->db->bind('pn_cust', NULL);
        $this->db->bind('pic', NULL);
        $this->db->bind('pn_api_exp', NULL);
        $this->db->bind('part_name', NULL);
        $this->db->bind('dock', NULL);
        $this->db->bind('pos', NULL);
        $this->db->bind('job_num', NULL);
        $this->db->bind('address', NULL);
        $this->db->bind('qty_exp', NULL);
        $this->db->bind('count_qty_oem', NULL);
        $this->db->bind('count_qty_exp', NULL);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function resetVarExcNpk()
    {
        $query = 'UPDATE ' . $this->table . " SET pn_cust = :pn_cust, pic = :pic, pn_api_exp = :pn_api_exp, part_name = :part_name, dock = :dock, pos = :pos, job_num = :job_num, address = :address, qty_exp = :qty_exp, count_qty_oem = :count_qty_oem, count_qty_exp = :count_qty_exp";
        $this->db->query($query);
        $this->db->bind('pn_cust', NULL);
        $this->db->bind('pic', NULL);
        $this->db->bind('pn_api_exp', NULL);
        $this->db->bind('part_name', NULL);
        $this->db->bind('dock', NULL);
        $this->db->bind('pos', NULL);
        $this->db->bind('job_num', NULL);
        $this->db->bind('address', NULL);
        $this->db->bind('qty_exp', NULL);
        $this->db->bind('count_qty_oem', NULL);
        $this->db->bind('count_qty_exp', NULL);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function setVar($data)
    {
        $query = 'UPDATE ' . $this->table . " SET pn_cust = :pn_cust, pic = :pic, pn_api_exp = :pn_api_exp, part_name = :part_name, dock = :dock, pos = :pos, job_num = :job_num, address = :address, qty_exp = :qty_exp, count_qty_oem = :count_qty_oem, count_qty_exp = :count_qty_exp";
        $this->db->query($query);
        $this->db->bind('pn_cust', $data['pn_cust']);
        $this->db->bind('pic', $data['barcode']);
        $this->db->bind('pn_api_exp', $data['pn_api_exp']);
        $this->db->bind('part_name', $data['part_name']);
        $this->db->bind('dock', $data['dock']);
        $this->db->bind('pos', $data['pos']);
        $this->db->bind('job_num', $data['job_num']);
        $this->db->bind('address', $data['address']);
        $this->db->bind('qty_exp', $data['qty_exp']);
        $this->db->bind('count_qty_oem', $data['qty_oem']);
        $this->db->bind('count_qty_exp', $data['count_qty_exp']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function setCountQty($data)
    {
        $query = 'UPDATE ' . $this->table . " SET count_qty_oem = :count_qty_oem";
        $this->db->query($query);
        $this->db->bind('count_qty_oem', $data['val-qty-oem']);
        // $this->db->bind('count_qty_exp', $data['val-qty-exp']);
        $this->db->execute();

        // $query = 'UPDATE ' . $this->table . " SET count_qty_oem = :count_qty_oem, count_qty_exp = :count_qty_exp";
        // $this->db->query($query);
        // $this->db->bind('count_qty_oem', $data['val-qty-oem']);
        // $this->db->bind('count_qty_exp', $data['val-qty-exp']);
        // $this->db->execute();

        return $this->db->rowCount();
    }

    public function setCountQtyOemExp($data)
    {
        $query = 'UPDATE ' . $this->table . " SET count_qty_oem = :count_qty_oem, count_qty_exp = :count_qty_exp";
        $this->db->query($query);
        $this->db->bind('count_qty_oem', $data['val-qty-oem']);
        $this->db->bind('count_qty_exp', $data['val-qty-exp']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function setQtyExp($qty_exp)
    {
        $query = 'UPDATE ' . $this->table . " SET qty_exp = :qty_exp, count_qty_exp = :count_qty_exp";
        $this->db->query($query);
        $this->db->bind('qty_exp', $qty_exp);
        $this->db->bind('count_qty_exp', $qty_exp);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function decrementCount()
    {
        $query = 'UPDATE ' . $this->table . " SET count_qty_oem = count_qty_oem - 1, count_qty_exp = count_qty_exp - 1";
        $this->db->query($query);
        $this->db->execute();

        return $this->db->rowCount();
    }
}
