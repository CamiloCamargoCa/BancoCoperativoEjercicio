<?php  

session_start();
session_destroy();
session_unset();

echo'
<div class="alert alert-secondary">
  Sesion cerrada con exito!
</div>

<script type="text/javascript">
  location.href="index.php?men=3";
</script>
';

?>

