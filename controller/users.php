<?php

    require("../inc/conn.php"); // Get $conn (DB Connection).
    //echo $t = getUser($conn);
    if($_POST["proc"] == "1"){
        echo $t = getUser($conn);
    }
    if($_POST["proc"] == "2"){
        echo $t = editUser($conn);
    }

    function getUser($conn){
        $sql = "SELECT users.id, users.user_name, login.email
                FROM users 
                INNER JOIN login ON login.id = users.id
                WHERE users.id  = '". $_POST["userID"] ."' AND users.active = 1
                ";
        $result = $conn->query($sql);
        $conn->close();

        $res = array();
        $row_cnt = mysqli_num_rows($result);
        if ($row_cnt > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                //$res["res"] = "id: " . $row["id"]. " - Email: " . $row["email"]. " " . $row["password"]. " " . $row["active"]. "<br>", ["num"] = 1) ;
                $res['user_id'] = $row["id"];
                $res['user_name'] = $row["user_name"];
                $res['email'] = $row["email"];
                $res['count'] = $row_cnt;
            }
        } else {
            $res['user_id'] = 0;
            $res['user_name'] = "No Data";
            $res['count'] = $row_cnt;
        }


        return json_encode($res);
        //return $sql;
    }

    function editUser($conn){
        //$_POST["userID"];
        $count = count($_POST);
        if($_POST["user_name"] != ""){
            $sql_editUser = "UPDATE users SET user_name = '". $_POST["user_name"]. "' WHERE id = '".$_POST["user_id"]."'";
            $conn->query($sql_editUser);
        }
        if($_POST["email"] != ""){
            $sql_editUser = "UPDATE login SET  email = '". $_POST["email"]. "' WHERE id = '".$_POST["user_id"]."'";
            $conn->query($sql_editUser);
        }
        $conn->close();
    }
    

?>