<?php
    if(isset($_SESSION['loggedUser'])) {
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar Usuario Administrador</h2>
            <form action="<?php echo FRONT_ROOT ?>User/AddAdmin" method="post" class="bg-light-alpha p-5">
                <div class="row">                         
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="">Email</label></strong>
                                <input type="email" name="email" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="password">Contrase&ntilde;a</label></strong>
                                <input type="password" name="password" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4 divButtom">
                            <button type="submit" name="button" class="btn btn-dark d-block">Agregar</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</main>   
<?php
    } else {
        require_once(VIEWS_PATH."home.php");
    }
?>