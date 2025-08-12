<?php

require_once 'connection.php';

class Fornecedores{

    function registaFornecedores($nome, $contacto, $email, $NIF, $morada){
    
        global $conn;
        $msg = "";
        $flag = false;

        // $pw = md5($pw);

        $stmt = $conn->prepare("INSERT INTO Fornecedores (nome, contacto, email, NIF,morada) 
        VALUES (?, ?, ?, ?,?);");
        $stmt->bind_param("sssss", $nome, $contacto, $email,$NIF,$morada);

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

        $stmt = $conn->prepare("INSERT INTO Sessao (filme_id, sala_id, data, hora, estado) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) return "Erro na preparação: " . $conn->error;

        $linha = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            if ($linha === 0 && $data[0] === 'filme_id') {
                $linha++;
                continue;
            }
            if (count($data) < 5) continue;

            $filme_id = intval($data[0]);
            $sala_id = intval($data[1]);
            $data_sessao = $data[2];
            $hora_sessao = $data[3];
            $estado = $data[4];

            if (!in_array($estado, ['ativa', 'inativa'])) continue;

            $stmt->bind_param("iisss", $filme_id, $sala_id, $data_sessao, $hora_sessao, $estado);
            $stmt->execute();
            $linha++;
        }

        fclose($handle);
        $stmt->close();
        $conn->close();
        return "Importação concluída com sucesso. $linha linhas processadas.";
    }
    function getListaFornecedores(){

        global $conn;
        $msg = "";

        $sql = "SELECT Fornecedores.* as Fornecedores FROM Fornecedores";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['id']."</th>";
                $msg .= "<th scope='row'>".$row['nome']."</th>";
                $msg .= "<td>".$row['contacto']."</td>";
                $msg .= "<td>".$row['email']."</td>";
                $msg .= "<td>".$row['nif']."</td>";
                $msg .= "<td>".$row['morada']."</td>";
                $msg .= "<td><button class='btn btn-warning' onclick ='getDadosJogador(".$row['num'].")'><i class='fa fa-pencil'></i></button></td>";
                $msg .= "<td><button class='btn btn-danger' onclick ='removerJogador(".$row['num'].")'><i class='fa fa-trash'></i></button></td>";
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

    function removerFornecedores($num){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "DELETE FROM jogadores WHERE num = ".$num;

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

    function getDadosFornecedores($num){
        global $conn;
        $msg = "";
        $row = "";

        $sql = "SELECT * FROM jogadores WHERE num =".$num;
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        // output data of each row
            $row = $result->fetch_assoc();
        }

        $conn->close();

        return (json_encode($row));

    }


    function guardaEditFornecedores($numJogador, $nome, $idade, $telefone, $email, $morada, $clube, $numOld, $foto){
        
        global $conn;
        $msg = "";
        $flag = true;
        $sql = "";

        // if($resp['flag']){
        //     $sql = "UPDATE jogadores SET num = '".$numJogador."',nome = '".$nome."', idade = '".$idade."',tel = '".$telefone."',email = '".$email."',morada = '".$morada."', foto = '".$resp['target']."' WHERE num =".$numOld;
        // }else{
        //     $sql = "UPDATE jogadores SET num = '".$numJogador."',nome = '".$nome."', idade = '".$idade."',tel = '".$telefone."',email = '".$email."',morada = '".$morada."' WHERE num =".$numOld;

        // }

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