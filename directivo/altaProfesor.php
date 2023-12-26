<?php session_start(); 
// Conexión a la base de datos
include 'db.php';

// Obtener todos los profesores
$query = "SELECT * FROM usuario WHERE tipo='profesor'";
$resultado = mysqli_query($conn, $query);


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ConSchool</title>
	<link rel="stylesheet" href="../CSS/stylesres.css">

	<!-- Google Font Link for Icons -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <script src="../JS/script.js" defer></script>

</head>
<body>
	<?php include "menu_profesor_y_direccion.html"?>

	<div class="contenedor">

		<div class="colDatosPersonales">
			
					<img class="fotoPersonal" src="../Media/cara_generica.jpg" alt="Foto personal">

			<p id="nombre">Nombre</p>
			<br>
			<p id="apellidos">Apellidos</p>
			<br>
			<p>Curso: <span id="cursoActual">Curso actual</span></p>
			<br>
			<p>Número de centro: <span id="centro">Centro</span></p>
		</div>

		<div class="colContenido bajando">

			<?php

			// Mostrar lista de profesores
while ($profesor = mysqli_fetch_assoc($resultado)) {
    echo "ID: " . $profesor['idUsuario'] . " - Nombre: " . $profesor['Nombre'] . " " . $profesor['Apellidos'] . "<br>";
    echo "<a href='editarProfesor.php?id=" . $profesor['idUsuario'] . "'>Editar</a> | ";
    echo "<a href='eliminarProfesor.php?id=" . $profesor['idUsuario'] . "'>Eliminar</a><br>";
}


include 'db.php';

// Si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger y limpiar datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $apellidos = mysqli_real_escape_string($conn, $_POST['apellidos']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $tipo = 'profesor'; // Asigna el tipo de usuario
    $id_centro = mysqli_real_escape_string($conn, $_POST['id_centro']);
    $cursoActual = mysqli_real_escape_string($conn, $_POST['cursoActual']);

    // Insertar datos en la base de datos
    $query = "INSERT INTO usuario (Nombre, Apellidos, contraseña, tipo, id_centro, cursoActual) VALUES ('$nombre', '$apellidos', '$password', '$tipo', '$id_centro', '$cursoActual')";
    mysqli_query($conn, $query);

   
    header('Location: altaProfesor.php');
}
			
?>
			

			


			
			

		</div>
        <div class="bajando">
        <form action="agregarProfesor.php" method="post">
            Nombre: <input type="text" name="nombre"><br>
            Apellidos: <input type="text" name="apellidos"><br>
            Contraseña: <input type="password" name="password"><br>
            ID Centro: <input type="number" name="id_centro"><br>
            Curso Actual: <input type="text" name="cursoActual"><br>
            <input type="submit" value="Agregar Profesor">
        </form>
        </div>
        


	</div>

	<script>
		renderCalendar();
	</script>

</body>
<?php 
$userID = $_SESSION['userID'];

// Realiza una consulta SQL para obtener los datos personales del usuario
$query2 = "SELECT Nombre, Apellidos, cursoActual, id_centro FROM Usuario WHERE idUsuario = '$userID'";
$result2 = mysqli_query($conn, $query2);

// Verifica si se encontraron resultados
if (mysqli_num_rows($result2) > 0) {
 // Procesa y muestra los datos aquí
 while ($row = mysqli_fetch_assoc($result2)) {
     $nombre = $row['Nombre'];
     $apellidos = $row['Apellidos'];
     $curso = $row['cursoActual'];
     $centro = $row['id_centro'];
    // Asigna los datos a los elementos HTML utilizando PHP
    echo '<script>';
    echo 'document.getElementById("nombre").innerHTML = "' . $nombre . '";';
    echo 'document.getElementById("apellidos").innerHTML = "' . $apellidos . '";';
    echo 'document.getElementById("cursoActual").innerHTML = "' . $curso . '";';
    echo 'document.getElementById("centro").innerHTML = "' . $centro . '";';
    echo '</script>';
} }else {
 
}

$conn->close();
?>
</html>