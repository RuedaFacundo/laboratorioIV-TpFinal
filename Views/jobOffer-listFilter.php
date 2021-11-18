<?php
    if(isset($_SESSION['loggedUser'])) {
        if($_SESSION['loggedUser']->getProfile() == 'Admin'){
            require_once('nav.php');
        } else if ($_SESSION['loggedUser']->getProfile() == 'Company') {
            require_once('nav-company.php');
        }
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Ofertas laborales</h2>
            <table class="table bg-light-alpha">
                <thead>
                <tr>
                    <th>Numero</th>
                    <th>Empresa</th>
                    <th>Puesto</th>
                    <th>Salario</th>
                    <th>Skills</th>
                    <th>Remoto</th>
                    <th>Descripcion</th>
                    <th>Activa</th>
                </tr>
                </thead>
                <tbody>
                <?php 
                    foreach($jobOfferList as $value){                                
                ?>
                <tr>
                    <td><?php echo $value->getJobOfferId() ?></td>
                    <td><?php echo $value->getCompany()->getName() ?></td>
                    <td><?php echo $value->getJobPosition()->getDescription() ?></td>
                    <td><?php echo $value->getSalary() ?></td>
                    <td><?php echo $value->getSkills() ?></td>
                    <td><?php 
                        if ($value->getRemote() == 0){
                            echo "No";
                        } else {
                            echo "Si";
                        }
                    ?></td>
                    <td><?php echo $value->getProjectDescription() ?></td>
                    <td style="min-width: 140px;"><?php 
                        if ($value->getActive() == 0){
                            echo "No";
                        } else {
                            echo "Si";
                            ?> <a href=" <?php echo FRONT_ROOT ?>JobOffer/Cancel?id=<?php echo $value->getJobOfferId()?>"> <button type="button" class="btn btn-outline-info">Anular</button></a> <?php
                        }
                    ?></td>
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
    } else {
        require_once(VIEWS_PATH."home.php");
    }
?>