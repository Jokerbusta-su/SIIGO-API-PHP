<?php 
    include("services.php");
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
        <script type="text/javascript" src='index.js'> </script>
    <script>
        
    </script>
</head>

<body>
    <div class="container">
        <h2>Desarrolladores Aplicación</h2>
        <table class="table" id="table-desarrolladores">
            <thead>
                <tr>
                    <th>Primer Nombre</th>
                    <th>Apellidos</th>
                    <th>Activo</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $result = getDevelopers();
                    foreach ($result as $developer) { ?>
                        <tr>
                            <td><?php echo $developer['FirstName'] ?></td>
                            <td><?php echo $developer['LastName'] ?></td>
                            <td><?php echo ($developer['IsActive'] == 1) ? 'Activo' : 'Inactivo' ?></td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="container">
        <h2>Productos</h2>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Crear Producto
        </button>
        <table class="table" id="table-productos">
            <thead>
                <tr>
                    <th>Identificación</th>
                    <th>Codigo</th>
                    <th>Descripción</th>
                    <th>Costo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                    $result = getProducts();
                    foreach ($result as $product) { ?>
                        <tr>
                            <td><?php echo $product['Id'] ?></td>
                            <td><?php echo $product['Code'] ?></td>
                            <td><?php echo $product['Description'] ?></td>
                            <td><?php echo $product['Cost'] ?></td>
                            <td><a href="delete-product.php?id=<?php echo $product['Id'] ?>" class="btn btn-primary" role="button" aria-pressed="true">Eliminar</a></td>
                        </tr>
                    <?php } ?>
            </tbody>
        </table>
         <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Crear Producto</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <form class="needs-validation" novalidate action="save-product.php" method="POST">
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="text-codigo">Codigo</label>
                                <input type="text" name="code" class="form-control" id="text-codigo" placeholder="Codigo del producto">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text-descripcion">Descripción</label>
                                <input type="text" name="description" class="form-control" id="text-descripcion" placeholder="Descripcion del producto">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                    <label for="text-referencia">Referencia</label>
                                    <input type="text" name="references" class="form-control" id="text-referencia" placeholder="Referencia del producto">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="text-tipo-producto">Tipo producto</label>
                                    <select class="form-control" name="productType" id="text-tipo-producto">
                                        <option value="" selected>Seleccione</option>
                                        <option value="ProductType_Consumer">ProductType_Consumer</option>
                                        <option value="ProductType_Product">ProductType_Product</option>
                                        <option value="ProductType_Service">ProductType_Service</option>
                                    </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="text-unidad-medida">Unidad Medida</label>
                                <select class="form-control" name="unit" id="text-unidad-medida">
                                    <option value="" selected>Seleccione</option>
                                    <option value="Unidades">Unidad</option>
                                    <option value="Kg">Kg</option>
                                    <option value="Litros">Litros</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text-codigo-producto">Codigo Barras</label>
                                <input type="text" class="form-control" name="barCode" id="text-codigo-producto" placeholder="Codigo Barras">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="text-comentarios">Comentarios</label>
                            <input type="text" class="form-control" name="comentary" id="text-comentarios" placeholder="Comentario producto">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="text-costo-producto">Costo</label>
                                <input type="number" class="form-control" name="cost" id="text-costo-producto" placeholder="Costo producto">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="text-estado-producto">Estado</label>
                                <select class="form-control" name="status" id="text-estado-producto">
                                    <option value="" selected>Seleccione</option>
                                    <option value=0>No Habilitado</option>
                                    <option value=1>Habilitado</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button id="btn-guardar-producto" type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
        <!-- Modal -->



        <!-- Modal Out Put -->
        <div class="modal fade" id="modal-out-put" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="titulo-mensaje-salida"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div id="mensaje-salida"></div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
            </div>
        </div>
        <!-- Modal Out Put -->
    </div>
</body>

</html>