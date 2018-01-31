<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function getlastupdate($table, $nik, $field) {
    $ci = & get_instance();
    $sql = "select MAX(" . $field . ") last_update from " . $table . " where nik='" . $nik . "' ";
    $query = $ci->db->query($sql);
    if ($query->num_rows() > 0) {
        if ($query->row()->last_update != "0000-00-00 00:00:00") {
            $time = strtotime($query->row()->last_update);
            $date = date("d M Y", $time);
            return $date;
        } else
            return "Out Of Date";
    } else
        return "No last update defined";
}

function getlastupdateskill($type, $nik, $field) {
    $ci = & get_instance();
    $where = ($type == "tech" ? "typeskill NOT IN (1,2)" : "typeskill IN (1,2)" );
    $sql = "select MAX(" . $field . ") last_update from technicalperson where nik='" . $nik . "' and " . $where . " ";
    $query = $ci->db->query($sql);
    if ($query->num_rows() > 0) {
        if ($query->row()->last_update != "0000-00-00 00:00:00") {
            $time = strtotime($query->row()->last_update);
            $date = date("d M Y", $time);
            return $date;
        } else
            return "Out Of Date";
    } else
        return "No last update defined";
}

function single_emp($nik) {
    $ci = & get_instance();
    $dbemp = $ci->load->database('employee', TRUE);
    $sql = "select a.EMAIL, a.EMP_NAME ,a.EMP_LEVEL,b.BU_NAME , d.EMP_NAME SPV  from hr_emp a LEFT JOIN hr_bu b ON a.BU_ID=b.BU_ID
   LEFT JOIN hr_hierarchy c ON a.EMP_ID=c.EMP_ID
   LEFT JOIN hr_emp d ON d.EMP_ID=c.EMP_PID
   WHERE a.EMP_ID='" . $nik . "'";
    $query = $dbemp->query($sql);
    $dbemp->close();
    if ($query->num_rows() > 0)
        return $query->row();
    else
        return "null";
}

function last_update($table) {
    $ci = & get_instance();
    $ci->db->where('table_name', $table);
    $query = $ci->db->get('log_update');
    return ($query->num_rows() > 0) ? $query->row(0) : NULL;
}

function bef_sumsizeblob($table, $field){
    $ci = & get_instance();
    $sql = "SELECT SUM(OCTET_LENGTH($field)) as scanevi FROM $table";
    $hsl = $ci->db->query($sql);
    return ($hsl->num_rows() > 0) ? $hsl->row()->scanevi : null;
}


