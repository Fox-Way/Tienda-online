<html>
<head>

  <style media="screen">
    table{
      width: 100%;
    }
  </style>
    <link href="<?php echo URL?>css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <br>
  <center><legend><h2>FACTURA</h2></legend>
    <h4><strong>Nombre Cliente:</strong> <?= $value['nombre_persona']?></h4>
    <h4><strong>Teléfono:</strong> <?= $value['telefono']?></h4>
    <h4><strong>Dirección:</strong> <?= $value['direccion']?></h4>
    <h4><strong>Número Factura:</strong> <?= $value['id_factura']?></h4>
    <h4><strong>Fecha Generación Factura:</strong> <?= $value['fecha']?>&nbsp;&nbsp;&nbsp;<?= date("H:i:s"); ?></h4></center>
    <br>
    <legend><h2>Productos</h2></legend>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Producto</th>
        <th>Cantidad</th>
        <th>Valor</th>
        <th>Valor Final</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?= $value['nombre_producto'] ?></td>
        <td><?= $value['cantidad'] ?></td>
        <td><?= "$ " . number_format($value['valor'], 0, '.', '.') ?></td>
        <td><?= "$ " . number_format($value['valor_final'], 0, '.', '.') ?></td>
      </tr>
    </tbody>
  </table>
<script src="<?php echo URL ?>js/bootstrap.min.js"></script>
</body>
</html>
