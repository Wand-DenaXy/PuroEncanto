<?php

require_once 'connection2.php';

class Funcionario{

    function registaFuncionario($nome, $telefone, $valor,$NIF,$ID_TipoColaboradores){
    
        global $conn;
        $msg = "";
        $flag = false;
                $stmt = $conn->prepare("INSERT INTO Colaboradores (nome, telefone, valor,NIF,ID_TipoColaboradores) 
            VALUES (?, ?, ?,?,?);");
            $stmt->bind_param("siisi", $nome, $telefone, $valor,$NIF,$ID_TipoColaboradores);

            $stmt->execute();
            $stmt1 = $conn->prepare("INSERT INTO DividasAPagar (Tipo, Valor, Estado,ID_Colaboradores) 
            VALUES (?, ?, ?,?);");
            $ID_Colaboradores = $conn->insert_id;
            $tipo = "Funcionario";
            $estado = "Em aberto";
            $stmt1->bind_param("sdsi", $tipo, $valor, $estado, $ID_Colaboradores);
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

        $sql = "SELECT TipoColaboradores.Tipo AS Funcao,Colaboradores.* FROM Colaboradores,TipoColaboradores WHERE Colaboradores.ID_TipoColaboradores = TipoColaboradores.ID_TipoColaboradores";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['ID_Colaboradores']."</th>";
                $msg .= "<th scope='row'>".$row['nome']."</th>";
                $msg .= "<td>".$row['Funcao']."</td>";
                $msg .= "<td>".$row['telefone']."</td>";
                $msg .= "<td>".$row['valor']."€</td>";
                $msg .= "<td>".$row['NIF']."</td>";
                $msg .= "<td><button class='btn btn-warning' onclick ='getDadosFuncionario(".$row['ID_Colaboradores'].")'><i class='fa fa-pencil'>Editar</i></button></td>";
                $msg .= "<td><button class='btn btn-danger' onclick ='removerFuncionario(".$row['ID_Colaboradores'].")'><i class='fa fa-trash'>Remover</i></button></td>";
                $msg .= "<td><button class='btn btn-success' onclick ='PagarSalarioFuncionario(".$row['ID_Colaboradores'].")'><i class='fa fa-trash'>Pagar Salario</i></button></td>";
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
    function PagarSalarioFuncionario($ID_Colaboradores)
    {
        global $conn;
        $msg = "";
        $flag = true;
        $sql = "";
        $sql = "UPDATE DividasAPagar SET estado = 'Em aberto' WHERE ID_Colaboradores =".$ID_Colaboradores;

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
        function getDadosFuncionario($ID_Colaboradores){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM Colaboradores WHERE ID_Colaboradores =".$ID_Colaboradores;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }

    function guardaEditFuncionario($nome, $telfone, $valor, $nif,$ID_Colaboradores,$ID_TipoColaboradores){
        
        global $conn;
        $msg = "";
        $flag = true;
        $sql = "";


        $sql = "UPDATE Colaboradores SET nome = '".$nome."', telefone = '".$telfone."',valor = '".$valor."',nif = '".$nif."',ID_TipoColaboradores = '".$ID_TipoColaboradores."' WHERE ID_Colaboradores =".$ID_Colaboradores;

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
    function removerFuncionario($ID_Colaboradores){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "DELETE FROM Colaboradores WHERE ID_Colaboradores = ".$ID_Colaboradores;

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