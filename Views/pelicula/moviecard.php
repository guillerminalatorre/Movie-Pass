<div class="col-md-4 movie-card">
    <div class="card" style="height: 850px;">
        <div class="card-header" >
            <img class="card-img" src="
            <?php
            $poster = $values->getPoster();
            if ($poster != NULL) {
                echo "https://image.tmdb.org/t/p/w500" . $poster;
            } else {
                echo IMG_PATH . "noImage.jpg";
            }
            ?>" alt="Card image">

        </div>
        <div class="card-body">
            <h3 class="card-title">
                <?php echo $values->getTitulo(); ?>
            </h3>
            <div class="container">
                <div class="row">
                    <div class="col-4" style="color: gold;">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        <p><?php echo $values->getPopularidad() . "/10"; ?></p>
                    </div>
                    <div class="col-8 metadata">
                        <?php
                        foreach ($values->getGeneros() as $gen) {
                            echo $gen . " ";
                        }
                        ?></div>
                </div>
            </div>
            <p class="card-text">
                <?php
                $description = $values->getDescripcion();
                if ($description != NULL) {
                    if (strlen($description) > 300) {
                        echo substr($description, 0, 300) . "...";
                        echo "<a href='#' class='card-link text-warning'>Ver mas</a>";
                    } else {
                        echo $description;
                    }
                }
                ?>
            </p>
            <div class="text-right">
                <a href="#" class="btn btn-warning">Consultar funciones</a></div>
        </div>
    </div>
</div>