<?php
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Ofertas laborales</h2>
            <table class="table bg-light-alpha">
                <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Puesto</th>
                    <th>Salario</th>
                    <th>Remoto</th>
                    <th>Descripcion</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($jobOfferList as $value){                                
                ?>
                <tr>
                    <td><?php echo $value['name'] ?></td>
                    <td><?php echo $value['description'] ?></td>
                    <td><?php echo $value['salary'] ?></td>
                    <td><?php 
                        if ($value['remote'] == 0){
                            echo "No";
                        } else {
                            echo "Si";
                        }
                    ?></td>
                    <td><?php echo $value['projectDescription'] ?></td>
                </tr>
                <?php                              
                    }
                ?>
            </tbody>
            </table>
        </div>
        
    </section>
</main>