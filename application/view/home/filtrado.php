
        <header>
          <div class="row">
            <div class="col-xs-12 col-sm-12">
              <div class="cabecera wow bounceInLeft" data-wow-duration="2s">
                <?php require APP. 'view/_templates/logo.php'; ?>
              </div>
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
        <hgroup>
          <div class="title-bar-filter">
              <h2 class="text-center">Resultados de la Búsqueda</h2>
          </div>
          <h3 class="bottom">Productos encontrados: <span class="total-productos"><?php echo count($productosFiltrados); ?></span></h3>
        </hgroup>
        <div class="bottom">
          <span class="fuente">Ordenar Por:</span>
          <p>
            <form class="form-horizontal" name="form1">
              <select class="form-control" onchange="OrdenarProductos()" name="ordenar">
                  <option>---</option>
                  <option value="menor-mayor">Ordenar por precio de menor a mayor</option>
                  <option value="mayor-menor">Ordenar por precio de mayor a menor</option>
                  <option value="mayor-dcto">Ordenar por mayor descuento</option>
              </select>
            </form>
          </p>
        </div>
        <?php if (count($productosFiltrados) > 0): ?>
          <?php foreach($productosPorFiltrado as $producto): ?>
            <a href="<?= URL ?>productos/DetallesProducto&id_producto=<?php echo $producto['id']; ?>">
              <div class="productos-main hvr-float-shadow">
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
          <?php endforeach; ?>

          <!-- Paginador -->
          <div class="paginator-search">
            <nav>
              <ul class="pagination">
                <?php

                    if ($totalPaginas > 1) {

                      if ($pagina != 1)
                        echo '<li>
                                <a href="'.URL.'home/Buscador&?busqueda='.$_GET['busqueda'].'&pagina=' . ($pagina - 1). '" aria-label="Previous"><span aria-hidden="true">Anterior</span></a>
                              </li>';
                        for ($i = 1; $i <= $totalPaginas; $i++) {

                          if ($pagina == $i){
                            echo '<li><a href="#"><div class="pag">'.$pagina.'</div></a></li>';
                          }
                          else{
                            // echo '<li><a href="'.URL.'home/Index&pagina='.$i.'"</a></li>';
                            echo '<li><a href="'.URL.'home/Buscador&?busqueda='.$_GET['busqueda'].'&pagina='.$i.'">'.$i.'</a></li>';
                          }
                        }

                        if ($pagina != $totalPaginas) {
                          $pag = '';
                          $pag .= '<li>';
                          $pag .= '<a href="'.URL.'home/Buscador&?busqueda='.$_GET['busqueda'].'&pagina='.($pagina + 1).'" aria-label="Next"><span aria-hidden="true">Siguiente</span></a>';
                          $pag .= '</li>';
                          echo $pag;
                        }
                    }
                    echo '<p>';
                 ?>
              </ul>
            </nav>
          </div>

        <?php else: ?>
          <div class="alert alert-danger alert-dismissible" role="alert">
           <p class="centrar">
             <h3 class="text-center">
               <i class="fa fa-frown-o fa-2x" aria-hidden="true"></i>&nbsp;
               <strong>
                 Lo sentimos!
               </strong> La búsqueda no generó ningún resultado
             </h3>
           </p>
         </div>
        <?php endif; ?>
        <div class="limpiar"></div>

      </div>
    </div>
