<?php
require_once '../../Modelo/EspecialidadCl15.php';

if(!empty($_POST)){
	if(isset($_POST["Nombre"]) && isset($_POST["Cupo"])) 
	{
		if($_POST['Nombre']!="" && $_POST['Cupo']!="") 
		{
			$nom = $_POST['Nombre'];
			$cupo = $_POST['Cupo'];
            
			$esp = new EspecialidadCl15();
			$reg = $est->EspecialidadCl15_EditEsp($nom,$cupo);
			if ($reg) 
			{
				print $reg;
			}	
		}
	} 
}
?>