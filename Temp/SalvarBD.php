function AtualizarGeleia() {
	global $db;

	$server =  'localhost';
	$usuario = $_POST['mysql_user'];
	$senha = $_POST['mysql_password'];

	$db->Connect($server, $banco_de_dados = null, $usuario, $senha);

	// Verificar se está usando windows, e definir o caminho
	if (preg_match('/linux/i', PHP_OS)) {
		$caminho = 'mysql';
	} else {
		$caminho = 'c:\xampp\mysql\bin\mysql';
	}

	if ($senha != null) {
		$senha = ' -p ' . $senha;
	}

	exec($caminho . ' -u ' . $usuario . $senha . ' -e "DROP database geleia_framework"');
	exec($caminho . ' -u ' . $usuario . $senha . ' -e "CREATE database geleia_framework"');
	exec($caminho . ' -u ' . $usuario . $senha . ' geleia_framework < geleia_framework.sql');

	// Pegar o numero de versao do Geleia
	$arquivo = fopen(DOCUMENT_ROOT . '/versao.txt', 'r');
	$versao = fread($arquivo, filesize(DOCUMENT_ROOT . "/versao.txt"));
	fclose($arquivo);

	AtualizarNumeroVersao($versao);

}

function SalvarVersaoGeleia() {
	global $db;

	$server =  'localhost';
	$usuario = $_POST['mysql_user'];
	$senha = $_POST['mysql_password'];

	$db->Connect($server, $banco_de_dados = null, $usuario, $senha);

	// Verificar se está usando windows, e definir o caminho
	if (preg_match('/linux/i', PHP_OS)) {
		$caminho = 'mysqldump';
	} else {
		$caminho = 'c:\xampp\mysql\bin\mysqldump';
	}

	if ($senha != null) {
		$senha = ' -p ' . $senha;
	}

	exec($caminho . ' --add-drop-database --opt -u ' . $usuario . $senha . ' geleia_framework > geleia_framework.sql');

	// Atualizar o numero de versao do Geleia
	$arquivo = fopen(DOCUMENT_ROOT . '/versao.txt', 'r');
	$versao = fread($arquivo, filesize(DOCUMENT_ROOT . "/versao.txt"));
	fclose($arquivo);
	$arquivo = fopen(DOCUMENT_ROOT . '/versao.txt', 'w');
	$versao += 0.01;
	$versao = str_replace(',', '.', $versao);
	fwrite($arquivo, $versao);
	fclose($arquivo);

	AtualizarNumeroVersao($versao);
}

function VersaoGeleia() {

	if(filesize(DOCUMENT_ROOT . "/versao.txt") != 0) {
		$arquivo = fopen(DOCUMENT_ROOT . '/versao.txt', 'r');
		$versao = fread($arquivo, filesize(DOCUMENT_ROOT . "/versao.txt"));
		fclose($arquivo);
	} else {
		return 0;
	}

	return $versao;

}

function VersaoGeleiaLocal() {
	global $db;

	$resultado = $db->GetObject('SELECT * FROM geleia.versao WHERE id = 1');
	if($resultado->numero != null) {
		return str_replace(',', '.', $resultado->numero);
	} else {
		return 0;
	}

}

function AtualizarNumeroVersao($versao) {
	global $db;

	// Atualizar versão local do Geleia
	$sql = 'UPDATE geleia.versao SET numero = ' . $versao . ' WHERE id = 1';
	$db->ExecSQL($sql);
}