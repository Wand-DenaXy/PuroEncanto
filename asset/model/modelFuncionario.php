<?php

require_once 'connection2.php';

class Funcionario{

    function registaFuncionario($nome, $telefone, $salario,$NIF){
    
        global $conn;
        $msg = "";
        $flag = false;
                $stmt = $conn->prepare("INSERT INTO Funcionarios (nome, telefone, salario,NIF) 
            VALUES (?, ?, ?,?);");
            $stmt->bind_param("siis", $nome, $telefone, $salario,$NIF);

            $stmt->execute();
            $stmt1 = $conn->prepare("INSERT INTO DividasAPagar (Tipo, Valor, Estado,ID_Funcionario) 
            VALUES (?, ?, ?,?);");
            $ID_Funcionario = $conn->insert_id;
            $tipo = "Funcionario";
            $estado = "Em aberto";
            $stmt1->bind_param("sdsi", $tipo, $salario, $estado, $ID_Funcionario);
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
                $msg .= "<td>".$row['salario']."</td>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td>".$row['NIF']."</td>";
                $msg .= "<td><button class='btn btn-warning' onclick ='getDadosFuncionario(".$row['ID_Funcionario'].")'><i class='fa fa-pencil'>Editar</i></button></td>";
                $msg .= "<td><button class='btn btn-danger' onclick ='removerFuncionario(".$row['ID_Funcionario'].")'><i class='fa fa-trash'>Remover</i></button></td>";
                $msg .= "<td><button class='btn btn-success' onclick ='PagarSalarioFuncionario(".$row['ID_Funcionario'].")'><i class='fa fa-trash'>Pagar Salario</i></button></td>";
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
    function PagarSalarioFuncionario($ID_Funcionario)
    {
        global $conn;
        $msg = "";
        $flag = true;
        $sql = "";
        $sql = "UPDATE DividasAPagar SET estado = 'Em aberto' WHERE ID_Funcionario =".$ID_Funcionario;

                if ($conn->query($sql) === TRUE) {
            $msg = "Divida Recebida!";
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
        function getDadosFuncionario($ID_Funcionario){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM Funcionarios WHERE ID_Funcionario =".$ID_Funcionario;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }

    function guardaEditFuncionario($nome, $telfone, $salario, $nif,$ID_Funcionario){
        
        global $conn;
        $msg = "";
        $flag = true;
        $sql = "";


        $sql = "UPDATE Funcionarios SET nome = '".$nome."', telefone = '".$telfone."',salario = '".$salario."',nif = '".$nif."' WHERE ID_Funcionario =".$ID_Funcionario;

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