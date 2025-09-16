<?php

require_once 'connection2.php';

class Clientes{

function registaClientes($nome, $nif, $morada, $IBAN){
    global $conn;
    $msg = "";
    $flag = false;

    $stmt = $conn->prepare("INSERT INTO Clientes (nome, nif, morada, IBAN) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $nome, $nif, $morada, $IBAN);

    if($stmt->execute()){
        $msg = "Registado com sucesso!";
        $flag = true;
    } else {
        $msg = "Erro ao registar: " . $stmt->error;
        $flag = false;
    }

    $resp = json_encode([
        "flag" => $flag,
        "msg" => $msg
    ]);

    $stmt->close();
    $conn->close();

    return $resp;
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
    function getListaClientes(){

        global $conn;
        $msg = "";

        $sql = "SELECT * from Clientes where ID_TipoUtilizador = 1;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['ID_Cliente']."</th>";
                $msg .= "<th scope='row'>".$row['nome']."</th>";
                $msg .= "<td>".$row['Email']."</td>";
                $msg .= "<td>".$row['nif']."</td>";
                $msg .= "<td>".$row['IBAN']."</td>";
                $msg .= "<td><button class='btn btn-warning' onclick ='getDadosClientes(".$row['ID_Cliente'].")'><i class='fa fa-pencil'>Editar</i></button></td>";
                $msg .= "<td><button class='btn btn-danger' onclick ='removerClientes(".$row['ID_Cliente'].")'><i class='fa fa-trash'>Remover</i></button></td>";
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

    function removerClientes($ID_Cliente){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "DELETE FROM Clientes WHERE ID_Cliente = ".$ID_Cliente;

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
        function getDadosClientes($ID_Cliente){
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


    function guardaEditClientes($nome, $email,$nif,$IBAN,$ID_Cliente){
        
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