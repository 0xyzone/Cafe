<?php
include '../includes/dbconnection.php';
if ($_POST){
    $uname = $_POST['username'];
    $pw = $_POST['password'];
    
    if ($uname == ""){
        $err = "Username is empty!";
    }
    if ($pw == ""){
        $err = "Please enter your password!";
    }
    if (($uname == "") && ($pw == "")){
        $err = "Arey kei ta lekhana hau!";
    } else {
        if ((!empty($_POST['username'])) && (!empty($_POST['password']))){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = mysqli_query($db,"SELECT * FROM userbase WHERE username='".$username."' AND password='".$password."'");
            $numrows = mysqli_num_rows($query);
            if ($numrows == 0){
                $err = "Username or password inccorect!";
            }
            if($numrows!=0){
                while($row=mysqli_fetch_assoc($query)){
                    $dbuser = $row['username'];
                    $dbpass = $row['password'];
                    $dbtype = $row['username'];
                }

                if(($username == $dbuser) && ($password == $dbpass)){
                    $_SESSION["user"] = $dbtype;
                    header('location:'.$site);
                } else {
                    $err = "Username or password inccorect!";
                }
            }
        }
    }
}
?>