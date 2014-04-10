<?php 
class MercadoProducto{
	private $NU_IdMercadoProducto;
	private $NU_IdMercado;	
	private $NU_IdProducto;

	function insertar($objConexion,$NU_IdMercado,$NU_IdProducto){
		$this->NU_IdMercado			= $NU_IdMercado;				
		$this->NU_IdProducto		= $NU_IdProducto;

		$query="INSERT INTO mercado_producto (NU_IdMercado,NU_IdProducto)
				VALUES
				(".$this->NU_IdMercado.",".$this->NU_IdProducto.")";
		$resultado=$objConexion->ejecutar($query);
		return true;
	}

	function listarMercadoProducto($objConexion,$NU_IdMercado){
		$this->NU_IdMercado = $NU_IdMercado;
		$query="SELECT MP.NU_IdMercadoProducto, MP.NU_IdMercado, P.*, M.AL_Medida
				FROM mercado_producto AS MP
				LEFT JOIN producto AS P ON (P.NU_IdProducto=MP.NU_IdProducto)
				LEFT JOIN medida AS M ON (M.NU_IdMedida=P.medida_NU_IdMedida)
				WHERE NU_IdMercado = ".$this->NU_IdMercado."
				ORDER BY P.AF_NombreProducto ASC";

		$resultado=$objConexion->ejecutar($query);
		return $resultado;		
	}
	
	function cantProducXmerc($objConexion,$NU_IdMercado){
		$this->NU_IdMercado=$NU_IdMercado;
		$query="SELECT PR.AF_NombreProducto
				FROM mercado_producto AS MP
                LEFT JOIN producto AS PR ON (PR.NU_IdProducto=MP.NU_IdProducto)
				WHERE MP.NU_IdMercado=".$this->NU_IdMercado;
		$resultado=$objConexion->ejecutar($query);
		
		return $resultado;		
	}
/*	
	function actualizar($objConexion,$AF_RIF,$ciudad_AF_CodCiudad,$pais_AL_CodPais,$AF_Clasificacion_Empresa,$AF_Razon_Social,$AF_Direccion,$AL_Web,$AF_Correo_Electronico,$AF_Telefono,$AF_Fax){
		$this->AF_RIF					= $AF_RIF;
		$this->ciudad_AF_CodCiudad		= $ciudad_AF_CodCiudad;				
		$this->pais_AL_CodPais			= $pais_AL_CodPais;
		$this->AF_Clasificacion_Empresa	= $AF_Clasificacion_Empresa;
		$this->AF_Razon_Social			= $AF_Razon_Social;
		$this->AF_Direccion				= $AF_Direccion;
		$this->AL_Web					= $AL_Web;
		$this->AF_Correo_Electronico	= $AF_Correo_Electronico;
		$this->AF_Telefono				= $AF_Telefono;
		$this->AF_Fax					= $AF_Fax;
		
		$query="UPDATE empresa SET
				ciudad_AF_CodCiudad='".$this->ciudad_AF_CodCiudad."',				
				pais_AL_CodPais='".$this->pais_AL_CodPais."',
				AF_Clasificacion_Empresa='".$this->AF_Clasificacion_Empresa."',
				AF_Razon_Social='".$this->AF_Razon_Social."',
				AF_Direccion='".$this->AF_Direccion."',
				AL_Web='".$this->AL_Web."',
				AF_Correo_Electronico='".$this->AF_Correo_Electronico."',
				AF_Telefono='".$this->AF_Telefono."',
				AF_Fax='".$this->AF_Fax."'				
				WHERE AF_RIF='".$this->AF_RIF."'";
		$resultado=$objConexion->ejecutar($query);
		return true;
	}
	
	
	function obtenerUltimoRIF($objConexion){
		$query="SELECT MAX(id) as id, AF_RIF
				FROM empresa";
		$resultado=$objConexion->ejecutar($query);
		if($objConexion->cantidadRegistros($resultado)>0){
			$this->AF_RIF=$objConexion->obtenerElemento($resultado,0,'AF_RIF');
		}
		
		return $this->AF_RIF;		
	}
*/		

}
?>