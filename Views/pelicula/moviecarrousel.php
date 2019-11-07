<?php if($id%3 == 0) { ?><div class="carousel-item <?php if($id == 0) { ?>active<?php } ?>"><?php } ?>

          <div class="row">
            <div class="col-md-4">
                <?php 
                $values = $peliculaList[$id++];
                require("moviecard.php"); 
                ?>
            </div>

            <div class="col-md-4 clearfix d-none d-md-block">
                <?php 
                $values = $peliculaList[$id++];
                require("moviecard.php"); 
                ?>
            </div>

            <div class="col-md-4 clearfix d-none d-md-block">
                <?php 
                $values = $peliculaList[$id++];
                require("moviecard.php"); 
                ?>
            </div>
          </div>

<?php if($id%3 == 0 || $id == count($peliculaList)) { ?></div><?php } ?>