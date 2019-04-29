# SIIGO-API-PHP
Este proyecto contiene el código fuente de un ejemplo de integración con la API de SIIGO. Cubre cómo autenticarse y consumir métodos para obtener registros, insertar y eliminar.

## Instrucciones

### 1. Requisitos
Para poder ejecutar el siguiente proyecto requiere en su aplicación web.

```
          - * jQuery -> https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js
          - Bootstrap -> https://getbootstrap.com/

*Este requisito es indispensable, dado que el lenguaje usado es javascript sobre jQuery
```

### 2. Métodos
A continuación los ejemplos de los métodos necesarios para interactuar con el API de SIIGO.

#### Obtener Token
Para interactuar con el API es necesario usar la seguridad por token, para eso se debe consumir el servicio https://siigonube.siigo.com:50050/connect/token que solicita el usuario y contraseña; retornando finalmente el token que se usara en el resto de solicitudes.

Ejemplo con jQuery
```
    var token = '';
    $.ajax({
        url: 'https://siigonube.siigo.com:50050/connect/token',
        type: 'POST',
        headers: {
            'Authorization' : 'Basic U2lpZ29XZWI6QUJBMDhCNkEtQjU2Qy00MEE1LTkwQ0YtN0MxRTU0ODkxQjYx',
            'Accept' : 'application/json',
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        success: function (result) {
            console.log(result);
            token = result.access_token;
            return token;
        },
        data: 'grant_type=password&username=Empresadeperas\admin@peras.com&password=siigo2019&scope=WebApi offline_access'
    });
```

#### Consultas
Una vez se obtiene el token, se puede realizar consultas a los métodos definidos en el API <URL>, a continuación un ejemplo de la solicitud por ajax.

Ejemplo con jQuery
```
    var token = obtenerToken();
    $.ajax({
        url: 'http://siigoapi.azure-api.net/siigo/api/v1/Developers/GetAll?namespace=v1',
        type: "GET",
        headers: {
            "Authorization": token,
            "Ocp-Apim-Subscription-Key": "a21a8a8413134995b658925143dc87e7"
        }
    }).done(function (result) {
        //El objecto result, retorna una lista de los objetos a buscar en este caso estamos obteniendo una lista de desarrolladores.
    });
```

#### Consultas
Una vez se obtiene el token, se puede realizar consultas a los métodos definidos en el API <URL>, a continuación un ejemplo de la solicitud por ajax.

Ejemplo con jQuery (Obtener lista de desarrolladores)
```
    var token = obtenerToken();
    $.ajax({
        url: 'http://siigoapi.azure-api.net/siigo/api/v1/Developers/GetAll?namespace=v1',
        type: "GET",
        headers: {
            "Authorization": token,
            "Ocp-Apim-Subscription-Key": "a21a8a8413134995b658925143dc87e7"
        }
    }).done(function (result) {
        //El objecto result, retorna una lista de los objetos a buscar en este caso estamos obteniendo una lista de desarrolladores.
    });
```

Ejemplo con jQuery (Obtener lista de productos)
```
    var token = obtenerToken();
    $.ajax({
        url: 'http://siigoapi.azure-api.net/siigo/api/v1/Products/GetAll?numberPage=0&namespace=v1',
        type: "Get",
        headers: {
            "Authorization": token,
            "Ocp-Apim-Subscription-Key": "a21a8a8413134995b658925143dc87e7"
        }
    }).done(function (result) {
        $("#table-productos tbody tr").remove();
        $.each(result, function(item, value) {
             //El objecto result, retorna una lista de los objetos a buscar en este caso estamos obteniendo una lista de productos.
        });
    });
```

#### Eliminar
Para realizar una eliminación es necesario enviar el id del objecto a eliminar, en este caso vamos a eliminar un producto.

Ejemplo con jQuery
```
    var token = obtenerToken();
    console.log("Prodcuto a eliminar", id);
    $.ajax({
        url: 'http://siigoapi.azure-api.net/siigo/api/v1/Products/Delete/' + id + '?namespace=v1',
        type: 'DELETE',
        headers: {
            'Ocp-Apim-Subscription-Key': 'a21a8a8413134995b658925143dc87e7',
            'Authorization': token
        },
        success: function (result) {
            //Para refrescar la lista del objecto es necesario volver a consultar.
        }
    });
```

#### Crear
Para realizar una creación se requiere enviar los campos solicitados del objecto a crear.

Ejemplo con jQuery
```
    var token = obtenerToken();
    var codigo = $("#text-codigo").val();
    var descripcion = $("#text-descripcion").val();
    var referencia = $("#text-referencia").val();
    var tipoProducto = $("#text-tipo-producto").val();
    var unidadMedida = $("#text-unidad-medida").val();
    var codigoBarras = $("#text-codigo-producto").val();
    var comentarios = $("#text-comentarios").val();
    var costo = $("#text-costo-producto").val();
    var estado = $("#text-estado-producto").val();
    var productoJSON = '{ "Code": "' + codigo + '", "Description": "' + descripcion + '", "ReferenceManufactures": "' + referencia + '", "ProductTypeKey": "' + tipoProducto + '",' +
        '"MeasureUnit": "' + unidadMedida + '", "CodeBars": "' + codigoBarras + '", "Comments": "' + comentarios + '", "TaxAddID": 0, "TaxDiscID": 0, "IsIncluded": true,' +
        '"Cost": ' + costo + ', "IsInventoryControl": true, "State": ' + estado + ', "PriceList1": 0, "PriceList2": 0, "PriceList3": 0, "PriceList4": 0,' +
        '"PriceList5": 0, "PriceList6": 0, "PriceList7": 0, "PriceList8": 0, "PriceList9": 0, "PriceList10": 0, "PriceList11": 0, "PriceList12": 0,' +
        '"Image": "string", "AccountGroupID": 40, "SubType": 0, "TaxAdd2ID": 0, "TaxImpoValue": 0}';
    console.log(productoJSON);
    $.ajax({
        url: 'http://siigoapi.azure-api.net/siigo/api/v1/Products/Create?namespace=v1',
        type: 'Post',
        dataType: 'json',
        contentType: 'application/json',
        headers: {
            'Content-Type': 'application/json',
            'Authorization': token,
            'Ocp-Apim-Subscription-Key': 'a21a8a8413134995b658925143dc87e7'
        },
        success: function (data) {
            console.log(data);
            $('#exampleModal').modal('hide');
            obtenerProductos();
            $("#titulo-mensaje-salida").html("Agregar Producto");
            $("#mensaje-salida").html('Producto guardado correctamente');
            $('#modal-out-put').modal('show');
        },
        //data: JSON.stringify(person)
        data: productoJSON
    });
```
### 3. Estructura del Proyecto
En el proyecto encontrara 2 archivos.
  
#### index.js
```
Se encuentran los métodos para interactuar con la API
          - obtenerToken
          - obtenerDesarrolladores
          - obtenerProductos
          - borrarProducto(ID)    
          - crearProducto    
```
    
#### index.html
```
Se encuentra los formularios para las consultas.
```

### 4. Configuración

- Clonar el proyecto
- Configurar <a href="https://medium.freecodecamp.org/how-to-get-https-working-on-your-local-development-environment-in-5-minutes-7af615770eec">HTTPS en su computador</a> *Esto para evitar el error por <a href="https://developer.mozilla.org/es/docs/Web/HTTP/Access_control_CORS">CORS</a>*
- Abra el index.html en su navegador preferido y verifique los procesos.
