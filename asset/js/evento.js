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
  const ID_Evento = $('#filmeSelectCalendar').val();

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
        ID_Evento: ID_Evento
      },
      failure: function () {
        alerta("error", "Erro ao carregar sessões");
      }
    },
    select: function (info) {
      Swal.fire({
        title: 'Criar Evento',
    html: `
      <input id="swalIDCliente" class="swal2-input" placeholder="ID do Cliente">
      <input id="swalNome" class="swal2-input" placeholder="Nome">
      <input id="swalIDTipoEvento" class="swal2-input" placeholder="ID Tipo Evento">
      <input id="swalIDPacote" class="swal2-input" placeholder="ID Pacote">
    `,
        focusConfirm: false,
      preConfirm: () => {
        const ID_Cliente = document.getElementById('swalIDCliente').value;
        const nome = document.getElementById('swalNome').value;
        const ID_TipoEvento = document.getElementById('swalIDTipoEvento').value;
        const ID_Pacote = document.getElementById('swalIDPacote').value;

        if (!ID_Cliente || !nome || !ID_TipoEvento || !ID_Pacote) {
          Swal.showValidationMessage('Preenche todos os campos');
          return false;
        }

        return {
          ID_Evento: $('#filmeSelectCalendar').val(), // pega o evento selecionado
          ID_Cliente,
          nome,
          ID_TipoEvento,
          ID_Pacote
        };
      }
      }).then(result => {
        if (result.isConfirmed) {
          const data = info.startStr.split('T')[0];
          const hora = info.startStr.split('T')[1].substring(0, 5);

          let dados = new FormData();
          dados.append('op', 10);
          dados.append('Evento_id', result.value.ID_Evento);
          dados.append('ID_Cliente', result.value.ID_Cliente);
          dados.append('nome', result.value.nome);
          dados.append('hora', hora);
          dados.append('estado', 'aceite');
          dados.append('Data', data);
          dados.append('ID_TipoEvento', result.value.ID_TipoEvento);
          dados.append('ID_Pacote', result.value.ID_Pacote);

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
function alerta(titulo,msg,icon){
    Swal.fire({
        position: 'center',
        icon: icon,
        title: titulo,
        text: msg,
        showConfirmButton: true,

      })
}