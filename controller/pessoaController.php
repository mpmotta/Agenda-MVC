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

    public function inserir(Pessoa $pessoa) {
        if (strlen($pessoa->getNome()) == 0 || strlen($pessoa->getFone()) == 0 || strlen($pessoa->getEmail()) == 0) {
            header("Location: ../view/cadastro.php?campoVazio");
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pessoaModel = new Pessoa();
            $pessoaModel->inserir($pessoa);
            header('Location: ../view/agenda.php?cadastro=ok');
        } else {
            header("Location: ../view/agenda.php?erro");
        }
    }

    public function editar(Pessoa $pessoa) {
        if (strlen($pessoa->getNome()) == 0 || strlen($pessoa->getFone()) == 0 || strlen($pessoa->getEmail()) == 0) {
            header("Location: ../view/editar.php?id={$pessoa->getId()}&campoVazio");
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $pessoaModel = new Pessoa();
            $pessoaModel->editar($pessoa, $pessoa->getId());
            header("Location: ../view/agenda.php?edit=ok");
        } else {
            header("Location: ../view/agenda.php?erro=erro");
        }
    }

    public function excluir($id) {
        $pessoaModel = new Pessoa();
        $pessoaModel->excluir($id);
        header("Location: ../view/agenda.php?delete=ok");
    }

    public function handleRequest() {
        if (isset($_GET['action']) && $_GET['action'] == 'cadastrarPessoa') {
            $pessoa = new Pessoa();
            $pessoa->setNome($_POST['nome']);
            $pessoa->setFone($_POST['fone']);
            $pessoa->setEmail($_POST['email']);
            $this->inserir($pessoa);
        }
        if (isset($_GET['action']) && $_GET['action'] == 'editarPessoa') {
            $pessoa = new Pessoa();
            $pessoa->setId($_POST['meuid']);
            $pessoa->setNome($_POST['nome']);
            $pessoa->setFone($_POST['fone']);
            $pessoa->setEmail($_POST['email']);

            $avatar = $_POST['meuavatar']; 

            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
                $arquivo = $_FILES['avatar']['tmp_name'];
                $foto = $_FILES['avatar']['name'];
                $extensao = pathinfo($foto, PATHINFO_EXTENSION);
                $tmp_nome = md5($foto . date('d-m-Y-h-i-s'));
                $avatar = $tmp_nome . "." . $extensao;
                $destino = '../view/img/avatar/' . $avatar;
                move_uploaded_file($arquivo, $destino);
				$pessoa->setAvatar($avatar); 
            }

            $this->editar($pessoa);
        }
        if (isset($_GET['action']) && $_GET['action'] == 'excluirPessoa') {
            $this->excluir($_GET['id']);
        }
    }
}

$PessoaController = new pessoaController();
$PessoaController->handleRequest();
