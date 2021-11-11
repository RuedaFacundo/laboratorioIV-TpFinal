<?php
    if(isset($_SESSION['loggedUser'])) {
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Listado de empresas</h2>
            <table class="table bg-light-alpha">
                <thead>
                <tr>
                    <th>Numero</th>
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
                    <td><?php echo $value->getJobOfferId() ?></td>
                    <td><?php echo $value->getCompany()->getName() ?></td>
                    <td><?php echo $value->getJobPosition()->getDescription() ?></td>
                    <td><?php echo $value->getSalary() ?></td>
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
        </div>
        <div class="container">
            <h2 class="mb-4">Modificar oferta</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Modify" method="post" class="bg-light-alpha p-5">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="id">Numero</label></strong>
                                <input type="number" name="id" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <strong><label for="nameCompany">Empresa</label></strong>
                            <select name="nameCompany" class="form-control" aria-label="Default select example" required>
                                <?php 
                                    foreach($companyList as $value){ 
                                ?>
                                <option value="<?php echo $value->getName() ?>"><?php echo $value->getName() ?></option>
                                <?php                              
                                    }
                                ?>
                            </select>
                        </div>
                    </div>                          
                    <div class="col-lg-4">
                        <div class="form-group">
                            <strong><label for="jobPositionId">Puesto laboral</label></strong>
                            <select name="jobPositionId" class="form-control" aria-label="Default select example" required>
                                <?php 
                                    foreach($jobPositionList as $value){ 
                                        foreach($careerList as $careers){
                                            if ($careers->getCareerId() == $value->getCareer()->getCareerId() && $careers->getActive() == 1){
                                        
                                ?>
                                <option value="<?php echo $value->getJobPositionId() ?>"><?php echo $value->getDescription() ?></option>
                                <?php  
                                        }                            
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="datePublished">Fecha de publicacion</label></strong>
                                <input type="date" name="datePublished" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <strong><label for="remote">Remoto</label></strong>
                            <select name="remote" class="form-control" aria-label="Default select example" required>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="salary">Salario</label></strong>
                                <input type="number" name="salary" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                                <strong><label for="skills">Skills</label></strong>
                                <input type="text" name="skills" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="form-group">
                                <strong><label for="projectDescription">Descripcion</label></strong>
                                <input type="text" name="projectDescription" value="" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Modificar</button>
            </form>
        </div>
    </section>
</main>
<?php
    } else {
        require_once(VIEWS_PATH."home.php");
    }
?>