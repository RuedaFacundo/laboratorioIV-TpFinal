<?php
    header("Content-type: application/pdf");
    header("Content-Disposition: attachment; filename=$name");
    readfile(UPLOADS_PATH."$name");
?>