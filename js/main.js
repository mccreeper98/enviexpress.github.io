var paqId = -1;
var cpOrigen = '';
  var cpDestino = '';
  var colonia = '';
  var nombre = '';
  var apellidos = '';
  var correo = '';
  var telefono = '';
  var razon = '';
  var paqN = '';
  var peso = '';
  var alto = '';
  var largo = '';
  var descripcion = '';
  var ancho = '';
  var manejo = '';
  var especial = false;
  var fragil = false;
  var precio = '';

$(document).ready(function(){
  $('.modal').modal();
  $("#especial").click(function() {  
    if($("#especial").is(':checked')) {  
      document.querySelector(`#esp`).classList.remove('hide');
    } else {  
      document.querySelector(`#esp`).classList.add('hide');  
    }  
  }); 
});

function next(number){
  if(number == 1){
    document.querySelector('#pasos').classList.remove('hide');
  }
  const nextStep = document.querySelector(`#step${number}`);

  nextStep.classList.remove("hide");
  nextStep.scrollIntoView({block: "start", behavior: "smooth"});
}

function prev(number){
  const prevStep = document.querySelector(`#step${number}`);
  const actStep = document.querySelector(`#step${number+1}`);

  prevStep.scrollIntoView({block: "start", behavior: "smooth"});
  // actStep.classList.add("hide");
}

function colonias(val){
  $('#modal1').modal('open');
  $.ajax({
    url:"getcolonias.php",
    type: "POST",
    data:{cpd: val,},
    success: function(data){
      console.log(data);
      $('#modal1').modal('close');
      $('#coloniadiv').removeClass('hide');
      $('#colonia').html('');
      $('#colonia').html(data);
      $('select').material_select();
    },
    error: function(e){
      console.log(e);
      $('#modal1').modal('close');
      error('Ha ocurrido un error inesperado, recargue la pagina e intente nuevamente');
    }
  });
}

function validStepOne(){
  cpOrigen = document.getElementById("cpo").value;
  cpDestino = document.getElementById("cpd").value;
  colonia = document.getElementById("colonia").value;
  nombre = document.getElementById("name").value;
  apellidos = document.getElementById("lastn").value;
  correo = document.getElementById("email").value;
  telefono = document.getElementById("phone").value;
  razon = document.getElementById("reason").value;

  var terminos = document.getElementById("terminos");
  var notificar = document.getElementById("info");

  if(cpOrigen == ''){
    error('Introduce el codigo postal de origen');
    return false;
  }

  if(cpDestino == ''){
    error('Introduce el codigo postal de destino');
    return false;
  }

  if(colonia == ''){
    error('Selecciona la colonia de destino');
    return false;
  }

  if(nombre  == ''){
    error('Introduce tu nombre');
    return false;
  }

  if(apellidos == ''){
    error('Introduce tus apellidos');
    return false;
  }

  if(correo == ''){
    error('Introduce tu correo');
    return false;
  }

  if(telefono == ''){
    error('Introduce tu teléfono');
    return false;
  }
  
  if(telefono.length != 10){
    error("Introduce un teléfono valido");
    return false;
  }

  if(!/^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i.test(correo)){
    error('Introduce un correo valido');
  }

  if(!terminos.checked){
    error('Acepta el aviso de privacidad');
    return false;
  }

  $('#modal1').modal('open');
  $.ajax({
    url:"datos.php",
    type: "POST",
    data:{cpo: cpOrigen, cpd: cpDestino, name: nombre, lastn: apellidos, email: correo, phone: telefono, reason: razon, contact: notificar.checked},
    success: function(data){
      $('#modal1').modal('close');
      if(data == 'error'){
        error('Todos los datos son necesarios');
      }else{
        $('#paqSection').html('');
        $('#paqSection').html(data);
        next(2);
      }
    },
    error: function(e){
      console.log(e);
      $('#modal1').modal('close');
      error('Ha ocurrido un error inesperado, recargue la pagina e intente nuevamente');
    }
  });

}

function error(msg){
  return sweetAlert('Error', msg, 'error');
}

function validaNumber(e) {
  tecla = (document.all) ? e.keyCode : e.which;

  //Tecla de retroceso para borrar, siempre la permite
  if (tecla == 8) {
    return true;
  }

  // Patron de entrada, en este caso solo acepta numeros
  patron = /[0-9-.]/;
  tecla_final = String.fromCharCode(tecla);
  return patron.test(tecla_final);
}

function selectPaq(number, cantidad, idPaq, name){
  paqId = idPaq;
  paqN = name;

  for(i=1; i<= cantidad; i++){
    var paq = document.querySelector(`#paq${i}`);

    if(i == number){
      paq.classList.add("selected");
    }else{
      paq.classList.remove("selected");
    }
  }

}

function validaPaq(){
  if(paqId != -1){
    next(3);
  }else{
    error('Selecciona una paquetería')
  }
}

function validarMedidas(){
  peso = document.getElementById("peso").value;
  alto = document.getElementById("alto").value;
  largo = document.getElementById("largo").value;
  descripcion = document.getElementById("descripcion").value;
  ancho = document.getElementById("ancho").value;
  manejo = document.getElementById("manejo").value;

  especial = document.getElementById("especial").checked;
  fragil = document.getElementById("fragil").checked;

  if(peso == ''){
    error('Introduce el peso');
    return false;
  }

  if(alto == ''){
    error('Introduce el alto');
    return false;
  }

  if(largo  == ''){
    error('Introduce el largo');
    return false;
  }

  if(ancho == ''){
    error('Introduce el ancho');
    return false;
  }

  if(descripcion == ''){
    error('Introduce la descripción');
    return false;
  }

  if(especial && manejo == ''){
    error('Introduce el manejo especial');
    return false;
  }


  $('#modal1').modal('open');
  $.ajax({
    url:"cotizar.php",
    type: "POST",
    data:{paq: paqId, peso: peso},
    success: function(data){
      precio = data;
      $('#modal1').modal('close');
      $('#costo').html('');
      $('#costo').html('Costo: $' + data);
      next(4);
      
    },
    error: function(e){
      console.log(e);
      $('#modal1').modal('close');
      error('Ha ocurrido un error inesperado, recargue la pagina e intente nuevamente');
    }
  });
}

function selectenv(number, cantidad){

  for(i=1; i<= cantidad; i++){
    var env = document.querySelector(`#env${i}`);

    if(i == number){
      env.classList.add("selected");
    }else{
      env.classList.remove("selected");
    }
  }
}


function generarpdf(){
  $('#modal1').modal('open');
  $.ajax({
    url:"pdf.php",
    type: "POST",
    data:{cpo: cpOrigen, cpd: cpDestino, colonia: colonia, name: nombre, ape: apellidos, email: correo, tel: telefono, razon: razon, paq: paqN, peso: peso, alto:alto, largo:largo, ancho:ancho, des:descripcion, fragil: fragil, especial: especial, cual: manejo, precio:precio},
    success: function(data){
      console.log(data);
      $('#modal1').modal('close');
      $('#costo').html('');
      $('#costo').html('Costo: $' + data);
      next(4);
      
    },
    error: function(e){
      console.log(e);
      $('#modal1').modal('close');
      error('Ha ocurrido un error inesperado, recargue la pagina e intente nuevamente');
    }
  });
}
