<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de empresas</h2>
            <table class="table bg-light-alpha">
                <thead>
                <tr>
                    <th>Razon social</th>
                    <th>Cuit</th>
                    <th>Direccion</th>
                    <th>Fecha Fundacion</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($companyList as $value){                                
                ?>
                <tr>
                    <td><?php echo $value->getName() ?></td>
                    <td><?php echo $value->getCuit() ?></td>
                    <td><?php echo $value->getAdress() ?></td>
                    <td><?php echo $value->getFounded() ?></td>
                </tr>
                <?php                              
                    }
                ?>
            </tbody>
            </table>
        </div>
        <div class="container">
            <h2 class="mb-4">Modificar empresa</h2>
            <form action="<?php echo FRONT_ROOT ?>Company/Modify" method="post" class="bg-light-alpha p-5">
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
                                <input type="date" name="founded" value="" class="form-control">
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Modificar</button>
            </form>
        </div>
    </section>
</main>
<?php 
  include_once('footer.php');
?>