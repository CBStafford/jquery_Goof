<?php

    // echo $_POST["email"];
    // exit();

    require("../inc/conn.php"); // Get $conn (DB Connection).

    $t = login($conn);
    echo $t;

    function login($conn){  // Validate User and Create new login & user if one does not exist.

        $sql = "SELECT id, email, password, active FROM login WHERE email  = '". $_POST["email"] ."' AND password = '".$_POST["password"]."'";
        $result = $conn->query($sql);
        //$conn->close();

        $res = array();
        $row_cnt = mysqli_num_rows($result);
        if ($row_cnt > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if($row["active"] > 0){
                    //$res["res"] = "id: " . $row["id"]. " - Email: " . $row["email"]. " " . $row["password"]. " " . $row["active"]. "<br>", ["num"] = 1) ;
                    $res['user_id'] = $row["id"];
                    $res['res'] = 'You are logged in';
                    $res['count'] = $row_cnt;
                }else{
                    //$res["res"] = "0 results", ["num"] = 0);
                    $res['res'] = 'Access Denied';
                    $res['count'] = 0;
                }
                
            }
            
        } else {
            $mystring = $_POST["email"];
            $findme   = '@';
            $pos = strpos($mystring, $findme);
            $user_name = substr($_POST["email"], 0, $pos);

            $sql_insert_new_login = "INSERT INTO login (email, password) VALUES ('". $_POST["email"] ."', '".$_POST["password"]."'); ";
            $conn->query($sql_insert_new_login);
            $last_id = $conn->insert_id;
            $sql_insert_new_user = "INSERT INTO users (id, user_name) VALUES ($last_id, '". $user_name ."');";
            $conn->query($sql_insert_new_user);

            //$res["res"] = "0 results", ["num"] = 0);
            $res['res'] = 'Your Account has beed created.  Please login.';
            $res['count'] = 0;
        }
        $conn->close();

        return json_encode($res);

    }       

?>