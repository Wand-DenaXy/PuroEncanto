<?php

require_once 'connection2.php';

class Fornecedores1{

    function registaFornecedores($descricao, $contacto, $email, $morada, $nif,$total_debito){
    
        global $conn;
        $msg = "";
        $flag = false;

        $stmt = $conn->prepare("INSERT INTO Fornecedores (descricao, contacto, email, morada,nif,total_debito) 
        VALUES (?, ?, ?, ?,?,?);");
        $stmt->bind_param("sssssi", $descricao, $contacto, $email, $morada, $nif,$total_debito);


        $stmt->execute();
       $stmt1 = $conn->prepare("INSERT INTO DividasAPagar (Tipo, Valor, Estado,ID_Fornecedor) 
            VALUES (?, ?, ?,?);");
            $ID_Fornecedor = $conn->insert_id;
            $tipo = "Fornecedor";
            $estado = "Em aberto";
            $stmt1->bind_param("sdsi", $tipo, $total_debito, $estado, $ID_Fornecedor);
            $stmt1->execute();
            
            $msg = "Registado com sucesso!";
            $flag = true;
            
            $resp = json_encode(array(
                "flag" => $flag,
                "msg" => $msg
            ));

        $stmt1->close();
        $stmt->close();
        $conn->close();

        return($resp);

    }
    function getListaFornecedores(){

        global $conn;
        $msg = "";

        $sql = "SELECT * FROM Fornecedores";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['ID_Fornecedor']."</th>";
                $msg .= "<th scope='row'>".$row['descricao']."</th>";
                $msg .= "<td>".$row['contacto']."</td>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td>".$row['morada']."</td>";
                $msg .= "<td>".$row['nif']."</td>";
                $msg .= "<td>".$row['total_debito']."€</td>";
                $msg .= "<td><button class='btn btn-warning' onclick ='getDadosFornecedores(".$row['ID_Fornecedor'].")'><i class='fa fa-pencil'>Editar</i></button></td>";
                $msg .= "<td><button class='btn btn-danger' onclick ='removerFornecedores(".$row['ID_Fornecedor'].")'><i class='fa fa-trash'>Remover</i></button></td>";
                $msg .= "</tr>";
            }
        } else {
            $msg .= "<tr>";
            $msg .= "<td>Sem Registos</td>";
            $msg .= "<th scope='row'></th>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "<td></td>";
            $msg .= "</tr>";
        }
        $conn->close();

        return ($msg);
    }

    function removerFornecedores($ID_Fornecedor){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "DELETE FROM Fornecedores WHERE ID_Fornecedor = ".$ID_Fornecedor;

        if ($conn->query($sql) === TRUE) {
            $msg = "Removido com Sucesso";
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

    function getDadosFornecedores($ID_Fornecedor){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM Fornecedores WHERE ID_Fornecedor =".$ID_Fornecedor;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }


    function guardaEditFornecedores($descricao, $contacto, $email, $morada, $nif,$total_debito,$ID_Fornecedor){
        
        global $conn;
        $msg = "";
        $flag = true;
        $sql = "";


        $sql = "UPDATE Fornecedores SET descricao = '".$descricao."', contacto = '".$contacto."',email = '".$email."',morada = '".$morada."',nif = '".$nif."', total_debito = '".$total_debito."' WHERE ID_Fornecedor =".$ID_Fornecedor;

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
    function getFornecedoresAbril() {
    global $conn;
    $dados1 = [];
    $dados2 = [];
    $msg = "";
    $flag = false;

    $sql = "SELECT descricao, total_debito FROM Fornecedores WHERE ID_Fornecedor BETWEEN 1 AND 15 ORDER BY total_debito desc;";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dados1[] = $row['descricao'];   
            $dados2[] = $row['total_debito'];
        }
        $flag = true;
    } else {
        $msg = "Nenhum Serviço encontrado.";
    }

    $resp = json_encode(array(
        "flag" => $flag,
        "msg" => $msg,
        "dados1" => $dados1,
        "dados2" => $dados2
    ));

    $conn->close();
    return $resp;
}
}
?>