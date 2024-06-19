Write-Host "creando modelos y recursos"

$Nombres = "Sistemas", " Departamentos", "Ciudades", 
"Categorias", "Marcas", "Bodegas", "Medidas",  
"Clientes", "Proveedores", "Inventarios",
"Compras", "Ventas", "Cotizaciones"


foreach ($Nombre in $Nombres) {
    Write-Host "...$Nombre"
    modelo $Nombre
    recurso $Nombre
    Start-Sleep -Seconds 2
}

$Nombres = "Deta_Compras", "Deta_Ventas", "Deta_Cotizaciones"

foreach ($Nombre in $Nombres) {
    Write-Host "...$Nombre"
    modelo $Nombre
    Start-Sleep -Seconds 2
}

Write-Host "Proceso terminado..."

    