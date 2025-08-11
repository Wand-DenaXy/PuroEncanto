<?php

require_once 'connection.php';


class Login{

    function registaUser($username, $pw, $tpUser){
    
        global $conn;
        $msg = "";
        $flag = false;

        $pw = md5($pw);

        $stmt = $conn->prepare("INSERT INTO utilizador (user, pw, idtpuser) 
        VALUES (?, ?, ?, ?);");
        $stmt->bind_param("ssis", $username, $pw, $tpUser);

        $stmt->execute();

        $msg = "Registado com sucesso!";
        $flag = true;
        
        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));

        $stmt->close();
        $conn->close();

        return($resp);

    }

    function login($username, $pw){

        global $conn;
        $msg = "";
        $flag = true;
        session_start();

        $pw = md5($pw);

        $stmt = $conn->prepare("SELECT * FROM utilizador WHERE user LIKE ? AND pw LIKE ?;");
        $stmt->bind_param("ss", $username, $pw);
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $msg = "Bemvindo ".$row['user'];
            $_SESSION['utilizador'] = $row['user'];
            $_SESSION['tipo'] = $row['idtpuser'];
            $_SESSION['foto'] = $row['foto'];
        }else{
            $flag = false;
            $msg = "Erro! Dados Inválidos"; 
        }

        $stmt->close();
        $conn->close();
        
        return (json_encode(array(
            "msg" => $msg,
            "flag" => $flag
        )));
    }

    function logout(){

        session_start();
        session_destroy();

        return("Obrigado!");
    }

    function getTiposUser(){

        global $conn;
        $msg = "<option value = '-1'>Escolha uma opção</option>";


        $stmt = $conn->prepare("SELECT * FROM tipouser");
        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()) {
                $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
            }
        }else{
            $msg .= "<option value = '-1'>Sem tipos registados</option>";
        }

        $stmt->close();
        $conn->close();
        return $msg;
    }

}