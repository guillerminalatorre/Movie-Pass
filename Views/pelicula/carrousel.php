<div class="col-sm-12 col-lg-10 offset-sm-0 offset-lg-1 bg-dark rounded shadow mb-4">
    <?php require_once(VIEWS_PATH."alert.php"); ?>
    <div class="row">
    <div id="multi-item-example" class="carousel slide carousel-multi-item" data-ride="carousel">

      <!--Indicators-->
      <ol class="carousel-indicators">
        <li data-target="#multi-item-example" data-slide-to="0" class="active"></li>
        <li data-target="#multi-item-example" data-slide-to="1"></li>
        <li data-target="#multi-item-example" data-slide-to="2"></li>
      </ol>
      <!--/.Indicators-->

      <!--Slides-->
      <div class="carousel-inner" role="listbox">
        <?php 
          if (!empty($peliculaList)) 
          {
            $carrousel = true;
            $id = 0;
            while($id < count($peliculaList))
            {
              require("moviecarrousel.php");
            }
          } 
        ?>
      </div>
      </div>
      <!--/.Slides-->
      <a class="carousel-control-prev" href="#multi-item-example" role="button" data-slide="prev">
        <i class="fas fa-chevron-left text-dark"></i>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#multi-item-example" role="button" data-slide="next">
        <i class="fas fa-chevron-right text-dark"></i>
        <span class="sr-only">Next</span>
      </a>

    </div>
    <!--/.Carousel Wrapper-->
</div>