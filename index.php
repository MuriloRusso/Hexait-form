<!DOCTYPE html>

<html lang="pt-br">

	<head>
		
		
<!--		links redes sociais -->
		
		
		<meta property="og:type" content="website" />
		
		<meta property="og:title" content="Hexait" />
		
		<meta property="og:description" content="" />
		
		<meta property="og:image" itemprop="image" content="" />
		
		<meta property="og:image:width" content="1200" />
		
		<meta property="og:image:height" content="630" />
		
		<meta property="og:locale" content="pt_BR" />
		
		<meta property="og:url" content="" />

<!--		------------------->
		
		<title>Hexait</title>
	

		<link rel="stylesheet" type="text/css" href="style.css" media="screen" />
		
		<meta name="viewport" content="width=device-width, initial-scale=1">		
		
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="iso-8859-1">
		
        <meta name="description" content="Descrição">
			
		<meta name="author" content="2UP">
				
		<meta name="robots" content="index,follow">
		
		
		

		
<!--		favicon-->
		
<link rel="icon" href="https://www.hexait.com.br/wp-content/uploads/2021/05/cropped-Icone-Web-HexaIT-32x32.png" sizes="32x32">
		
		
		
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>

		

         <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

	</head>
	
	<body>

        <div class="container row flex-wrap">		

            <header>

                <img alt="Hexait" src="img/logo-hexait.png">

            </header>

            <section>

                <h6>Agende uma reunião</h6>

                <h1>Reúna-se com seu especialista em segurança da Fortinet</h1>

                <div class="details">

                    <h2>DETALHES</h2>

                    <p>Preencha o formulário e clique em enviar para escolher o horário mais adequado para agendar uma reunião com nosso especialista.<br>
                        Você receberá um convite de calendário imediatamente após a reserva de agenda e o nosso consultor de segurança da Fortinet ligará para você.</p>

                </div>

            </section>

            <section>

                <form action="" method="post" class="row flex-wrap">

                    <?php   

                        error_reporting(0);

                        if(isset($_POST['nome'])){

                            $nome = $_POST['nome'];
                            $sobrenome = $_POST['sobrenome'];
                            $email = $_POST['email'];
                            $organizacao = $_POST['organizacao'];
                            $pais = $_POST['pais'];
                            $cargo = $_POST['cargo'];
                            $EmployeeSize = $_POST['EmployeeSize'];	
                            $telefone = $_POST['telefone'];
                            $tema = $_POST['tema'];
                            

                            // $data_envio = date('d/m/Y');
                            $data_envio = date('Y-m-d');
                            $hora_envio = date('H:i:s');


                            //Guardar informações preenchidas no banco de dados

                            $usuario = 'formhexait';
                            $senha = 'H7667@ngeL';
                            $database = 'formhexait';
                            $host = 'formhexait.mysql.dbaas.com.br';


                            $mysqli = new mysqli($host, $usuario, $senha, $database);

                            if($mysqli->error){

                                die('Falha ao conectar ao banco de dados');

                            }


                            $sql_code = "INSERT INTO agendamento_reuniao (nome, sobrenome, email, organizacao, pais, cargo, EmployeeSize, telefone, tema, data_envio, hora_envio) VALUES ('{$nome}', '{$sobrenome}', '{$email}', '{$organizacao}', '{$pais}', '{$cargo}', '{$EmployeeSize}', '{$telefone}', '{$tema}', '{$data_envio}', '{$hora_envio}')";

                            $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL" . $mysqli->error);		

                            // header("Location: index.html");

                            //---------------------


                            require 'PHPMailer-master/PHPMailerAutoload.php';

                            $mail = new PHPMailer;
                            $mail->isSMTP();

                            $mail->Host = "email-ssl.com.br";
                            $mail->Port = "465";
                            $mail->SMTPSecure = "ssl";
                            $mail->SMTPAuth = "true";
                            $mail->Username = "no-reply@hexait.com.br";
                            $mail->Password = "H7667@ngeL";


                            $mail->setFrom($mail->Username, 'Hexait'); //remetente

                            // $mail->addAddress('juridico@hexait.com.br');
                            $mail->addAddress('contato@murilorusso.com.br');

                            $mail->Subject = 'Agendamento Reunião';

                            $mail->Subject = '=?UTF-8?B?'.base64_encode($mail->Subject).'?=';


                            $conteudo_email = " 
                            
                            <strong>Nome: </strong><br> $nome <br> <br>

                            <strong>Sobrenome: </strong><br> $sobrenome <br> <br>
                            
                            <strong>E-mail: </strong><br> $email <br> <br>

                            <strong>Organização:</strong> <br> $organizacao  <br> <br>

                            <strong>Pais:</strong> <br> $pais  <br> <br>

                            <strong>Cargo:</strong> <br> $cargo  <br> <br>

                            <strong>EmployeeSize:</strong> <br> $EmployeeSize  <br> <br>

                            <strong>Telefone: </strong><br> $telefone <br> <br>

                            <strong>tema:/strong> <br> $tema  <br> <br>


                            <br><br><br>
                            Este e-mail foi enviado em $data_envio às $hora_envio <br>

                            ";


                            $conteudo_email = utf8_decode($conteudo_email);

                            $mail->IsHTML(true);
                            $mail->Body = $conteudo_email;


                            

                            if($mail->send()){
                                
                        // 		$mail->ClearAllRecipients();
                                
                        // 		// $mail->addAddress('diretoria@hexait.com.br');
                        // //		$mail->addAddress('murilo@2up.com.br');
                                
                        // 		$mail->send();
                                
                                
                                
                                // header("Location: index.html?alert=sucess");

                                print '<div class="alert alert-success text-center w-100">'.$nome.', Seu Registro foi Enviado com Sucesso, Obrigado!</div>
                                
                                
                                <a class="btn" href="index.php">Novo Registro</a>';
                                
                                $_POST['nome'] = '';
        
                            }

                            else{
                                
                                // header("Location: index.html?alert=error".$mail->ErrorInfo);

                                print '<div class="alert alert-error text-center w-100">Erro: '.$mail->ErrorInfo.'</div>';
                                
                            }

                        }

                        else{


                    ?>

                    <p class=" text-center"><strong>Registre-se para selecionar um horário para a reunião.</strong></p>

                    <div class="form-group">

                        <label for="nome">Nome *</label>
                        <input type="text" name="nome" id="nome" required>

                    </div>

                    <div class="form-group">

                        <label for="sobrenome">Sobrenome *</label> 
                        <input type="text" name="sobrenome" id="sobrenome" required>

                    </div>

                    <div class="form-group">

                        <label for="email">E-mail *</label>
                        <input type="email" name="email" id="email" required>

                    </div>

                    <div class="form-group">

                        <label for="organizacao">Organização *</label>
                        <input type="text" name="organizacao" id="organizacao" required>

                    </div>


                    <div class="form-group">

                        <label for="pais">Pais *</label>
                        <select name="pais" id="pais" required>
                            <option value="">--Selecione uma opção--</option>
                            <option value="Afghanistan">Afeganistão</option>
                            <option value="South Africa">África do Sul</option>
                            <option value="Albania">Albânia</option>
                            <option value="Germany">Alemanha</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antártica</option>
                            <option value="Antigua and Barbuda">Antígua e Barbuda</option>
                            <option value="Netherlands Antilles">Antilhas Holandesas</option>
                            <option value="Saudi Arabia">Arábia Saudita</option>
                            <option value="Algeria">Argélia</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armênia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Austrália</option>
                            <option value="Austria">Áustria</option>
                            <option value="Azerbaijan">Azerbaijão</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Bélgica</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermudas</option>
                            <option value="Bolivia">Bolívia</option>
                            <option value="Bosnia and Herzegovina">Bósnia e Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Brazil">Brasil</option>
                            <option value="Brunei">Brunei</option>
                            <option value="Bulgaria">Bulgária</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Bhutan">Butão</option>
                            <option value="Cape Verde">Cabo Verde</option><option value="Cameroon">Camarões</option><option value="Cambodia">Camboja</option><option value="Jersey">camisola</option><option value="Canada">Canadá</option><option value="Qatar">Catar</option><option value="Kazakhstan">Cazaquistão</option><option value="Central African Republic">Central Africano República</option><option value="Chad">Chade</option><option value="Chile">Chile</option><option value="China">China</option><option value="Cyprus">Chipre</option><option value="Singapore">Cingapura</option><option value="West Bank">Cisjordânia</option><option value="Colombia">Colômbia</option><option value="Comoros">Comores</option><option value="South Korea">Coreia do Sul</option><option value="Cote D'Ivoire">Costa do Marfim</option><option value="Costa Rica">Costa Rica</option><option value="Croatia">Croácia</option><option value="Cuba">Cuba</option><option value="Curaçao">Curaçao</option><option value="Denmark">Dinamarca</option><option value="Djibouti">Djibouti</option><option value="Dominica">Dominica</option><option value="Egypt">Egito</option><option value="El Salvador">El Salvador</option><option value="United Arab Emirates">Emirados Árabes Unidos</option><option value="Ecuador">Equador</option><option value="Eritrea">Eritrea</option><option value="Slovakia">Eslováquia</option><option value="Slovenia">Eslovenia</option><option value="Spain">Espanha</option><option value="United States">Estados Unidos</option><option value="Estonia">Estônia</option><option value="Ethiopia">Etiópia</option><option value="Gaza Strip">faixa de Gaza</option><option value="Fiji">Fiji</option><option value="Philippines">Filipinas</option><option value="Finland">Finlândia</option><option value="France">França</option><option value="Gabon">Gabão</option><option value="Gambia">Gâmbia</option><option value="Ghana">Gana</option><option value="Georgia">Georgia</option><option value="Gibraltar">Gibraltar</option><option value="Greece">Grécia</option><option value="Grenada">Grenada</option><option value="Greenland">Groenlândia</option><option value="Guam">Guam</option><option value="Guatemala">Guatemala</option><option value="Guyana">Guiana</option><option value="Guinea">Guiné</option><option value="Equatorial Guinea">Guiné Equatorial</option><option value="Guinea-Bissau">Guiné-Bissau</option><option value="Haiti">Haiti</option><option value="Honduras">Honduras</option><option value="Hong Kong">Hong Kong</option><option value="Hungary">Hungria</option><option value="Yemen">Iémen</option><option value="Christmas Island">Ilha do Natal</option><option value="Norfolk Island">Ilha Norfolk</option><option value="Cayman Islands">Ilhas Cayman</option><option value="Cocos Islands">Ilhas Cocos</option><option value="Cook Islands">Ilhas Cook</option><option value="Falkland Islands">Ilhas Falkland</option><option value="Faroe Islands">ilhas Faroe</option><option value="Northern Mariana Islands">Ilhas Marianas do Norte</option><option value="Mashall Islands">Ilhas Marshall</option><option value="Pitcairn Islands">Ilhas Pitcairn</option><option value="Solomon Islands">Ilhas Salomão</option><option value="Turks and Caicos Islands">Ilhas Turks e Caicos</option><option value="British Virgin Islands">Ilhas Virgens Britânicas</option><option value="US Virgin Islands">Ilhas Virgens dos EUA</option><option value="India">Índia</option><option value="Indonesia">Indonésia</option><option value="Iran, Islamic Republic of">Irã</option><option value="Iraq">Iraque</option><option value="Ireland">Irlanda</option><option value="Iceland">Islândia</option><option value="Isle of Man">Isle of Man</option><option value="Israel">Israel</option><option value="Italy">Itália</option><option value="Jamaica">Jamaica</option><option value="Japan">Japão</option><option value="Jordan">Jordânia</option><option value="Kiribati">Kiribati</option><option value="Kosovo">Kosovo</option><option value="Kuwait">Kuweit</option><option value="Laos">Laos</option><option value="Lesotho">Lesoto</option><option value="Latvia">Letônia</option><option value="Lebanon">Líbano</option><option value="Liberia">Libéria</option><option value="Libya">Líbia</option><option value="Liechtenstein">Liechtenstein</option><option value="Lithuania">Lituânia</option><option value="Luxembourg">Luxemburgo</option><option value="Macau">Macau</option><option value="Republic of North Macedonia">Macedónia</option><option value="Madagascar">Madagáscar</option><option value="Malaysia">Malásia</option><option value="Malawi">Malavi</option><option value="Maldives">Maldivas</option><option value="Mali">Mali</option><option value="Malta">Malta</option><option value="Morocco">Marrocos</option><option value="Mauritania">Mauritânia</option><option value="Mauritius">Mauritius</option><option value="Mayotte">Mayotte</option><option value="Mexico">México</option><option value="Micronesia">Micronesia</option><option value="Mozambique">Moçambique</option><option value="Moldova, Republic of">Moldova</option><option value="Monaco">Monaco</option><option value="Mongolia">Mongólia</option><option value="Montenegro">Montenegro</option><option value="Montserrat">Montserrat</option><option value="Myanmar">Myanmar</option><option value="Namibia">Namíbia</option><option value="Nauru">Nauru</option><option value="Nepal">Nepal</option><option value="Nicaragua">Nicarágua</option><option value="Niger">Níger</option><option value="Nigeria">Nigéria</option><option value="Niue">Niue</option><option value="Norway">Noruega</option><option value="New Caledonia">Nova Caledônia</option><option value="New Zealand">Nova Zelândia</option><option value="Oman">Omã</option><option value="Netherlands">Países Baixos</option><option value="Palau">Palau</option><option value="Palestine, State of">Palestina</option><option value="Panama">Panamá</option><option value="Papua New Guinea">Papua Nova Guiné</option><option value="Pakistan">Paquistão</option><option value="Paraguay">Paraguai</option><option value="Peru">Peru</option><option value="French Polynesia">Polinésia Francesa</option><option value="Poland">Polônia</option><option value="Portugal">Portugal</option><option value="Puerto Rico">Puerto Rico</option><option value="Kenya">Quênia</option><option value="Kyrgyzstan">Quirguistão</option><option value="United Kingdom">Reino Unido</option><option value="Czech Republic">República Checa</option><option value="Congo, The Democratic Republic Of The">República Democrática do Congo</option><option value="Congo">República do Congo</option><option value="Dominican Republic">República Dominicana</option><option value="Romania">Romênia</option><option value="Rwanda">Ruanda</option><option value="Russian Federation">Rússia</option><option value="Western Sahara">Saara Ocidental</option><option value="Saint Martin">Saint Martin</option><option value="Saint Pierre and Miquelon">Saint Pierre e Miquelon</option><option value="Samoa">Samoa</option><option value="American Samoa">Samoa Americana</option><option value="San Marino">San Marino</option><option value="Saint Helena">Santa Helena</option><option value="Saint Lucia">Santa Lúcia</option><option value="Holy See (Vatican City State)">Santa Sé</option><option value="Saint Barthélemy">São Barth_lemy</option><option value="Saint Kitts and Nevis">São Cristóvão e Nevis</option><option value="Sao Tome and Principe">São Tomé e Príncipe</option><option value="Saint Vincent and the Grenadines">São Vicente e Granadinas</option><option value="Senegal">Senegal</option><option value="Sierra Leone">Serra Leoa</option><option value="Serbia">Sérvia</option><option value="Seychelles">Seychelles</option><option value="Syrian Arab Republic">Síria</option><option value="Somalia">Somália</option><option value="Sri Lanka">Sri Lanka</option><option value="Swaziland">Suazilândia</option><option value="Sudan">Sudão</option><option value="South Sudan">Sudão do Sul</option><option value="Sweden">Suécia</option><option value="Switzerland">Suíça</option><option value="Suriname">Suriname</option><option value="Svalbard and Jan Mayen">Svalbard</option><option value="Thailand">Tailândia</option><option value="Taiwan">Taiwan</option><option value="Tajikistan">Tajiquistão</option><option value="Tanzania, United Republic of">Tanzânia</option><option value="British Indian Ocean Territory">Território Britânico do Oceano Índico</option><option value="Timor-Leste">Timor-Leste</option><option value="Togo">Togo</option><option value="Tokelau">Tokelau</option><option value="Tonga">Tonga</option><option value="Trinidad and Tobago">Trinidad e Tobago</option><option value="Tunisia">Tunísia</option><option value="Turkmenistan">Turquemenistão</option><option value="Turkey">Turquia</option><option value="Tuvalu">Tuvalu</option><option value="Ukraine">Ucrânia</option><option value="Uganda">Uganda</option><option value="Uruguay">Uruguai</option><option value="Uzbekistan">Uzbequistão</option><option value="Vanuatu">Vanuatu</option><option value="Venezuela">Venezuela</option><option value="Vietnam">Vietnã</option><option value="Wallis and Futuna">Wallis e Futuna</option><option value="Zambia">Zâmbia</option><option value="Zimbabwe">Zimbábue</option>
                        </select>
                    </div>


                    <div class="form-group">

                        <label for="cargo">Cargo *</label>
                        <select name="cargo" id="cargo" required>
                            <option value="">--Selecione uma opção--</option>
                            <option value="C-Level">C-Level</option>
                            <option value="Director">Diretor</option>
                            <option value="Manager">Gerente</option>
                            <option value="Engineer/Architect">Engenheiro/Arquiteto</option>
                            <option value="Admin/Analyst">Administrador/Analista</option>
                            <option value="Individual Contributor">Colaborador</option>
                            <option value="Self-employed">Autônomo</option>
                            <option value="VP">VP</option>
                            <option value="Other">Outro</option>
                        </select>

                    </div>


                    <div class="form-group">

                        <label for="EmployeeSize">Número de empregados</label>
                        <select name="EmployeeSize">
                            <option value="">--Selecione uma opção--</option>
                            <option value="1-10">1-10</option>
                            <option value="11-100">11-100</option>
                            <option value="101-250">101-250</option>
                            <option value="251-500">251-500</option>
                            <option value="501-1000">501-1000</option>
                            <option value="1001-2500">1001-2500</option>
                            <option value="2501-4999">2501-4999</option>
                            <option value="5000+">5000+</option>
                        </select>
                        

                    </div>

                    <div class="form-group">

                        <label for="telefone">Telefone *</label>
                        <input type="text" name="telefone" id="telefone" required>

                    </div>

                    <div class="form-group w-100">

                        <label for="tema">Sobre qual tema gostaria de falar na reunião? *</label>
                        <input type="text" name="tema" id="tema" required>

                    </div>

                    <div class="form-group w-100 accept">

                        <div class="row baseline">

                            <input type="checkbox" name="explicitConsent1" id="fe22328" required>

                            <label for="fe22328">Aceito receber comunicações promocionais (que podem incluir telefone, e-mail e mídias sociais) da Fortinet. Entendo que posso desativar proativamente as comunicações com a Fortinet a qualquer momento.</label>
                        
                        </div>

                    </div>

                    <div class="form-group">

                        <input type="submit" value="Enviar">

                    </div>

                    <!-- <p>By clicking submit, I agree to the use of my personal information in accordance with Fortinet's <a href="" target="_blank">Privacy Policy</a>.</p> -->

                    <?php

                        }

                    ?>

                </form>



            </section>
		

        </div>


        <footer>

            <div class="row container space-betwen">

                <div id="copyright">Copyright © 
                    <span id="current-year">2023</span> 
                    Fortinet, Inc. All Rights Reserved. | <a href="#">Terms of Service</a> | 
                    <a href="#">Privacy Policy</a> | 
                    <a href="#">Contact Us</a>
                </div>

                <!-- <div> -->

                    <div id="social-share">
                        <a href="#" target="_blank"><span class="fab fa-facebook-f">&nbsp;</span></a> 
                        <a href="#" target="_blank"><span class="fab fa-twitter">&nbsp;</span></a> 
                        <a href="#" target="_blank"><span class="fab fa-youtube">&nbsp;</span></a> 
                        <a href="#" target="_blank"><span class="fab fa-linkedin">&nbsp;</span></a> 
                        <a href="#" target="_blank"><span class="fab fa-instagram">&nbsp;</span></a> 
                        <a href="#" target="_blank"><span class="fa fa-rss">&nbsp;</span></a>
                    </div>

                <!-- </div> -->

            </div>

            <div class="container" id="terms">
                <p>TERMS AND CONDITIONS.</p>
                
                <p>NO PURCHASE NECESSARY. Void where prohibited by law. Recipient must be of the legal age of majority where the recipient resides, a legal U.S. resident, and not: an employee of Fortinet, a Fortinet reseller or partner, a consultant, a Fortinet competitor, or a government affiliate. To receive the gift you must: (a) be an IT professional currently employed at a company, who is not a current Fortinet end customer, with at least 250 employees, (b) complete the phone or in-person meeting with a Fortinet Account Executive, and (c) sign Fortinet's Product Awareness Gift Acknowledgement Form. The initial conversation will be conducted by a Fortinet Business Development Representative to qualify the need prior to scheduling.</p>
                
                <p>By scheduling the call and by receiving any gift, recipient certifies, acknowledges and agrees that:(1) the products listed are not provided in exchange for new or continued business or any improper benefit, and (2) the products are being provided to the recipient's company for a legitimate business purchase and not to an individual for an individual's benefit. Further, recipient represents and warrants that (a) the gift is in compliance with and not in violation of recipient's company policies, and (b) recipient is not a government entity or affiliate.</p>
                </div>


        </footer>

		<script>

            $( '#telefone').mask('(99) 99999-9999');

        </script>
		
	</body>
	

</html>