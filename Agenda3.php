<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desconto Madeira e Cia Ltda</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> <!-- link para o w3 css -->
    <link rel="stylesheet" href="Agenda3.css"> <!-- link para o estilo css -->

    <!-- A div da imagem e a prórpia imagem não tavam pegando a formatação co css então coloquei aqui pelo css interno -->
    <style>
        .divImg {
            margin-left: 20%;
            margin-right: 20%;
            padding: 20px;
            background-color: #6e351c;
            border-radius: 10px;
            box-shadow: 5px 5px 10px #430704;

        }

        img {
            display: block;
            margin-left: auto;
            margin-right: auto;
            border-radius: 10px;
            box-shadow: 5px 5px 10px #652510;
        }

        img:hover {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <!-- mesma formatação da página do formulário-->
    <h1>Madeira e Cia Ltda</h1>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $nome = $_POST['txtNome'];
        $valorCompra = $_POST['txtValorCompra'];

        // formatando seguindo o padrão brasileiro, tira os pontos para não dar erro e troca a vírgula por ponto 
        $valorCompra = str_replace(".", "", $valorCompra); // 10.000,99 -> 10000,99
        $valorCompra = str_replace(",", ".", $valorCompra); //  10000,99 -> 10000.99 (formato para a conta das variáveis)
        $valorCompra = (float) $valorCompra; // voltando o valor como número pra garantir que a conta é possível
        $formaPagamento = $_POST['cmbPag'];
        $desconto = 0;

        if ($formaPagamento == "cartão de crédito") {

            $desconto = 0;

            $mensagem = "Olá " . $nome . ", sua compra de R$" . $valorCompra . " foi realizada com cartão de crédito. Não há desconto.";

        } elseif ($formaPagamento == "boleto") {

            $desconto = number_format($valorCompra * 0.08, 2, ',', '.'); // formatação com 2 casas com a porcentagem correta
            $desconto = (float) $desconto;

            $mensagem = "Olá " . $nome . ", sua compra de R$ " . $valorCompra . " foi realizada com boleto. Seu desconto é de R$ " . $desconto . ".";

        } elseif ($formaPagamento == "depósito") {

            $desconto = number_format($valorCompra * 0.10, 2, ',', '.'); // formatação com 2 casas com a porcentagem correta
            $desconto = (float) $desconto;
            $mensagem = "Olá " . $nome . ", sua compra de R$ " . $valorCompra . " foi realizada com depósito. Seu desconto é de R$ " . $desconto . ".";

        } else {

            $mensagem = "Forma de pagamento inválida.";
        }
         // criação da variável para o valor com desconto
        $valorcomdesconto = $valorCompra - $desconto;
                                                                                              // formatação do valor com desconto com 2 casas decimais
        echo "<div class='w3-panel w3-white'> <h3>" . $mensagem . " Valor com desconto:R$ " . number_format($valorcomdesconto, 2, ',', '.') . "</h3> </div>";


    }

    ?>
    <div class="divImg">
        <figure>
            <img src="lojaMadeiraeCia.png" alt="Madeira e Cia Ltda" width="100%" height="100%">
        </figure>
    </div>
    <h1>———————————————————————————</h1>
</body>


<!--    ------------------------------------------------------------   
                  Raciocínio para corrigir os erros 
         -----------------------------------------------------------
    No código dado pela atividade haviam 3 erros

     $desconto = $valorCompra * 0.1; // ERRO: deveria ser 8% para boleto

     $desconto = $valorCompra * 0.08; // ERRO: deveria ser 10% para depósito

     // ERRO: mensagem final não mostra valor com desconto
     echo "<div class='w3-panel w3-green'>$mensagem</div>";

     ---------------------------------------------------------------------------

     Para resolver os dois primeiros, a porcentagem estava errada o de 8% tava com 0.1 (10%), o certo é 0.08 
     e o de 10% tava com 0.08 (8%), o correto é 0.1 ou 0.10, ambos dão o mesmo resultado

     Para o último erro era necessário adicionar uma variável para o valor com o desconte e logo apos mostrar 
     ela juntamente com a mensagem.

-->

</html>