function getTiposEventos() {
  let dados = new FormData();
  dados.append('op', 1);

  $.ajax({
    url: "asset/controller/controllerEventos.php",
    method: "POST",
    data: dados,
    contentType: false,
    processData: false
  })
  .done(function (msg) {
    $('#filmeSelectCalendar').html(msg);
  })
  .fail(function () {
    alerta("Eventos", "Erro ao carregar tipos de eventos", "error");
  });
}

$(function () {
  getTiposEventos()
    listarEventos();
    setTimeout(() => {
      carregarCalendario();
    }, 1000);
  });

function removerEventos(id){

    let dados = new FormData();
    dados.append("op", 5);
    dados.append("ID_Evento", id);

    $.ajax({
    url: "asset/controller/controllerEventos.php",
    method: "POST",
    data: dados,
    dataType: "html",
    cache: false,
    contentType: false,
    processData: false
    })
    
    .done(function( msg ) {

        let obj = JSON.parse(msg);
        if(obj.flag){
            alerta("Eventos",obj.msg,"sucess");  
            listarEventos();    
        }else{
            alerta("Eventos",obj.msg,"error");    
        }
        
    })
    
    .fail(function( jqXHR, textStatus ) {
    alert( "Request failed: " + textStatus );
    });

}
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
    editable: false,
    selectable: false, 
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