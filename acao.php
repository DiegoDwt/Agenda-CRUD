<?php

$acao = isset($_POST['acao'])?$_POST['acao']:'';

if ($acao =='Salvar'){
    $data = DateTime::createFromFormat('Y-m-d', $_POST['nascimento']);
    $datastatus = FALSE;
    if($data && $data->format('Y-m-d') === $_POST['nascimento']){
    $datastatus = TRUE;
    }
    if (empty($_POST["nome"])) {
        echo "Nome inválido";
    }elseif (empty($_POST["email"])) {
        echo "Email inválido";
    }elseif ($_POST["idade"] < 0 or $_POST["idade"] > 120 or ! is_numeric($_POST["idade"])) {
        echo "Idade inválida";
    }elseif ($datastatus == FALSE) {
        echo "Data inválida";
    }elseif ($_POST["parente"]!= "1" and $_POST["parente"]!= "2") {
        echo "Parentesco inválido";
    }elseif ($_POST["local"]!= "1" and $_POST["local"]!= "2"and $_POST["local"]!= "3") {
        echo "Local inválido";
    }else{

        $acao = isset($_GET['acao'])?$_GET['acao']:'';

        if($acao =='editar'){
            $id = isset($_GET['id'])?$_GET['id']:'';
        }else{
            $id = 0;  
        }
        
        if ($id == 0){
            $dados = get_dados();
            $id = nextID($dados);  
            $organiz = organize($id);
    
            if ($dados){ 
                array_push($dados,$organiz);
            }else{
                $dados[] = $organiz;
            }
    
            file_put_contents("banco.json",json_encode($dados));
    
            header('location: cadastrar.php');
        }else{
            $organiz = organize($id);
            alterar($organiz);
            header('location: index.php'); 
        }
        
    }
}else {
    
    $acao = isset($_GET['acao'])?$_GET['acao']:'';
    $id = isset($_GET['id'])?$_GET['id']:'';


    if ($acao == 'excluir'){
        excluir($id);
    }
}

function nextID($dados){
    $id = 0;
    if ($dados)
        $id = intval($dados[count($dados)-1]['id']);
    return ++$id;
}

//excluir
function excluir($id){
    $dados = get_dados();
    $i = 0;
    foreach($dados as $contato){
        if ($contato['id'] == $id)
            break;
        else
        $i++;
    }
    array_splice($dados,$i,1);
    file_put_contents("banco.json",json_encode($dados));
}

//alterar
function alterar($alterado){
    $dados = get_dados();
    $i = 0;
    foreach($dados as $contato){
        if ($contato['id'] == $alterado['id'])
            break;
        else
        $i++;
    }
    array_splice($dados,$i,1,array($alterado));
    file_put_contents("banco.json",json_encode($dados));
}

function get_dados(){
    $contatos[] = "";

    if (file_exists("banco.json")){
        $conteudo =file_get_contents("banco.json");
        $contatos = json_decode($conteudo, true);
    }

    return $contatos;
}

function organize($id){
    $nome =$_POST["nome"];
    $email =$_POST["email"];
    $idade =$_POST["idade"];
    $data =$_POST["nascimento"]; 
    $parente =$_POST["parente"];
    $local =$_POST["local"];

    $dados = array("id"=>strval($id), "Nome"=>$nome, "Email"=>$email, "Idade"=>$idade, "Data"=>$data, "Parente"=>$parente, "Local"=>$local);

    return $dados;
}

?>