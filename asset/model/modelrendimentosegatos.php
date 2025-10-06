<?php

require_once 'connection2.php';

class Gastos{

function registaGastos($descricao,$Valor, $Data){
    global $conn;
    $msg = "";
    $flag = false;

    $stmt = $conn->prepare("INSERT INTO Gastos (descricao,Valor, Data) VALUES (?, ?,?)");
    $stmt->bind_param("sds", $descricao, $Valor, $Data);

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
function getListaGastos(){

    global $conn;
    $msg = "";

    $sql = "SELECT * FROM Gastos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $msg .= "<tr>";
            $msg .= "<th scope='row'>".$row['ID_Gasto']."</th>";
            $msg .= "<th scope='row'>".$row['descricao']."</th>";
            $msg .= "<td>".$row['Valor']."€</td>";
            $msg .= "<td>".$row['Data']."</td>";
            $msg .= "<td><button class='btn btn-warning' onclick ='getDadosGastos(".$row['ID_Gasto'].")'><i class='fa fa-pencil'>Editar</i></button></td>";
            $msg .= "<td><button class='btn btn-danger' onclick ='removerGastos(".$row['ID_Gasto'].")'><i class='fa fa-trash'>Remover</i></button></td>";
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
            $msg .= "</tr>";
        }
    $conn->close();

    return ($msg);
}
function removerGastos($ID_Gasto){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "DELETE FROM Gastos WHERE ID_Gasto = ".$ID_Gasto;

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
    function getDadosGastos($ID_Gasto){
    global $conn;
    $msg = "";
    $row = "";

    $sql = "SELECT * FROM Gastos WHERE ID_Gasto =".$ID_Gasto;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }

    $conn->close();

    return (json_encode($row));

}


function guardaEditGastos($descricao, $Valor,$Data,$ID_Gasto){
    
    global $conn;
    $msg = "";
    $flag = true;
    $sql = "";


    $sql = "UPDATE Gastos SET descricao = '".$descricao."', Valor = '".$Valor."',Data = '".$Data."' WHERE ID_Gasto =".$ID_Gasto;

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
function registaRendimentos($descricao,$Valor, $Data){
    global $conn;
    $msg = "";
    $flag = false;

    $stmt = $conn->prepare("INSERT INTO Rendimento (descricao,Valor, Data) VALUES (?, ?,?)");
    $stmt->bind_param("sds", $descricao, $Valor, $Data);

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
    function getListaRendimentos(){

    global $conn;
    $msg = "";

    $sql = "SELECT * FROM Rendimento";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $msg .= "<tr>";
            $msg .= "<th scope='row'>".$row['ID_Rendimento']."</th>";
            $msg .= "<th scope='row'>".$row['descricao']."</th>";
            $msg .= "<td>".$row['Valor']."€</td>";
            $msg .= "<td>".$row['Data']."</td>";
            $msg .= "<td><button class='btn btn-warning' onclick ='getDadosRendimentos(".$row['ID_Rendimento'].")'><i class='fa fa-pencil'>Editar</i></button></td>";
            $msg .= "<td><button class='btn btn-danger' onclick ='removerRendimentos(".$row['ID_Rendimento'].")'><i class='fa fa-trash'>Remover</i></button></td>";
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
            $msg .= "</tr>";
        }
    $conn->close();

    return ($msg);
}
function removerRendimentos($ID_Rendimento){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "DELETE FROM Rendimento WHERE ID_Rendimento = ".$ID_Rendimento;

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
        function getDadosRendimentos($ID_Rendimento){
    global $conn;
    $msg = "";
    $row = "";

    $sql = "SELECT * FROM Rendimento WHERE ID_Rendimento =".$ID_Rendimento;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }

    $conn->close();

    return (json_encode($row));

}


function guardaEditRendimento($descricao, $Valor,$Data,$ID_Rendimento){
    
    global $conn;
    $msg = "";
    $flag = true;
    $sql = "";


    $sql = "UPDATE Rendimento SET descricao = '".$descricao."', Valor = '".$Valor."',Data = '".$Data."' WHERE ID_Rendimento =".$ID_Rendimento;

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
function getDadosResumo($ID_Finaceiro){
    global $conn;
    $msg = "";
    $row = "";

    $sql = "SELECT * FROM ResumoFinanceiro WHERE ID_Finaceiro =".$ID_Finaceiro;
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    }

    $conn->close();

    return (json_encode($row));

}


function guardaEditResumo($descricao,$ID_Finaceiro){
    
    global $conn;
    $msg = "";
    $flag = true;
    $sql = "";


    $sql = "UPDATE ResumoFinanceiro SET descricao = '".$descricao."' WHERE ID_Finaceiro =".$ID_Finaceiro;

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
function getListaResumo(){

    global $conn;
    $msg = "";

    $sql = "SELECT * FROM ResumoFinanceiro";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $msg .= "<tr>";
            $msg .= "<th scope='row'>".$row['ID_Finaceiro']."</th>";
            $msg .= "<th scope='row'>".$row['descricao']."</th>";
            $msg .= "<td>".$row['ID_Rendimento']."</td>";
            $msg .= "<td>".$row['ID_Gasto']."</td>";
            $msg .= "<td><button class='btn btn-warning' onclick ='getDadosResumo(".$row['ID_Finaceiro'].")'><i class='fa fa-pencil'>Editar</i></button></td>";
            $msg .= "<td><button class='btn btn-danger' onclick ='RemoverResumo(".$row['ID_Finaceiro'].")'><i class='fa fa-trash'>Remover</i></button></td>";
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
            $msg .= "</tr>";
        }
    $conn->close();

    return ($msg);
}
function getSelectGastos(){
    global $conn;
    $row = "";
    $dados = [];
    $flag = false;

    $sql = "SELECT * from gastos;";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc())
        {
            $dados[] = $row;
        }
    }

    $conn->close();

    return json_encode([
        "flag" => true,
        "dados" => $dados
    ]);

}
function getSelectRendimentos(){
    global $conn;
    $row = "";
    $dados = [];
    $flag = false;

    $sql = "SELECT * from Rendimento;";
    $result = $conn->query($sql);

        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc())
        {
            $dados[] = $row;
        }
    }

    $conn->close();

    return json_encode([
        "flag" => true,
        "dados" => $dados
    ]);

}
function registaResumo($descricao,$ID_Rendimento, $ID_Gasto){
    global $conn;
    $msg = "";
    $flag = false;


    $stmt = $conn->prepare("INSERT INTO ResumoFinanceiro (descricao,ID_Rendimento, ID_Gasto) VALUES (?, ?,?)");
    $stmt->bind_param("sss", $descricao, $ID_Rendimento, $ID_Gasto);

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
function RemoverResumo($ID_Finaceiro){
        global $conn;
        $msg = "";
        $flag = true;

        $sql = "DELETE FROM ResumoFinanceiro WHERE ID_Finaceiro = ".$ID_Finaceiro;

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