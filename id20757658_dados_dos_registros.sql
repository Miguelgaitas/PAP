-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Fev-2024 às 22:17
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `id20757658_dados_dos_registros`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'Placas Arduino'),
(2, 'Sensores'),
(3, 'Atuadores'),
(4, 'Módulos de Comunicação'),
(5, 'Outros Componentes'),
(7, 'bombas de agua');

-- --------------------------------------------------------

--
-- Estrutura da tabela `componentes`
--

CREATE TABLE `componentes` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `quantidade_utilizada` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `componentes`
--

INSERT INTO `componentes` (`id`, `nome`, `quantidade_utilizada`) VALUES
(1, 'Arduino Uno', 5),
(2, 'Arduino Mega', 0),
(3, 'Arduino Nano', 0),
(4, 'Arduino Pro Mini', 0),
(5, 'Arduino Leonardo', 0),
(6, 'Sensor de temperatura', 0),
(7, 'Sensor de luz', 0),
(8, 'Sensor de movimento (PIR)', 0),
(9, 'Acelerômetro', 0),
(10, 'Giroscópio', 0),
(11, 'Câmera OV7670', 0),
(12, 'Sensor de umidade do solo', 0),
(13, 'Módulo de reconhecimento de voz', 0),
(14, 'Módulo RFID', 0),
(15, 'Sensor de batimentos cardíacos', 0),
(16, 'Módulo de temperatura e umidade (DHT)', 0),
(17, 'Módulo de detecção de chama', 0),
(18, 'Sensor de distância ultrassônico', 0),
(19, 'Módulo de reconhecimento facial', 0),
(20, 'Módulo de detecção de som', 0),
(21, 'Módulo de detecção de umidade do solo', 0),
(22, 'Módulo de sensor de cor', 0),
(23, 'Módulo de detecção de obstáculos (ultrassônico)', 0),
(24, 'Servo Motor', 0),
(25, 'Motor de passo', 0),
(26, 'Motor DC', 0),
(27, 'Módulo Bluetooth', 0),
(28, 'Módulo Wi-Fi', 0),
(29, 'Módulo GPS', 0),
(30, 'Módulo de comunicação LoRa', 0),
(31, 'Módulo GSM/GPRS', 0),
(32, 'Módulo Ethernet', 0),
(33, 'Módulo CAN', 0),
(34, 'Resistor', 4),
(35, 'LED', 3),
(36, 'Potenciômetro', 0),
(37, 'Display LCD', 0),
(38, 'Buzzer', 1),
(39, 'Display de 7 segmentos', 0),
(40, 'Módulo de relé', 0),
(41, 'Módulo de relógio em tempo real (RTC)', 0),
(42, 'Módulo de detecção de obstáculos (IR)', 0),
(43, 'Módulo de controle remoto IR', 0),
(44, 'Módulo de monitoramento de bateria', 0),
(45, 'Módulo de detecção de vibração', 0),
(46, 'Módulo de acionamento de carga', 0),
(96, 'LED RGB', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `componentes_categorias`
--

CREATE TABLE `componentes_categorias` (
  `id` int(11) NOT NULL,
  `componente_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `componentes_categorias`
--

INSERT INTO `componentes_categorias` (`id`, `componente_id`, `categoria_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1),
(4, 4, 1),
(5, 5, 1),
(6, 6, 2),
(7, 7, 2),
(8, 8, 2),
(9, 9, 2),
(10, 10, 2),
(11, 11, 2),
(12, 12, 2),
(13, 13, 2),
(14, 14, 2),
(15, 15, 2),
(16, 16, 2),
(17, 17, 2),
(18, 18, 2),
(19, 19, 2),
(20, 20, 2),
(21, 21, 2),
(22, 22, 2),
(23, 23, 2),
(24, 24, 2),
(25, 25, 3),
(26, 26, 3),
(27, 27, 3),
(28, 28, 4),
(29, 29, 4),
(30, 30, 4),
(31, 31, 4),
(32, 32, 4),
(33, 33, 4),
(34, 34, 4),
(35, 35, 5),
(36, 36, 5),
(37, 37, 5),
(38, 38, 5),
(39, 39, 5),
(40, 40, 5),
(41, 41, 5),
(42, 42, 5),
(43, 43, 5),
(44, 44, 5),
(45, 45, 5),
(46, 46, 5),
(52, 96, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `lojas`
--

CREATE TABLE `lojas` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `cidade` varchar(255) NOT NULL,
  `codigo_postal` varchar(8) NOT NULL,
  `telefone` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `lojas`
--

INSERT INTO `lojas` (`id`, `nome`, `endereco`, `cidade`, `codigo_postal`, `telefone`) VALUES
(1, 'Aquário Electrónica', 'R. Dr. Júlio de Matos 65', 'Porto', '4200-356', '225072810'),
(5, 'arduino code master', 'rua santa luzia 804', 'Porto', '4250-415', '969230067');

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja_componente`
--

CREATE TABLE `loja_componente` (
  `id` int(11) NOT NULL,
  `loja_id` int(11) DEFAULT NULL,
  `componente_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `loja_componente`
--

INSERT INTO `loja_componente` (`id`, `loja_id`, `componente_id`) VALUES
(1, 1, 1),
(5, 1, 96);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) DEFAULT NULL,
  `pergunta` text DEFAULT NULL,
  `data_publicacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `autor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `perguntas`
--

INSERT INTO `perguntas` (`id`, `titulo`, `pergunta`, `data_publicacao`, `autor_id`) VALUES
(23, 'buzzer', 'preciso de saber oque é um buzzer ?', '2024-01-23 09:45:13', 44),
(24, 'led ', 'oque é um led\r\n', '2024-01-23 09:46:22', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos_arduino`
--

CREATE TABLE `projetos_arduino` (
  `id` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `codigo` text NOT NULL,
  `simula` text DEFAULT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pendente',
  `prazo_edicao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `projetos_arduino`
--

INSERT INTO `projetos_arduino` (`id`, `autor`, `nome`, `descricao`, `imagem`, `codigo`, `simula`, `status`, `prazo_edicao`) VALUES
(1, 1, 'Nivel 1: Led Que Pisca ', 'O código fornecido é um exemplo simples que demonstra como fazer um LED piscar utilizando um Arduino. Vamos descrever passo a passo o que o código faz:\r\n\r\nPasso 1: Configuração inicial\r\nNo início do programa, temos a função void setup(). Esta função é executada apenas uma vez e é usada para configurar o ambiente inicial do Arduino. Neste caso, temos a instrução pinMode(13, OUTPUT), que define o pino 13 como uma saída, indicando que iremos utilizar esse pino para enviar um sinal de saída.\r\n\r\nPasso 2: Loop principal\r\nApós a configuração inicial, entramos na função void loop(), que será executada continuamente. Nesta função, temos as seguintes etapas:\r\n\r\nPasso 3: Ligar o LED\r\nUtilizando a instrução digitalWrite(13, HIGH), definimos o pino 13 como \"HIGH\", o que significa que estamos a ligar o LED conectado a esse pino. Isso faz com que o LED acenda.\r\n\r\nPasso 4: Pausa\r\nCom a instrução delay(1000), o programa faz uma pausa de 1000 milissegundos (1 segundo). Durante esse tempo, o LED permanece aceso.\r\n\r\nPasso 5: Desligar o LED\r\nUtilizando a instrução digitalWrite(13, LOW), definimos o pino 13 como \"LOW\", o que significa que estamos a desligar o LED conectado a esse pino. Isso faz com que o LED apague.\r\n\r\nPasso 6: Pausa\r\nNovamente, o programa faz uma pausa de 1000 milissegundos (1 segundo) com a instrução delay(1000). Durante esse tempo, o LED permanece apagado.\r\n\r\nO código retorna ao início da função loop() e repete os passos de ligar e desligar o LED, criando assim um efeito contínuo de piscar.\r\n\r\nEm resumo, o código configura o pino 13 como saída e alterna entre ligar e desligar o LED conectado a esse pino com intervalos de 1 segundo, resultando num efeito de piscar visível no LED. Este é um exemplo básico que ilustra o uso das funções pinMode(), digitalWrite() e delay(), que são comuns ao trabalhar com Arduino.', 'Copy of LED que Pisca.png', 'void setup()\r\n{\r\n  pinMode(13, OUTPUT);\r\n}\r\n\r\nvoid loop()\r\n{\r\n  digitalWrite(13, HIGH);\r\n  delay(1000); // Wait for 1000 millisecond(s)\r\n  digitalWrite(13, LOW);\r\n  delay(1000); // Wait for 1000 millisecond(s)\r\n}', '<iframe width=\"560\" height=\"350\" src=\"https://www.tinkercad.com/embed/dbLWSh0cXiv?editbtn=1\" frameborder=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>', 'verificado', NULL),
(2, 1, 'Nivel 2: 3 Leds A Piscar', '1. Declaração de variáveis: No início do programa, são criadas três variáveis chamadas ledverde, ledamarelo e ledvermelho. Cada uma dessas variáveis está associada a um número que representa o pino onde um LED está conectado no Arduino (10, 9 e 8, respetivamente).\n\n2. Configuração dos pinos: Na função setup(), é dito ao Arduino que os pinos associados aos LEDs devem ser usados para enviar energia elétrica aos LEDs. Isto é feito com a função pinMode().\n\n3. Loop principal: Na função loop(), o seguinte acontece repetidamente:\nLigar os LEDs: Todos os LEDs (verde, amarelo e vermelho) são acesos simultaneamente. Isso é feito definindo os pinos correspondentes como \"HIGH\", o que faz com que os LEDs se acendam.\nEsperar um pouco: Após acender os LEDs, o programa faz uma pausa de 500 milissegundos (meio segundo). Durante esse tempo, os LEDs permanecem acesos.\nDesligar os LEDs: Em seguida, todos os LEDs são apagados, definindo os pinos como \"LOW\". Isso faz com que os LEDs se apaguem.\nEsperar mais um pouco: O programa faz uma pausa adicional de 500 milissegundos antes de repetir o ciclo.\n\n4. Repetição infinita: Esse ciclo (ligar, esperar, apagar, esperar) é repetido continuamente na função loop(). Como resultado, os LEDs conectados aos pinos 10, 9 e 8 do Arduino piscam intermitentemente, com um intervalo de meio segundo entre cada piscar, e esse padrão de piscar se repete indefinidamente enquanto o programa estiver em execução.', 'Copy of Execício5 3 leds a piscar  .png', 'int ledverde=10;\r\nint ledamarelo=9;\r\nint ledvermelho=8;\r\nvoid setup()\r\n{\r\n  pinMode(ledverde,OUTPUT);\r\n  pinMode(ledamarelo,OUTPUT);\r\n  pinMode(ledvermelho,OUTPUT);\r\n}\r\n\r\nvoid loop()\r\n{\r\n  digitalWrite(ledverde,HIGH);\r\n  digitalWrite(ledamarelo,HIGH);\r\n  digitalWrite(ledvermelho,HIGH);\r\n  delay(500);\r\n  digitalWrite(ledverde,LOW);\r\n  digitalWrite(ledamarelo,LOW);\r\n  digitalWrite(ledvermelho,LOW);\r\n  delay(500); \r\n}', '<iframe width=\"560\" height=\"350\" src=\"https://www.tinkercad.com/embed/9UL0sgFWnCM?editbtn=1\" frameborder=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>', 'verificado', NULL),
(3, 1, 'Nivel 3: Varios Leds A Piscar em sequencia', '1. Declaração de variáveis: No início do programa, são declaradas várias variáveis, cada uma associada a um LED e ao tempo de espera entre cada aceso e apagado. Os LEDs são numerados de 1 a 8, e o tempo entre cada aceso e apagado é definido como 100 milissegundos.\n\n2. Configuração dos pinos: Na função setup(), são configurados os pinos do Arduino para os LEDs. Isso é feito com a função pinMode(). Cada pino é configurado como saída, o que significa que irá fornecer energia elétrica aos LEDs para que eles possam acender.\n\n3. Loop principal: Na função loop(), o seguinte acontece repetidamente:\nAceso de LEDs em sequência: Os LEDs são acesos sequencialmente do 1 ao 8. Isso é feito através do uso da função digitalWrite(), que define o pino do LED como \"HIGH\", fazendo com que o LED acenda.\nEspera um pouco: Após acender cada LED, o programa faz uma pausa de 100 milissegundos (0,1 segundos) utilizando a função delay(tempo).\nApagar dos LEDs em sequência: Após a pausa, o programa apaga o LED atual definindo o pino correspondente como \"LOW\". Isso faz com que o LED se apague.\nEspera mais um pouco: O programa faz outra pausa de 100 milissegundos antes de avançar para o próximo LED na sequência.\n\n4. Repetição infinita: Este ciclo (aceso, esperar, apagar, esperar) é repetido continuamente na função loop(). Como resultado, os LEDs numerados de 1 a 8 acendem sequencialmente, um de cada vez, com um intervalo de 100 milissegundos entre cada aceso e apagado. Este padrão repete-se indefinidamente enquanto o programa estiver em execução.', 'Copy of Piscar Leds.png', 'int led1 = 2;\r\nint led2 = 3;\r\nint led3 = 4;\r\nint led4 = 5;\r\nint led5 = 6;\r\nint led6 = 7;\r\nint led7 = 8;\r\nint led8 = 9;\r\nint tempo = 100;\r\n\r\nvoid setup()\r\n{\r\n  pinMode(led1, OUTPUT);\r\n  pinMode(led2, OUTPUT);\r\n  pinMode(led3, OUTPUT);\r\n  pinMode(led4, OUTPUT);\r\n  pinMode(led5, OUTPUT);\r\n  pinMode(led6, OUTPUT);\r\n  pinMode(led7, OUTPUT);\r\n  pinMode(led8, OUTPUT);\r\n}\r\n\r\nvoid loop()\r\n{\r\n  digitalWrite(led1, HIGH);\r\n  delay(tempo);\r\n  digitalWrite(led1, LOW);\r\n  delay(tempo);\r\n  digitalWrite(led2, HIGH);\r\n  delay(tempo);\r\n  digitalWrite(led2, LOW);\r\n  delay(tempo);\r\n  digitalWrite(led3, HIGH);\r\n  delay(tempo);\r\n  digitalWrite(led3, LOW);\r\n  delay(tempo);\r\n  digitalWrite(led4, HIGH);\r\n  delay(tempo);\r\n  digitalWrite(led4, LOW);\r\n  delay(tempo);\r\n  digitalWrite(led5, HIGH);\r\n  delay(tempo);\r\n  digitalWrite(led5, LOW);\r\n  delay(tempo);\r\n  digitalWrite(led6, HIGH);\r\n  delay(tempo);\r\n  digitalWrite(led6, LOW);\r\n  delay(tempo);\r\n  digitalWrite(led7, HIGH);\r\n  delay(tempo);\r\n  digitalWrite(led7, LOW);\r\n  delay(tempo);\r\n  digitalWrite(led8, HIGH);\r\n  delay(tempo);\r\n  digitalWrite(led8, LOW);\r\n  delay(tempo);\r\n}', '<iframe width=\"560\" height=\"350\" src=\"https://www.tinkercad.com/embed/kCXIQXgtfdZ?editbtn=1\" frameborder=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>', 'verificado', NULL),
(28, 36, 'Buzzer que toca', '\r\nConfiguração Inicial (Setup):\r\n\r\nA função void setup() executa-se uma vez ao ligar ou reiniciar o Arduino.\r\npinMode(9, OUTPUT);: Configura o pino digital 9 como saída, para enviar sinais elétricos.\r\nbeep(100);, beep(200);, beep(300);: Gera três bips com diferentes durações usando a função beep().\r\ndelay(5000);: Aguarda 5 segundos.\r\nLoop Principal (Loop):\r\n\r\nA função void loop() executa-se continuamente após a configuração inicial.\r\nbeep(1000);: Gera um bip mais longo a cada iteração do loop.\r\nFunção Beep:\r\n\r\nvoid beep(unsigned char delayms): Função personalizada para gerar bips.\r\nanalogWrite(9, 200);: Ativa o pino 9 com intensidade de 200 (0 a 255), gerando som.\r\ndelay(delayms);: Aguarda a duração especificada em milissegundos.\r\nanalogWrite(9, 0);: Desativa o som.\r\ndelay(delayms);: Aguarda novamente antes de retornar.\r\nNota:\r\n\r\nEste código usa analogWrite() para gerar som no pino 9, criando um efeito de beep.\r\nA função delay() pausa a execução por um período específico.\r\nEstá configurado para produzir uma série de bips na inicialização e um bip mais longo repetidamente durante o loop principal.\r\nA função beep() simplifica a geração de bips em diferentes partes do código.\r\n\r\n', 'Copy of Buzzer.png', 'void setup()\r\n{\r\n  pinMode(9, OUTPUT);\r\n  beep(100);\r\n  beep(200);\r\n  beep(300);\r\n  delay(5000);\r\n}\r\n\r\nvoid loop()\r\n{\r\n  beep(1000);\r\n}\r\n\r\nvoid beep(unsigned char delayms){\r\n analogWrite(9, 200); //Any value but 0 and 255\r\n  \r\n  delay(delayms);\r\n  analogWrite(9,0);\r\n  delay(delayms);\r\n}', '<iframe width=\"560\" height=\"350\" src=\"https://www.tinkercad.com/embed/6eTzVtGQxnJ?editbtn=1\" frameborder=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>', 'verificado', NULL),
(69, 44, 'Led RGB com botao', 'Passo 1: Definição de Pinos\r\nNo início do código, são especificados os pinos que serão utilizados para conectar os LEDs e o botão ao Arduino. Os LEDs estão conectados aos pinos 11 (BLED), 10 (GLED) e 12 (RLED), enquanto o botão está conectado ao pino 2 (BUTTON).\r\n\r\nPasso 2: Configuração dos Pinos\r\nNo método setup(), os pinos são configurados como saídas para os LEDs e como entrada para o botão, preparando-os para serem utilizados no programa.\r\n\r\nPasso 3: Debounce para o Botão\r\nO código inclui uma função chamada debounce que evita leituras instáveis do botão devido a possíveis ruídos elétricos. Essa função realiza duas leituras do estado do botão, aguardando um curto intervalo entre elas, e retorna o estado final do botão.\r\n\r\nPasso 4: Configuração dos Modos de LED\r\nO método setMode é responsável por configurar os LEDs com base no modo escolhido. Ele utiliza estruturas condicionais para determinar qual configuração aplicar a cada modo específico.\r\n\r\nPasso 5: Loop Principal\r\nNo método loop(), o programa executa continuamente. Ele utiliza a função debounce para verificar se o botão foi pressionado. Se o botão foi pressionado (passando de LOW para HIGH), o modo de LED é incrementado. O código garante que o modo não ultrapasse o número de modos disponíveis (8). Em seguida, a função setMode é chamada para configurar os LEDs conforme o modo atual.\r\n\r\nPasso 6: Configuração dos Modos de LED (Continuação)\r\nDentro do método setMode, diferentes modos de iluminação são configurados para os LEDs. Isso pode incluir ligar ou desligar LEDs individualmente, ajustar a intensidade luminosa ou criar padrões específicos de cores.\r\n\r\nPasso 7: Modos de LED Específicos\r\nSão definidos diferentes modos de iluminação para os LEDs dentro do método setMode, utilizando comandos como digitalWrite para ligar ou desligar LEDs, e analogWrite para controlar a intensidade luminosa.\r\n\r\nPasso 8: Repetição Contínua\r\nO loop principal continua executando indefinidamente, permitindo que o usuário alterne entre os modos de LED pressionando o botão. Cada modo oferece uma experiência visual distinta, proporcionando ao usuário a oportunidade de explorar e interagir com o projeto.\r\n', 'led rgb Botao.png', 'const int BLED=11;\r\nconst int GLED=10;\r\nconst int RLED=12;\r\nconst int BUTTON=2;\r\nboolean lastButton = LOW;\r\nboolean currentButton = LOW;\r\nint ledMode = 0;\r\nvoid setup()\r\n{\r\npinMode (BLED, OUTPUT);\r\npinMode (GLED, OUTPUT);\r\npinMode (RLED, OUTPUT);\r\npinMode (BUTTON, INPUT);\r\n}\r\nboolean debounce (boolean last)\r\n{\r\nboolean current = digitalRead(BUTTON);\r\nif (last !=current)\r\n{\r\ndelay (5);\r\ncurrent = digitalRead(BUTTON);\r\n}\r\nreturn current;\r\n}\r\nvoid setMode(int mode)\r\n{\r\nif (mode == 1)\r\n{\r\ndigitalWrite(RLED, HIGH);\r\ndigitalWrite(GLED, LOW);\r\ndigitalWrite(BLED, LOW);\r\n}\r\nelse if (mode == 2)\r\n{\r\ndigitalWrite(RLED, LOW);\r\ndigitalWrite(GLED, HIGH);\r\ndigitalWrite(BLED, LOW);\r\n}\r\nelse if (mode == 3)\r\n{\r\ndigitalWrite(RLED, LOW);\r\ndigitalWrite(GLED, LOW);\r\ndigitalWrite(BLED, HIGH);\r\n}\r\nelse if (mode == 4)\r\n{\r\nanalogWrite(RLED, 127);\r\nanalogWrite(GLED, 0);\r\nanalogWrite(BLED, 127);\r\n}\r\nelse if (mode == 5)\r\n{\r\nanalogWrite(RLED, 0);\r\nanalogWrite(GLED, 127);\r\nanalogWrite(BLED, 127);\r\n}\r\nelse if (mode == 6)\r\n{\r\nanalogWrite(RLED, 127);\r\nanalogWrite(GLED, 127);\r\nanalogWrite(BLED, 0);\r\n}\r\nelse if (mode == 7)\r\n{\r\nanalogWrite(RLED, 85);\r\nanalogWrite(GLED, 85);\r\nanalogWrite(BLED, 85);\r\n}\r\nelse\r\n{\r\ndigitalWrite(RLED, LOW);\r\ndigitalWrite(GLED, LOW);\r\ndigitalWrite(BLED, LOW);\r\n}\r\n}\r\nvoid loop()\r\n{\r\ncurrentButton = debounce(lastButton);\r\nif (lastButton == LOW && currentButton ==\r\nHIGH)\r\n{\r\nledMode++;\r\n}\r\nlastButton = currentButton;\r\nif (ledMode == 8) ledMode = 0;\r\nsetMode(ledMode);\r\n}\r\n', '<iframe width=\"560\" height=\"350\" src=\"https://www.tinkercad.com/embed/4UIxVJqGSy5?editbtn=1\" frameborder=\"0\" marginwidth=\"0\" marginheight=\"0\" scrolling=\"no\"></iframe>', 'verificado', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos_componentes`
--

CREATE TABLE `projetos_componentes` (
  `projeto_id` int(11) NOT NULL,
  `componente_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `projetos_componentes`
--

INSERT INTO `projetos_componentes` (`projeto_id`, `componente_id`) VALUES
(1, 1),
(1, 34),
(1, 35),
(2, 1),
(2, 34),
(2, 35),
(3, 1),
(3, 34),
(3, 35),
(28, 1),
(28, 34),
(28, 38),
(69, 1),
(69, 96);

-- --------------------------------------------------------

--
-- Estrutura da tabela `respostas`
--

CREATE TABLE `respostas` (
  `id` int(11) NOT NULL,
  `pergunta_id` int(11) DEFAULT NULL,
  `resposta` text DEFAULT NULL,
  `data_publicacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `autor_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `respostas`
--

INSERT INTO `respostas` (`id`, `pergunta_id`, `resposta`, `data_publicacao`, `autor_id`) VALUES
(11, 23, 'O buzzer é uma caixa de som por frequencias', '2024-01-23 09:45:53', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tokens_reset_senha`
--

CREATE TABLE `tokens_reset_senha` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expiracao` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `status` enum('nao_verificado','verificado') NOT NULL DEFAULT 'nao_verificado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `senha`, `admin`, `status`) VALUES
(1, 'Arduino Code Masters', 'admin@gmail.com', '5fe621f8cd25d4cdc3d9f976a0768f0c', 1, 'verificado'),
(2, 'MiguelGaitas', 'brunomiguelvieira2005@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 0, 'verificado'),
(14, 'Luquinhas', 'lucas12@gmail.com', '22135d43d8f8fb8e456e15505e3c3846', 0, 'verificado'),
(35, 'tomas', 'tomas@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'verificado'),
(36, 'bruno', 'bruno@gmail.com', '202cb962ac59075b964b07152d234b70', 0, 'verificado'),
(39, 'marques1', 'zedemarques@gg.com', '202cb962ac59075b964b07152d234b70', 0, 'verificado'),
(40, 'João Campos', 'f481@prof.filipa-vilhena.edu.pt', '6e24a85785fd5e2688f1a23aee9d88f3', 0, 'verificado'),
(41, 'Philipee', 'philipee@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0, 'verificado'),
(44, 'Davide', 'david@gmail.com', 'e807f1fcf82d132f9bb018ca6738a19f', 0, 'verificado');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `componentes`
--
ALTER TABLE `componentes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `componentes_categorias`
--
ALTER TABLE `componentes_categorias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `componente_id` (`componente_id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Índices para tabela `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `loja_componente`
--
ALTER TABLE `loja_componente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `loja_id` (`loja_id`),
  ADD KEY `componente_id` (`componente_id`);

--
-- Índices para tabela `perguntas`
--
ALTER TABLE `perguntas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `projetos_arduino`
--
ALTER TABLE `projetos_arduino`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_projetos_arduino_usuarios` (`autor`);

--
-- Índices para tabela `projetos_componentes`
--
ALTER TABLE `projetos_componentes`
  ADD PRIMARY KEY (`projeto_id`,`componente_id`),
  ADD KEY `componente_id` (`componente_id`);

--
-- Índices para tabela `respostas`
--
ALTER TABLE `respostas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pergunta_id` (`pergunta_id`);

--
-- Índices para tabela `tokens_reset_senha`
--
ALTER TABLE `tokens_reset_senha`
  ADD PRIMARY KEY (`id`,`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `componentes`
--
ALTER TABLE `componentes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT de tabela `componentes_categorias`
--
ALTER TABLE `componentes_categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de tabela `lojas`
--
ALTER TABLE `lojas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `loja_componente`
--
ALTER TABLE `loja_componente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `perguntas`
--
ALTER TABLE `perguntas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de tabela `projetos_arduino`
--
ALTER TABLE `projetos_arduino`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT de tabela `respostas`
--
ALTER TABLE `respostas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tokens_reset_senha`
--
ALTER TABLE `tokens_reset_senha`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `componentes_categorias`
--
ALTER TABLE `componentes_categorias`
  ADD CONSTRAINT `componentes_categorias_ibfk_1` FOREIGN KEY (`componente_id`) REFERENCES `componentes` (`id`),
  ADD CONSTRAINT `componentes_categorias_ibfk_2` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`);

--
-- Limitadores para a tabela `loja_componente`
--
ALTER TABLE `loja_componente`
  ADD CONSTRAINT `loja_componente_ibfk_1` FOREIGN KEY (`loja_id`) REFERENCES `lojas` (`id`),
  ADD CONSTRAINT `loja_componente_ibfk_2` FOREIGN KEY (`componente_id`) REFERENCES `componentes` (`id`);

--
-- Limitadores para a tabela `projetos_arduino`
--
ALTER TABLE `projetos_arduino`
  ADD CONSTRAINT `FK_projetos_arduino_usuarios` FOREIGN KEY (`autor`) REFERENCES `usuarios` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Limitadores para a tabela `projetos_componentes`
--
ALTER TABLE `projetos_componentes`
  ADD CONSTRAINT `projetos_componentes_ibfk_1` FOREIGN KEY (`projeto_id`) REFERENCES `projetos_arduino` (`id`),
  ADD CONSTRAINT `projetos_componentes_ibfk_2` FOREIGN KEY (`componente_id`) REFERENCES `componentes` (`id`),
  ADD CONSTRAINT `projetos_componentes_ibfk_3` FOREIGN KEY (`projeto_id`) REFERENCES `projetos_arduino` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `respostas`
--
ALTER TABLE `respostas`
  ADD CONSTRAINT `respostas_ibfk_1` FOREIGN KEY (`pergunta_id`) REFERENCES `perguntas` (`id`);

--
-- Limitadores para a tabela `tokens_reset_senha`
--
ALTER TABLE `tokens_reset_senha`
  ADD CONSTRAINT `tokens_reset_senha_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
