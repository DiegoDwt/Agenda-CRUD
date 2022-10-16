<?php
    include "acao.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script>
        
        function preencher(){

            var now =new Date();                            
            var currentY= now.getFullYear();

            var dobget =document.getElementById("nascimento").value;
            var dob= new Date(dobget);

            var prevY= dob.getFullYear();

            var ageY =currentY - prevY;

            console.log(ageY);

            idade.value = ageY;

        }
        
    </script>
</head>
<body>
    <h1 class="display-4 text-center">Cadastro</h1>

    <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="cadastrar.php">Cadastros</a>
        </li>
    </ul>
    <br>  
    <div class="col-sm-3">
        <form method="post" enctype="multipart/form-data" name="myForm">
            <fieldset>
                <input readonly class="form-control-plaintext" type="text" id="id" name="id"  value= >

                <div class="form-floating mb-3">
                    <input type="text" id="nome" name="nome" class="form-control" value=<?=isset($_GET['nome'])?$_GET['nome']:''?>>
                    <label class="label label-primary" for="nome">Nome:</label>
                </div>
                    <br>
                <div class="form-floating mb-3">
                    <input type="email" id="floatingEmail" name="email" class="form-control" value=<?=isset($_GET['email'])?$_GET['email']:''?>>
                    <label for="floatingEmail">Email:</label>
                </div>
                    <br>
                <div class="form-floating">
                    <input type="number" id="idade" name="idade" class="form-control" value=<?=isset($_GET['idade'])?$_GET['idade']:''?>>
                    <label for="idade">Idade:</label>
                </div>
                    <br>
                <div class="form-floating">
                    <input type="date" id="nascimento" name="nascimento" class="form-control" value=<?=isset($_GET['data'])?$_GET['data']:''?> onchange=preencher()>
                    <label for="nascimento">Data de Nascimento:</label>
                </div>
                    <br>
                <div>
                    <label for="parente">Parentesco:</label>
                    <input type="radio" id="parente1" class="form-check-input" name="parente" value="1" <?php if(isset($_GET['parente']) and $_GET['parente']=='1') echo 'checked'; ?> required> Sim
                    <input type="radio" id="parente2" class="form-check-input" name="parente" value="2" <?php if(isset($_GET['parente']) and $_GET['parente']=='2') echo 'checked'; ?> required> Não
                </div>
                    <br>
                <div class="form-floating">
                    <select class="form-select" name="local" id="local">
                    <option value=""></option>
                    <option value="1" <?php if(isset($_GET['local']) and $_GET['local']=='1') echo 'selected'; ?>>Escola</option>
                    <option value="2" <?php if(isset($_GET['local']) and $_GET['local']=='2') echo 'selected'; ?>>Trabalho</option>
                    <option value="3" <?php if(isset($_GET['local']) and $_GET['local']=='3') echo 'selected'; ?>>Night</option>
                    </select>
                    <label for="select">Origem do Contato:</label>
                </div>
                    <br>
                <div>
                    <label for="imagem" class="form-label">Imagem de Perfil</label>
                    <input class="form-control" name="img" type="file" id="formFile">
                </div>
                    <br>
                <input type="submit" value="Salvar" name="acao">
                <input type="reset" value="Limpar">
            </fieldset>
        </form>
    </div>
</body>
</html>