<?php

$id = $_SESSION['id'];

$query = "SELECT * FROM users WHERE id = '$id'";

try {
    $result = mysqli_query($conexao, $query);
    
    $row = mysqli_num_rows($result);
    
    if ($row == 1) {
        while($rowDTO = mysqli_fetch_array($result)) {
            updateSessions($rowDTO);
            exit();
        }
    }
}
catch(Exception $e) {
    echo json_encode(
        array(
            'error' => array(
                'msg' => $e->getMessage(), 
                'code'=> $e->getCode())));
}

function updateSessions($row) {
    $_SESSION['id'] = $row['id'];
    $_SESSION['login'] = $row['login'];
    $_SESSION['full_name'] = $row['full_name'];
    $_SESSION['picture'] = $row['picture'] != null ? $row['picture'] : 'img/anon.jpg';
    $_SESSION['permission'] = $row['permission'];
}

?>