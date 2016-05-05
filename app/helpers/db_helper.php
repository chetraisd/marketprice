<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// get option =========
if (!function_exists('getoption')) {

    function getoption($sql, $key, $display, $select = '', $istop = false)
    {
        $ci = &get_instance();
        $query = $ci->db->query($sql);
        $op = "";
        if ($istop) {
            $op .= '<option value=""></option>';
        }
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $op .= '<option ' . ($select == $row[$key] ? ' selected= "selected" ' : '') . '  value="' . $row[$key] . '">' . $row[$display] . '</option>';
            }
        }
        return $op;
    }

}
// call back
/*<select required class="form-control" id="dmid" name="dmid" placeholder="Roles">
	<?php
        echo getoption("SELECT
								r.id,
								r.role_name
						FROM
								z_roles AS r
						ORDER BY
								r.role_name ASC", "id", "role_name", (isset($row->dmid) ? $row->dmid : ''), true);
    ?>
</select>*/