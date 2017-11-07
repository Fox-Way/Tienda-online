
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

          <?php foreach($productosPaginador as $producto):?>
            <a href="<?= URL ?>productos/DetallesProducto&id_producto=<?php echo $producto['id']; ?>">
              <div class="productos-main hvr-buzz-out">
                <div class="text-center container-name">
                  <?php echo $producto['nombre']; ?>
                </div>
                <img src="<?php echo URL ?>img/images-productos/<?php if($producto['imagen'] != 0) echo $producto['imagen']; else echo 'no-disponible.jpg' ?>" alt="<?php echo $producto['imagen'] ?>" class="img-products">
                <?php if ($producto['descuento'] == 0 || $producto['descuento'] == ''): ?>
                <div class="precio"><?php echo "$ " . number_format($producto['precio'], 0, '.', '.'); ?></div>
                <?php else: ?>
                  <div class="precio"><?php echo "$ " . number_format($producto['precio2'], 0, '.', '.'); ?></div>
                <?php endif; ?>
              </div>
            </a>
          <?php endforeach ?>
        <div class="limpiar"></div>

        <!-- Paginador -->
        <div class="paginator">
          <nav>
            <ul class="pagination">
              <?php

                  if ($totalPaginas > 1) {

                    if ($pagina != 1)
                      echo '<li>
                              <a href="'.URL.'home/Index&pagina=' . ($pagina - 1). '" aria-label="Previous"><span aria-hidden="true">Anterior</span></a>
                            </li>';
                      for ($i = 1; $i <= $totalPaginas; $i++) {

                        if ($pagina == $i){
                          echo '<li><a href="#"><div class="pag">'.$pagina.'</div></a></li>';
                        }
                        else{
                          // echo '<li><a href="'.URL.'home/Index&pagina='.$i.'"</a></li>';
                          echo '<li><a href="'.URL.'home/Index&pagina='.$i.'">'.$i.'</a></li>';
                        }
                      }

                      if ($pagina != $totalPaginas) {
                        $pag = '';
                        $pag .= '<li>';
                        $pag .= '<a href="'.URL.'home/Index&pagina='.($pagina + 1).'" aria-label="Next"><span aria-hidden="true">Siguiente</span></a>';
                        $pag .= '</li>';
                        echo $pag;
                      }
                  }
                  echo '<p>';
               ?>
            </ul>
          </nav>
        </div>
      </div>
    </div>
