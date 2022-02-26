<?php

    // print_r($_POST);
    // echo $_POST['txtID'];
    // echo "<br>";
    // echo $_POST['txtNombre'];
    // echo "<br>";
    // echo $_POST['txtApellidoP'];
    // echo "<br>";
    // echo $_POST['txtApellidoM'];
    // echo "<br>";

    $txtID = ( isset($_POST['txtID']) ) ? $_POST['txtID'] : "";
    $txtNombre= ( isset($_POST['txtNombre']) ) ? $_POST['txtNombre'] : "";
    $txtAppellidoP = ( isset($_POST['txtAppellidoP']) ) ? $_POST['txtAppellidoP'] : "";
    $txtAppellidoM = ( isset($_POST['txtAppellidoM']) ) ? $_POST['txtAppellidoM'] : "";
    $txtCorreo = ( isset($_POST['txtCorreo']) ) ? $_POST['txtCorreo'] : "";
    $txtFoto = ( isset($_POST['txtFoto']) ) ? $_POST['txtFoto'] : "";
    
    
    $accion = ( isset($_POST['accion']) ) ? $_POST['accion'] : "";

    include ("../conexion/conexion.php");



    switch ($accion) {
        case 'btnAgregar':
            $sentencia = $pdo->prepare("INSERT INTO empleados(Nombre, AppellidoP, AppellidoM, Correo, Foto)
            VALUES (:Nombre, :AppellidoP, :AppellidoM, :Correo, :Foto)");

            $sentencia->bindParam(':Nombre', $txtNombre);
            $sentencia->bindParam(':AppellidoP', $txtAppellidoP);
            $sentencia->bindParam(':AppellidoM', $txtAppellidoM);
            $sentencia->bindParam(':Correo', $txtCorreo);
            $sentencia->bindParam(':Foto', $txtFoto);

            $sentencia->execute();

            break;
        case 'btnModificar':
            echo "presionaste btnMod<br>";
            echo $txtAppellidoP;
            break;
        case 'btnEliminar':
            echo "presionaste btneliminarr<br>";
            echo $txtAppellidoM;
            break;
        case 'btnCancelar':
            echo "presionaste btnCancelar<br>";
            echo $txtCorreo;
            break;
    }
//ACCEDEMOS  a la info de 
    $sentencia = $pdo->prepare("SELECT * FROM `empleados` WHERE 1");
    $sentencia -> execute();
    $listaEmpleados = $sentencia -> fetchAll(PDO::FETCH_ASSOC);
    print_r($listaEmpleados);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD con PHP Y boostrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" ></script>
</head>
<body>
    <div class="container">
    <form action="" method="post"  enctype="multipart/form-data">

    <label for="">ID:</label>
    <input type="text" name="txtID" placeholder="" id="txt1" require="">
    <br>

    <label for="">Nombre:</label>
    <input type="text" name="txtNombre" value=<?php echo $txtNombre ?> placeholder="" id="txt2" require="">
    <br>

    <label for="">Apellido Paterno:</label>
    <input type="text" name="txtAppellidoP" value=<?php echo $txtAppellidoP ?> placeholder="" id="txt3" require="">
    <br>

    <label for="">Apellido Materno:</label>
    <input type="text" name="txtAppellidoM"  value=<?php echo $txtAppellidoM ?> placeholder="" id="txt4" require="">
    <br>

    <label for="">Correo:</label>
    <input type="text" name="txtCorreo" value=<?php echo $txtCorreo ?> placeholder="" id="txt5" require="">
    <br>

    <label for="">Foto:</label>
    <input type="text" name="txtFoto" value=<?php echo $txtFoto ?> placeholder="" id="txt6" require="">
    <br>

    <button value="btnAgregar" type="submit" name="accion">Agregar</button>
    <button value="btnModificar" type="submit" name="accion">Modificar</button>
    <button value="btnEliminar" type="submit" name="accion">Eliminar</button>
    <button value="btnCancelar" type="submit" name="accion">Cancelar</button>



    </form>
    <div class="row">
        <table>
            <thread>
                <tr>
                    <th>Foto</th>
                    <th>Nombre completo</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thread>
            <?php  foreach($listaEmpleados as $empleado){ ?>
                <tr>
                    <td><?php echo $empleado['Foto']; ?> </td>
                    <td><?php echo $empleado['Nombre']; ?> <?php echo $empleado['AppellidoP']; ?> <?php echo $empleado['AppellidoM'] ?> </td>
                    <td><?php echo $empleado['Correo']; ?> </td>
                    <td>
                        <form action="" method="post">

                            <input type="hidden" name="txtID" value="<?php echo $empleado['ID']; ?>">
                            <input type="hidden" name="txtNombre" value="<?php echo $empleado['Nombre']; ?>">
                            <input type="hidden" name="txtAppellidoP" value="<?php echo $empleado['AppellidoP']; ?>">
                            <input type="hidden" name="txtAppellidoM" value="<?php echo $empleado['AppellidoM']; ?>">
                            <input type="hidden" name="txtCorreo" value="<?php echo $empleado['Correo']; ?>">
                            <input type="hidden" name="txtFoto" value="<?php echo $empleado['Foto']; ?>">
                            
                            <input type="submit" value="Seleccionar" name="accion">

                        </form>
                    </td>
                </tr>
            <?php } ?>    
        </table>
    </div>
    </div>
</body>
</html>