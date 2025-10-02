<?php

require_once 'connection2.php';

class Homepage {

    function getDadosTipoPerfil($ID_Cliente,$tpUser){

        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM Clientes WHERE ID_Cliente = " . $ID_Cliente;
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                if($tpUser == 2)
                {     
                    $msg .= "<li><a href='dashboard.php'>Dashboard</a></li>";
                    $msg .= "<li><a href='perfilAdmin.php'>Perfil</a></li>";
                }
                else
                {
                    $msg .= "<li><a href='dashboardCliente.php'>Dashboard</a></li>";
                    $msg .= "<li><a href='perfilCliente.php'>Perfil</a></li>";
                }
                
                $msg .= "<li><a href='asset/controller/controllerLogin.php?op=3'>Logout</a></li>";
            }
            
        }
        return $msg;
    }
}

?>