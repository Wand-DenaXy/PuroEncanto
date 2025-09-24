<?php

require_once 'connection2.php';

class Eventos {


function getTiposEventos() {
    global $conn;
    $msg = "<option value='-1'>Escolha uma opção</option>";

    $stmt = $conn->prepare("SELECT DISTINCT Clientes.nome AS Nome FROM Clientes,Eventos where Eventos.ID_Cliente = Clientes.ID_Cliente;");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $msg .= "<option value='{$row['ID_Cliente']}'>{$row['Nome']}</option>";
        }
    } else {
        $msg .= "<option value='-1'>Sem tipos registados</option>";
    }

    $stmt->close();
    $conn->close();
    return $msg;
}
function listarSessoesJSON($ID_Cliente) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM Eventos WHERE ID_Cliente = ?");
    $stmt->bind_param("i", $ID_Cliente);
    $stmt->execute();
    $result = $stmt->get_result();

    $eventos = [];
    while ($row = $result->fetch_assoc()) {
        $eventos[] = [
            "title" => "Evento " . $row['ID_Cliente'] . " (" . $row['Nome'] . ")",
            "start" => $row['data'] . "T" . $row['hora']
        ];
    }

    $stmt->close();
    $conn->close();
    return json_encode($eventos);
}
function criarSessao($ID_Evento, $ID_Cliente, $nome, $hora, $estado,$Data,$ID_TipoEvento,$ID_Pacote) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO Eventos (ID_Evento,ID_Cliente,nome,hora,estado, Data, ID_TipoEvento, ID_Pacote) VALUES (?, ?, ?, ?, ?,?,?,?)");
    $stmt->bind_param("iissssii", $ID_Evento, $ID_Cliente, $nome, $hora, $estado,$Data,$ID_TipoEvento,$ID_Pacote);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    return "Sessão criada com sucesso!";
}
    
    function listarEventos() {
        global $conn;
        $msg = "<table class='table'><thead><tr><th>ID do Evento</th><th>Nome</th><th>ID do Cliente</th><th>Data</th><th>Hora</th><th>Tipo</th><th>Remover</th><th>Editar</th></tr></thead><tbody>";
        $stmt = $conn->prepare("SELECT Eventos.*, TiposEventos.nome As tipo_nome from TiposEventos,Eventos where Eventos.ID_TipoEvento = TiposEventos.ID_TipoEvento group by Eventos.ID_Evento;");
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $msg .= "<tr><th scope='row'>{$row['ID_Evento']}</th><td>{$row['Nome']}</td><td>{$row['ID_Cliente']}</td><td>{$row['Data']}</td><td>{$row['hora']}</td><td>{$row['tipo_nome']}</td>";
            $msg .= "<td><button class='btn btn-danger' onclick='removerFilme({$row['ID_Evento']})'>Remover</button></td>";
            $msg .= "<td><button class='btn btn-primary' onclick='getDadosfilme({$row['ID_Evento']})'>Editar</button></td></tr>";
        }

        if ($result->num_rows == 0) {
            $msg .= "<tr><td colspan='7'>Sem resultados</td></tr>";
        }

        $msg .= "</tbody></table>";
        $stmt->close();
        $conn->close();
        return $msg;
    }
}
?>