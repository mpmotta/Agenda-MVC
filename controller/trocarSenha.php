<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trocar senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-secondary">
    <div class="container bg-light p-0" style="width:400px; margin: 80px auto">
        <h1 class="text-center">TROCAR SENHA</h1>
         <form method="post" action="">
            <div class="m-3">
                <input required type="password" name="senha" 
                id="senha" class="form-control"
                placeholder="Nova senha">
            </div>
            <div class="m-3">
                <input required type="password" name="senha2" 
                id="senha2" class="form-control"
                placeholder="Repita a senha">
            </div> 
            <div class="m-3">   
            <button type="submit" id="submit" class="form-control btn btn-primary mb-3">
                    Salvar nova senha
                </button>
            </div>    
        </form>
    </div>
    
</body>
</html>