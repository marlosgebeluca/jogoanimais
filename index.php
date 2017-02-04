<?php
    require_once("controller/animal.php");
    $controller = new AnimalController;
    session_start();

     if (isset($_POST['submit'])) {
        foreach ($_SESSION['animais'] as $i => $animais) {
            foreach ($animais as $j => $valor) {
                $controller->createAnimal($valor->tipo, $valor->especie);
            }
        }

        $tipo = $_POST["tipo"];
        $especie = $_POST["especie"];
        $controller->createAnimal($tipo, $especie);

        $arrayAnimais = $controller->getAnimais();
        $modais = $controller->getModais();
        $_SESSION['animais'] = $arrayAnimais;                 
    }else{
        $controller->startAnimais();
        $arrayAnimais = $controller->getAnimais();
        $modais = $controller->getModais();    
        $_SESSION['animais'] = $arrayAnimais;     
    }
?>

<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jogo dos Animais</title>

    <link rel="stylesheet" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/jogo.css">

</head>

<body>
    <div class="painel col-sm-7">
        <div class="panel panel-primary">
            <div class="panel-heading"> 
                Jogo dos Animais 
            </div>
            
            <div class="panel-body">
                Pense em um animal
                <br>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#start"> Ok </button>
            </div>
        </div>
    </div>

    <div id="start" class="modal fade" role="dialog"> 
        <div class="modal-dialog"> 
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Jogo Dos Animais </h4>
                </div>

                <div class="modal-body">
                    <p> O animal que você pensou vive na água? </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#0agua">Sim</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#0outros">Não</button>
                </div>
            </div>
        </div>
    </div>

    <div id="modalCadastro" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Desisto =( </h4>
                </div>

                <form name="registar" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                    <div class="modal-body">
                        <label for="especie">Qual animal você pensou?</label>
                        <input type="text" name="especie" class="form-control">
                        <input type="hidden" name="tipo" id="tipo">
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="submit btn btn-default" name="submit">Ok</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modalAcerto" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Jogo Dos Animais </h4>
                </div>

                <div class="modal-body">
                    <label for="especie">Acertei de novo!!!</label>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="submit btn btn-default" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>

</body>

<script src="public/js/jquery.js"></script>
<script src="public/js/bootstrap.min.js"></script>
<script type="text/javascript">
    $('body').append('<?php echo $modais ?>');

    $("#btnNaoMacaco").click(function(){
        $('#modalCadastro').modal('toggle');
         $("#tipo").val("outros");
    });

    $("#btnNaoTubarão").click(function(){
        $('#modalCadastro').modal('toggle');
         $("#tipo").val("água");
    });

<?php
    foreach ($arrayAnimais as $i => $array) {
        $arrayInvertido  = array_reverse($array);
        foreach ($arrayInvertido as $j => $animal) {
            echo "$('#btnSim".$animal->especie."').click(function(){".
                    "$('#".$j.$i."').modal('toggle');".
                    "$('#modalAcerto').modal('toggle');".
                "});";
        }
}
?>
</script>

</html>