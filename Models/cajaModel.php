<?php
// cajaModel.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $gases = ["15 KG", "11 KG", "5 KG", "45 KG", "VMF", "VMH"];
    $totalGeneral = 0;

    foreach ($gases as $gas) {
        $totalGas = 0;
        $clasificaciones = ["Lleno", "Vacio", "Concho", "Dañado", "Catalitico Lleno", "Catalitico Vacio"];

        foreach ($clasificaciones as $clasificacion) {
            // Obtener el valor del input correspondiente
            $inputName = "$gas-$clasificacion";
            $cantidad = isset($_POST[$inputName]) ? intval($_POST[$inputName]) : 0;

            // Sumar al total del gas
            $totalGas += $cantidad;
        }

        // Sumar al total general
        $totalGeneral += $totalGas;
    }

    // Puedes imprimir o almacenar los resultados como desees
    echo "Total general: $totalGeneral galones";

    // También puedes redirigir o realizar otras acciones después del cálculo
    // header("Location: otra_pagina.php");
} else {
    // Si se accede directamente a este archivo sin enviar el formulario, puedes redirigir a la página principal
    header("Location: index.php");
}
?>
