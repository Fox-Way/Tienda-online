
        <header>
          <div class="row">
            <div class="col-xs-12 col-sm-12">
              <div class="cabecera"></div>
                <nav class="wow bounceInLeft" data-wow-duration="2s">
                  <?php require APP. 'view/_templates/menu.php'; ?>
                </nav>
            </div>
          </div>

            <!-- <div class="row center-xs">
              <div class="col-xs-12 col-sm-12">
                    <div class="search">
                        <form action="buscador.php" method="POST">
                          <fieldset class="fieldset1">
                            <input type="search" name="buscar" class="input1" placeholder="Buscar...">
                            <button type="submit" class="button1">
                              <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                          </fieldset>
                        </form>
                    </div>
              </div>
            </div> -->

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
          <a href="<?= URL ?>productos/DetallesProducto">
            <div class="productos-main hvr-buzz-out">
              <img alt="demo" src="<?= URL ?>img/shirt.jpg" class="img-products">
              <div class="precio">Precio</div>
            </div>
          </a>

          <a href="#">
            <div class="productos-main hvr-buzz-out">
              <img alt="demo" src="<?= URL ?>img/big.jpg" class="img-products">
              <div class="precio">Precio</div>
            </div>
          </a>

          <a href="#">
            <div class="productos-main hvr-buzz-out">
              <img alt="demo" src="<?= URL ?>img/ropa_interior.jpeg" class="img-products">
              <div class="precio">Precio</div>
            </div>
          </a>

          <a href="#">
            <div class="productos-main hvr-buzz-out">
              <img alt="demo" src="<?= URL ?>img/ropa-nadal-tierra-batida.jpg" class="img-products">
              <div class="precio">Precio</div>
            </div>
          </a>

          <a href="#">
            <div class="productos-main hvr-buzz-out">
              <img alt="demo" src="<?= URL ?>img/shirt-blue-navy.jpg" class="img-products">
              <div class="precio">Precio</div>
            </div>
          </a>

          <a href="#">
            <div class="productos-main hvr-buzz-out">
              <img alt="demo" src="<?= URL ?>img/shirt.jpg" class="img-products">
              <div class="precio">Precio</div>
            </div>
          </a>

          <a href="#">
            <div class="productos-main hvr-buzz-out">
              <img alt="demo" src="<?= URL ?>img/t-shirt-blue.jpg" class="img-products">
              <div class="precio">Precio</div>
            </div>
          </a>
        <div class="limpiar"></div>
      </div>
    </div>
