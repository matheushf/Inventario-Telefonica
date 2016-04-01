<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Config.php';

$acao = $_GET['acao'] ? $_GET['acao'] : $_POST['acao'];

switch ($acao) {
    case 'inserir': {

            if ($FuncoesPadroes->Save($_GET['modulo'])) {
                $_SESSION['Mensagem']['tipo'] = "sucesso";
                $_SESSION['Mensagem']['texto'] = ucfirst($_GET['modulo']) . " inserido com sucesso.";
                header('Location: index.php');
            } else {
                $_SESSION['Mensagem']['tipo'] = "error";
                $_SESSION['Mensagem']['texto'] = "Ocorreu um erro ao realizar sua solicitação.";
            }

            break;
        }

    case 'atualizar': {
            $resultado = $FuncoesPadroes->Update($_GET['modulo']);

            if ($resultado === 'senha_diferente') {
                $_SESSION['Mensagem']['tipo'] = "error";
                $_SESSION['Mensagem']['texto'] = "A senha antiga não confere.";
            } elseif ($resultado == true) {
                $_SESSION['Mensagem']['tipo'] = "sucesso";
                $_SESSION['Mensagem']['texto'] = ucfirst($_GET['modulo']) . " atualizado com sucesso.";
                header('Location: index.php');
            } else {
                $_SESSION['Mensagem']['tipo'] = "error";
                $_SESSION['Mensagem']['texto'] = "Ocorreu um erro ao realizar sua solicitação.";
            }

            break;
        }

    case 'excluir': {
            $Id = $_POST['id'];
            $Modulo = $_POST['modulo'];

            $res = $FuncoesPadroes->Delete($Id, $Modulo);
//        var_dump($res);

            if ($res) {
                echo "OK";
            } else {
                echo "ERRO";
            }

            break;
        }

    case 'login': {
            $Email = $_POST['email'];
            $Senha = $_POST['senha'];

            if ($Usuario->Login($Email, $Senha)) {
                header('Location: /modulos/materiais/');
            } else {
                $_SESSION['Mensagem']['tipo'] = 'error';
                $_SESSION['Mensagem']['texto'] = 'Usuário ou senha inválidos.';

                header('Location: /index.php');
            }
        }
}
