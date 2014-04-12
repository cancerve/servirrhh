<?php 
class CTrabajo_Tipo{
	private $NU_IdTipoCTrabajo;
	private $AL_Tipo;	

	function listarTipos($objConexion){
		$query="SELECT *
				FROM ctrabajo_tipo AS CT
				ORDER BY AL_Tipo DESC";
		$resultado=$objConexion->ejecutar($query);
		return $resultado;		
	}
}
?>