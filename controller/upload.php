<?php
date_default_timezone_set('America/Sao_Paulo');
$agora = date('d-m-Y-h-i-s');

if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
    $arquivo = $_FILES['avatar']['tmp_name'];
    $foto = $_FILES['avatar']['name'];

    $extensao = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
    $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($extensao, $extensoesPermitidas)) {
        $tmp_nome = md5($foto . $agora);
        $avatar = $tmp_nome . "." . $extensao;
        $destino = '../view/img/avatar/' . $avatar;

        if (move_uploaded_file($arquivo, $destino)) {
            echo $avatar;
        } else {
            echo "Erro ao mover o arquivo para o destino.";
        }
    } else {
        echo "Extensão de arquivo não permitida.";
    }
} else {
    echo "Nenhum arquivo enviado ou erro no upload.";
}
