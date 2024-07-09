<?php
require_once('../model/pessoaModel.php');

class pessoaController {

    public function consultar() {
        $pessoaModel = new Pessoa();
        $result = $pessoaModel->consulta();
        return $result;
    }

    public function consultaID($id) {
        $pessoaModel = new Pessoa();
        $result = $pessoaModel->consultaID($id);
        return $result;
    }

    public function inserir() {
        $pessoa = array(
            'nome' => $_POST['nome'],
            'fone' => $_POST['fone'],
            'email' => $_POST['email']
        );

        if (strlen($pessoa['nome']) == 0 || strlen($pessoa['fone']) == 0 || strlen($pessoa['email']) == 0) {
            header("Location: ../view/cadastro.php?campoVazio");
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pessoaModel = new Pessoa();
            $pessoaModel->inserir($pessoa);
            header('Location: ../view/agenda.php?cadastro=ok');
        } else {
            header("Location: ../view/agenda.php?erro");
        }
    }

    public function editar() {
        $id = $_POST['meuid'];
        $pessoa = array(
            'avatar' => $_POST['meuavatar'],
            'nome' => $_POST['nome'],
            'fone' => $_POST['fone'],
            'email' => $_POST['email']
        );

        if (strlen($pessoa['nome']) == 0 || strlen($pessoa['fone']) == 0 || strlen($pessoa['email']) == 0) {
            header("Location: ../view/editar.php?id=$id&campoVazio");
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pessoaModel = new Pessoa();
            $pessoaModel->editar($pessoa, $id);
            header("Location: ../view/agenda.php?edit=ok");
        } else {
            header("Location: ../view/agenda.php?erro=erro");
        }
    }

    public function excluir() {
        $id = $_GET['id'];
        $pessoaModel = new Pessoa();
        $pessoaModel->excluir($id);
        header("Location: ../view/agenda.php?delete=ok");
    }

    public function handleRequest() {
        if (isset($_GET['action']) && $_GET['action'] == 'cadastrarPessoa') {
            $this->inserir();
        }
        if (isset($_GET['action']) && $_GET['action'] == 'editarPessoa') {
            $this->editar();
        }
        if (isset($_GET['action']) && $_GET['action'] == 'excluirPessoa') {
            $this->excluir();
        }
    }
}

$PessoaController = new pessoaController();
$PessoaController->handleRequest();