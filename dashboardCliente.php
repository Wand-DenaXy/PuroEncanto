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
                <th>Nome</th>
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
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Criar Evento</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <form id="formEvento">
          <div class="mb-3">
            <label for="nome" class="form-label">Nome do Evento</label>
            <select id="nome" name="Nome" class="form-control" required>
              <optgroup label="Manhã">
                <option value="Casamentos">Casamentos</option>
                <option value="Festas">Festas</option>
              </optgroup>
            </select>
          </div>
          <div class="mb-3">
            <label for="data" class="form-label">Data</label>
            <input type="date" class="form-control" id="data" required>
          </div>
          <div class="mb-3">
            <label for="hora">Hora</label>
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
          <button type="submit" class="btn btn-primary">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt',
        selectable: true,
        dateClick: function(info) {
            $('#data').val(info.dateStr);
            $('#eventoModal').modal('show');
        },
        validRange: function(nowDate) {
            return {
                start: nowDate 
            };
        }
    });
    calendar.render();

        var eventos = <?php echo json_encode($eventos); ?>;
        eventos.forEach(function(ev){
        var horaStr = ev.hora ? ev.hora : '09:00:00';
        calendar.addEvent({
        title: ev.Nome + (ev.estado=='Cancelado'?' (Cancelado)':''),
        start: ev.Data + 'T' + horaStr,
        color: ev.cor,
        id: ev.ID_Evento
    });
});




    $('#formEvento').on('submit', function(e) {
        e.preventDefault();
        var nome = $('#nome').val();
        var data = $('#data').val();
        var hora = $('#hora').val();
        if(nome && data && hora){
            var horaInt = parseInt(hora.split(':')[0]);
            if( (horaInt >= 9 && horaInt < 13) || (horaInt >= 14 && horaInt < 17) ){
                $.ajax({
                    url: 'salvarEvento.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { nome: nome, data: data, hora: hora },
                    success: function(res){
                        if(res.flag){
                            calendar.addEvent({ title: nome, start: data+"T"+hora });
                            $('#tabelaEventos').prepend(
                                `<tr data-id="${res.id}"><td>${nome}</td><td>${data}</td><td>${hora}</td><td>Pendente</td>
                                <td><button class="btn btn-danger btn-sm cancelarEvento">Cancelar</button></td></tr>`
                            );
                            $('#eventoModal').modal('hide');
                            $('#formEvento')[0].reset();
                            Swal.fire('Sucesso', res.msg, 'success');
                        } else {
                            Swal.fire('Erro', res.msg, 'error');
                        }
                    }
                });
            } else {
                Swal.fire('Horário inválido', 'Só pode marcar eventos das 9h às 13h ou das 14h às 17h.', 'warning');
            }
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
                        // Remove da tabela e do calendário
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
</script>
</body>
</html>
