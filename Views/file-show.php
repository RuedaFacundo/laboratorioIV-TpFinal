<?php
    header("Content-type: application/pdf");
    header("Content-Disposition: inline; filename=$name");
    readfile(UPLOADS_PATH."$name");
?>