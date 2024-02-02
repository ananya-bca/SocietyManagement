<?php

// This file conatins all curd operation functions in php.


// This function inserts values in database
function savedata($formdata, $faculty){
    include 'config.php';
    array_pop($_POST);
    $keys = array_keys($_POST);
    $keys = implode(',', $keys);
    $vals = array_values($_POST);
    $vals = implode(',', array_map(
        function($x){
            return is_numeric($x)?$x:"'$x'";
        },$vals
    ));
    if("script>confirm(Are you sure?)==ok"){
    $qry = "insert into $faculty($keys) values($vals)";
    $res = $conn->query($qry);
    }
    return $res;
}

// this function remove particular record from database
function delete_data($id ,$details, $fid){
include 'config.php';

$select = "DELETE FROM $details WHERE $fid = {$id}";
$result = mysqli_query($conn, $select);
}


// This function show a particular table data with edit and delete buttons
function read_data($course) {
    include 'config.php';

    $select = "SELECT * FROM $course";
    $res = $conn->query($select);

    $arr_data = $res->fetch_all(MYSQLI_ASSOC);

    $fieldinfo = $res->fetch_fields();

    echo '<table class="table table-bordered table-striped table-hover" id="mytable">';
    echo '<tr style="background-color:#61677A; color:white;"><th scope="col">#';
    
    foreach ($fieldinfo as $val) {
        echo '<th scope="col">' . $val->name . '</th>';
    }
    
    echo '<th scope="col">Action</th></tr>';

    $no = 1;
    foreach ($arr_data as $row) {
        echo '<tr class="filter"><td>' . $no++ . '</td>';

        foreach ($row as $key => $value) {
            echo '<td>' . $value . '</td>';
        }

        if ($course == 'flat') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success" style="margin-right:5px;" href="edit_flat.php?id=' . $row['flat_id'] . '" clas><i class="bx bxs-edit-alt"></i></a>';
            echo '<a class="btn btn-danger" style="margin-right:5px;" href="del_flat.php?id=' . $row['flat_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        } elseif ($course == 'members') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success" style="margin-right:5px;" href="edit_member.php?id=' . $row['member_id'] . '"><i class="bx bxs-edit-alt"></i></a>';
            echo '<a class="btn btn-danger"style="margin-right:5px;" href="del_member.php?id=' . $row['member_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        } elseif ($course == 'visitors') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success" style="margin-right:5px;" href="edit_visitor.php?id=' . $row['v_id'] . '"><i class="bx bxs-edit-alt"></i></a>';
            echo '<a class="btn btn-danger"style="margin-right:5px;" href="del_visitor.php?id=' . $row['v_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }elseif ($course == 'notice') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success" style="margin-right:5px;" href="edit_notice.php?id=' . $row['n_id'] . '"><i class="bx bxs-edit-alt"></i></a>';
            echo '<a class="btn btn-danger"style="margin-right:5px;" href="del_notice.php?id=' . $row['n_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }elseif ($course == 'bills') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success" style="margin-right:5px;" href="edit_bill.php?id=' . $row['bill_id'] . '"><i class="bx bx-check-double"></i></a>';
            echo '<a class="btn btn-danger"style="margin-right:5px;" href="del_bill.php?id=' . $row['bill_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }elseif ($course == 'contact_us') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success"style="margin-right:5px;" href="contacted.php?id=' . $row['id'] . '"><i class="bx bx-check-double"></i></a>';
            echo '<a class="btn btn-danger"style="margin-right:5px;" href="del_contact.php?id=' . $row['id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }else if ($course == 'wing') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success" style="margin-right:5px;" href="edit_wing.php?id=' . $row['wing_id'] . '" clas><i class="bx bxs-edit-alt"></i></a>';
            echo '<a class="btn btn-danger" style="margin-right:5px;" href="del_wing.php?id=' . $row['wing_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }else if ($course == 'complain'){
            echo '<td class="edit">';
            echo '<a class="btn btn-success"style="margin-right:5px;" href="complain_reply.php?id=' . $row['complain_id'] .'"><i class="bx bx-message-alt-dots"></i></a>';
            echo '<a class="btn btn-danger" style="margin-right:5px;" href="del_complain.php?id=' . $row['complain_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }   
        else{}
    }
}

// This function update particular record in given table
function updateData($table, $id, $columnData ,$fid){
    include 'config.php';
    $updateColumns = implode(' = ?, ', array_keys($columnData)) . ' = ?';
    $qry = "UPDATE $table SET $updateColumns WHERE $fid = ?";
    $res = $conn->prepare($qry);
    if ($res) {
        $types = str_repeat('s', count($columnData)) . 'i'; // Assuming 's' for string and 'i' for integer
        $bindValues = array_values($columnData);
        array_push($bindValues, $id);

        $res->bind_param($types, ...$bindValues);
        $res->execute();

        if ($res->affected_rows > 0) {
            return true; // Data updated successfully
        } else {
            return false; // No records were updated
        }

        $res->close();
    } else {
        return false; // Error in SQL statement
    }
}


// This function show a table data.
function show_data($course) {
    include 'config.php';

    $select = "SELECT * FROM $course";
    $res = $conn->query($select);

    $arr_data = $res->fetch_all(MYSQLI_ASSOC);

    $fieldinfo = $res->fetch_fields();

    echo '<table class="table table-bordered table-striped table-hover" id="mytable">';
    echo '<tr style="background-color:#61677A; color:white;"><th scope="col">#';
    
    foreach ($fieldinfo as $val) {
        echo '<th scope="col">' . $val->name . '</th>';
    }
    
    echo '</tr>';

    $no = 1;
    foreach ($arr_data as $row) {
        echo '<tr class="filter"><td>' . $no++ . '</td>';

        foreach ($row as $key => $value) {
            echo '<td>' . $value . '</td>';
        }
    }
}


// This function is also show a particular table data but with pagination
function data($course, $page = 1, $recordsPerPage = 6) {
    include 'config.php';

    // Calculate the offset based on the current page and records per page
    $offset = ($page - 1) * $recordsPerPage;

    $select = "SELECT * FROM $course LIMIT $offset, $recordsPerPage";
    $res = $conn->query($select);

    $arr_data = $res->fetch_all(MYSQLI_ASSOC);

    $fieldinfo = $res->fetch_fields();

    echo '<table class="table table-bordered table-striped table-hover" id="mytable">';
    echo '<tr style="background-color:#61677A; color:white;"><th scope="col">#';

    foreach ($fieldinfo as $val) {
        echo '<th scope="col">' . $val->name . '</th>';
    }

    echo '<th scope="col">Action</th></tr>';

    $no = $offset + 1; // Start numbering from the correct position
    foreach ($arr_data as $row) {
        echo '<tr class="filter"><td>' . $no++ . '</td>';

        foreach ($row as $key => $value) {
            echo '<td>' . $value . '</td>';
        }

        if ($course == 'flat') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success" style="margin-right:5px;" href="edit_flat.php?id=' . $row['flat_id'] . '" clas><i class="bx bxs-edit-alt"></i></a>';
            echo '<a class="btn btn-danger" style="margin-right:5px;" href="del_flat.php?id=' . $row['flat_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        } elseif ($course == 'members') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success" style="margin-right:5px;" href="edit_member.php?id=' . $row['member_id'] . '"><i class="bx bxs-edit-alt"></i></a>';
            echo '<a class="btn btn-danger"style="margin-right:5px;" href="del_member.php?id=' . $row['member_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        } elseif ($course == 'visitors') {
            echo '<td class="edit">';
            echo '<a class="btn btn-danger"style="margin-right:5px;" href="del_visitor.php?id=' . $row['v_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }elseif ($course == 'notice') {
            echo '<td class="edit">';
            echo '<a class="btn btn-danger"style="margin-right:5px;" href="del_notice.php?id=' . $row['n_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }elseif ($course == 'bills') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success" style="margin-right:5px;" href="edit_bill.php?id=' . $row['bill_id'] . '"><i class="bx bx-check-double"></i></a>';
            echo '<a class="btn btn-danger"style="margin-right:5px;" href="del_bill.php?id=' . $row['bill_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }elseif ($course == 'contact_us') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success"style="margin-right:5px;" href="contacted.php?id=' . $row['id'] . '"><i class="bx bx-check-double"></i></a>';
            echo '<a class="btn btn-danger"style="margin-right:5px;" href="del_contact.php?id=' . $row['id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }else if ($course == 'wing') {
            echo '<td class="edit">';
            echo '<a class="btn btn-success" style="margin-right:5px;" href="edit_wing.php?id=' . $row['wing_id'] . '" clas><i class="bx bxs-edit-alt"></i></a>';
            echo '<a class="btn btn-danger" style="margin-right:5px;" href="del_wing.php?id=' . $row['wing_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }else if ($course == 'complain'){
            echo '<td class="edit">';
            echo '<a class="btn btn-success"style="margin-right:5px;" href="complain_reply.php?id=' . $row['complain_id'] .'"><i class="bx bx-message-alt-dots"></i></a>';
            echo '<a class="btn btn-danger" style="margin-right:5px;" href="del_complain.php?id=' . $row['complain_id'] . '"><i class="bx bxs-trash-alt"></i></a>';
            echo '</td>';
        }   
        else{}
    }

    echo '</table>';

    // Pagination
    $query = "SELECT COUNT(*) FROM $course";
    $result = $conn->query($query);
    $row = $result->fetch_row();
    $total_records = $row[0];
    $total_pages = ceil($total_records / $recordsPerPage);

    echo '<div class="pagination">';
    if ($page > 1) {
        echo '<a href="?page=' . ($page - 1) . '">Prev</a>';
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        if ($i == $page) {
            echo '<a class="active" href="?page=' . $i . '">' . $i . '</a>';
        } else {
            echo '<a href="?page=' . $i . '">' . $i . '</a>';
        }
    }

    if ($page < $total_pages) {
        echo '<a href="?page=' . ($page + 1) . '">Next</a>';
    }
    echo '</div>';

    $conn->close();
}


?>

