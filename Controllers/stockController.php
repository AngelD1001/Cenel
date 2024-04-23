<?php

class StockManager {
    private $conexion;
    private $estadosProductos; // Propiedad para almacenar los estados de productos

    public function __construct($conexion) {
        $this->conexion = $conexion;
        // Inicializar los estados de productos al crear una instancia de StockManager
        $this->estadosProductos = $this->obtenerEstadosProductos();
    }

    public function obtenerBodegasAsignadas() {
        $bodegas = array();

        $query = "SELECT DISTINCT B.nombre_bodegas
                  FROM Asignacion_Stock AS ASG
                  INNER JOIN Bodegas AS B ON ASG.id_bodegas = B.id_bodegas";
        $result = mysqli_query($this->conexion, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $bodegas[] = $row['nombre_bodegas'];
            }
        }

        return $bodegas;
    }

    public function obtenerEstadosProductos() {
        $estados = array();
    
        $query = "SELECT CP.id_clasificaciones_producto, CP.nombre_clasificaciones_producto
                  FROM Clasificaciones_Producto CP";
        $result = mysqli_query($this->conexion, $query);
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $estados[$row['id_clasificaciones_producto']] = $row['nombre_clasificaciones_producto'];
            }
        }
    
        return $estados;
    }
    
    
    public function obtenerStockPorBodega($bodega) {
        $stock = array();
    
        // Obtener todos los productos y clasificaciones posibles
        $query = "SELECT P.nombre_producto, CP.id_clasificaciones_producto
                  FROM Producto P
                  INNER JOIN Clasificacion_Producto CP ON P.id_producto = CP.id_producto";
        $result = mysqli_query($this->conexion, $query);
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                $stock[$row['nombre_producto']][$row['id_clasificaciones_producto']] = 0;
            }
        }
    
        // Obtener el stock real por bodega
        $query = "SELECT P.nombre_producto, CP.id_clasificaciones_producto, SP.cantidad_stock_producto
                  FROM Stock_Producto SP
                  INNER JOIN Clasificacion_Producto CP ON SP.id_clasificacion_producto = CP.id_clasificacion_producto
                  INNER JOIN Producto P ON CP.id_producto = P.id_producto
                  INNER JOIN Asignacion_Stock ASG ON SP.id_stock_producto = ASG.id_stock_producto
                  INNER JOIN Bodegas B ON ASG.id_bodegas = B.id_bodegas
                  WHERE B.nombre_bodegas = '$bodega'";
        $result = mysqli_query($this->conexion, $query);
    
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Utiliza el array asociativo obtenido para mapear los IDs a los nombres
                $nombre_clasificacion = $this->estadosProductos[$row['id_clasificaciones_producto']];
                $stock[$row['nombre_producto']][$nombre_clasificacion] = $row['cantidad_stock_producto'];
            }
        }
    
        return $stock;
    }
    
}
?>
