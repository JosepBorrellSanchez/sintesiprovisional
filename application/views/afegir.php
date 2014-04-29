<html>
	<head>
		<title>Agregar productes</title>
		<?php include("capçalera.php"); ?>
	</head>
	<body>
<h1>Inserta un nou producte</h1>
<form method="post">
          <table border = "0">
            <tr>
             <td>Nom:</td>
              <td><input type="text" name="fullname"></td>
            </tr>
            <tr>
            <td>Preu en euros: </td>
              <td><input type="number" min="0" name="price"></td>
            </tr>
            <tr>
				<select>
				<?php foreach($query->result() as $index) {?> 
				<option value="" name="categoria"><?php echo $index -> name; ?></option>
			<?php  } ?> 
			</select>
            </tr>
            <tr>
             <td><input type="Submit" value="Enviar"></td>
             <td><input type="Reset" value="Cancelar"></td>
            </tr> 
            <tr>
            
			</tr>
         </table>
         
        </form>
</body>
</html>

