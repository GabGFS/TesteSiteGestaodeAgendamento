<?php
// Redireciona para o front-controller MVC
$qs = $_SERVER['QUERY_STRING'] ? ('?' . $_SERVER['QUERY_STRING']) : '';
header('Location: index.php?r=meusagendamentos' . $qs);
exit;
?>