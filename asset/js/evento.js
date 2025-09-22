function getTiposEventos() {
  let dados = new FormData();
  dados.append('op', 1);

  $.ajax({
    url: "asset/controller/controllerEventos.php",
    method: "POST",
    data: dados,
    contentType: false,
    processData: false,
    success: function (msg) {
      $('#filmeSelectCalendar').html(msg);
      //$('#tipoFilmeEdit').html(msg);
    }
  });
}

$(function () {
    getTiposEventos();
    listarEventos();
    carregarEventosParaCalendario();
});

function carregarEventosParaCalendario() {
  let dados = new FormData();
  dados.append('op', 1);

  $.ajax({
    url: "asset/controller/controllerEventos.php",
    method: "POST",
    data: dados,
    contentType: false,
    processData: false,
    success: function (html) {
      const parser = new DOMParser();
      const doc = parser.parseFromString(html, "text/html");
      const linhas = doc.querySelectorAll("tbody tr");
      let select = $('#filmeSelectCalendar');
      select.empty();
      linhas.forEach(l => {
        const id = l.querySelector("th")?.textContent;
        const nome = l.querySelector("td")?.textContent;
        if (id && nome) {
          select.append(`<option value="${id}">${nome}</option>`);
        }
      });
      carregarCalendario();
    }
  });
}

function listarEventos() {
  let dados = new FormData();
  dados.append('op', 2);

  $.ajax({
    url: "asset/controller/controllerEventos.php",
    method: "POST",
    data: dados,
    contentType: false,
    processData: false,
    success: function (msg) {
      $('#tableEventos').html(msg);
    }
  });
}

function carregarCalendario() {
  const Evento_id = $('#filmeSelectCalendar').val();

  const calendarioEl = document.getElementById('calendario');
  calendarioEl.innerHTML = "";

  const calendar = new FullCalendar.Calendar(calendarioEl, {
    initialView: 'timeGridWeek',
    locale: 'pt',
    editable: true,
    selectable: true,
    events: {
      url: 'asset/controller/controllerEventos.php',
      method: 'POST',
      extraParams: {
        op: 3,
        ID_Evento: Evento_id
      },
      failure: function () {
        alerta("error", "Erro ao carregar sessões");
      }
    },
    select: function (info) {
      Swal.fire({
        title: 'Criar Evento',
        html:
          '<input id="swalEvento" class="swal2-input" placeholder="ID do Evento">' +
          '<input id="swalCliente" class="swal2-input" placeholder="ID do Cliente">',
        focusConfirm: false,
        preConfirm: () => {
          const Evento_id = document.getElementById('swalEvento').value;
          const Cliente_id = document.getElementById('swalCliente').value;
          if (!Evento_id || !Cliente_id) {
            Swal.showValidationMessage('Preenche todos os campos');
            return false;
          }
          return { Evento_id, Cliente_id };
        }
      }).then(result => {
        if (result.isConfirmed) {
          const data = info.startStr.split('T')[0];
          const hora = info.startStr.split('T')[1].substring(0, 5);

          let dados = new FormData();
          dados.append('op', 2);
          dados.append('Evento_id', ID_Evento);
          dados.append('Cliente_id', result.value.Cliente_id);
          dados.append('data', data);
          dados.append('hora', hora);
          dados.append('estado', result.value.Cliente_id);

          $.ajax({
            url: 'asset/controller/controllerEventos.php',
            method: 'POST',
            data: dados,
            contentType: false,
            processData: false,
            success: function (msg) {
              alerta("success", msg);
              calendar.refetchEvents();
            }
          });
        }
      });
    }
  });

  calendar.render();
}