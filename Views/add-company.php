<?php
    if(isset($_SESSION['loggedUser'])) {
        $loggedUser = $_SESSION['loggedUser'];
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar Empresa</h2>
            <form action="<?php echo FRONT_ROOT ?>Company/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">                         
                    <div class="col-lg-4">
                        <div class="form-group">
                                <label for="">Razon Social</label>
                                <input type="text" name="name" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <label for="">Cuit</label>
                                <input type="number" name="cuit" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <label for="">Adress</label>
                                <input type="text" name="adress" value="" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <label for="">Founded</label>
                                <input type="date" name="founded" value="" id="datefield" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1;
        var yyyy = today.getFullYear();

        if (dd < 10) {
        dd = '0' + dd;
        }

        if (mm < 10) {
        mm = '0' + mm;
        } 

        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("datefield").setAttribute("max", today);
    </script>
</main>
<?php
    } else {
        require_once(VIEWS_PATH."home.php");
    }
?>