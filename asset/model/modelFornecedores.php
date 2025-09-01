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
    function importarSessoesCSV($ficheiroTMP) {
        global $conn;
        $handle = fopen($ficheiroTMP, "r");
        if ($handle === false) return "Erro ao abrir o ficheiro.";

        $stmt = $conn->prepare("INSERT INTO Fornecedores (ID_Fornecedor, nome, contacto, email, morada) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) return "Erro na preparação: " . $conn->error;

        $linha = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($linha === 0 && $data[0] === 'filme_id') {
                $linha++;
                continue;
            }

            $ID_Fornecedor = intval($data[0]);
            $nome = $data[1];
            $contacto = $data[2];
            $email = $data[3];
            $morada = $data[4];

            $stmt->bind_param("issss", $ID_Fornecedor, $contacto, $email, $morada);
            $stmt->execute();
            $linha++;
        }
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
                $msg .= "<td>".$row['total_debito']."</td>";
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