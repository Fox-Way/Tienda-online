
    <header>
      <div class="cabecera"></div>
        <nav class="wow bounceInLeft" data-wow-duration="2s">
          <?php require APP. 'view/_templates/menu.php'; ?>
        </nav>
        <div class="row center-xs">
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
        </div>
        <div class="slider wow bounceInRight" data-wow-duration="2s">

        </div>
    </header>
    <div class="main">
      <div class="detalles-producto">
            <div class="div-details">
              <div>
                <a href="" class="vlightbox1" title="">
                  <img alt="shirt" src="<?= URL ?>img/shirt.jpg" class="img-products">
                </a>
              </div>
              <br>
              <a href="#" class="vlightbox1" title="">
                <img src="<?= URL ?>img/shirt-blue-navy.jpg" alt="" width="130" height="130">
              </a>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <a href="#" class="vlightbox1" title="">
                <img src="<?= URL ?>img/t-shirt-blue.jpg" alt="" width="130" height="130">
              </a>
            </div>
            <p class="title-details"></p>
            <span class="precio-details"></span>
            <p class="characteristics">
              * Características
            </p>
            <div class="text-characts">
              <!-- <?php
                  $array = explode(" ", utf8_encode($fila2['descripcion']));
                  for ($i = 0; $i < 10; $i++)
                  {
                    echo $array[$i]." ";
                  }
                  echo "...";
              ?> -->
            <div class="hide-text" id="texto">
              <!-- <?php
              for ($i = 10; $i < count($array); $i++)
              {
                echo $array[$i]." ";
              }
              ?> -->
            </div>
              <br><br>
              <button type="button" name="button" class="btn btn-warning" onclick="mostrar()" id="btn-mostrar">Mostrar Más..</button>
              <button type="button" name="button" class="btn btn-warning" onclick="ocultar()" id="btn-ocultar">Mostrar Menos</button>
            </div>
          </div>
      <div class="limpiar"></div>
    </div>
