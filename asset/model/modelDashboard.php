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
    function getDividasReceber(){

        global $conn;
        $msg = "";

        $sql = "SELECT * from DividasAPagar where DividasAPagar.Estado Like 'Em Aberto';";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $msg .= "<tr>";
                $msg .= "<th scope='row'>".$row['ID_Divida']."</th>";
                $msg .= "<th scope='row'>".$row['Tipo']."</th>";
                $msg .= "<td>".$row['Valor']."</td>";
                $msg .= "<td>".$row['Estado']."</td>";
                $msg .= "<td><button class='btn btn-success' onclick ='pagarDividasReceber(".$row['ID_Divida'].")'><i class='fa fa-trash'>Pagar</i></button></td>";
                $msg .= "<td><button class='btn btn-danger' onclick ='recusarDividasReceber(".$row['ID_Divida'].")'><i class='fa fa-trash'>Recusar</i></button></td>";
                $msg .= "<td><button class='btn btn-warning' onclick ='getDadosFornecedores(".$row['ID_Divida'].")'><i class='fa fa-pencil'>Info</i></button></td>";            
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
function pagarDividasReceber($ID_Divida)
{
    global $conn;
    $dados1 = [];
    $dados2 = [];
    $msg = "";
    $flag = false;

    $sql = "UPDATE DividasAPagar SET Estado = 'Pago' WHERE ID_Divida = $ID_Divida";

        if ($conn->query($sql) === TRUE) {
            $flag = true;
            $msg = "Pago com Sucesso";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
        ));

    $conn->close();
    return $resp;

}
function recusarDividasReceber($ID_Divida)
{
    global $conn;
    $dados1 = [];
    $dados2 = [];
    $msg = "";
    $flag = false;

    $sql = "UPDATE DividasAPagar SET Estado = 'Recusado' WHERE ID_Divida = $ID_Divida";

        if ($conn->query($sql) === TRUE) {
            $flag = true;
            $msg = "Recusado com Sucesso";
        } else {
            $flag = false;
            $msg = "Error: " . $sql . "<br>" . $conn->error;
        }

        $resp = json_encode(array(
            "flag" => $flag,
            "msg" => $msg
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
function GraficoTotalAtivoDashboard() {
    global $conn;
    $dados1 = [];
    $dados2 = [];
    $msg = "";
    $flag = false;

        $sql = "SELECT 
        CASE MONTH(Data)
            WHEN 1 THEN 'Janeiro'
            WHEN 2 THEN 'Fevereiro'
            WHEN 3 THEN 'Março'
            WHEN 4 THEN 'Abril'
            WHEN 5 THEN 'Maio'
            WHEN 6 THEN 'Junho'
            WHEN 7 THEN 'Julho'
            WHEN 8 THEN 'Agosto'
            WHEN 9 THEN 'Setembro'
            WHEN 10 THEN 'Outubro'
            WHEN 11 THEN 'Novembro'
            WHEN 12 THEN 'Dezembro'
        END AS Mes,
        SUM(Valor) AS TotalAtivo
        FROM TotalAtivo
        GROUP BY MONTH(Data)
        ORDER BY MONTH(Data);";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $dados1[] = $row['Mes'];   
            $dados2[] = $row['TotalAtivo'];
        }
        $flag = true;
    } else {
        $msg = "Nenhum Grafico encontrado.";
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
        function getGastosDashboard() {
        global $conn;
        $dados1 = [];
        $dados2 = [];
        $msg = "";
        $flag = false;

        $sql = "SELECT 
    CASE MONTH(Data)
        WHEN 1 THEN 'Janeiro'
        WHEN 2 THEN 'Fevereiro'
        WHEN 3 THEN 'Março'
        WHEN 4 THEN 'Abril'
        WHEN 5 THEN 'Maio'
        WHEN 6 THEN 'Junho'
        WHEN 7 THEN 'Julho'
        WHEN 8 THEN 'Agosto'
        WHEN 9 THEN 'Setembro'
        WHEN 10 THEN 'Outubro'
        WHEN 11 THEN 'Novembro'
        WHEN 12 THEN 'Dezembro'
    END AS Mes,
    SUM(Valor) AS TotalGastos
FROM Gastos
GROUP BY MONTH(Data)
ORDER BY MONTH(Data);";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados1[] = $row['Mes'];   
                $dados2[] = $row['TotalGastos'];
            }
            $flag = true;
        } else {
            $msg = "Nenhum Gastos encontrado.";
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
    function getRedimentosDashboard() {
        global $conn;
        $dados1 = [];
        $dados2 = [];
        $msg = "";
        $flag = false;

        $sql = "SELECT 
    CASE MONTH(Data)
        WHEN 1 THEN 'Janeiro'
        WHEN 2 THEN 'Fevereiro'
        WHEN 3 THEN 'Março'
        WHEN 4 THEN 'Abril'
        WHEN 5 THEN 'Maio'
        WHEN 6 THEN 'Junho'
        WHEN 7 THEN 'Julho'
        WHEN 8 THEN 'Agosto'
        WHEN 9 THEN 'Setembro'
        WHEN 10 THEN 'Outubro'
        WHEN 11 THEN 'Novembro'
        WHEN 12 THEN 'Dezembro'
    END AS Mes,
    SUM(Valor) AS TotalRendimentos
FROM Rendimento
GROUP BY MONTH(Data)
ORDER BY MONTH(Data);";
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados1[] = $row['Mes'];   
                $dados2[] = $row['TotalRendimentos'];
            }
            $flag = true;
        } else {
            $msg = "Nenhum Gastos encontrado.";
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
    function GraficoDiferencaDashboard() {
        global $conn;
        $dados1 = [];
        $dados2 = [];
        $msg = "";
        $flag = false;

        $sql = "SELECT ResumoFinanceiro.descricao AS Meses, IFNULL(SUM(Rendimento.valor),2) - IFNULL(SUM(Gastos.valor),2) AS Saldo
                FROM ResumoFinanceiro,Gastos,Rendimento
                where Rendimento.ID_Rendimento = ResumoFinanceiro.ID_Rendimento AND Gastos.ID_Gasto = ResumoFinanceiro.ID_Gasto
                GROUP BY MONTH(Rendimento.Data), ResumoFinanceiro.descricao
                ORDER BY MONTH(Rendimento.Data);";
                
        $result = $conn->query($sql);
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $dados1[] = $row['Meses'];   
                $dados2[] = $row['Saldo'];
            }
            $flag = true;
        } else {
            $msg = "Nenhum Resumo Finaceiro encontrado.";
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