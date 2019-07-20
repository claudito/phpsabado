$(document).ready(function (){

$('#consulta').DataTable({

"language":{

 "url":"spanish.json"

}


});


});


//Cargar Modal Agregar
$(document).on('click','.btn-agregar',function (){


$('.btn-submit').html('Agregar');
$('.modal-title').html('Agregar');
$('#modal-registro').modal('show');

});


//Cargar Modal Actualizar
$(document).on('click','.btn-edit',function (){


nombres      = $(this).data('nombres');
apellidos    = $(this).data('apellidos');
dni          = $(this).data('dni');
fechaingreso = $(this).data('fechaingreso');

$('.nombres').val(nombres);
$('.apellidos').val(apellidos);
$('.dni').val(dni);
$('.fechaingreso').val(fechaingreso);

$('.btn-submit').html('Actualizar');
$('.modal-title').html('Actualizar');
$('#modal-registro').modal('show');

});


//Cargar Modal Eliminar
$(document).on('click','.btn-delete',function (){


swal({
  title: "¿Estás Seguro?",
  text: "El Registro Seleccionado se eliminará de forma permanente",
  type: "warning",
  showCancelButton: true,
  confirmButtonClass: "btn-danger",
  confirmButtonText: "Si, estoy Seguro",
  cancelButtonText: "Cancelar",
  closeOnConfirm: false
},
function(){

 swal({
  
  title : "Buen Trabajo",
  text  : "Registro Eliminado",
  type  : "success",
  timer : 3000,
  showConfirmButton:false


 }); 


});



});
