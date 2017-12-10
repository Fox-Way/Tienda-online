
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
          <?php if ($_GET['filter'] == "mayor-menor"): ?>
            <h3 class="bottom">Productos encontrados: <span class="total-productos"><?php echo count($precioMayorMenor); ?></span></h3>
          <?php endif; ?>
          <?php if ($_GET['filter'] == "menor-mayor"): ?>
            <h3 class="bottom">Productos encontrados: <span class="total-productos"><?php echo count($precioMenorMayor); ?></span></h3>
          <?php endif; ?>
          <?php if ($_GET['filter'] == "mayor-dcto"): ?>
            <h3 class="bottom">Productos encontrados: <span class="total-productos"><?php echo count($mayorDcto); ?></span></h3>
          <?php endif; ?>
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
         <?php if ($_GET['filter'] == "mayor-menor"): ?>
           <?php foreach($productosPorPrecioDescConPaginador as $mayorMenor): ?>
             <a href="<?= URL ?>productos/DetallesProducto&id_producto=<?php echo $mayorMenor['id']; ?>">
               <div class="productos-main hvr-float-shadow">
                 <div class="text-center container-name">
                   <?php echo $mayorMenor['nombre']; ?>
                 </div>
                 <img src="<?php echo URL ?>img/images-productos/<?php echo $mayorMenor['imagen'] != 0 ? $mayorMenor['imagen'] : 'no-disponible.jpg' ?>" alt="<?php echo $mayorMenor['imagen'] ?>" class="img-products">
                 <?php if ($mayorMenor['descuento'] == 0 || $mayorMenor['descuento'] == ''): ?>
                 <div class="precio"><?php echo "$ " . number_format($mayorMenor['precio'], 0, '.', '.'); ?></div>
                 <?php else: ?>
                   <div class="precio"><?php echo "$ " . number_format($mayorMenor['precio2'], 0, '.', '.'); ?></div>
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
                                 <a href="'.URL.'home/Ordenar&filter=mayor-menor&pagina=' . ($pagina - 1). '" aria-label="Previous"><span aria-hidden="true">Anterior</span></a>
                               </li>';
                         for ($i = 1; $i <= $totalPaginas; $i++) {

                           if ($pagina == $i){
                             echo '<li><a href="#"><div class="pag">'.$pagina.'</div></a></li>';
                           }
                           else{
                             // echo '<li><a href="'.URL.'home/Index&pagina='.$i.'"</a></li>';
                             echo '<li><a href="'.URL.'home/Ordenar&filter=mayor-menor&pagina='.$i.'">'.$i.'</a></li>';
                           }
                         }

                         if ($pagina != $totalPaginas) {
                           $pag = '';
                           $pag .= '<li>';
                           $pag .= '<a href="'.URL.'home/Ordenar&filter=mayor-menor&pagina='.($pagina + 1).'" aria-label="Next"><span aria-hidden="true">Siguiente</span></a>';
                           $pag .= '</li>';
                           echo $pag;
                         }
                     }
                     echo '<p>';
                  ?>
               </ul>
             </nav>
           </div>

         <?php endif;?>
        <?php if ($_GET['filter'] == "menor-mayor"): ?>
           <?php foreach($productosPorPrecioAscConPaginador as $menorMayor): ?>
             <a href="<?= URL ?>productos/DetallesProducto&id_producto=<?php echo $menorMayor['id']; ?>">
               <div class="productos-main hvr-float-shadow">
                 <div class="text-center container-name">
                   <?php echo $menorMayor['nombre']; ?>
                 </div>
                 <img src="<?php echo URL ?>img/images-productos/<?php echo $menorMayor['imagen'] != 0 ? $menorMayor['imagen'] : 'no-disponible.jpg' ?>" alt="<?php echo $menorMayor['imagen'] ?>" class="img-products">
                 <?php if ($menorMayor['descuento'] == 0 || $menorMayor['descuento'] == ''): ?>
                 <div class="precio"><?php echo "$ " . number_format($menorMayor['precio'], 0, '.', '.'); ?></div>
                 <?php else: ?>
                   <div class="precio"><?php echo "$ " . number_format($menorMayor['precio2'], 0, '.', '.'); ?></div>
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
                                 <a href="'.URL.'home/Ordenar&filter=menor-mayor&pagina=' . ($pagina - 1). '" aria-label="Previous"><span aria-hidden="true">Anterior</span></a>
                               </li>';
                         for ($i = 1; $i <= $totalPaginas; $i++) {

                           if ($pagina == $i){
                             echo '<li><a href="#"><div class="pag">'.$pagina.'</div></a></li>';
                           }
                           else{
                             // echo '<li><a href="'.URL.'home/Index&pagina='.$i.'"</a></li>';
                             echo '<li><a href="'.URL.'home/Ordenar&filter=menor-mayor&pagina='.$i.'">'.$i.'</a></li>';
                           }
                         }

                         if ($pagina != $totalPaginas) {
                           $pag = '';
                           $pag .= '<li>';
                           $pag .= '<a href="'.URL.'home/Ordenar&filter=menor-mayor&pagina='.($pagina + 1).'" aria-label="Next"><span aria-hidden="true">Siguiente</span></a>';
                           $pag .= '</li>';
                           echo $pag;
                         }
                     }
                     echo '<p>';
                  ?>
               </ul>
             </nav>
           </div>

         <?php endif; ?>
         <?php if ($_GET['filter'] == "mayor-dcto"): ?>
            <?php foreach($productosPorMayorDctoConPaginador as $dcto): ?>
              <a href="<?= URL ?>productos/DetallesProducto&id_producto=<?php echo $dcto['id']; ?>">
                <div class="productos-main hvr-float-shadow">
                  <div class="text-center container-name">
                    <?php echo $dcto['nombre']; ?>
                  </div>
                  <img src="<?php echo URL ?>img/images-productos/<?php echo $dcto['imagen'] != 0 ? $dcto['imagen'] : 'no-disponible.jpg' ?>" alt="<?php echo $dcto['imagen'] ?>" class="img-products">
                  <?php if ($dcto['descuento'] == 0 || $dcto['descuento'] == ''): ?>
                  <div class="precio"><?php echo "$ " . number_format($dcto['precio'], 0, '.', '.'); ?></div>
                  <?php else: ?>
                    <div class="precio"><?php echo "$ " . number_format($dcto['precio2'], 0, '.', '.'); ?></div>
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
                                  <a href="'.URL.'home/Ordenar&filter=mayor-dcto&pagina=' . ($pagina - 1). '" aria-label="Previous"><span aria-hidden="true">Anterior</span></a>
                                </li>';
                          for ($i = 1; $i <= $totalPaginas; $i++) {

                            if ($pagina == $i){
                              echo '<li><a href="#"><div class="pag">'.$pagina.'</div></a></li>';
                            }
                            else{
                              // echo '<li><a href="'.URL.'home/Index&pagina='.$i.'"</a></li>';
                              echo '<li><a href="'.URL.'home/Ordenar&filter=mayor-dcto&pagina='.$i.'">'.$i.'</a></li>';
                            }
                          }

                          if ($pagina != $totalPaginas) {
                            $pag = '';
                            $pag .= '<li>';
                            $pag .= '<a href="'.URL.'home/Ordenar&filter=mayor-dcto&pagina='.($pagina + 1).'" aria-label="Next"><span aria-hidden="true">Siguiente</span></a>';
                            $pag .= '</li>';
                            echo $pag;
                          }
                      }
                      echo '<p>';
                   ?>
                </ul>
              </nav>
            </div>

          <?php endif; ?>

        <div class="limpiar"></div>
      </div>
    </div>
