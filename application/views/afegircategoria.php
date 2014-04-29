<html>
	<head>
		<title>Agregar productes</title>
		<?php include("capçalera.php"); ?>
	</head>
	<body>
<h1>Insertar una categoria de productes</h1>
<form method="post">
          <table border = "0">
            <tr>
             <td>Nom:</td>
              <td><input type="text" name="name"></td>
            </tr>
            <tr>
             <td>Slug:</td>
              <td><input type="text" name="slug"></td>
            </tr>
            <tr>
             <td><input type="Submit" value="Enviar"></td>
             <td><input type="Reset" value="Cancelar"></td>
            </tr> 
         </table>
        </form>
</body>
</html>

