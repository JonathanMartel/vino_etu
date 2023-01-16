<strong>Database Connected: </strong>
<?php

/* Test si connection BD */
    try {
        \DB::connection()->getPDO();
        echo \DB::connection()->getDatabaseName();
        } catch (\Exception $e) {
        echo 'None';
    }
?>