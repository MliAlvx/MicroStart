<?php
    session_start();
    extract($_REQUEST, EXTR_OVERWRITE);

    if($nome != "" && $sobrenome != "" && $data_nasc != "" && $cnpj != "" && $ramo != "" && $email != "" && $senha != "" && $ddd1 != "" && $tel1 != "" && $cep != "" && $numero != "") {
        require_once("../model/Cliente.php");
        require_once("../model/ClienteDao.php");
        
        $cliente = new Cliente();

        //tabela cliente
        $cliente->setNome($nome);
        $cliente->setSobrenome($sobrenome);
        $cliente->setDataNasc($data_nasc);
        $cliente->setCnpj($cnpj);
        $cliente->setRamo($ramo);
        $cliente->setEmail($email);
        $cliente->setSenha($senha);

        //tabela telefone
        $cliente->setDDD1($ddd1);
        $cliente->setTelefone1($tel1);
        $cliente->setDDD2($ddd2);
        $cliente->setTelefone2($tel2);

        //tabela endereco
        $cliente->setCep($cep);

        // tabela con_endereco
        $cliente->setNumero($numero);
        $cliente->setComplemento($complemento);

        $clienteDao = new ClienteDao();

        if($clienteDao->verificarEmailCnpj($cliente) == 'certo')
        {
            if($clienteDao->verificarTel($cliente) == 'certo')
            {
                $clienteDao->create($cliente);

                echo " <script>
                            alert('Usuario Cadastrado');

                            window.location.href = '../view/loginCli.php';
                        </script>";
            
            }
        }

    } else {
        echo " <script>
                    alert('Preencha todos os dados de cadastro');

                    window.location.href = '../view/cadastrarCli.php';
                </script>";
    }
?>