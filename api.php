<?php
header('Content-Type: application/json');

$nombre = "Santos Nazareno";
$edad = 4;
$nueva_edad = $edad + 1;

$output = "Hola soy, " . $nombre . ", y mi edad es: " . $nueva_edad . " 😊";
$condicional = match(true) {
    $edad < 5 => "Eres un bebe. 👨‍🍼",
    $edad < 15 => "Eres un adolecente. 👦",
    $edad === 18 => "Eres un adulto joven. 👩",
    $edad < 65 => "Eres un adulto. 👨‍🦳",
    default => "Eres un adulto mayor. 👵"
};

$response = [
    'nombre' => $nombre,
    'edad' => $edad,
    'nueva_edad' => $nueva_edad,
    'output' => $output,
    'condicional' => $condicional
];

echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
