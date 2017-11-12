
    <header>
      <div class="cabecera"></div>
        <nav class="wow bounceInLeft" data-wow-duration="2s">
          <?php require APP. 'view/_templates/menu.php'; ?>
        </nav>

        <div class="slider wow bounceInRight" data-wow-duration="2s">

        </div>
    </header>
    <div class="main-details">
      <div class="title-bar">
        <h1 class="text-center">Pertenece a la categoría -> <?php echo $categoriaProducto[0]['nombre']; ?></h1>
      </div>
      <!-- <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2"> -->
          <div class="detalles-producto">
            <?php if($producto[0]['descuento'] == 0 || $producto[0]['descuento'] == ''){ ?>
            <?php } else { ?>
              <div class="descuento">
                <span class="disccount">descuento</span>
                -<?php echo $producto[0]['descuento'] ?> %
              </div>
            <?php } ?>
                <div class="div-details">
                  <div>
                    <?php foreach ($imagenes1 as $image1): ?>
                      <a href="<?php echo URL ?>img/images-productos/<?php  if($image1['nombre'] > 0) echo $image1['nombre']; else echo 'no-disponible.jpg' ?>" class="vlightbox1" title="<?php echo $producto[0]['nombre'] ?> - imágen # <?php echo $image1['prioridad'] ?>">
                        <img width="300" height="300" class="vlightbox1" src="<?php echo URL ?>img/images-productos/<?php if($image1['nombre'] > 0) echo $image1['nombre']; else echo 'no-disponible.jpg' ?>" alt="<?php echo $image1['nombre'] ?>">
                      </a>
                    <?php endforeach; ?>
                  </div>
                  <br>
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <?php foreach ($imagenes2 as $image2): ?>
                    <a href="<?php echo URL ?>img/images-productos/<?php if($image2['nombre'] > 0) echo $image2['nombre']; else echo 'no-disponible.jpg' ?>" class="vlightbox1" title="<?php echo $producto[0]['nombre'] ?> - imágen # <?php echo $image2['prioridad'] ?>">
                      <img width="100" height="100" src="<?php echo URL ?>img/images-productos/<?php if($image2['nombre'] > 0) echo $image2['nombre']; else echo 'no-disponible.jpg' ?>" alt="<?php echo $image2['nombre'] ?>">
                    </a>
                  <?php endforeach; ?>
                  <?php foreach ($imagenes3 as $image3): ?>
                    <a href="<?php echo URL ?>img/images-productos/<?php if($image3['nombre'] > 0) echo $image3['nombre']; else echo 'no-disponible.jpg' ?>" class="vlightbox1" title="<?php echo $producto[0]['nombre'] ?> - imágen # <?php echo $image3['prioridad'] ?>">
                      <img width="100" height="100" src="<?php echo URL ?>img/images-productos/<?php if($image3['nombre'] > 0) echo $image3['nombre']; else echo 'no-disponible.jpg' ?>" alt="<?php echo $image3['nombre'] ?>">
                    </a>
                  <?php endforeach; ?>
                </div>
                <p class="title-details"></p>
                <span class="precio-details"></span>
                <p class="characteristics">
                  <span class="caracteristicas-title">Características</span>
                </p>
                <p class="title-price">
                  <?php echo $producto[0]['nombre']; ?>
                </p>

                <?php foreach ($marca as $val): ?>
                  <?php if ($val['marca'] == ''): ?>
                  <?php else: ?>
                    <p class="title-ref">
                      Marca/Ref: <span class="red"><?php echo ucwords($marca[0]['marca']); ?></span>
                    </p>
                  <?php endif; ?>
                <?php endforeach; ?>

                <?php if($producto[0]['descuento'] == 0 || $producto[0]['descuento'] == ''): ?>
                  <p class="title-price">
                    <strong>
                      <span class="red">$ <?php echo number_format($producto[0]['precio'], 0, '.', '.') ?>&nbsp;Pesos</span>
                    </strong>
                  </p>
                <?php else: ?>
                  <p class="title-price">
                    <strong>
                      <span class="red">$ <?php echo number_format($producto[0]['precio2'], 0, '.', '.') ?>&nbsp;Pesos</span>
                    </strong>
                  </p>
                <?php endif; ?>
                  <?php if ($colores[0]['color'] == 'No definido'): ?>
                  <?php else: ?>
                    <p class="title-colors">
                      Colores
                      <select class="form-control" name="colores">
                        <option value="">Colores Disponibles</option>
                        <?php foreach ($colores as $color): ?>
                          <option value="<?php echo $color['id_color']; ?>" style="background-color: <?php echo $color['codigo_color']; ?>">
                            <strong><?php echo ucwords($color['color']); ?></strong>
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </p>
                  <?php endif; ?>
                <br>
                <div class="text-characts">
                  <h4><strong>Detalles del producto</strong></h4>
                  <?php
                      $array = explode(" ", $producto[0]['descripcion']);

                      if (strlen($producto[0]['descripcion']) < 25)
                      {
                        echo "";
                      }
                      else {
                        for ($i = 0; $i < 5; $i++)
                        {
                          echo $array[$i]." ";
                        }
                        echo "<span id='more'>...</span>";
                      }
                      ?>
                    <div class="hide-text" id="texto">
                  <?php

                    if (strlen($producto[0]['descripcion']) < 25)
                    {
                        echo "Este producto no tiene descripción";
                    }
                    else
                    {
                      for ($i = 5; $i < count($array); $i++)
                      {
                        echo $array[$i]." ";
                      }
                    }
                  ?>
                </div>
                  <br><br>
                  <button type="button" name="button" class="btn btn-warning" onclick="MostrarDescripcion()" id="btn-mostrar">Mostrar Más..</button>
                  <button type="button" name="button" class="btn btn-warning" onclick="OcultarDescripcion()" id="btn-ocultar">Mostrar Menos</button>
                  <br><br>
                  <label for="cant"> <span class="line_height">Cantidad</span>
                  <input type="number" name="cant" class="form-control cant" id="cant" min="1" value="1"></label>
                  <button type="button" name="button" class="btn btn-info" id="add-car">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;
                    Agregar al Carrito
                  </button>
                </div>
              </div>
        <!-- </div>
      </div> -->
      <!-- <br>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-2 col-md-offset-1">
          <div class="form-group">
            <input type="number" name="cant"class="form-control" min="1" value="1">
          </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-3">
          <div class="form-group">
            <button type="button" name="button" class="btn btn-info">
              <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;
              Agregar al Carrito</button>
          </div>
        </div>
      </div> -->
      <div class="limpiar"></div>
    </div>
