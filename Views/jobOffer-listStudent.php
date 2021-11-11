<?php
    if(isset($_SESSION['loggedUser'])) {
    require_once('nav-student.php');
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
                        <th>Skills</th>
                        <th>Remoto</th>
                        <th>Descripcion</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php 
                        foreach($jobOfferList as $value){
                    ?>
                    <form action="<?php echo FRONT_ROOT ?>Appointment/ShowAddView" method="post">
                    <tr>
                        <input type="hidden" name="jobOfferId" value="<?php echo $value->getJobOfferId() ?>">
                        <td><?php echo $value->getCompany()->getName() ?></td>
                        <input type="hidden" name="company" value="<?php echo $value->getCompany()->getName() ?>">
                        <td><?php echo $value->getJobPosition()->getDescription() ?></td>
                        <input type="hidden" name="jobPosition" value="<?php echo  $value->getJobPosition()->getDescription() ?>">
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
                        <td><button type="submit" class="btn" value="Postulation">Postularse</button></td>
                        </form>
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