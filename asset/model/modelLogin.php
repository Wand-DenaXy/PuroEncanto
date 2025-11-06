<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/PuroEncanto_Temp-Main/asset/model/connection2.php';

class Login {

    function registaUser($username, $email, $pw, $tpUser){
        global $conn;
        $msg = "";
        $flag = false;

        $hashedPw = password_hash($pw, PASSWORD_DEFAULT);

        $nif  = "000000000";  
        $iban = "PT50000000000000000000000";

        $stmt = $conn->prepare("INSERT INTO Clientes (nome, Email, nif, Password, IBAN, ID_TipoUtilizador) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $username, $email, $nif, $hashedPw, $iban, $tpUser);
        $stmt->execute();

        if($stmt->affected_rows > 0){
            $msg = "Registado com sucesso!";
            $flag = true;

            session_start();
            $_SESSION['cliente_id']    = $stmt->insert_id;
            $_SESSION['cliente_nome']  = $username;
            $_SESSION['cliente_email'] = $email;
            $_SESSION['tpUser']        = $tpUser;

        } else {
            $msg = "Erro ao registar cliente!";
        }

        $resp = json_encode(array("flag" => $flag, "msg" => $msg));

        $stmt->close();
        $conn->close();
        return $resp;
    }

    function login($email, $pw){
    global $conn;
    $flag = true;
    $redirect = "";
    session_start();

    $stmt = $conn->prepare("
        SELECT c.ID_Cliente, c.nome, c.Email, c.Password, c.ID_TipoUtilizador, t.Tipo
        FROM Clientes c
        INNER JOIN TipoUtilizador t ON c.ID_TipoUtilizador = t.ID_TipoUtilizador
        WHERE c.Email = ?
    ");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        if(password_verify($pw, $row['Password'])){
          
            $_SESSION['cliente_id']    = $row['ID_Cliente'];
            $_SESSION['cliente_nome']  = $row['nome'];
            $_SESSION['cliente_email'] = $row['Email'];
            $_SESSION['tpUser']        = $row['ID_TipoUtilizador'];
            $_SESSION['tipo_nome']     = $row['Tipo'];

            if ($row['Tipo'] === 'Administrador') {
                $redirect = 'Dashboard.php';
            } else {
                $redirect = 'DashboardCliente.php';
            }

            $msg = "Login efetuado com sucesso!";
        } else {
            $flag = false;
            $msg = "Password incorreta!";
        }
    } else {
        $flag = false;
        $msg = "Email não encontrado!";
    }

    $stmt->close();
    $conn->close();

    return json_encode(['flag'=>$flag, 'msg'=>$msg, 'redirect'=>$redirect]);
}



    function logout(){
        session_start();
        session_destroy();
        return "Logout efetuado com sucesso!";
    }

    function getTiposUser(){
        global $conn;
        $msg = "<option value='-1'>Escolha uma opção</option>";

        $stmt = $conn->prepare("SELECT * FROM TipoUtilizador");
        $stmt->execute();
        $result = $stmt->get_result();

        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $msg .= "<option value='".$row['ID_TipoUtilizador']."'>".$row['Tipo']."</option>";
            }
        } else {
            $msg .= "<option value='-1'>Sem tipos registados</option>";
        }

        $stmt->close();
        $conn->close();
        return $msg;
    }
}
?>