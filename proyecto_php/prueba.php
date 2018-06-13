<link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- FORMULARIO PARA AÑADIR CLIENTE-->
    <div class="css">
    <div class="col-md-8">
        <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#usuario">
            Añadir Cliente
        </button>
    </div>
   </div>
<section class="seccion_dos">
    <div class="modal fade" id="usuario" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document"><!-- MODAL CONTENT NOS AYUDA ABRIR DIALOGOS-->
    <div class="modal-content">
        <form action="clientes.php" method="POST">
      <div class="modal-header">
       
        <h4 class="modal-title">Nuevo Cliente</h4>
      </div>
      <div class="modal-body"> <!--Cuerpo del BODY form-->
        <div class="form-group">
              <label>Nombre del Cliente</label>
              <input type="text" name ="nombre" class="form-control" required="required" placeholder="ejemplo: roberto">
        </div>
        <div class="form-group">
              <label>Apellidos</label>
              <input type="text" name="apellido" required="required" class="form-control" placeholder="ejem ramirez">
        </div>
          <div class="form-group">
              <label>Dirección</label>
              <input type="text" name="direccion" required ="required" class="form-control">
          </div>
        <div class="modal-header">
        <h4 class="modal-title">Añadir Parte Servicio</h4>
      </div>
          <div class="form-group"><br>
              <label>Acepta Presupuesto</label>
              <select name='acepta_presupuesto' class="form-control" required="required">
                <option value='Si'>Si</option>
                <option value='No'>No</option>
              </select>
          </div>
          <div class="form-group">
              <label>Valor Presupuesto</label>
              <input tpye="text" name="valor_presupuesto" class="form-control" required="required">
          </div>
          <div class="form-group">
              <label>Estado</label>
              <select name="estados" class="form-control">
                <option value="Pendiente">Pendiente</option>
                <option value="En Proceso">En Proceso</option>
                <option value="Finalizado">Finalizado</option>
              </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="submit" name="envia" class="btn btn-primary">Guardar Cambios</button>
      </div>
    </form>
    </div>
  </div>
</div>
</section><!--FIN DEL FORMULARIO-->

 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>