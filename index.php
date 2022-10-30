<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="styles.css">

    <title>
        PROCESSO SELETIVO PLANIUM
    </title>

</head>

<body>
    <section class="content">
        <div class="tudo">

            <?php
            //Captura o Json para os planos e preços
            $json_data = file_get_contents("plans.json");
            $planos = json_decode($json_data, true);

            if(json_last_error()){
                print_r($planos);
            }

            $json_data2 = file_get_contents("prices.json");
            $precos = json_decode($json_data2, true);

            if(json_last_error()){
                print_r($precos);
            }
            ?>

            <h3>
                Formuário de Planos
            </h3>


            <?php
            $plans_values = (isset($_POST['plans_values']) ? $_POST['plans_values'] : null);

            $valor = (isset($_POST['numero']) ? $_POST['numero'] : null);


            //Primeira página para a quantidade
            if ($valor <= 0 and $plans_values == null) {
            ?>
                <form class="form" method="POST" action="index.php">
                    <input class="input" type="number" min="0" name="numero" placeholder="Quantidade de Beneficiario">



                    <?php
                }



                //Segunda página para os outros dados
                if ($valor > 0) {
                    for ($i = 0; $i < $valor; $i++) {
                    ?>
                        <form class="form" method="POST" action="index.php">

                            <input class="input" type="text" name="nome[]" placeholder="Nome do Beneficiario">
                            <input class="input" type="number" name="idade[]" placeholder="Idade">


                        <?php
                    }
                        ?>
                        <select class="plans_values" name="plans_values">
                            <?php
                            if (count($planos) != 0) {
                                foreach ($planos as $plano) {
                            ?>
                                    <?php echo '<option value="' . $plano['codigo'] . '">' . $plano['nome'] . '</option>' ?><br></th>

                            <?php
                                }
                            }
                        }

                        if ($plans_values) {
                            ?>
                            <form class="form" method="POST" action="index.php">
                            <table>
                                <tr>

                                    <?php
                                    $plano_nome= "";
                                    $preco_total = 0;
                                    $preco_individual = [];
                                    $nome_beneficiario = $_POST['nome'];
                                    $idade_beneficiario = $_POST['idade'];
                                    $total_dados = count($nome_beneficiario);

                                    foreach ($planos as $plano) {
                                        if ($plano['codigo'] == $plans_values) {
                                            $plano_nome = $plano['nome'];
                                            echo "<th colspan='3' >Plano Escolhido: " . $plano['nome'] . "</th><br>";
                                        }
                                    }

                                    ?>
                                <tr>
                                    <td>Nome Beneficiário</td>
                                    <td>Idade Beneficiário</td>
                                    <td>Preco</td>
                                </tr>
                            <?php
                  


                            if ($plans_values == 1) {
                                foreach ($precos as $preco) {

                                    if ($preco['codigo'] == 1) {
                                        if ($preco['minimo_vidas'] == 1 and $total_dados < 4) {
                                            for ($i = 0; $i < $total_dados; $i++) {
                                                if ($idade_beneficiario[$i] <= 17) {
                                                    $preco_total += $preco['faixa1'];
                                                    array_push($preco_individual, $preco['faixa1']);
                                                } elseif ($idade_beneficiario[$i] >= 18 and $idade_beneficiario[$i] <= 40) {
                                                    $preco_total += $preco['faixa2'];
                                                    array_push($preco_individual, $preco['faixa2']);
                                                } else {
                                                    $preco_total += $preco['faixa3'];
                                                    array_push($preco_individual, $preco['faixa3']);
                                                }
                                            }
                                        }
                                        else {
                                            if($preco['codigo'] == 1 and $preco['minimo_vidas'] == 4 and $total_dados  >= 4){
                                                for ($i = 0; $i < $total_dados; $i++) {
                                                    if ($idade_beneficiario[$i] <= 17) {
                                                        $preco_total += $preco['faixa1'];
                                                        array_push($preco_individual, $preco['faixa1']);
                                                    } elseif ($idade_beneficiario[$i] >= 18 and $idade_beneficiario[$i] <= 40) {
                                                        $preco_total += $preco['faixa2'];
                                                        array_push($preco_individual, $preco['faixa2']);
                                                    } else {
                                                        $preco_total += $preco['faixa3'];
                                                        array_push($preco_individual, $preco['faixa3']);
                                                    }
                                                }

                                            }
                                        }
                                    }
                                }
                            }


                            if ($plans_values == 2) {
                                foreach ($precos as $preco) {
                                    if ($preco['codigo'] == 2) {
                                        for ($i = 0; $i < $total_dados; $i++) {
                                            if ($idade_beneficiario[$i] <= 17) {
                                                $preco_total += $preco['faixa1'];
                                                array_push($preco_individual, $preco['faixa1']);
                                            } elseif ($idade_beneficiario[$i] >= 18 and $idade_beneficiario[$i] <= 40) {
                                                $preco_total += $preco['faixa2'];
                                                array_push($preco_individual, $preco['faixa2']);
                                            } else {
                                                $preco_total += $preco['faixa3'];
                                                array_push($preco_individual, $preco['faixa3']);
                                            }
                                        }
                                    }
                                }
                            }


                            if ($plans_values == 3) {
                                foreach ($precos as $preco) {
                                    if ($preco['codigo'] == 1) {
                                        for ($i = 0; $i < $total_dados; $i++) {
                                            if ($idade_beneficiario[$i] <= 17) {
                                                $preco_total += $preco['faixa1'];
                                                array_push($preco_individual, $preco['faixa1']);
                                            } elseif ($idade_beneficiario[$i] >= 18 and $idade_beneficiario[$i] <= 40) {
                                                $preco_total += $preco['faixa2'];
                                                array_push($preco_individual, $preco['faixa2']);
                                            } else {
                                                $preco_total += $preco['faixa3'];
                                                array_push($preco_individual, $preco['faixa3']);
                                            }
                                        }
                                    }
                                }
                            }


                            if ($plans_values == 4) {
                                foreach ($precos as $preco) {
                                    if ($preco['codigo'] == 4) {
                                        for ($i = 0; $i < $total_dados; $i++) {
                                            if ($idade_beneficiario[$i] <= 17) {
                                                $preco_total += $preco['faixa1'];
                                                array_push($preco_individual, $preco['faixa1']);
                                            } elseif ($idade_beneficiario[$i] >= 18 and $idade_beneficiario[$i] <= 40) {
                                                $preco_total += $preco['faixa2'];
                                                array_push($preco_individual, $preco['faixa2']);
                                            } else {
                                                $preco_total += $preco['faixa3'];
                                                array_push($preco_individual, $preco['faixa3']);

                                            }
                                        }
                                    }
                                }
                            }


                            if ($plans_values == 5) {
                                foreach ($precos as $preco) {
                                    if ($preco['codigo'] == 5) {
                                        for ($i = 0; $i < $total_dados; $i++) {
                                            if ($idade_beneficiario[$i] <= 17) {
                                                $preco_total += $preco['faixa1'];
                                                array_push($preco_individual, $preco['faixa1']);
                                            } elseif ($idade_beneficiario[$i] >= 18 and $idade_beneficiario[$i] <= 40) {
                                                $preco_total += $preco['faixa2'];
                                                array_push($preco_individual, $preco['faixa2']);
                                            } else {
                                                $preco_total += $preco['faixa3'];
                                                array_push($preco_individual, $preco['faixa3']);

                                            }
                                        }
                                    }
                                }
                            }


                            if ($plans_values == 6) {
                                foreach ($precos as $preco) {

                                    if ($preco['codigo'] == 6) {
                                        if ($preco['minimo_vidas'] == 1 and $total_dados < 2) {
                                            for ($i = 0; $i < $total_dados; $i++) {
                                                if ($idade_beneficiario[$i] <= 17) {
                                                    $preco_total += $preco['faixa1'];
                                                    array_push($preco_individual, $preco['faixa1']);
                                                } elseif ($idade_beneficiario[$i] >= 18 and $idade_beneficiario[$i] <= 40) {
                                                    $preco_total += $preco['faixa2'];
                                                    array_push($preco_individual, $preco['faixa2']);
                                                } else {
                                                    $preco_total += $preco['faixa3'];
                                                    array_push($preco_individual, $preco['faixa3']);

                                                }
                                            }
                                        }
                                        else {
                                            if($preco['codigo'] == 6 and $preco['minimo_vidas'] == 2 and $total_dados  >= 2){
                                                for ($i = 0; $i < $total_dados; $i++) {
                                                    if ($idade_beneficiario[$i] <= 17) {
                                                        $preco_total += $preco['faixa1'];
                                                        array_push($preco_individual, $preco['faixa1']);
                                                    } elseif ($idade_beneficiario[$i] >= 18 and $idade_beneficiario[$i] <= 40) {
                                                        $preco_total += $preco['faixa2'];
                                                        array_push($preco_individual, $preco['faixa2']);
                                                    } else {
                                                        $preco_total += $preco['faixa3'];
                                                        array_push($preco_individual, $preco['faixa3']);
                                                    }
                                                }

                                            }
                                        }
                                    }
                                }
                            }
                            for ($i = 0; $i < $total_dados; $i++) {
                                echo "<td>" . $nome_beneficiario[$i] . "</td><br>";
                                echo "<td>" . $idade_beneficiario[$i] . " anos</td><br>";
                                echo "<td>R$ ".number_format($preco_individual[$i],2,",","." ). " </td></tr>";

                            }


                            $array_json = [];

                            echo "<td></td><td></td><td>Total:  " . number_format($preco_total,2,",",".")  . "</td><br>";
                            for($i=0;$i<$total_dados;$i++){
                                $array_json[$i] = array(
                                    "Nome" => "$nome_beneficiario[$i]",
                                    "Idade" =>" $idade_beneficiario[$i]",
                                    "Preco" => " $preco_individual[$i]",
                                    "Plano" =>  $plano_nome 
                                );
                            }

                            echo json_encode($array_json);

                            
                        }
                        ?>
                                                </table>

                        <input type="submit" name= "submit" value="Confirmar">


                        <?php
                            if(isset($_POST['submit']) and isset($array_json)){
                                if(filesize("beneficiarios.json") == 0){
                                    $primeira_gravacao_json = array($array_json);
                                    $salvar_arquivo = $primeira_gravacao_json;
                                }
                                else{
                                    $dados_json_antigos = json_decode(file_get_contents("beneficiarios.json"));

                                    array_push($dados_json_antigos, $array_json);

                                    $salvar_arquivo = $dados_json_antigos;
                                }

                                if(!file_put_contents("beneficiarios.json", json_encode($salvar_arquivo, JSON_PRETTY_PRINT), LOCK_EX)){
                                    $erro = "Erro ao salvar mensagem, tente de novo";

                                }
                                else{
                                    $sucesso = "Informações gravadas com sucesso!";
                                }
                            }
               
                            ?>
                        </select>
                        </table>
 
                        </form>
        </div>
    </section>
</body>

</html>