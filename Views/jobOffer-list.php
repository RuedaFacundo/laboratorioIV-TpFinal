<?php
    if(isset($_SESSION['loggedUser'])) {
    require_once('nav.php');
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
                </tr>
                <?php                              
                    }
                ?>
            </tbody>
            </table>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Remove" method="post">
                <table style="max-width: 35%;" >
                    <thead>
                    <tr>
                        <th style="width: 100px;">Numero</th>
                        <th style="width: 170px; text-align: center">Accion</th>
                    </tr>
                    </thead>
                    <tbody align=center>
                    <tr>
                        <td>
                        <input type="number" name="id" style="height: 40px;" min="0" placeholder="Ingrese el numero">  
                        </td>
                        <td>
                        <input type="submit" class="btn" value="Remover" style="background-color:#DC8E47;color:white;"/>
                        </td>
                    </tr>
                    </tbody>
                    </tr>
                </table>
            </form>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowListOffersByJobPosition" method="post">
                <table style="max-width: 35%;" >
                    <thead>
                    <tr>
                        <th style="width: 100px;">Puesto laboral</th>
                        <th style="width: 170px; text-align: center"></th>
                    </tr>
                    </thead>
                    <tbody align=center>
                    <tr>
                        <td>
                        <input type="text" name="jobPosition" style="height: 40px;" min="0" placeholder="Ingrese el puesto">  
                        </td>
                        <td>
                        <input type="submit" class="btn" value="Buscar" style="background-color:#DC8E47;color:white;"/>
                        </td>
                    </tr>
                    </tbody>
                    </tr>
                </table>
            </form>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/ShowListOffersByCareer" method="post">
                <table style="max-width: 35%;" >
                    <thead>
                    <tr>
                        <th style="width: 100px;">Carrera</th>
                        <th style="width: 170px; text-align: center"></th>
                    </tr>
                    </thead>
                    <tbody align=center>
                    <tr>
                        <td>
                        <input type="text" name="career" style="height: 40px;" min="0" placeholder="Ingrese la carrera">  
                        </td>
                        <td>
                        <input type="submit" class="btn" value="Buscar" style="background-color:#DC8E47;color:white;"/>
                        </td>
                    </tr>
                    </tbody>
                    </tr>
                </table>
            </form>
        </div>
    </section>
</main>
<?php
    } else {
        require_once(VIEWS_PATH."home.php");
    }
?>