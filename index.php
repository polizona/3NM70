<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> conjuntas </title>
	</head> 
<body>
<div class="container">
<div class="row align-items-center">
<div class="col-12 align-self-center text-center p-4">
<h1>conjuntas</h1>
								
<br>
		
<label for="opciones"> Selecciona el proceso a realizar: </label>
		<select id="opciones">
			<option value="A"> Registro de Embarque </option>
			<option value="B"> Orden de Trabajo </option>
			<option value="C"> Finaliza Produccion </option>
			<option value="D"> Conjuntas</option>
			<option value="E"> Cobro a credito </option>
		</select><br><br>
		
		<p></p>
		<div class="info"></div>
		
<script type = "text/javascript">
const seleccionar = document.querySelector('select');
const parrafo = document.querySelector('p');
const div = document.querySelector('.info');
seleccionar.onchange = establecerClima;
function establecerClima() {
  const eleccion = seleccionar.value;
  if (eleccion === 'A') {
    parrafo.textContent = 'Porfavor, ingrese el total de mercancia obtenido de los embarques.';
	div.innerHTML = '<form action="regEmbarque.php" method="post"><fieldset><legend> Ingrese datos solicitados</legend> <p><label>Numero de Empresa:<input type="int" name="idEmpresa" /></label> </p><p><label>Total Insumo A:<input type="int" name="tInsumoA" /></label> </p><p><label>Total Insumo B: <input type="int" name="tInsumoB" /></label></p><p><input type="submit" value="enviar"/></p></fieldset></form>';
    div.innerHTML;
 } else if (eleccion === 'B') {
    parrafo.textContent = 'Porfavor, indique la cantidad de Insumos a Utilizar.';
	div.innerHTML = '<form action="ordTrabajo.php" method="post"><fieldset><legend> Ingrese datos solicitados</legend> <p><label>Numero de Empresa:<input type="int" name="idEmpresa" /></label> </p><p><label>Total Insumo A a utilizar:<input type="int" name="tInsumoA" /></label> </p><p><label>Total Insumo B a utilizar: <input type="int" name="tInsumoB" /></label></p><p><input type="submit" value="enviar"/></p></fieldset></form>';
    div.innerHTML;
  } else if (eleccion === 'C') {
    parrafo.textContent = 'Porfavor, inserte el numero de total de productos terminados.';
	div.innerHTML = '<form action="finProd.php" method="post"><fieldset><legend> Ingrese datos solicitados</legend><p><label>Numero de Empresa: <input type="int" name="idEmpresa" /></label></p><p><label>Total Productos Terminados: <input type="int" name="totProd" /></label></p><p><input type="submit" value="enviar"/></p></fieldset></form>';
    div.innerHTML;
  } else if (eleccion === 'D') {
    parrafo.textContent = 'tabla campo1 y campo2.';
	div.innerHTML = '<form action="conjuntas.php" method="post"><fieldset><legend> Ingrese datos solicitados</legend><p><label>tabla:<input type="text" name="tabla" /></label> </p><p><label>campo1: <input type="text" name="campo1" /></label></p><p><label>campo2: <input type="texto" name="campo2" /></label></p><p><input type="submit" value="enviar"/></p></fieldset></form>';
    div.innerHTML;
  } else if (eleccion === 'E') {
    parrafo.textContent = 'Inserte la mercancia que se desea comprar .';
	div.innerHTML = '<form action="compraCred.php" method="post"><fieldset><legend> Ingrese datos solicitados</legend><p><label>Numero de Empresa: <input type="int" name="idEmpresa" /></label></p><p><label>Total de Mercancia a Comprar: <input type="int" name="totCompra" /></label></p><p><input type="submit" value="enviar"/></p></fieldset></form>';
    div.innerHTML;
  } 
else {
    parrafo.textContent = 'NO PUSO NADA';
  }
}
</script>
</div>
</div>	
</div>
</body>
</html>
