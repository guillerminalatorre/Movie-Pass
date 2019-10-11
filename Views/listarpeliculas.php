<?php

/* esto archivo era para probar que andaba borrenlo despues si les parece*/

echo count($peliculaList);

foreach($peliculaList as $values)
{

    echo $values->getPoster();
		echo $values->getId();
		echo $values->getIdioma();

		foreach($values->getGeneros() as $genero)
			{
				echo $genero;
			}

		echo $values->getTitulo();
		echo $values->getClasificacion();
		echo $values->getDescripcion();
		echo $values->getFechaDeEstreno();				
        echo $values->getVideo();
        
        echo "<br>";
}

?>
