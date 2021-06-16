
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title> Ciclo del dinero </title>
	</head> 
<body>
<div class="container">
<div class="row align-items-center">
<div class="col-12 align-self-center text-center p-4">
<h1>Asientos Contables</h1>
<h2>Huitron Rodriguez Rafael Moises </h2>
<h2>3NM70 Ing. Conocimiento </h2>								
<br>
		
<label for="opciones"> Selecciona el proceso a realizar: </label>
		<select id="opciones">
			<option value="A"> Registro de Embarque </option>
			<option value="B"> Orden de Trabajo </option>
			<option value="C"> Finaliza Produccion </option>
			<option value="D"> Venta a credito </option>
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
    parrafo.textContent = 'Inserte el costo del producto y la utilidad a obtener.';
	div.innerHTML = '<form action="ventaCred.php" method="post"><fieldset><legend> Ingrese datos solicitados</legend><p><label>Número de Empresa:<input type="int" name="idEmpresa" /></label> </p><p><label>Costo del Producto: <input type="double" name="costoPro" /></label></p><p><label>Utilidad del producto: <input type="double" name="ganancia" /></label></p><p><input type="submit" value="enviar"/></p></fieldset></form>';
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
