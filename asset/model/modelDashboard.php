<?php

require_once 'connection2.php';

class Dashboard {

    function getFornecedoresDebito() {
        global $conn;
        $dados = [];
        $msg = "";
        $flag = false;

        $sql = "SELECT descricao, total_debito FROM Fornecedores ORDER BY total_debito DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados[] = $row;
            }
            $flag = true;
        } else {
            $msg = "Nenhum fornecedor encontrado.";
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg,
            "dados" => $dados
        ));

        $conn->close();
        return $resp;
    }
function getServicoUsados() {
    global $conn;
    $dados1 = [];
    $dados2 = [];
    $msg = "";
    $flag = false;

    $sql = "SELECT descricao, total_vendas FROM VendasServicos WHERE ID BETWEEN 1 AND 4 ORDER BY total_vendas desc;";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dados1[] = $row['descricao'];
            $dados2[] = $row['total_vendas'];
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
function getServicoUsadosMaio() {
    global $conn;
    $dados1 = [];
    $dados2 = [];
    $msg = "";
    $flag = false;

    $sql = "SELECT descricao, total_vendas FROM VendasServicos WHERE ID BETWEEN 5 AND 8 ORDER BY total_vendas desc;";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dados1[] = $row['descricao'];   
            $dados2[] = $row['total_vendas'];
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
    function getServicoUsadosJunho() {
        global $conn;
        $dados1 = [];
        $dados2 = [];
        $msg = "";
        $flag = false;

        $sql = "SELECT descricao, total_vendas FROM VendasServicos WHERE ID BETWEEN 9 AND 14 ORDER BY total_vendas desc;";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados1[] = $row['descricao'];   
                $dados2[] = $row['total_vendas'];
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
function GraficoServicoDashboard() {
    global $conn;
    $dados1 = [];
    $dados2 = [];
    $msg = "";
    $flag = false;

    $sql = "SELECT descricao, SUM(total_vendas) AS total
            FROM VendasServicos
            GROUP BY descricao
            ORDER BY total DESC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dados1[] = $row['descricao'];
            $dados2[] = $row['total'];
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
function getFornecedoresTop() {
    global $conn;
    $dados1 = [];
    $dados2 = [];
    $msg = "";
    $flag = false;

    $sql = "SELECT descricao, total_debito FROM Fornecedores WHERE ID_Fornecedor ORDER BY total_debito desc;";
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
function GraficoServicoUtilizadoAbril() {
        global $conn;
        $dados1 = [];
        $dados2 = [];
        $msg = "";
        $flag = false;

        $sql = "SELECT Servicos.nome as Nome, COUNT(*) AS Usado FROM Servicos,Eventos_Servicos,Eventos WHERE Servicos.ID_Servico = Eventos_Servicos.ID_Servico AND Eventos.ID_Evento = Eventos_Servicos.ID_Evento AND MONTH(Eventos.data) = 4 GROUP BY Servicos.nome ORDER BY Usado DESC;";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados1[] = $row['Nome'];   
                $dados2[] = $row['Usado'];
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
function GraficoServicoUtilizadoMaio() {
        global $conn;
        $dados1 = [];
        $dados2 = [];
        $msg = "";
        $flag = false;

        $sql = "SELECT Servicos.nome as Nome, COUNT(*) AS Usado FROM Servicos,Eventos_Servicos,Eventos WHERE Servicos.ID_Servico = Eventos_Servicos.ID_Servico AND Eventos.ID_Evento = Eventos_Servicos.ID_Evento AND MONTH(Eventos.data) = 5 GROUP BY Servicos.nome ORDER BY Usado DESC;";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados1[] = $row['Nome'];   
                $dados2[] = $row['Usado'];
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
function GraficoServicoUtilizadoJunho() {
        global $conn;
        $dados1 = [];
        $dados2 = [];
        $msg = "";
        $flag = false;

        $sql = "SELECT Servicos.nome as Nome, COUNT(*) AS Usado FROM Servicos,Eventos_Servicos,Eventos WHERE Servicos.ID_Servico = Eventos_Servicos.ID_Servico AND Eventos.ID_Evento = Eventos_Servicos.ID_Evento AND MONTH(Eventos.data) = 6 GROUP BY Servicos.nome ORDER BY Usado DESC;";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados1[] = $row['Nome'];   
                $dados2[] = $row['Usado'];
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
        function getClientesDashboard() {
        global $conn;
        $dados1 = [];
        $dados2 = [];
        $msg = "";
        $flag = false;

        $sql = "SELECT MONTH(clientes.data) AS Mes, COUNT(*) AS Total_Clientes FROM clientes WHERE MONTH(clientes.data) IN (4,5,6) GROUP BY MONTH(clientes.data) ORDER BY Mes;";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados1[] = $row['Mes'];   
                $dados2[] = $row['Total_Clientes'];
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