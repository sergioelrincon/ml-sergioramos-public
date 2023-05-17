<html>
    <body>

    <header>
		<h1>Descubriendo Gran Canaria</h1>
	</header>
	<nav>
		<ul>
			<li><a href="nuevo.html">Nuevo lugar que visitar</a></li>
			<li><a href="listado.html">Lugares que no me puedo perder</a></li>
		</ul>
	</nav>
    <main>
        <h1>Receiving data from the form</h1>


<?php

/**
 * Validate the filed value passed by parameter
 */
function validateRequired($fieldValue) {
    if (empty(trim($fieldValue)))
        return false;
    else 
        return true;
}

/**
 * Check the size of the value passed by parameter
 */
function validateSize($fieldValue, $size) {
    if (strlen(trim($fieldValue)) > $size)
        return false;
    else
        return true;
}

// DEGUB CODE
/*
echo "<pre>";
echo "<h1>Contenido del array _POST</h1>";
print_r($_POST);

echo "<h1>Contenido del array _FILES</h1>";
print_r($_FILES);
echo "</pre>";
^*/

$arrayErrors = array();

// Recibimos los datos enviados a través del formulario
$namePlace = $_POST["nombre-lugar"];
$descriptionPlace = $_POST["descripcion"];
$town = $_POST["municipio"];
$url_info = $_POST["url-info"];
$url_maps = $_POST["url-maps"];
$image = $_FILES["imagen"]["name"];

// Validamos los datos
if (!validateRequired($namePlace)) {
    $arrayErrors[] = "<li>ERROR: The name field is empty";
}
if (!validateRequired($descriptionPlace)) {
    $arrayErrors[] = "<li>ERROR: The description field is empty";
}
if (!validateRequired($town)) {
    $arrayErrors[] = "<li>ERROR: The town field is empty";
}
if (!validateRequired($url_info)) {
    $arrayErrors[] = "<li>ERROR: The URL (info) field is empty";
}
if (!validateRequired($url_maps)) {
    $arrayErrors[] = "<li>ERROR: The URL (Google Maps) field is empty";
}
if (!validateRequired($image)) {
    $arrayErrors[] = "<li>ERROR: The image field is empty";
}

if (!validateSize($namePlace, 20)) {
    $arrayErrors[] = "<li>ERROR: The size of the name field is greater than 20 characters";
}
if (!validateSize($descriptionPlace, 100)) {
    $arrayErrors[] = "<li>ERROR: The size of the description is field greater than 100 characters";
}
if (!validateSize($url_info, 100)) {
    $arrayErrors[] = "<li>ERROR: The size of the URL (info) is field greater than 100 characters";
}
if (!validateSize($url_maps, 100)) {
    $arrayErrors[] = "<li>ERROR: The size of the URL (Google Maps) isfield greater than 100 characters";
}



// Mostramos los diferentes campos
if (sizeof($arrayErrors) > 0)
{
    echo "<H2>Detected some errors</H2>";    
    echo "<ul>";
    foreach($arrayErrors as $errorMessage)
    {
        echo $errorMessage;
    }
    echo "</ul>";
    echo "<a href='nuevo.html'>Try again</a>";
}
else
{
    echo "<H2>The data is OK. We are going to insert into the database</H2>";
    echo "<ul>";
    echo "<li>The name of the place is...$namePlace";
    echo "<li>The description of the place is...$descriptionPlace";
    echo "<li>The URL with info of the place is...$url_info";
    echo "<li>The URL with the map of the place is...$url_maps";
    echo "<li>The image name is...$image";
    echo "</ul>";

    $fileUploadDir = "./upload";

    if (!(move_uploaded_file($_FILES["imagen"]["tmp_name"], $fileUploadDir."/".$_FILES["imagen"]["name"])))
        echo "<br>Error al subir el fichero";

    $myfile = fopen("places.csv", "a") or die("Unable to open file!");
    $txt = "\n$namePlace;$descriptionPlace;$town;$url_info;$url_maps;$image";
    fwrite($myfile, $txt);
    fclose($myfile);
}

?>
        </main>

    </body>

</html>