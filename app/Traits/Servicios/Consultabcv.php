<?php

namespace App\Traits\Servicios;
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
        
        $usd = $this->valorbcv();

        if ($usd == false) {
            $text = 'error de consulta de USD';
            return false;
        } else {
            $valor = $this->valordelusd();

            if (!empty($valor)) {
                if ($usd == $valor) {  
                    return true;
                } else {
                    $moneda = Valorbcv:: create([                    
                        'valor' => $usd,
                    ]);             
                }
                return true; 
            } else {
                return false; 
            }
        }
    }

    public function valordelusd()
    {
        $valormoneda = Valorbcv::orderBy('created_at', 'desc')->first();
        
        $valor = round($valormoneda['valor'] , 3);
        return $valor;
    }
}
