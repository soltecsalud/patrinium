<?php 
    include_once '../model/RolesModelo.php'; 
    $roles  = RolesModelo::mdlConsultarRoles();
    for($i=0;$i<count($roles);$i++){
        $key   = $roles[$i]['rol'];
        $value =  ucwords(strtolower($roles[$i]['rol']));
        echo "<option value=\"$key\">$value</option>";
    }
?>