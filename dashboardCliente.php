<?php
session_start();
require_once 'asset/model/connection2.php';

$idCliente = $_SESSION['cliente_id'] ?? null;
$eventos = [];

if ($idCliente) {
    $sql = "SELECT * FROM Eventos WHERE ID_Cliente = ? ORDER BY Data DESC, hora ASC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idCliente);
    $stmt->execute();
    $result = $stmt->get_result();

    while($row = $result->fetch_assoc()){
        $row['cor'] = ($row['estado'] == 'Cancelado') ? 'red' : 'green';
        $eventos[] = $row;
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Puro Encanto - Dashboard</title>
<link rel="stylesheet" href="asset/css/calendario.css">
<link rel="stylesheet" href="asset/css/lib/bootstrap.css">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
<script src="asset/js/lib/jquery.js"></script>
<script src="asset/js/lib/bootstrap.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

</head>
<body>
<div class="sidebar">
    <div class="logo"><a href="index.php"><img src="images/logos/PURO ENCANTO LOGO.png" alt=""></a>
        <p class="logotitulo">Puro Encanto</p>
    </div>
    <a href="dashboardCliente.php" class="active"><i class="bi bi-calendar-event"></i> Criar Evento</a>
    <a href="perfil.php"><i class="bi bi-person-circle"></i> Perfil</a>
    <div class="time" id="time"></div>
</div>

<div class="content" style="margin-left:250px; padding:20px;">

    <h2>Calendário de Eventos</h2>
    <div id="calendar"></div>

    <h3 class="mt-5">Os meus Eventos</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tipo Evento</th>
                <th>Data</th>
                <th>Hora</th>
                <th>Estado</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tabelaEventos">
            <?php if(count($eventos) > 0): ?>
    <?php foreach($eventos as $e): ?>
        <tr data-id="<?= $e['ID_Evento'] ?>">
            <td><?= htmlspecialchars($e['Nome']) ?></td>
            <td><?= htmlspecialchars($e['Data']) ?></td>
            <td><?= htmlspecialchars($e['hora']) ?></td>
            <td><?= htmlspecialchars($e['estado']) ?></td>
            <td>
                <?php if($e['estado'] != 'Cancelado'): ?>
                    <button class="btn btn-danger btn-sm cancelarEvento">Cancelar</button>
                <?php else: ?>
                    <button class="btn btn-secondary btn-sm" disabled>Cancelado</button>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
<?php else: ?>
    <tr><td colspan="5">Ainda não tens eventos</td></tr>
<?php endif; ?>

        </tbody>
    </table>
</div>

<div class="modal fade" id="eventoModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-header">
        <h5 class="modal-title">Criar Evento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formEvento">
          <!-- Tipo do Evento -->
          <div class="mb-3">
            <label for="nome" class="form-label"><strong>Tipo do Evento</strong></label>
            <select id="nome" name="Nome" class="form-control" required>
              <optgroup label="Seleciona um Evento">
                <option value="2">Casamentos</option>
                <option value="3">Festas Infantis</option>
                <option value="4">Aniversários</option>
                <option value="1">Empresarial</option>
              </optgroup>
            </select>
          </div>

          <!-- Data -->
          <div class="mb-3">
            <label for="data" class="form-label"><strong>Data</strong></label>
            <input type="date" class="form-control" id="data" name="data" required>
          </div>

          <!-- Hora -->
          <div class="mb-3">
            <label for="hora" class="form-label"><strong>Hora</strong></label>
            <select id="hora" name="hora" class="form-control" required>
              <optgroup label="Manhã">
                <option value="09:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
              </optgroup>
              <optgroup label="Tarde">
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
              </optgroup>
            </select>
          </div>

          <!-- Serviços Adicionais -->
          <div class="mb-3">
            <label class="form-label"><strong>Serviços Adicionais</strong></label>
            <div class="form-check">
              <input class="form-check-input servico" type="checkbox" id="catering" value="246">
              <label class="form-check-label" for="catering">Catering - 246€</label>
            </div>
            <div class="form-check">
              <input class="form-check-input servico" type="checkbox" id="insuflaveis" value="123">
              <label class="form-check-label" for="insuflaveis">Insufláveis - 123€</label>
            </div>
            <div class="form-check">
              <input class="form-check-input servico" type="checkbox" id="pipocas" value="369">
              <label class="form-check-label" for="pipocas">Máquina de Pipocas - 369€</label>
            </div>
            <div class="form-check">
              <input class="form-check-input servico" type="checkbox" id="bolos" value="86.10">
              <label class="form-check-label" for="bolos">Bolos - 86.10€</label>
            </div>
            <div class="form-check">
              <input class="form-check-input servico" type="checkbox" id="decoracao" value="123">
              <label class="form-check-label" for="decoracao">Decoração - 123€</label>
            </div>
          </div>

          <!-- Pacote de Convidados -->
          <div class="mb-3">
            <label for="pacote" class="form-label"><strong>Pacote de Convidados</strong></label>
            <select id="pacote" name="pacote" class="form-control" required>
              <option value="">-- Seleciona um Pacote --</option>
              <option value="1" data-preco="200">Pacote 20 convidados - 200€</option>
              <option value="2" data-preco="350">Pacote 40 convidados - 350€</option>
              <option value="3" data-preco="500">Pacote 60 convidados - 500€</option>
              <option value="4" data-preco="650">Pacote 80 convidados - 650€</option>
              <option value="5" data-preco="800">Pacote 100 convidados - 800€</option>
              <option value="6" data-preco="950">Pacote 120 convidados - 950€</option>
              <option value="7" data-preco="1100">Pacote 140 convidados - 1100€</option>
              <option value="8" data-preco="1250">Pacote 160 convidados - 1250€</option>
              <option value="9" data-preco="1400">Pacote 180 convidados - 1400€</option>
              <option value="10" data-preco="1550">Pacote 200 convidados - 1550€</option>
            </select>
          </div>

          <h4 id="precoTotal">Preço: 0 €</h4>

          <button type="submit" class="btn btn-primary">Criar Evento</button>
        </form>
      </div>
    </div>
  </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inicialização do calendário
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt',
        selectable: true,
        events: <?php echo json_encode(array_map(function($ev){
            return [
                'id' => $ev['ID_Evento'],
                'title' => $ev['Nome'] . ($ev['estado']=='Cancelado'?' (Cancelado)':''),
                'start' => $ev['Data'] . 'T' . ($ev['hora'] ?: '09:00:00'),
                'color' => ($ev['estado'] == 'Cancelado') ? 'red' : 'green'
            ];
        }, $eventos)); ?>,
        dateClick: function(info) {
            $('#data').val(info.dateStr);
            $('#eventoModal').modal('show');
            calcularPreco(); // Atualiza preço ao abrir modal
        },
        validRange: function(nowDate) {
            return { start: nowDate };
        }
    });
    calendar.render();

    // Função para calcular o preço total
    function calcularPreco() {
        let total = 0;

        // Pacote
        let pacote = $('#pacote option:selected');
        if(pacote.length > 0 && pacote.val() !== "") {
            total += parseFloat(pacote.data('preco')) || 0;
        }

        // Serviços
        $('.servico:checked').each(function() {
            total += parseFloat($(this).val()) || 0;
        });

        $('#precoTotal').text("Preço: " + total.toFixed(2) + " €");
        return total;
    }

    $(document).on('change', '.servico, #pacote', calcularPreco);
    $('#eventoModal').on('shown.bs.modal', calcularPreco);

    $('#formEvento').on('submit', function(e) {
        e.preventDefault();

        let tipoId = $('#nome').val();
        let tipoNome = $('#nome option:selected').text();
        let data = $('#data').val();
        let hora = $('#hora').val();
        let pacote = $('#pacote').val();
        let precoTotal = calcularPreco();

        let servicosSelecionados = [];
        $('.servico:checked').each(function() {
            servicosSelecionados.push($(this).val());
        });

        if(tipoId && data && hora && pacote){
            let horaInt = parseInt(hora.split(':')[0]);
            if((horaInt >= 9 && horaInt < 13) || (horaInt >= 14 && horaInt < 17)){
                $.ajax({
                    url: 'salvarEvento.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        nome: tipoNome,
                        id_tipoevento: tipoId,
                        data: data,
                        hora: hora,
                        id_pacote: pacote,
                        servicos: servicosSelecionados
                    },
                    success: function(res){
                        console.log("Resposta do servidor:", res);
                        if(res.flag){
                        
                            calendar.addEvent({ 
                                title: tipoNome, 
                                start: data+"T"+hora,
                                id: res.id,
                                color: 'green'
                            });

                            // Adiciona à tabela
                            $('#tabelaEventos').prepend(
                                `<tr data-id="${res.id}">
                                    <td>${tipoNome}</td>
                                    <td>${data}</td>
                                    <td>${hora}</td>
                                    <td>Pendente</td>
                                    <td><button class="btn btn-danger btn-sm cancelarEvento">Cancelar</button></td>
                                </tr>`
                            );

                            $('#eventoModal').modal('hide');
                            $('#formEvento')[0].reset();
                            calcularPreco();

                            Swal.fire({
                                title: 'Evento criado!',
                                text: 'Preço total: ' + precoTotal.toFixed(2) + ' €',
                                icon: 'success'
                            }).then(() => {
                                window.location.href = 'checkout.php?preco=' + precoTotal.toFixed(2);
                            });
                        } else {
                            Swal.fire('Erro', res.msg, 'error');
                            console.error("DEBUG PHP:", res.debug || res);
                        }
                    },
                    error: function(xhr){
                        Swal.fire('Erro', 'Erro no servidor: '+xhr.responseText, 'error');
                    }
                });
            } else {
                Swal.fire('Horário inválido', 'Só pode marcar eventos das 9h às 13h ou das 14h às 17h.', 'warning');
            }
        } else {
            Swal.fire('Erro', 'Preenche todos os campos obrigatórios!', 'warning');
        }
    });
    $(document).on('click', '.cancelarEvento', function(){
        var row = $(this).closest('tr');
        var idEvento = row.data('id');

        Swal.fire({
            title: 'Tens a certeza?',
            text: "Queres cancelar este evento?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sim, cancelar',
            cancelButtonText: 'Não'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: 'cancelarEvento.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: idEvento },
                    success: function(res){
                        if(res.flag){
                            row.remove();
                            var evCal = calendar.getEventById(idEvento);
                            if(evCal) evCal.remove();
                            Swal.fire('Cancelado!', res.msg, 'success');
                        } else {
                            Swal.fire('Erro', res.msg, 'error');
                        }
                    },
                    error: function(xhr){
                        Swal.fire('Erro', 'Erro no servidor: '+xhr.responseText, 'error');
                    }
                });
            }
        });
    });

});


let precoBase = 100; 
let precoPorConvidado = 10;
function calcularPreco() {
    let total = 0;

    let pacote = $('#pacote option:selected');
    if(pacote.length > 0 && pacote.val() !== "") {
        total += parseFloat(pacote.data('preco')) || 0;
    }

  
    $('.servico:checked').each(function() {
        total += parseFloat($(this).val()) || 0;
    });

    $('#precoTotal').text("Preço: " + total.toFixed(2) + " €");
    return total;
}

$(document).on('change', '.servico, #pacote', calcularPreco);
$('#eventoModal').on('shown.bs.modal', calcularPreco);

$('#formEvento').on('submit', function(e) {
    e.preventDefault();

    let tipoId = $('#nome').val();
    let tipoNome = $('#nome option:selected').text();
    let data = $('#data').val();
    let hora = $('#hora').val();
    let pacote = $('#pacote').val();
    let precoTotal = calcularPreco();

    let servicosSelecionados = [];
    $('.servico:checked').each(function() {
        servicosSelecionados.push($(this).val());
    });

    if(tipoId && data && hora && pacote){
        let horaInt = parseInt(hora.split(':')[0]);
        if((horaInt >= 9 && horaInt < 13) || (horaInt >= 14 && horaInt < 17)){
            $.ajax({
                url: 'salvarEvento.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    nome: tipoNome,
                    id_tipoevento: tipoId,
                    data: data,
                    hora: hora,
                    id_pacote: pacote,
                    servicos: servicosSelecionados
                },
                success: function(res){
                    console.log("Resposta do servidor:", res);
                    if(res.flag){
                        calendar.addEvent({ 
                            title: tipoNome, 
                            start: data+"T"+hora,
                            id: res.id
                        });

                        $('#tabelaEventos').prepend(
                            `<tr data-id="${res.id}">
                                <td>${tipoNome}</td>
                                <td>${data}</td>
                                <td>${hora}</td>
                                <td>Pendente</td>
                                <td><button class="btn btn-danger btn-sm cancelarEvento">Cancelar</button></td>
                            </tr>`
                        );

                        $('#eventoModal').modal('hide');
                        $('#formEvento')[0].reset();
                        calcularPreco();

                        Swal.fire({
                            title: 'Evento criado!',
                            text: 'Preço total: ' + precoTotal.toFixed(2) + ' €',
                            icon: 'success'
                        }).then(() => {
                            window.location.href = 'checkout.php?preco=' + precoTotal.toFixed(2);
                        });
                    } else {
                        Swal.fire('Erro', res.msg, 'error');
                        console.error("DEBUG PHP:", res.debug || res);
                    }
                },
                error: function(xhr){
                    Swal.fire('Erro', 'Erro no servidor: '+xhr.responseText, 'error');
                }
            });
        } else {
            Swal.fire('Horário inválido', 'Só pode marcar eventos das 9h às 13h ou das 14h às 17h.', 'warning');
        }
    } else {
        Swal.fire('Erro', 'Preenche todos os campos obrigatórios!', 'warning');
    }
});
</script>
</body>
</html>
