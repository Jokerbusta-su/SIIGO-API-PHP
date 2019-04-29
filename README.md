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

Ejemplo con PHP
```
    $url = "https://siigonube.siigo.com:50050/connect/token";
        $body = "grant_type=password&username=Empresadeperas\\admin@peras.com&password=siigo2019&scope=WebApi offline_access";
        $ch = curl_init();
        $header = array(
            'Authorization: Basic U2lpZ29XZWI6QUJBMDhCNkEtQjU2Qy00MEE1LTkwQ0YtN0MxRTU0ODkxQjYx',
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        curl_setopt($ch, CURLOPT_POST, 1);
        try
        {
            $response = curl_exec($ch);
            $response = json_decode($response);
            return $response;
        }
        catch (HttpException $ex)
        {
            echo $ex;
            return null;
        }
```

#### Consultas
Una vez se obtiene el token, se puede realizar consultas a los métodos definidos en el API <URL>, a continuación un ejemplo de la solicitud por PHP.

Ejemplo con PHP (Obtener lista de desarrolladores)
```
$url = "http://siigoapi.azure-api.net/siigo/api/v1/Developers/GetAll?namespace=v1";
        $ch = curl_init();
        $header = array(
            'Ocp-Apim-Subscription-Key: a21a8a8413134995b658925143dc87e7',
            'Authorization: '. getToken()
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        try
        {
            $response = curl_exec($ch);
            $response = json_decode($response, true);
            return $response;
        }
        catch (HttpException $ex)
        {
            echo $ex;
            return null;
        }
```

Ejemplo con PHP (Obtener lista de productos)
```
$url = "http://siigoapi.azure-api.net/siigo/api/v1/Products/GetAll?numberPage=0&namespace=v1";
        $ch = curl_init();
        $header = array(
            'Ocp-Apim-Subscription-Key: a21a8a8413134995b658925143dc87e7',
            'Authorization: '. getToken()
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        try
        {
            $response = curl_exec($ch);
            $response = json_decode($response, true);
            return $response;
        }
        catch (HttpException $ex)
        {
            echo $ex;
            return null;
        }
```

#### Eliminar
Para realizar una eliminación es necesario enviar el id del objecto a eliminar, en este caso vamos a eliminar un producto.

Ejemplo con PHP
```
    $url = "http://siigoapi.azure-api.net/siigo/api/v1/Products/Delete/". $id . "?namespace=v1";
        $ch = curl_init();
        $header = array(
            'Ocp-Apim-Subscription-Key: a21a8a8413134995b658925143dc87e7',
            'Authorization: '. getToken()
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        try
        {
            $response = curl_exec($ch);
            return $response;
        }
        catch (HttpException $ex)
        {
            echo $ex;
            return null;
        }
```

#### Crear
Para realizar una creación se requiere enviar los campos solicitados del objecto a crear.

Ejemplo con jQuery
```
function createProduct($product) {
        //$url = "http://localhost:16391/api/v1/Products/Create?namespace=v1";
        $url = "http://siigoapi.azure-api.net/siigo/api/v1/Products/Create?namespace=v1";
        $ch = curl_init();
        $header = array(
            'Ocp-Apim-Subscription-Key: a21a8a8413134995b658925143dc87e7',
            'Authorization: '. getToken(),
            'Content-Type: application/json'
        );
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $product);
        curl_setopt($ch, CURLOPT_POST, 1);
        try
        {
            $response = curl_exec($ch);
            $response = json_decode($response);
            return $response;
        }
        catch (HttpException $ex)
        {
            echo $ex;
            return null;
        }
    }
```
### 3. Estructura del Proyecto
En el proyecto encontrara 4 archivos.
  
#### index.php
```
Se encuentra los formualarios para las consultas.
```
    
#### services.php
```
Se encuentran los servicios para la aplicación.
```

#### save-product.php
```
Se encuentran el servicio encargado de gestionar el almacenamiento de un producto.
```

#### delete-product.php
```
Se encuentran el servicio encargado de gestionar la eliminación de un producto.
```

### 4. Configuración

- Clonar el proyecto
- Configurar <a href="https://medium.freecodecamp.org/how-to-get-https-working-on-your-local-development-environment-in-5-minutes-7af615770eec">HTTPS en su computador</a> *Esto para evitar el error por <a href="https://developer.mozilla.org/es/docs/Web/HTTP/Access_control_CORS">CORS</a>*
- Necesita un interperte para el lenguaje PHP <a href="https://www.apachefriends.org/es/index.html"> Instalar XAMP</a>
- Agrege los archivos del proyecto en la carpeta *htdocs*
- Ingrese al navegador a la siguiente URL *http://localhost:80/nombre_carpeta_proyecto/index.php* y compruebe el funcionamiento.
