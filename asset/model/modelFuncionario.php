<?php

require_once 'connection2.php';

class Funcionario{

    function registaFuncionario($nome, $telefone, $NIF){
    
        global $conn;
        $msg = "";
        $flag = false;

        $stmt = $conn->prepare("INSERT INTO Funcionarios (nome, telefone, NIF) 
        VALUES (?, ?, ?);");
        $stmt->bind_param("sis", $nome, $telefone, $NIF, $morada, $nif,$total_debito);


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
    function getListaFuncionario(){

        global $conn;
        $msg = "";

        $sql = "SELECT * FROM Funcionarios";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['ID_Funcionario']."</th>";
                $msg .= "<th scope='row'>".$row['nome']."</th>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td>".$row['NIF']."</td>";
                $msg .= "<td><button class='btn btn-warning' onclick ='getDadosFornecedores(".$row['ID_Funcionario'].")'><i class='fa fa-pencil'>Editar</i></button></td>";
                $msg .= "<td><button class='btn btn-danger' onclick ='removerFornecedores(".$row['ID_Funcionario'].")'><i class='fa fa-trash'>Remover</i></button></td>";
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

    function removerFuncionario($ID_Funcionario){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "DELETE FROM Funcionarios WHERE ID_Funcionario = ".$ID_Funcionario;

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
}
?>