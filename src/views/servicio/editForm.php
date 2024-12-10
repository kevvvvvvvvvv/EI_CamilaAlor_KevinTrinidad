<?php include '../layaout/header.php' ?>
<?php include '../../controllers/RolesController/roles.php'?>

<?php 
    session_start(); 
    $usuario = $_SESSION['usuario']; 

    if(isset($_GET['idS'])){
        $id = $_GET['idS'];
        $sql = "select * from servicios where idS = $id;";
        $execute = mysqli_query($con, $sql);
        if(mysqli_num_rows($execute)==1){
            
            $row = mysqli_fetch_array($execute);
            $nombre = $row['nombre'];
            $precio = $row['precio'];
            $duracion = $row['duracion'];
           
        }
    }else{
        echo "No se ha recibido un ID";
    }

    if(isset($usuario) && esAdmin($usuario)){
?>

        <header class="row">
            <a class="col-md-4 col-sm-12" href="<?=asset_general('src/views/servicio/consultaAdmin.php')?>"><i class="bi bi-arrow-left-circle"></i></a>
            <h2 class="col-md-8 col-sm-12">Regresar</h2>
        </header>

        <main class="row">
            <div class="formulario col-md-6 col-sm-12">
                <h6>Registra un nuevo servicio</h6>

                <form method="POST" name="frmRes" id="frmRes" action="<?= asset_general('src/controllers/ServicioController/edit.php?idS=' . $id) ?>">

                    <div class="form_container">
                        <label class="formulario_label">Nombre del servicio:</label>
                        <br>
                        <input type="" name="nombre" id="nombre" value="<?php echo $nombre; ?>">
                        <br>
                        <p class="alert alert-danger" id="nom" name="nom" style="display: none;">
                            ¡Ingresa una nombre!
                        </p> 
                    </div> 

                    <br>

                    <div class="form_container">
                        <label class="formulario_label">Precio:</label>
                        <br>
                        <input type="number" name="precio" id="precio" value="<?php echo $precio; ?>">
                        <br>
                        <p class="alert alert-danger" id="pre" name="pre" style="display: none;">
                            ¡Ingresa un precio válido!
                        </p> 
                    </div>

                    <br>

                    <div class="form_container">
                        <label class="formulario_label">Duración (horas):</label>
                        <br>
                        <input type="number" name="duracion" id="duracion" value="<?php echo $duracion; ?>">
                        <br>
                        <p class="alert alert-danger" id="dur" name="dur" style="display: none;">
                            ¡Ingresa una duración válida!
                        </p> 
                    </div> 

                    <br>
                    <br>
                    
                    <div class="form_container">                    
                        <button type="button" class="formulario_btn" onclick="validacion();">Enviar</button>                    
                    </div>       
                </form>

                <br>
                
                <?php
                    if (isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                        unset($_SESSION['error']); 
                    }
                ?>
            </div>

            <div class="imagen col-md-6 col-sm-12">
                <img class="img-fluid" src="<?=asset('img/barber-image.png') ?>" alt="Persona en una barbería">
            </div>
        </main>

        <script src="<?=asset('js/validarServicio.js')?>"></script>  
      
<?php

    }else{
        $loginUrl = asset_general('src/views/login/login.php'); 
        header('Location: ' . $loginUrl); 
        exit; 
    }

?>

<?php include '../layaout/footer.php' ?>