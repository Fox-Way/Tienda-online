<div class="container">
  <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <h2>Abonos a Factura</h2>
    </div>
  </div>
  <fieldset>
    <legend></legend>
  </fieldset>

  <div class="container">
    <div class="row">
      <div class="col-md-9 col-md-offset-2">
          <table class="table table-hover">
            <thead>
              <tr>
                <th>Número de Factura</th>
                <th>Nombre Cliente</th>
                <th>Valor Factura</th>
                <th>Valor Abono</th>
                <th>Valor Restante</th>
                <th>Estado Factura</th>
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($factura as $val):?>

              <tr>
                <td><?= $val['id_factura']; ?></td>
                <td><?= $val['nombre_persona']; ?></td>
                <td>$ <?= number_format($val['valor_factura'], 0, '.', '.'); ?></td>
                <td>$ <?= number_format($val['valor_abono'], 0, '.', '.'); ?></td>
                <td>$ <?= $val['saldo'] == NULL ? number_format($val['valor_factura'], 0, '.', '.') : number_format($val['saldo'], 0, '.', '.'); ?></td>
                <td><?= $val['estado'] == 1 ? 'Pendiente por pagar' : 'Pagado'; ?></td>
                <td>
                  <a href="<?= URL. 'FacturacionCtrl/CrearAbonoFactura?idpersona=' . $val['id_persona'] . '&idfactura='.$val['id_factura']?>">
                    <button type="button" class="btn btn-warning btn-circle btn-md" data-toggle="modal" data-target="#abonos" title="Abonos">
                      <i class="fa fa-money" aria-hidden="true"></i>
                    </button>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
            </tbody>
          </table>
      </div>
    </div>
    <div class="row">
      <div class="col-md-5 col-md-offset-5">
        <a href="<?= URL ?>LoginCtrl/dashboard_rol2" class="btn btn-default">
          <i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;Volver
        </a>
      </div>
    </div>
  </div>
  <br>
  <?php if(isset($_GET['success']) && $_GET['success'] == 'ok'): ?>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="alert alert-success" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;El abono fue registrado correctamente</div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <?php if(isset($_GET['error']) && $_GET['error'] == 'fallo'): ?>
    <div class="container">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
          <div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>&nbsp;Ha ocurrido un error al guardar el abono</div>
        </div>
      </div>
    </div>
  <?php endif; ?>

  <div class="modal fade abonos" id="abonos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-keyboard ="false" data-backdrop = "static">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-body">
           <form method="POST" id="form-abonos" action="<?= URL ?>FacturacionCtrl/guardarAbono">
           <div class="row">
             <div class="panel panel-primary" style="margin-left: 2%; margin-right: 2%">
                 <div class="panel-heading" stlyle="height: 70px; width: 100px">
                     <center><span id="myModalLabel" style="text-align:center; color: #fff; font-size: 18px"><strong>Abonos a Factura</strong></center>
                 </div>
              <div class="panel-body">
                <div class="col-xs-12 col-md-6 col-md-offset-3">
                  <br>
                  <label >Valor Abono</label><br>
                  <input type="number" class="form-control" placeholder="Valor Abono" id="idabono" name="txtvalorabono" data-parsley-type="number">
                  <input type="hidden" name="idpersona" value="<?= $_GET['idpersona']?>">
                  <input type="hidden" name="idfactura" value="<?= $_GET['idfactura']?>">
                </div>
              </div>
         </div>
         </div>
           <br>
             <div class="row">
               <div class="col-xs-6 col-md-6 col-lg-6">
                 <button type="button" class="btn btn-secondary btn-active pull-right"  data-dismiss="modal" style="float: left">
                   <i class="fa fa-times" aria-hidden="true">   Cerrar</i>
                 </button>
               </div>

               <div class="col-xs-6 col-md-3 col-lg-3">
                 <button type="submit" name="btnRegistrarAbono" class="btn btn-success btn-active" id="btn-Guardar-Abono">
                   <i class="fa fa-hdd-o" aria-hidden="true"></i>&nbsp;Guardar</button>
               </div>
           </div>
         </form>
   </div>
 </div>
</div>
</div>
