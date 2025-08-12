<?php
// controllerFilme.php
require_once 'connection.php';

class Funcionario {

    function registarFuncionario($nomeFilme, $contacto, $email, $morada) {
        global $conn;
        $stmt = $conn->prepare("INSERT INTO Fornecedores (nome, contacto, email, morada) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nomeFilme, $contacto, $email, $morada);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return "Registado com sucesso!";
    }

    function listarFuncionario() {
        global $conn;
        $msg = "<table class='table'><thead><tr><th>ID</th><th>Nome</th><th>Ano</th><th>Descrição</th><th>Tipo</th><th>Remover</th><th>Editar</th></tr></thead><tbody>";
        $stmt = $conn->prepare("SELECT Filme.*, TipoFilme.descricao AS tipo_descr FROM Filme JOIN TipoFilme ON Filme.tipo_id = TipoFilme.tipo_id");
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $msg .= "<tr><th scope='row'>{$row['filme_id']}</th><td>{$row['nome']}</td><td>{$row['ano']}</td><td>{$row['descricao']}</td><td>{$row['tipo_descr']}</td>";
            $msg .= "<td><button class='btn btn-danger' onclick='removerFilme({$row['filme_id']})'>Remover</button></td>";
            $msg .= "<td><button class='btn btn-primary' onclick='getDadosfilme({$row['filme_id']})'>Editar</button></td></tr>";
        }

        if ($result->num_rows == 0) {
            $msg .= "<tr><td colspan='7'>Sem resultados</td></tr>";
        }

        $msg .= "</tbody></table>";
        $stmt->close();
        $conn->close();
        return $msg;
    }

    function removerFilme($id) {
        global $conn;
        $stmt = $conn->prepare("DELETE FROM Filme WHERE filme_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return "Removido com sucesso!";
    }

    function getDadosfilme($id) {
        global $conn;
        $stmt = $conn->prepare("SELECT * FROM Filme WHERE filme_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return json_encode($row);
    }

    function editFilme($id, $nome, $descricao, $ano, $tipo, $chave) {
        global $conn;
        $chave = md5($chave);
        $stmt = $conn->prepare("UPDATE Filme SET nome = ?, ano = ?, descricao = ?, tipo_id = ?, chave = ? WHERE filme_id = ?");
        $stmt->bind_param("sisisi", $nome, $ano, $descricao, $tipo, $chave, $id);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        return "Editado com sucesso!";
    }

    function getTiposFilme() {
        global $conn;
        $msg = "<option value='-1'>Escolha uma opção</option>";
        $stmt = $conn->prepare("SELECT * FROM TipoFilme");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $msg .= "<option value='{$row['tipo_id']}'>{$row['descricao']}</option>";
        }
        if ($result->num_rows == 0) {
            $msg .= "<option value='-1'>Sem tipos registados</option>";
        }
        $stmt->close();
        $conn->close();
        return $msg;
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
}
?>
