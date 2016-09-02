<?php
	if(!class_exists('iPDV')) 	
		include($_SERVER['SUBDOMAIN_DOCUMENT_ROOT'] != "" ? ($_SERVER['SUBDOMAIN_DOCUMENT_ROOT'] . "/global.php") : $_SERVER['DOCUMENT_ROOT'] . "/global.php");
	
	require_once($actions);
	$global->forceAuthentication();
	
	$colunas = array( 'ID' => 'agen_id', 'RESPONS¡VEL' => 'usua_nome',
			'CLIENTE' => 'clie_razao_social',
			'TIPO CLIENTE' => 'clie_tipo',
			'TIPO DE ABERTURA' => 'agen_tipo_abertura',
	        'TIPO DE ATENDIMENTO' => 'agen_tipo_atendimento',
			'SOLICITA«√O' => 'agen_solicitacao',
			'QTDE' => 'agen_quantidade',
	        'ESTADO' => 'agen_estado',
			'SERVI«O SOLICITADO' => 'agen_servico',
	        'HORA INICIO' => 'agen_hora_inicio',
			'HORA_FIM' => 'agen_hora_fim',
	        'DESCRI«√O SERVI«O' => 'agen_descricao_servico',
	        'DESCRI«√O' => 'agen_descricao',
	        'OBSERVA«√O' => 'agen_observacao',
			'DATA AGENDADO' => 'agen_data_inicio',
			'DATA CADASTRO' => 'agen_data_cadastro',
			'DATA TERMINO' => 'agen_data_termino'
	);
	
	$t = explode("FROM agenda LEFT JOIN ", $_SESSION['agenda.listing.sql']);
	
	//Mostrando somente colunas que ser√£o usados na planilha excel
	foreach($colunas as $c) {
		$sql_temp .= $c . ",";
	}
	
	$sql_anexo = " , CASE WHEN (SELECT COUNT( agan_agen_id ) 
			FROM agenda_anexo
			WHERE agan_agen_id = agen_id AND (agan_anexo_1<>'' OR agan_anexo_2 <> '' OR agan_anexo_3 <> '' OR  agan_anexo_4 <> '') ) > 0 THEN 'Sim' ELSE 'N„o' END as agen_anexo ";
	
	
	
	$sql_temp = substr($sql_temp, 0, strlen($sql_temp) - 1) ;
	$sql = "SELECT " . $sql_temp . $sql_anexo . " FROM agenda LEFT JOIN " . $t[1];
	
	//Retirando os limites da SQL
	$sql_temp = explode(" LIMIT ", $sql);
	$sql = $sql_temp[0];

	
	
	$sql .= " ORDER BY usua_nome ASC";
	
	$rset = $db->ExecSQL($sql);
	$linhas = mysql_num_rows($rset);
	
	$resultado = mysql_fetch_array ( $rset , MYSQL_NUM );
	
	
	$colunas['ANEXO'] = 'agen_anexo';
	$colunas_titulo = array_keys($colunas);
	
	for ( $i=0 ; $i <= sizeof($colunas_titulo) ; $i++ ) {
		$planilha .= strtoupper ( $colunas_titulo[$i]) . ";";
	}
	
	$planilha .= "\n";
	
	for ( $i=0 ; $i < $linhas ; $i++ ) {

		for ( $n=0 ; $n <= sizeof($colunas_titulo) ; $n++ ) {
			$planilha .= str_replace("\t", "", (str_replace("\r", "", (str_replace("\n", "", $resultado[$n]))))) .";";
		}
		$planilha .= "\n";
		$resultado = mysql_fetch_array ( $rset , MYSQL_NUM );
	}
	
	 
	header('Content-type: txt/csv');
	header('Content-Disposition: attachment; filename=ListaDeCompromissos_'. date("dmY_H:i:s") . '.csv');
	header('Pragma: no-cache');
	header('Expires: 0');
	
	 
	print($planilha);
	
?>
