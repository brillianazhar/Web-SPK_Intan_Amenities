<?php

$namakr = $_GET['namakr'];

$this->db->where('namakr', $namakr);
// here we select every column of the table
$q = $this->db->get('kriteria');
$data = $q->result_array();

if ($data->num_rows > 0) {
    echo "false";
} else {
    echo "true";
}
