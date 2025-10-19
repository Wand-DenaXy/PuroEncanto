<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Puro Encanto - Dashboard</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<link rel="stylesheet" href="asset/css/calendario.css">
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>

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
        $eventos[] = $row;
    }

    $stmt->close();
}

$conn->close();
?>

<style>

</style>
</head>
<body>
<div class="sidebar">
    <div class="logo">
        <a href="index.php"><img src="images/logos/PURO ENCANTO LOGO.png" alt="Puro Encanto"></a>
        <p class="logotitulo">Puro Encanto</p>
    </div>
    <a href="dashboardCliente.php" class="active"><i class="bi bi-calendar-event"></i> Criar Evento</a>
    <a href="perfil.php"><i class="bi bi-person-circle"></i> Perfil</a>
    <div class="time" id="time"></div>
</div>

<div class="content">
    <div class="header-section">
        <h2>Bem-vindo ao Puro Encanto!</h2>
        <p>Gerir os teus eventos nunca foi tão fácil</p>
    </div>

    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-calendar-check"></i>
            </div>
            <p class="stat-value" id="totalEventos">0</p>
            <p class="stat-label">Total de Eventos</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-clock-history"></i>
            </div>
            <p class="stat-value" id="eventosPendentes">0</p>
            <p class="stat-label">Eventos Pendentes</p>
        </div>
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-calendar-event"></i>
            </div>
            <p class="stat-value" id="proximoEvento">---</p>
            <p class="stat-label">Próximo Evento</p>
        </div>
    </div>

    <div class="calendar-container">
        <h3>📅 Calendário de Eventos</h3>
        <div id="calendar"></div>
    </div>

    <div class="eventos-section">
        <h3>Os Meus Eventos</h3>
        <div id="listaEventos"></div>
    </div>
</div>

<div class="modal fade" id="eventoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bi bi-plus-circle"></i> Criar Novo Evento</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formEvento">
                    <div class="mb-4">
                        <label for="nome" class="form-label">Tipo de Evento</label>
                        <select id="nome" name="Nome" class="form-select" required>
                            <option value="">-- Seleciona o tipo --</option>
                            <option value="2">Casamentos</option>
                            <option value="3">Festas Infantis</option>
                            <option value="4">Aniversários</option>
                            <option value="1">Empresarial</option>
                        </select>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label for="data" class="form-label">Data</label>
                            <input type="date" class="form-control" id="data" name="data" required>
                        </div>
                        <div class="col-md-6">
                            <label for="hora" class="form-label">Hora</label>
                            <select id="hora" name="hora" class="form-select" required>
                                <option value="">-- Seleciona a hora --</option>
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
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Serviços Adicionais</label>
                        <div class="form-check">
                            <input class="form-check-input servico" type="checkbox" value="246" id="catering">
                            <label class="form-check-label" for="catering">
                                Catering - 246€
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input servico" type="checkbox" value="123" id="insuflaveis">
                            <label class="form-check-label" for="insuflaveis">
                                Insufláveis - 123€
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input servico" type="checkbox" value="369" id="pipocas">
                            <label class="form-check-label" for="pipocas">
                                Máquina de Pipocas - 369€
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input servico" type="checkbox" value="86.10" id="bolos">
                            <label class="form-check-label" for="bolos">
                                Bolos - 86.10€
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input servico" type="checkbox" value="123" id="decoracao">
                            <label class="form-check-label" for="decoracao">
                                Decoração - 123€
                            </label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="pacote" class="form-label">Pacote de Convidados</label>
                        <select id="pacote" name="pacote" class="form-select" required>
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

                    <div class="preco-total-box">
                        <p style="color: #666; margin-bottom: 0.5rem; font-size: 0.875rem;">Preço Total</p>
                        <h4 id="precoTotal">0,00 €</h4>
                    </div>

                    <button type="submit" class="btn-primary-custom">
                        Criar Evento
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Relógio
    function updateTime() {
        const now = new Date();
        document.getElementById('time').textContent = now.toLocaleString('pt-PT');
    }
    updateTime();
    setInterval(updateTime, 1000);

    // Carregar eventos do PHP
    let eventosData = <?php echo json_encode($eventos); ?>;
    
    console.log('Eventos carregados:', eventosData);

    // Estatísticas
    const totalEventos = eventosData.length;
    const eventosPendentes = eventosData.filter(e => e.estado !== 'Cancelado').length;
    
    document.getElementById('totalEventos').textContent = totalEventos;
    document.getElementById('eventosPendentes').textContent = eventosPendentes;
    
    if (eventosPendentes > 0) {
        const proximos = eventosData
            .filter(e => e.estado !== 'Cancelado')
            .sort((a, b) => new Date(a.Data) - new Date(b.Data));
        if (proximos.length > 0) {
            const dataProx = new Date(proximos[0].Data);
            document.getElementById('proximoEvento').textContent = 
                dataProx.toLocaleDateString('pt-PT', { day: '2-digit', month: 'short' });
        }
    }

    // FullCalendar
    const calendarEl = document.getElementById('calendar');
    const calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'pt',
        selectable: true,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        },
        events: eventosData.map(ev => ({
            id: ev.ID_Evento,
            title: ev.Nome + (ev.estado === 'Cancelado' ? ' (Cancelado)' : ''),
            start: ev.Data + 'T' + (ev.hora || '09:00:00'),
            color: ev.estado === 'Cancelado' ? 'red' : 'green'
        })),
        dateClick: function(info) {
            $('#data').val(info.dateStr);
            $('#eventoModal').modal('show');
            calcularPreco();
        },
        validRange: function(nowDate) {
            return { start: nowDate };
        }
    });
    calendar.render();

    // Renderizar eventos como cards
    function renderEventos() {
        const container = document.getElementById('listaEventos');
        if (eventosData.length === 0) {
            container.innerHTML = `
                <div class="empty-state">
                    <i class="bi bi-calendar-x"></i>
                    <p>Ainda não tens eventos agendados</p>
                </div>
            `;
            return;
        }

        container.innerHTML = eventosData.map(e => `
            <div class="evento-card" data-id="${e.ID_Evento}">
                <div class="evento-info">
                    <div class="evento-tipo">${e.Nome}</div>
                    <div class="evento-detalhes">
                        <span><i class="bi bi-calendar"></i> ${new Date(e.Data).toLocaleDateString('pt-PT')}</span>
                        <span><i class="bi bi-clock"></i> ${e.hora}</span>
                        <span class="evento-status ${e.estado === 'Cancelado' ? 'status-cancelado' : 'status-pendente'}">
                            ${e.estado}
                        </span>
                    </div>
                </div>
                ${e.estado !== 'Cancelado' 
                    ? '<button class="btn-custom btn-cancel cancelarEvento">Cancelar</button>'
                    : '<button class="btn-custom" disabled style="opacity: 0.5;">Cancelado</button>'
                }
            </div>
        `).join('');
    }
    renderEventos();

    // Calcular preço
    function calcularPreco() {
        let total = 0;
        const pacote = $('#pacote option:selected');
        if (pacote.length > 0 && pacote.val() !== "") {
            total += parseFloat(pacote.data('preco')) || 0;
        }
        $('.servico:checked').each(function() {
            total += parseFloat($(this).val()) || 0;
        });
        $('#precoTotal').text(total.toFixed(2) + ' €');
        return total;
    }

    $(document).on('change', '.servico, #pacote', calcularPreco);
    $('#eventoModal').on('shown.bs.modal', calcularPreco);

    // Submeter formulário
    $('#formEvento').on('submit', function(e) {
        e.preventDefault();

        const tipoId = $('#nome').val();
        const tipoNome = $('#nome option:selected').text();
        const data = $('#data').val();
        const hora = $('#hora').val();
        const pacote = $('#pacote').val();
        const precoTotal = calcularPreco();

        const servicosSelecionados = [];
        $('.servico:checked').each(function() {
            servicosSelecionados.push($(this).val());
        });

        if (tipoId && data && hora && pacote) {
            const horaInt = parseInt(hora.split(':')[0]);
            if ((horaInt >= 9 && horaInt < 13) || (horaInt >= 14 && horaInt < 18)) {
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
                    success: function(res) {
                        if (res.flag) {
                            // Adicionar ao calendário
                            calendar.addEvent({ 
                                title: tipoNome, 
                                start: data + "T" + hora,
                                id: res.id,
                                color: 'green'
                            });

                            // Adicionar o novo evento ao array
                            const novoEvento = {
                                ID_Evento: res.id,
                                Nome: tipoNome,
                                Data: data,
                                hora: hora,
                                estado: 'Pendente'
                            };
                            eventosData.unshift(novoEvento);

                            // Atualizar a lista de eventos
                            renderEventos();

                            // Atualizar estatísticas
                            document.getElementById('totalEventos').textContent = eventosData.length;
                            document.getElementById('eventosPendentes').textContent = eventosData.filter(e => e.estado !== 'Cancelado').length;

                            $('#eventoModal').modal('hide');
                            $('#formEvento')[0].reset();
                            calcularPreco();
                            
                            Swal.fire({
                                title: 'Evento criado!',
                                text: 'Preço total: ' + precoTotal.toFixed(2) + ' €',
                                icon: 'success',
                                confirmButtonColor: '#8B7355'
                            }).then(() => {
                                window.location.href = 'checkout.php?preco=' + precoTotal.toFixed(2);
                            });
                        } else {
                            Swal.fire('Erro', res.msg, 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Erro', 'Erro no servidor: ' + xhr.responseText, 'error');
                    }
                });
            } else {
                Swal.fire({
                    title: 'Horário inválido',
                    text: 'Só podes marcar eventos das 9h às 13h ou das 14h às 17h.',
                    icon: 'warning',
                    confirmButtonColor: '#8B7355'
                });
            }
        } else {
            Swal.fire({
                title: 'Campos obrigatórios',
                text: 'Por favor, preenche todos os campos!',
                icon: 'warning',
                confirmButtonColor: '#8B7355'
            });
        }
    });

    // Cancelar evento
    $(document).on('click', '.cancelarEvento', function() {
        const card = $(this).closest('.evento-card');
        const idEvento = card.data('id');

        Swal.fire({
            title: 'Tens a certeza?',
            text: "Queres cancelar este evento?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc2626',
            cancelButtonColor: '#6B5744',
            confirmButtonText: 'Sim, cancelar',
            cancelButtonText: 'Não'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: 'cancelarEvento.php',
                    type: 'POST',
                    dataType: 'json',
                    data: { id: idEvento },
                    success: function(res) {
                        if (res.flag) {
                            // Remover o evento do array
                            const index = eventosData.findIndex(e => e.ID_Evento == idEvento);
                            if (index > -1) {
                                eventosData.splice(index, 1);
                            }

                            // Atualizar estatísticas
                            document.getElementById('totalEventos').textContent = eventosData.length;
                            document.getElementById('eventosPendentes').textContent = eventosData.filter(e => e.estado !== 'Cancelado').length;

                            card.fadeOut(300, function() {
                                $(this).remove();
                                // Se não houver mais eventos, mostrar estado vazio
                                if (eventosData.length === 0) {
                                    renderEventos();
                                }
                            });
                            
                            const evCal = calendar.getEventById(idEvento);
                            if (evCal) evCal.remove();
                            
                            Swal.fire({
                                title: 'Cancelado!',
                                text: res.msg,
                                icon: 'success',
                                confirmButtonColor: '#8B7355'
                            });
                        } else {
                            Swal.fire('Erro', res.msg, 'error');
                        }
                    },
                    error: function(xhr) {
                        Swal.fire('Erro', 'Erro no servidor: ' + xhr.responseText, 'error');
                    }
                });
            }
        });
    });
});
</script>
</body