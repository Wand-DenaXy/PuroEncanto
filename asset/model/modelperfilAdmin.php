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
                $msg .= "<button class='btinfoperfil' data-bs-toggle='modal' data-bs-target='#editarPerfilModal'>";
                $msg .= "Editar Perfil";
                $msg .= "</button>";
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
    
    function TituloPerfil($ID_Cliente){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM Clientes WHERE ID_Cliente = " . $ID_Cliente;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $msg .= "<div class='profile-header'>";
                $msg .= "<p>Olá Bem vindo, " . $row['nome'] . "!</p>";
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
}
?>