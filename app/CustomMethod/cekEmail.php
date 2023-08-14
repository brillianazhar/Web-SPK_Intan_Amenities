<?php

$email = $_GET['sgemail'];

$this->db->where('email', '$email');
// here we select every column of the table
$q = $this->db->get('user');
$data = $q->result_array();

if ($data->num_rows > 0) {
    echo "false";
} else {
    echo "true";
}
