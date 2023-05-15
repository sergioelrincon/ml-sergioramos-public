<?php

// Open the file. Read mode
$file = fopen("places.csv", "r"); 

// New array. One position - One file line
$places = array();

// Read the file until End Of File
while(!feof($file)) {
    // One position of the array - One file
    // We use explode funtion to separate the fields
    $places[] = explode(";",fgets($file));
}

//  DEBUG CODE
/*
echo "<pre>";
print_r($places);
echo "</pre>";
*/


?>

<!DOCTYPE html>
<html>
<head>
	<title>Descubriendo Gran Canaria</title>
</head>
<body>
	<header>
		<h1>Descubriendo Gran Canaria</h1>
	</header>
	<nav>
		<ul>
			<li><a href="nuevo.html">Nuevo lugar que visitar</a></li>
			<li><a href="listado.php">Lugares que no me puedo perder</a></li>
		</ul>
	</nav>
    <br>
	<main>
        <div class="containerListado">
            <h1>Lugares que no  me puedo perder</h1>
            <table border="1">
                <thead>
                    <tr>
                        <th>Visitado</th>
                        <th>Nombre del lugar</th>
                        <th>Descripción</th>
                        <th>Municipio</th>
                        <th>URL con más información</th>
                        <th>URL de Google Maps</th>
                        <th>Imagen</th>
                    </tr>
                </thead>
                <tbody>

                    <?php

                        // Iterate over the $places array
                        // $place will contain one place on every iteration
                        foreach ($places as $place) {
                            
                            echo "<tr>";
                            echo "<td><input type='checkbox' checked='checked'></td>";
                            echo "<td>$place[0]</td>";
                            echo "<td>$place[1]</td>";
                            echo "<td>$place[2]</td>";
                            echo "<td><a href='$place[3]'>$place[3]</a></td>";
                            echo "<td><a href='$place[4]'>$place[4]</a></td>";
                            echo "<td><img src='upload/".$place[5]."' width='200px'></td>";
                            echo "</tr>";

                        }

                    ?>
                
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>        