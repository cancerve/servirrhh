<?php 
class Empresa{
	private $NU_IdEmpresa;
	private $parroquia_NU_IdParroquia;	
	private $municipio_NU_IdMunicipio;
	private $estado_NU_IdEstado;	
	private $AF_RIF;
	private $AF_RazonSocial;
	private $AF_Telefono;
	private $AL_Contacto;			
	private $AF_Correo;
	private $NU_Activo;			
	private $FE_Registro;	

	private function generarNuevo($objConexion){
		$this->NU_IdEmpresa=0;
		$query="SELECT MAX(NU_IdEmpresa) as NU_IdEmpresa
				FROM empresa";
		$resultado=$objConexion->ejecutar($query);
		if($objConexion->cantidadRegistros($resultado)>0){
			$this->NU_IdEmpresa=$objConexion->obtenerElemento($resultado,0,0);
		}
		$this->NU_IdEmpresa++;
		return;
	}

	function insertar($objConexion,$NU_IdEmpresa,$parroquia_NU_IdParroquia,$municipio_NU_IdMunicipio,$estado_NU_IdEstado,$AF_RIF,$AF_RazonSocial,$AF_Telefono,$AL_Contacto,$AF_Correo){
		$this->generarNuevo($objConexion);
		$this->parroquia_NU_IdParroquia	= $parroquia_NU_IdParroquia;
		$this->municipio_NU_IdMunicipio	= $municipio_NU_IdMunicipio;				
		$this->estado_NU_IdEstado		= $estado_NU_IdEstado;
		$this->AF_RIF					= $AF_RIF;
		$this->AF_RazonSocial			= $AF_RazonSocial;
		$this->AF_Telefono				= $AF_Telefono;
		$this->AL_Contacto				= $AL_Contacto;
		$this->AF_Correo				= $AF_Correo;

		$query="INSERT INTO empresa (NU_IdEmpresa,parroquia_NU_IdParroquia,municipio_NU_IdMunicipio,estado_NU_IdEstado,AF_RIF,AF_RazonSocial,AF_Telefono,AL_Contacto,AF_Correo)
				VALUES
				(".$this->NU_IdEmpresa.",".$this->parroquia_NU_IdParroquia.",".$this->municipio_NU_IdMunicipio.",".$this->estado_NU_IdEstado.",'".$this->AF_RIF."','".$this->AF_RazonSocial."','".$this->AF_Telefono."','".$this->AL_Contacto."','".$this->AF_Correo."')";
		$resultado=$objConexion->ejecutar($query);
		return true;
	}
	
	function buscar($objConexion,$NU_IdEmpresa){
		$this->NU_IdEmpresa=$NU_IdEmpresa;
		$query="SELECT *
				FROM empresa
				WHERE NU_IdEmpresa=".$this->NU_IdEmpresa;
		$resultado=$objConexion->ejecutar($query);
		return $resultado;		
	}
	
	function listarEmpresa($objConexion){
		$query="SELECT EMP.*,E.nombre AS estado,M.nombre AS municipio,P.nombre AS parroquia
				FROM empresa AS EMP
				LEFT JOIN estado AS E ON (E.id=EMP.estado_NU_IdEstado)
				LEFT JOIN municipio AS M ON (M.id=EMP.municipio_NU_IdMunicipio)				
				LEFT JOIN parroquia AS P ON (P.id=EMP.parroquia_NU_IdParroquia)				
				ORDER BY AF_RazonSocial ASC";
		$resultado=$objConexion->ejecutar($query);
		return $resultado;		
	}
}
?>