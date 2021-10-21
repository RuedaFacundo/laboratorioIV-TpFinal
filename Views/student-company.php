<?php
    require_once('nav-student.php');
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
    </section>
</main>
<?php 
  include_once('footer.php');
?>