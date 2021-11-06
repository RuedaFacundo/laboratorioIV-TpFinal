<?php
    if(isset($_SESSION['loggedUser'])) {
        $loggedUser = $_SESSION['loggedUser'];
    require_once('nav.php');
?>
<main class="py-5">
    <section id="listado" class="mb-5">
        <div class="container">
            <h2 class="mb-4">Agregar Oferta Laboral</h2>
            <form action="<?php echo FRONT_ROOT ?>JobOffer/Add" method="post" class="bg-light-alpha p-5">
                <div class="row">
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
                                ?>
                                <option value="<?php echo $value->getJobPositionId() ?>"><?php echo $value->getDescription() ?></option>
                                <?php                              
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
                    <div class="col-lg-12">
                        <div class="form-group">
                                <strong><label for="projectDescription">Descripcion</label></strong>
                                <input type="text" name="projectDescription" value="" class="form-control" required>
                        </div>
                    </div>
                </div>
                <button type="submit" name="button" class="btn btn-dark ml-auto d-block">Agregar</button>
            </form>
        </div>
    </section>
</main>  
<?php
    } else {
        require_once(VIEWS_PATH."home.php");
    }
?>