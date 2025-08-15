<?php

namespace App\Traits\Servicios;
use Illuminate\Support\Facades\Http;
use App\Models\Valorbcv;

trait Consultabcv
{
	/**
	* Esta función no recibe ningún parámetro 
	*
	* @return Retorna un número decimal.
	*/

	public function valorbcv()
    {
	    try {
	    	$url = 'http://bcv.org.ve/';

	    	$response = Http::withOptions([
				'verify' => false,
			])->get($url);
			
	    	$respuesta = $response->getBody()->getContents();// accedemos a el contenido
			$text = strip_tags($respuesta); //limpiamos

			$findme = 'USD'; 
			$pos = strpos($text, $findme);

			$rempl = array('USD');

		    $r = trim(str_replace($rempl, '|', self::limpiarCampo($text)));
		    $resource = explode("|", $r);
		    $datos = explode(" ", self::limpiarCampo($resource[2])); 

		    $usd = $datos[0]; //obtenemos el valor del USD
		    $num=str_replace(',','.',$usd); //reemplazamos la coma por un punto
		    $valor = floatval($num); //convertimos en un numero
	    	return  $valor;

    	} catch (\Illuminate\Http\Client\ConnectionException $e) {
	        report($e);	 
	        return false;
	        
	    }
    }

    public static function limpiarCampo($valor) {//Con esto limpiamos los errores de la pagina
        $rempl = array('\n', '\t');
        $r = trim(str_replace($rempl, ' ', $valor));
        return str_replace("\r", "", str_replace("\n", "", str_replace("\t", "", $r)));
    }

    public function consultarelvalordelusd()
    {
        // Obtener valor actual del BCV
        $usdActual = $this->valorbcv();
        
        // Manejar error de conexión con BCV
        if ($usdActual === false) {
            return $this->obtenerUltimoValorSeguro();
        }
        
        // Normalizar a 3 decimales
        $usdActual = round($usdActual, 3);
        
        // Obtener último valor almacenado
        $ultimoValor = $this->valordelusd();
        
        // Si no hay registros o el valor cambió, almacenar nuevo valor
        if ($ultimoValor === null || abs($ultimoValor - $usdActual) > 0.001) {
            Valorbcv::create(['valor' => $usdActual]);
        }
        
        return true;
    }

    public function valordelusd()
    {
        $registro = Valorbcv::latest('created_at')->first();
        return $registro ? round($registro->valor, 3) : null;
    }

    // Nuevo método para manejar errores
    private function obtenerUltimoValorSeguro()
    {
        $ultimo = $this->valordelusd();
        
        if ($ultimo === null) {
            // Registrar emergencia si no hay valores
            Log::emergency('No hay valores BCV almacenados y falló la conexión');
            return false;
        }
        
        return true;
    }
}
