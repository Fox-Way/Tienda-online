<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h2>Crear Factura</h2>
    </div>
  </div>
  <form class="form-horizontal" action="<?= URL ?>FacturacionCtrl/guardarFactura" method="POST">
    <fieldset>
      <legend></legend>
    </fieldset>
    <div class="row">
      <div class="col-md-3 col-md-offset-1">
        <div class="form-group">
          <label for="nombre">Nombre</label>
          <input type="text" id="nombre" name="nombre" placeholder="Ingrese el nombre..." class="form-control">
        </div>
      </div>
      <div class="col-md-3 col-md-offset-1">
        <div class="form-group">
          <label for="telefono">Teléfono</label>
          <input type="text" id="telefono" name="telefono" placeholder="Ingrese el teléfono..." class="form-control">
        </div>
      </div>
      <div class="col-md-3 col-md-offset-1">
        <div class="form-group">
          <label for="direccion">Dirección</label>
          <input type="text" id="direccion" name="direccion" placeholder="Ingrese la dirección..." class="form-control">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-md-offset-1">
        <div class="form-group">
          <label for="producto">Nombre Producto</label>
          <input type="text" id="producto" name="producto" placeholder="Ingrese el nombre del producto..." class="form-control">
        </div>
      </div>
      <div class="col-md-3 col-md-offset-1">
        <div class="form-group">
          <label for="cantidad">Cantidad</label>
          <input type="number" min="0" id="cantidad" name="cantidad" value="0" max="100" class="form-control">
        </div>
      </div>
      <div class="col-md-3 col-md-offset-1">
        <div class="form-group">
          <label for="valor">Valor</label>
          <input type="number" id="valor" min="0" name="valor" value="0" class="form-control">
        </div>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-md-2 col-md-offset-4">
        <button type="submit" name="btn-factura" class="btn btn-success"><i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;Guardar</button>
      </div>
      <div class="col-md-3 col-md-offset-1">
        <a href="<?= URL ?>LoginCtrl/dashboard_admin" class="btn btn-default">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Volver
        </a>
      </div>
    </div>
      </form>
      <br>
      <div class="row">
        <div class="col-md-4 col-md-offset-4">
          <?php if(isset($_GET['success']) && $_GET['success'] == 'ok'): ?>
              <div class="alert alert-success" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;El producto fue registrado correctamente</div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
