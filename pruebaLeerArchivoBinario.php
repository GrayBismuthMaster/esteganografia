<?php
	//MANIPULANDO LA IMAGEN
			
			//print("La cadena de binarios uno a uno es:".$cadenaBinarioUnoPorUnoImagen);
		    //CONVERTIR TEXTO A BINARIO 
		    $txt_str = "Pollitos";
		    // Meter cada binario a array
		    $binarioUnoPorUnoTexto = array();
		        //$len = strlen($txt_str); 
		        $bin = ''; 
	        	//dividir la cadena y pasarla a un array
				$str_arr = str_split($txt_str, 4);
				for($i = 0; $i<count($str_arr); $i++)
				{
					$bin = $bin.str_pad(decbin(hexdec(bin2hex($str_arr[$i]))), strlen($str_arr[$i])*8, "0", STR_PAD_LEFT);
					//Se le revierte para poder agregarlo en la imagen
					$binRevertido = strrev($bin);
		           for($j=0;$j<strlen($bin);$j++)
		           {
		                $binarioUnoPorUnoTexto[$j] = $binRevertido[$j];  
		           }

		        	//Solo saca dos bits 
		           // $bin .= strlen(decbin(ord($txt_str[$i]))) < 8 ? $bin = str_pad(decbin(ord($txt_str[$i])), 8, 0, STR_PAD_LEFT) : decbin(ord($txt_str[$i])); 
		          	
				}
				//convertir, corregir ceros y concatenar cada subcadena
				
		        echo "Cadena de texto introducido en binario<br>";
		        print($bin);
		        echo "Cadena binaria de texto";
		        echo "<br>";
		        print_r($binarioUnoPorUnoTexto);
		        echo "<br>";
		        //print("El texto en binario es:".$bin);
		        
		        //print_r($binarioUnoPorUno);

		        //Alterar el último dígito
		        //$cadena="Observa a cada una";
		        //echo substr($cadena,0,-1)."o";
		        

		        //32 estan en la primera línea de la cabecera
		        //Modificar el LSB
		        /*        
		            for($j=26 ; $j<count($binario);$j+=8)
		            {
		                
		            }
		        */

		    //print_r($binario);
		    //BINARIO A TEXTO
		    /*
		        if(!empty($bin_str)){
		    
		        $text_str = ''; 
		        $chars = explode("\n", chunk_split(str_replace("\n", '', $bin_str), 8)); 
		        $_I = count($chars); 
		        for($i = 0; $i < $_I; $text_str .= chr(bindec($chars[$i])), $i++  ); 
		        return $text_str; 
		    
		        }
		    */

    
	$data = file_get_contents("C:\Users\Dell\Pictures\Fondo_Elliot.jpg"); 
	
	$array = array(); 
	//Array decimal ascii
	foreach(str_split($data) as $char){ 
	    array_push($array, ord($char)); 
	} 
	//var_dump(implode(' ', $array));
	
	//ARRAY BINARIO 
	print("Nuevo array Binario");
	echo "<br>";
	$binario = array();

	$cadenaBinarioUnoPorUnoImagen='';
	
	//Auxiliar para la cadena necesaria
	$auxBinario = array();
	//ESTE ES EL ARRAY PRINCIPAL EN EL QUE SE HAN COLOCADO LOS DIGITOS BINARIOS EN GRUPOS DE 8 
	for($i=0;$i<count($array);++$i)
	{
		$binario[]=decbin($array[$i]);
		//EL 5 REPRESENTA EL 5 X8 DE LA CABECERA
		if($i>=5 &&  $i<=count($binarioUnoPorUnoTexto)+4)
		{
				$auxBinario[$i] = decbin($array[$i]);
		}

	}
	$cadenaBinarioUnoPorUnoImagen .= implode(",",$auxBinario);	
	echo "LA CADENA PRINCIPAL ES LA SIGUIENTE: <br>";
	print_r($binario);

	//REEMPLAZANDO EL DIGITO BINARIO POR EL NUEVO

	$cadenaBinarioUnoPorUnoImagenNueva = '';
	$mystring = 'abc';
	$findme   = 'a';

	// Recorremos cada carácter de la cadena
	$posiciones=array();
	//Revertimos la cadena
	print("Cadena normal de imagen : <br>".$cadenaBinarioUnoPorUnoImagen);
	echo "<br>";
	$cadenaBinarioUnoPorUnoImagen = strrev($cadenaBinarioUnoPorUnoImagen);
	
	$arrayCadenaBinariaUnoPorUnoImagen = explode(",", $cadenaBinarioUnoPorUnoImagen);
	echo "Cadena revertida y sin comas de imagen:";
	echo "<br>";
	print_r($arrayCadenaBinariaUnoPorUnoImagen) ;
	echo "<br>";

	$CadenaBinariaUnoPorUnoImagenRevertida="";
	for($i = 0; $i<=count($arrayCadenaBinariaUnoPorUnoImagen)-1;$i++)
	{
		//PARA PODER COLOCAR EN LA CADENA EL NUEVO DIGITO DEBEMOS REVERTIRLO

		echo "Cadena reemplazada en el ultimo digito";
		echo "<br>";
		echo substr($arrayCadenaBinariaUnoPorUnoImagen[$i],0,-1)."o";
		echo "<br>";
		echo "Cadena reemplazada en el ultimo digito con los caracteres al reves <br>";
		$CadenaBinariaUnoPorUnoImagenRevertida .=substr(strrev($arrayCadenaBinariaUnoPorUnoImagen[$i]),0,-1).$binarioUnoPorUnoTexto[$i].",";
	}
	//Eliminando la última coma
	$CadenaBinariaUnoPorUnoImagenRevertida = substr($CadenaBinariaUnoPorUnoImagenRevertida,0,-1);

	echo "<br>";
	print("Cadena binaria una a una de la imagen revertida : <br>".$CadenaBinariaUnoPorUnoImagenRevertida);
	
	// Retiras el último elemento del arreglo.
	
	
	$arrayCadenaBinariaUnoPorUnoImagenNormal= explode(",",$CadenaBinariaUnoPorUnoImagenRevertida);
	echo "<br>Array Binario normal<br>";
	
	print_r($arrayCadenaBinariaUnoPorUnoImagenNormal);
	
	# rotamos los valores y los ponemos en el nuevo array
	echo "<br>CADENA PRINCIPAL INYECTADA DE LA IMAGEN CON EL METODO LSB CON EL TEXTO ENVIADO<br>";
	$arrayCadenaBinariaUnoPorUnoImagenNormal = array_reverse($arrayCadenaBinariaUnoPorUnoImagenNormal);
	
	//---------------------------------------------------------------------------------------------------------------------------------------------
	//INGRESO EN EL ARRAY PRINCIPAL 
	echo "<br>Nuevo:<br>";
	print_r($arrayCadenaBinariaUnoPorUnoImagenNormal);
	
	//Obtener los primeros 5 elementos
	$arrayNuevoCinco = array();
	for($i=0;$i<count($binario);++$i)
	{
		if($i<5)
		{
			$arrayNuevoCinco[$i] = $binario[$i];
		}
		if($i==5)
		{
			array_splice( $binario, 0, 5);
			$binario = array_replace($binario, $arrayCadenaBinariaUnoPorUnoImagenNormal);
		}

	}
	//Cinco primeros elementos
	echo "<br>Primeros elementos<br>";
	print_r($arrayNuevoCinco);
	//VOLVER A INGRESAR LOS PRIMEROS CINCO ELEMENTOS
	
		array_unshift( $binario, $arrayNuevoCinco[4] );
		array_unshift( $binario, $arrayNuevoCinco[3] );
		array_unshift( $binario, $arrayNuevoCinco[2] );
		array_unshift( $binario, $arrayNuevoCinco[1] );
		array_unshift( $binario, $arrayNuevoCinco[0] );
		
		
	
	//MUESTRA LA PRINCIPAL
	echo "<br> CADENA PRINCIPAL<br>";
	print_r($binario);
?>