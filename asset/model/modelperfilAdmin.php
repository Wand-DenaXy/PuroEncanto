<?php

require_once 'connection2.php';

class Perfil{

    function getDadosPerfil($ID_Cliente){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM Clientes WHERE ID_Cliente = " . $ID_Cliente;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='profile-item'>";
                $msg .= "<p><strong>Nome: </strong> <span class='infoperfil'>" . $row['nome'] . "</span></p>";
                $msg .= "</div>";
                $msg .= "<div class='profile-item'>";
                $msg .= "<p><strong>Email: </strong><span class='infoperfil'>" . $row['Email'] . "</span></p>";
                $msg .= "</div>";
                $msg .= "<div class='profile-item'>";
                $msg .= "<p><strong>NIF: </strong><span class='infoperfil'>" . $row['nif'] . "</span></p>";
                $msg .= "</div>";
                $msg .= "<div class='profile-item'>";
                $msg .= "<p><strong>IBAN: </strong><span class='infoperfil'>" . $row['IBAN'] . "</span></p>";
                $msg .= "</div>";
            }
            
        }
        else
        {
                $msg .= "<div class='profile-item'>";
                $msg .= "<p>Erro a Procurar o Nome</p> ";
                $msg .= "</div>";
                $msg .= "<div class='profile-item'>";
                $msg .= "<p>Erro a Procurar o Email</p> ";
                $msg .= "</div>";
                $msg .= "<div class='profile-item'>";
                $msg .= "<p>Erro a Procurar o NIF</p> ";
                $msg .= "</div>";
                $msg .= "<div class='profile-item'>";
                $msg .= "<p>Erro a Procurar o IBAN</p> ";
                $msg .= "</div>";
        }
        echo $msg;
        $conn->close();
        
        return ($msg);

    }
function getButtonEdit($ID_Cliente){
    global $conn;
    $msg = "";
    $row = "";

    $sql = "SELECT * FROM Clientes WHERE ID_Cliente = " . $ID_Cliente;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $msg .= "<button class='btn-edit' data-bs-toggle='modal' data-bs-target='#formEditPerfil' onclick='getDadosPerfilEdit(" . $row['ID_Cliente'] . ")'>";
            $msg .= "<i class='bi bi-pencil-square'></i>";
            $msg .= "Editar Perfil";
            $msg .= "</button>";
            $msg .= "<a href='destroyer.php' class='logoutlink'>";
            $msg .= "<button class='btn-logout'>";
            $msg .= "<i class='bi bi-box-arrow-right'></i>";
            $msg .= "Fazer Logout";
            $msg .= "</button>";
            $msg .= "</a>";
        }
    }
    else {
        $msg .= "<div class='profile-item'>";
        $msg .= "<p>Erro a Procurar os Dados do Cliente</p>";
        $msg .= "</div>";
    }
    
    $conn->close();
    
    return $msg;
}

    
    function TituloPerfil($ID_Cliente){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM Clientes WHERE ID_Cliente = " . $ID_Cliente;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='profile-header'>";
                $msg .= "<p style='font-size: xx-large;'>" . $row['nome'] . "</p>";
                $msg .= "</div>";
            }
        }
        else
        {
                $msg .= "<div class='profile-item'>";
                $msg .= "<p>Nome não encontrado/p> ";
                $msg .= "</div>";
        }
        echo $msg;
        $conn->close();
        
        return ($msg);

    }
    function getDadosPerfilEdit($ID_Cliente){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM Clientes WHERE ID_Cliente =".$ID_Cliente;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }

    function guardaEditPerfil($nome, $email, $nif,$IBAN,$ID_Cliente){
        
        global $conn;
        $msg = "";
        $flag = true;
        $sql = "";


        $sql = "UPDATE Clientes SET nome = '".$nome."', email = '".$email."',nif = '".$nif."',IBAN = '".$IBAN."' WHERE ID_Cliente =".$ID_Cliente;

        if ($conn->query($sql) === TRUE) {
            $msg = "Editado com Sucesso";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));
          
        $conn->close();

        return($resp);

    }
}
?>