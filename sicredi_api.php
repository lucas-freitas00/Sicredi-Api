<?php 
	
	function solicitaToken($chave_master){
		$ch = curl_init("https://cobrancaonline.sicredi.com.br/sicredi-cobranca-ws-ecomm-api/ecomm/v1/boleto/autenticacao");

		$header    = [];
		$header[] = 'Content-Type:application/json';
		$header[] = 'token: '.$chave_master;

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);

		$retorno = curl_exec($ch);
		curl_close($ch);
		$retorno = json_decode($retorno, true);

		// $retorno = null;
		// if(isset($aux['codigo'])){
		// 	switch ($aux['codigo']) {
		// 		case '0001':
		// 			$retorno['status'] = 0;
		// 			$retorno['msg'] = $aux['mensagem'];
		// 			break;

		// 		case '0002':
		// 			$retorno['status'] = 0;
		// 			$retorno['msg'] = $aux['mensagem'];
		// 			break;

		// 		case '0003':
		// 			$retorno['status'] = 0;
		// 			$retorno['msg'] = $aux['mensagem'];
		// 			break;

		// 		case '0004':
		// 			$retorno['status'] = 0;
		// 			$retorno['msg'] = $aux['mensagem'];
		// 			break;

		// 		case '0010':
		// 			$retorno['status'] = 0;
		// 			$retorno['msg'] = $aux['mensagem'];
		// 			break;

		// 		case 'E0011':
		// 			$retorno['status'] = 0;
		// 			$retorno['msg'] = $aux['mensagem'];
		// 			break;
		// 	}
		// }else{
		// 	$retorno['status'] = 1;
		// 	$retorno['chaveTransacao'] = $aux['chaveTransacao'];
		// 	$retorno['dataExpiracao'] = $aux['dataExpiracao'];
		// }

		return $retorno;
	}

	function monitoraTitulo($sicredi, $nossonumero = '', $data = ''){

		if($data != ''){
			$ch = curl_init("https://cobrancaonline.sicredi.com.br/sicredi-cobranca-ws-ecomm-api/ecomm/v1/boleto/consulta?agencia=".$sicredi['agencia']."&cedente=".$sicredi['cedente']."&nossoNumero=".$nossonumero."&posto=".$sicredi['posto']."&dataInicio=".$data['dataInicio']."&dataFim=".$data['dataFim']."&tipoData=".$data['tipoData']);
		}else{
			$ch = curl_init("https://cobrancaonline.sicredi.com.br/sicredi-cobranca-ws-ecomm-api/ecomm/v1/boleto/consulta?agencia=".$sicredi['agencia']."&cedente=".$sicredi['cedente']."&nossoNumero=".$nossonumero."&posto=".$sicredi['posto']);
		}

		$header   = [];
		$header[] = 'Content-Type:application/json';
		$header[] = 'token: '.$sicredi['token'];

		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);

		$retorno = curl_exec($ch);
		curl_close($ch);

		$retorno = json_decode($retorno, true);

		echo "<pre>";
		print_r($retorno);
		echo "</pre>";
		// $aux = json_decode($retorno);
		// var_dump($retorno);
	}

	function testeConexao(){
		$ch = curl_init("https://cobrancaonline.sicredi.com.br/sicredi-cobranca-ws-ecomm-api/ecomm/v1/boleto/health");

		$header   = [];
		$header[] = 'Content-Type:application/json';

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);

		curl_exec($ch);

		$retorno = curl_getinfo($ch); 
		curl_close($ch);

		if($retorno['http_code'] == 200){
			return true;
		}else{
			return false;
		}
	}

	function registraBoleto($sicredi, $boleto){

		$ch = curl_init("https://cobrancaonline.sicredi.com.br/sicredi-cobranca-ws-ecomm-api/ecomm/v1/boleto/emissao");

		$header    = [];
		$header[] = 'Content-Type:application/json';
		$header[] = 'token: '.$sicredi['token'];

		$boleto['agencia'] = $sicredi['agencia'];
		$boleto['posto'] = $sicredi['posto'];
		$boleto['cedente'] = $sicredi['cedente'];

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($boleto));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);

		$retorno = curl_exec($ch);
		curl_close($ch);

		$retorno = json_decode($retorno, true);
		return $retorno;
	}

	function alteraBoleto($sicredi, $boleto){
		$ch = curl_init("https://cobrancaonline.sicredi.com.br/sicredi-cobranca-ws-ecomm-api/ecomm/v1/boleto/comandoInstrucao");

		$header    = [];
		$header[] = 'Content-Type:application/json';
		$header[] = 'token: '.$sicredi['token'];

		$boleto['agencia'] = $sicredi['agencia'];
		$boleto['posto'] = $sicredi['posto'];
		$boleto['cedente'] = $sicredi['cedente'];

		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($boleto));
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);

		$retorno = curl_exec($ch);
		curl_close($ch);

		var_dump($retorno);

		// $retorno = json_decode($retorno, true);
		// return $retorno;
	}

	function segundaVia($sicredi, $nossonumero){
		$ch = curl_init("https://cobrancaonline.sicredi.com.br/sicredi-cobranca-ws-ecomm-api/ecomm/v1/boleto/impressao?agencia=".$sicredi['agencia']."&cedente=".$sicredi['cedente']."&nossoNumero=".$nossonumero."&posto=".$sicredi['posto']);

		$header    = [];
		$header[] = 'Content-Type:application/json';
		$header[] = 'token: '.$sicredi['token'];

		curl_setopt($ch, CURLOPT_POST, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);

		$retorno = curl_exec($ch);
		curl_close($ch);

		$nome_unico = date('Ymdhsi');
		$retorno = json_decode($retorno, true);
		$pdf64 = base64_decode($retorno['arquivo']);

		$pdf = fopen ('boletos/'.$nome_unico.'.pdf','w+');
		fwrite ($pdf, $pdf64);
		//close output file
		fclose ($pdf);
		
		return $nome_unico.'.pdf';

		// return $retorno;
	}

	// ESTRUTURA BASE SICREDI PARA CONSULTA E REGISTRO DE TITULOS
	// sicredi['token']	   = 'SEU_TOKEN_AQUI';  		64 digitos
	// sicredi['agencia']  = 'SUA_AGENCIA_AQUI'; 		4 digitos
	// sicredi['cedente']  = 'SEU_CODIGO_CEDENTE_AQUI'; 5 digitos
	// sicredi['posto']	   = 'SEU_POSTO_AQUI'; 			2 digitos

	
	//ESTRUTURA DATA PARA MONITORAMENTO DE TITULOS POR DATA
	// data['dataInicio'] = 'DATA_INICIO',
	// data['dataFim'] 	  = 'DATA_FIM',
	// data['tipoData']   = 'DATA_EMISSAO OU DATA_VENCIMENTO OU DATA_BAIXA OU DATA_LIQUIDACAO',

	//	OBSERVAÇÕES
	//	nossonumero são 9 digitos já incluso o digito verificador


	// $boleto['nossoNumero'] 	= 'NOSSO_NUMERO_AQUI'  9 DIGITOS
	// $boleto['codigoPagador'] = 'CODIGO_AQUI'  	   5 DIGITOS
	// $boleto['tipoPessoa'] 	= 'TIPO_AQUI'		   1 = PF || 2 = PJ
	// $boleto['cpfCnpj'] 		= 'DOCUMENTO_AQUI'	   ATE 14 DIGITOS SEM FORMATAÇÃO
	// $boleto['nome'] = 'DADOS_AQUI'		   ATE 40 DIGITOS SEM FORMATAÇÃO
	// $boleto['endereco'] = 'DADOS_AQUI'		ATE 40 DIGITOS SEM FORMATAÇÃO
	// $boleto['cidade'] = 'DADOS_AQUI'		ATE 25 DIGITOS SEM FORMATAÇÃO
	// $boleto['uf'] = 'DADOS_AQUI'  			ATE 2 DIGITOS SEM FORMATAÇÃO
	// $boleto['cep'] = 'DADOS_AQUI'  			ATE 8 DIGITOS SEM FORMATAÇÃO
	// $boleto['telefone'] = 'DADOS_AQUI'  	ATE 11 DIGITOS SEM FORMATAÇÃO
	// $boleto['email'] = 'DADOS_AQUI'			ATE 40 DIGITOS SEM FORMATAÇÃO
	// $boleto['especieDocumento'] = 'DADOS_AQUI'  DE A-O DE ACORDO COM A ESPÉCIE DO DOCUMENTO
	// $boleto['codigoSacadorAvalista'] = 'DADOS_AQUI'  ATE 3 DIGITOS SE NAO EXISTIR USAR 000
	// $boleto['seuNumero'] = 'DADOS_AQUI'  ATE 10 DIGITOS SEM FORMATACAO
	// $boleto['dataVencimento'] = 'DADOS_AQUI'  DD/MM/YYYY
	// $boleto['valor'] = 'DADOS_AQUI'  		ATE 14 DIGITOS USANDO . PARA CASA DECIMAIS
	// $boleto['tipoDesconto'] = 'DADOS_AQUI'  A = VALOR || B = PERCENTUAL
	// $boleto['valorDesconto1'] = 'DADOS_AQUI'  ATE 14 DIGITOS USANDO . PARA CASA DECIMAIS
	// $boleto['dataDesconto1'] = 'DADOS_AQUI'   DD/MM/YYYY
	// $boleto['valorDesconto2'] = 'DADOS_AQUI'  ATE 14 DIGITOS USANDO . PARA CASA DECIMAIS
	// $boleto['dataDesconto2'] = 'DADOS_AQUI'   DD/MM/YYYY
	// $boleto['valorDesconto3'] = 'DADOS_AQUI'  ATE 14 DIGITOS USANDO . PARA CASA DECIMAIS
	// $boleto['dataDesconto3'] = 'DADOS_AQUI'   DD/MM/YYYY
	// $boleto['tipoJuros'] = 'DADOS_AQUI'  	  A = VALOR || B = PERCENTUAL
	// $boleto['juros'] = 'DADOS_AQUI'  		  ATE 14 DIGITOS USANDO . PARA CASA DECIMAIS
	// $boleto['multas'] = 'DADOS_AQUI'  		  ATE 14 DIGITOS USANDO . PARA CASA DECIMAIS
	// $boleto['descontoAntecipado'] = 'DADOS_AQUI'  ATE 14 DIGITOS USANDO . PARA CASA DECIMAIS
	// $boleto['informativo'] = 'DADOS_AQUI'  ATE 80 DIGITOS
	// $boleto['mensagem'] = 'DADOS_AQUI'  ATÉ 300 DIGITOS
	// $boleto['codigoMensagem'] = 'DADOS_AQUI'  ATE 4 DIGITOS


	// $sicredi['token'] 	 = '2414FF06D32C83E6E4C951977C8DD81A4CB7313CA81831DB86FCFFC35D79FB56';  
	// $sicredi['agencia']  = '0736';
	// $sicredi['cedente']  = '42712'; 
	// $sicredi['posto']	 = '13'; 

	// $boleto['nossoNumero'] 	 = '192500012';
	// $boleto['codigoPagador'] = '';
	// $boleto['tipoPessoa'] 	 = '1';
	// $boleto['cpfCnpj'] 		 = '35313879871';
	// $boleto['nome'] 		 = 'Wesley Amancio';
	// $boleto['endereco'] 	 = 'Avenida Luiz Vasconcelos';
	// $boleto['cidade']		 = 'Franca'	;
	// $boleto['uf'] 			 = 'SP' ;
	// $boleto['cep'] 			 = '14406133' ;
	// $boleto['telefone']		 = '1699973077' ;
	// $boleto['email'] 		 = 'sis.wesley@gmail.com';
	// $boleto['especieDocumento'] = 'A'; 
	// $boleto['codigoSacadorAvalista'] = '000';  
	// $boleto['seuNumero']	 = '50003';
	// $boleto['dataVencimento'] = '30/09/2019';  
	// $boleto['valor'] 		 = '1.20';
	// $boleto['tipoDesconto'] = 'A'  ;
	// $boleto['valorDesconto1'] = '' ; 
	// $boleto['dataDesconto1'] = ''   ;
	// $boleto['valorDesconto2'] = ''  ;
	// $boleto['dataDesconto2'] = ''   ;
	// $boleto['valorDesconto3'] = ''  ;
	// $boleto['dataDesconto3'] = ''  ;
	// $boleto['tipoJuros'] = 'A'  	 ;
	// $boleto['juros'] = ''  		  ;
	// $boleto['multas'] = ''  		  ;
	// $boleto['descontoAntecipado'] = ''; 
	// $boleto['informativo'] = 'Quadra 1 Lote 1'  ;
	// $boleto['mensagem'] = 'Não Receber após o vencimento'  ;
	// $boleto['codigoMensagem'] = ''  ;

	// $data['dataInicio'] = '01/09/2019';
	// $data['dataFim'] 	  = '30/09/2019';
	// $data['tipoData'] = 'DATA_EMISSAO';

	// $aux = monitoraTitulo($sicredi, '', $data);

	$aux = solicitaToken('2C2C67E23F62D6F4F4D46F12B7FD5BD76A171E45309EFD6B4AEE5E32C3A24CBB');
	var_dump($aux);
?>