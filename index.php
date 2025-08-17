<?php
	// ===============================
	// Variables de usuario
	// ===============================
	$nombre = "Santos Nazareno"; // Nombre del usuario
	$edad = 30; // Edad actual
	$nueva_edad = $edad + 1; // Edad incrementada en 1

	// Mensaje personalizado con nombre y edad
	$output = "Hola soy, <br />" . $nombre . "<br />y mi edad es: " . $nueva_edad . " 😊";

	// Condicional para mostrar una descripción según la edad
	$condicional = match(true) {
		$edad < 5 => "Eres un bebe. 👨‍🍼", // Menor de 5 años
		$edad < 15 => "Eres un adolecente. 👦", // Menor de 15 años
		$edad === 18 => "Eres un adulto joven. 👩", // Exactamente 18 años
		$edad < 65 => "Eres un adulto. 👨‍🦳", // Menor de 65 años
		default => "Eres un adulto mayor. 👵" // 65 años o más
	};

	// ===============================
	// Llamada a la API local con cURL
	// ===============================
	// Se realiza una petición HTTP a api.php para obtener los datos en formato JSON
	$url = "http://localhost:8000/api.php"; // Ruta de la API local 
	$ch = curl_init($url); // Inicializa cURL con la URL
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Configura cURL para devolver el resultado como string
	$api_response = curl_exec($ch); // Ejecuta la petición y guarda la respuesta
	curl_close($ch); // Cierra la sesión cURL

	// Decodifica la respuesta JSON en un array asociativo de PHP
	$data = json_decode($api_response, true);
?>



<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Hello Santos</title>
	<!-- TailwindCSS CDN: Framework de estilos para diseño moderno -->
	<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 flex flex-col items-center justify-center min-h-screen gap-8">
	<!-- Título principal de la página -->
	<header class="mb-6">
		<h1 class="text-6xl font-extrabold text-white bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 p-8 rounded-xl shadow-xl text-center animate-pulse">
			Bienvenido a la página de Cristhia Santos Nazareno
		</h1>
	</header>
	<!-- Imágenes decorativas -->
	<div class="flex flex-row gap-8 mb-6">
		<img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" alt="Imagen 1" class="w-64 h-64 object-cover rounded-2xl shadow-lg border-4 border-purple-500">
		<img src="https://images.unsplash.com/photo-1519125323398-675f0ddb6308?auto=format&fit=crop&w=400&q=80" alt="Imagen 2" class="w-64 h-64 object-cover rounded-2xl shadow-lg border-4 border-pink-500">
	</div>
	<!-- Mensaje condicional según la edad -->
	<h2 class="text-5xl font-extrabold text-white bg-gradient-to-r from-purple-500 via-pink-500 to-red-500 p-6 rounded-lg shadow-lg text-center ">
		<?= $condicional ?>
	</h2>
	<!-- Tabla con la respuesta de la API -->
	<div class="bg-white/10 text-white p-4 rounded-lg shadow w-full max-w-xl">
		<h3 class="text-2xl font-bold mb-2">Respuesta de la API:</h3>
		<table class="w-full text-lg">
			<tbody>
				<?php // Si la respuesta de la API es un array, se muestran los datos en una tabla
				if(is_array($data)): ?>
					<?php foreach($data as $key => $value): ?>
						<tr class="border-b border-white/20">
							<td class="font-semibold py-2 pr-4 text-purple-300"><?= htmlspecialchars($key) // Nombre del campo ?></td>
							<td class="py-2 text-white"><?= htmlspecialchars($value) // Valor del campo ?></td>
						</tr>
					<?php endforeach; ?>
				<?php else: // Si no se pudo obtener datos de la API ?>
					<tr><td colspan="2">No se pudo obtener datos de la API.</td></tr>
				<?php endif; ?>
			</tbody>
		</table>
	</div>
</body>
</html>