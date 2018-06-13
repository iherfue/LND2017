
function comprueba() {
        var nombre = document.getElementById('nombre').value;
        var apellido = document.getElementById('apellido').value;

            if (nombre > 10) {
                alert('Atención el campo nombre no debe superar más de 10 carácteres y debe ser de texto');
                return false;

            } else if (nombre == 0 || nombre.length < 2) {
                alert('El campo nombre no puede estar vacio, o requiere de como mínimo dos carácteres');
                return false;
            }
            
            if (apellido == 0 || apellido.length < 3) {
                alert('el campo apellido no puede estar vacio, o debe ser mas largo');
                return false;

            } else if (apellido.length > 20) {

                alert('En apellido solo se permiten 40 Carácteres');
                return false;
            }
}

function valida_discos() {
            
            var capacidad = document.getElementById('capacidad').value;
            var marca = document.getElementById('marca').value;
            var marcas = ["Toshiba","WD","Seagate","Hitachi"];
            var existe = false;
            var textfecha = document.getElementById('fecha').value;
            
          if( capacidad < 50){
              
              alert('La capacidad debe ser mayor a 50');
              
              return false;
          }
         
          for(var i=0; i < marcas.length; i++){
              
              if(marca == marcas[i]){
                  existe = true;
                 return true;
              }
          }
          
          if(existe == false) {
                  
             alert('No existe la marca ' + marca + ' Elija entre ' + marcas);
            return false;
            
          }
              
}

function equipos(){
    
    var equipomarca = document.getElementById('marca_equipos').value;
    var marcasequipo = ["Acer","Lenovo","Samsung","HP"];
    var existe = false;
    
    for(var i = 0; i < marcasequipo.lenght; i++){
        
        if(equipomarca == marcasequipo[i]){
            
            existe = true;
            return true;
        }
        
    }    
          if(existe == false) {
                  
             alert('No existe la marca ' + equipomarca + ' Elija entre ' + marcasequipo);
            return false;
            
          }
             
}
                    
$(document).ready(function(){
    $('[data-toggle="popover"]').popover(); 
});

function hora(hora, minuto, segundo,dia){
		segundo = segundo + 1;
		if(segundo == 60) {
           	 minuto = minuto + 1;
           	 segundo = 0;
       	        if(minuto == 60) {
                 minuto = 0;
                 hora = hora + 1;
                if(hora == 24) {
                   hora = 0;
               	 }
               }
	     }
		if(hora < 10) hora = '0' + hora;
		if(minuto < 10) minuto = '0' + minuto;
		if(segundo < 10) segundo = '0' + segundo;
		HoraCompleta= " Hora del servidor " + hora + " : " + minuto + " : " + segundo;
		document.getElementById('muestra_hora').innerHTML = HoraCompleta;
		setTimeout("hora(" +hora+ ", "+minuto+", "+segundo+")", 1000);
} 
