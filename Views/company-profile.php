<?php
    if(isset($_SESSION['loggedUser'])) {
    require_once('nav-company.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <main class="d-flex align-items-center justify-content-center height-100">
            <div class="content">
                <header class="text-center">
                    <h2>Bienvenido <?php echo $_SESSION['loggedUser']->getEmail() ?> !!</h2>
                </header>
                <div class="login-form bg-dark-alpha text-white" style="height: 200px; display: flex; align-items: center; justify-content: center;">
                    <p style="padding: 10px;">
                        Seleccione una de las opciones del menu desplegable para comenzar
                    </p>
                </div>
            </div>
        </div>
    </main>
        </div>
    </section>
</main>
<?php
    } else {
        require_once(VIEWS_PATH."home.php");
    }
?>