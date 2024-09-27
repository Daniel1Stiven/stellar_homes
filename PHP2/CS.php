<?php

session_start();
session_destroy();

echo '
<script> 
    alert ("Cerró sesión.");
    window.location.href = "../PHP/index.php" 
</script>
';