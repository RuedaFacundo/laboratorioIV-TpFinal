<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar Usuario</h2>
            <form action="<?php echo FRONT_ROOT ?>User/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">                         
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="">Nombre</label></strong>
                                <input type="text" name="name" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="">Apellido</label></strong>
                                <input type="text" name="lastName" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="">Email</label></strong>
                                <input type="email" name="email" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="">Telefono</label></strong>
                                <input type="number" name="telephone" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="">Genero</label></strong>
                                <input type="text" name="gender" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="">Fecha de nacimiento</label></strong>
                                <input type="date" name="birthDate" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="">Celular</label></strong>
                                <input type="number" name="cellphone" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="">DNI</label></strong>
                                <input type="number" name="dni" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <strong><label for="profile">Perfil</label></strong>
                            <select name="profile" class="form-control" aria-label="Default select example" required>
                                <option value="Student">Estudiante</option>
                                <option value="Admin">Administrador</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <strong><label for="careerId">Carrera</label></strong>
                            <select name="careerId" class="form-control" aria-label="Default select example" required>
                                <?php 
                                    foreach($careerList as $value){ 
                                        if($value->getActive() == true){
                                ?>
                                <option value="<?php echo $value->getCareerId() ?>"><?php echo $value->getDescription() ?></option>
                                <?php                              
                                        }    
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>   