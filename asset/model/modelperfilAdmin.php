<?php

require_once 'connection2.php';

class Perfil{

    function getDadosPerfil($ID_Cliente){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM Clientes WHERE ID_Cliente =".$ID_Cliente;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc())
            {
                $msg .= "<div class='profile-item'>";
                $msg .= "<p><strong>Nome:</strong>". $row['nome'] ."</p> ";
                $msg .= "</div>";
                $msg .= "<div class='profile-item'>";
                $msg .= "<p><strong>Email:</strong>". $row['Email'] ."</p> ";
                $msg .= "</div>";
                $msg .= "<div class='profile-item'>";
                $msg .= "<p><strong>NIF:</strong>". $row['nif'] ."</p> ";
                $msg .= "</div>";
                $msg .= "<div class='profile-item'>";
                $msg .= "<p><strong>IBAN:</strong>". $row['IBAN'] ."</p> ";
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

        $conn->close();
        
        return ($msg);

    }
}
?>