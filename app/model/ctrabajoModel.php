<?php 
class CTrabajo{
	private $NU_IdCTrabajo;
	private $usuario_NU_IdUsuario;	
	private $AF_Codigo;
	private $sede_NU_IdSede;
	private $gerencia_NU_IdGerencia;
	private $cargo_NU_IdCargo;
	private $BS_SalarioBasico;
	private $BS_PrimaAntiguedad;
	private $BS_PrimaResponsabilidad;
	private $BS_PrimaEspecializacion;
	private $BS_PrimaTransporte;
	private $BS_PrimaOtra;
	private $NU_IdTipoCTrabajo;
	private $FE_Solicitud;
	private $FE_Registro;
	
	function listarConstancias($objConexion, $usuario_NU_IdUsuario){
		$this->usuario_NU_IdUsuario = $usuario_NU_IdUsuario;
		$query="SELECT CT.*, CTT.AL_Tipo
				FROM ctrabajo AS CT
				LEFT JOIN ctrabajo_tipo AS CTT ON (CT.NU_IdTipoCTrabajo=CTT.NU_IdTipoCTrabajo)
				WHERE usuario_NU_IdUsuario=".$this->usuario_NU_IdUsuario."
				ORDER BY NU_IdCTrabajo DESC";
		$resultado=$objConexion->ejecutar($query);
		return $resultado;		
	}

	function obtenerUltimo($objConexion){
		$this->NU_IdCTrabajo = 0;
		
		$query="SELECT * 
				FROM ctrabajo
				ORDER BY NU_IdCTrabajo DESC
				LIMIT 1";		
				
		$resultado	= $objConexion->ejecutar($query);

		if($objConexion->cantidadRegistros($resultado) > 0){
			$this->NU_IdCTrabajo = $objConexion->obtenerElemento($resultado,0,'NU_IdCTrabajo');
		}

		return $this->NU_IdCTrabajo;	
	}
		
	function insertar($objConexion,$usuario_NU_IdUsuario,$AF_Codigo,$sede_NU_IdSede,$gerencia_NU_IdGerencia,$cargo_NU_IdCargo,$BS_SalarioBasico,$BS_PrimaAntiguedad,$BS_PrimaResponsabilidad,$BS_PrimaEspecializacion,$BS_PrimaTransporte,$BS_PrimaOtra,$NU_IdTipoCTrabajo){
		$this->usuario_NU_IdUsuario		= $usuario_NU_IdUsuario;
		$this->AF_Codigo				= $AF_Codigo;
		$this->sede_NU_IdSede			= $sede_NU_IdSede;
		$this->gerencia_NU_IdGerencia	= $gerencia_NU_IdGerencia;
		$this->cargo_NU_IdCargo			= $cargo_NU_IdCargo;
		$this->BS_SalarioBasico 		= $BS_SalarioBasico;
		$this->BS_PrimaAntiguedad		= $BS_PrimaAntiguedad;
		$this->BS_PrimaResponsabilidad	= $BS_PrimaResponsabilidad;
		$this->BS_PrimaEspecializacion	= $BS_PrimaEspecializacion;		
		$this->BS_PrimaTransporte		= $BS_PrimaTransporte;
		$this->BS_PrimaOtra				= $BS_PrimaOtra;
		$this->NU_IdTipoCTrabajo		= $NU_IdTipoCTrabajo;		
		$this->FE_Solicitud				= date("Y-m-d");
		
		$query="INSERT INTO ctrabajo (
					usuario_NU_IdUsuario, 
					AF_Codigo,
					sede_NU_IdSede,
					gerencia_NU_IdGerencia,
					cargo_NU_IdCargo, 
					BS_SalarioBasico, 
					BS_PrimaAntiguedad, 
					BS_PrimaResponsabilidad, 
					BS_PrimaEspecializacion, 
					BS_PrimaTransporte, 
					BS_PrimaOtra, 
					NU_IdTipoCTrabajo, 
					FE_Solicitud)
				VALUES (
					".$this->usuario_NU_IdUsuario.",
					'".$this->AF_Codigo."',
					".$this->sede_NU_IdSede.",
					".$this->gerencia_NU_IdGerencia.",
					'".$this->cargo_NU_IdCargo."',
					".$this->BS_SalarioBasico.",
					".$this->BS_PrimaAntiguedad.",
					".$this->BS_PrimaResponsabilidad.",
					".$this->BS_PrimaEspecializacion.",
					".$this->BS_PrimaTransporte.",
					".$this->BS_PrimaOtra.",
					".$this->NU_IdTipoCTrabajo.",
					'".$this->FE_Solicitud."')";
		
		$resultado=$objConexion->ejecutar($query);
		
		return true;
	}
	
	function buscar($objConexion,$NU_IdCTrabajo){
		$this->NU_IdCTrabajo=$NU_IdCTrabajo;
		$query="SELECT CT.*, U.AL_Apellido, U.AL_Nombre, U.NU_Cedula, U.FE_Ingreso, U.AL_Adscripcion, U.cargo_NU_IdCargo, S.AL_NombreSede, G.AL_NombreGerencia
				FROM ctrabajo AS CT
				LEFT JOIN usuario AS U ON (CT.usuario_NU_IdUsuario=U.NU_IdUsuario)
				LEFT JOIN sede AS S ON (CT.sede_NU_IdSede=S.NU_IdSede)
				LEFT JOIN gerencia AS G ON (CT.gerencia_NU_IdGerencia=G.NU_IdGerencia)
                LEFT JOIN usuario_cargo AS UC ON (CT.cargo_NU_IdCargo=UC.NU_IdCargo)
				WHERE CT.NU_IdCTrabajo=".$this->NU_IdCTrabajo;
		$resultado=$objConexion->ejecutar($query);
		return $resultado;		
	}	
		
}
?>