
        <header>
          <div class="row">
            <div class="col-xs-12 col-sm-12">
              <div class="cabecera"></div>
                <nav class="wow bounceInLeft" data-wow-duration="2s">
                  <?php require APP. 'view/_templates/menu.php'; ?>
                </nav>
            </div>
          </div>

        </header>

      <div class="video-container">
       <video autoplay height="720" loop poster="<?php echo URL ?>videos/clothing.jpg" width="1280">
         <source src="<?php echo URL ?>videos/clothing.mp4" typ="video/mp4">
         <source src="<?php echo URL ?>videos/clothing.webm" typ="video/webm">
         <source src="<?php echo URL ?>videos/clothing.ogv" typ="video/ogv">
       </video>
     </div>

    <div class="row">
      <div class="main top">
        <h1>Resultado de la búsqueda</h1>
          <?php foreach($productos_filtrados as $producto): ?>
            <?php if ($producto['nombre']!= 0): ?>
              <a href="<?= URL ?>productos/DetallesProducto&id_producto=<?php echo $producto['id']; ?>">
                <div class="productos-main hvr-buzz-out">
                  <div class="text-center container-name">
                    <?php echo $producto['nombre']; ?>
                  </div>
                  <img src="<?php echo URL ?>img/images-productos/<?php echo $producto['imagen'] != 0 ? $producto['imagen'] : 'no-disponible.jpg' ?>" alt="<?php echo $producto['imagen'] ?>" class="img-products">
                  <?php if ($producto['descuento'] == 0 || $producto['descuento'] == ''): ?>
                  <div class="precio"><?php echo "$ " . number_format($producto['precio'], 0, '.', '.'); ?></div>
                  <?php else: ?>
                    <div class="precio"><?php echo "$ " . number_format($producto['precio2'], 0, '.', '.'); ?></div>
                  <?php endif; ?>
                </div>
              </a>
          <?php else: ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
              <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span ari-hidden="true">&times;</span></button> -->
              <p class="centrar"><h3><strong>Lo sentimos!</strong> La búsqueda no generó ningún resultado</h3></p>
            </div>
          <?php endif; ?>
          <?php endforeach; ?>
        <div class="limpiar"></div>
      </div>
    </div>
