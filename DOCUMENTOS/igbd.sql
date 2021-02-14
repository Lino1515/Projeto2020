-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11-Jan-2021 às 23:57
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `igbd`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_assignment`
--

DROP TABLE IF EXISTS `auth_assignment`;
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_bin NOT NULL,
  `user_id` varchar(64) COLLATE utf8_bin NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `user_id` (`user_id`),
  KEY `user_id_2` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', NULL),
('moderador', '2', NULL),
('null', '10', NULL),
('null', '8', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

DROP TABLE IF EXISTS `auth_item`;
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_bin DEFAULT NULL,
  `rule_name` varchar(64) COLLATE utf8_bin DEFAULT NULL,
  `data` text COLLATE utf8_bin DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Permite ao utilizador gerir todo o website.', NULL, NULL, NULL, NULL),
('moderador', 1, 'Permite ao utilizador gerir comentarios, reviews e reports.', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item_child`
--

DROP TABLE IF EXISTS `auth_item_child`;
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_bin NOT NULL,
  `child` varchar(64) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `auth_item_child`
--

INSERT INTO `auth_item_child` (`parent`, `child`) VALUES
('admin', 'criarcomentario'),
('admin', 'criarjogo'),
('admin', 'criarreviews'),
('admin', 'criartipojogo'),
('admin', 'deletecomentarios'),
('admin', 'deletecomentariosreports'),
('admin', 'deletejogo'),
('admin', 'deletereview'),
('admin', 'deletereviewreports'),
('admin', 'deletetipojogo'),
('admin', 'updatecomentarios'),
('admin', 'updatejogo'),
('admin', 'updatereview'),
('admin', 'updatetipojogo'),
('admin', 'vercomentario'),
('admin', 'vercomentariosreport'),
('admin', 'verjogo'),
('admin', 'verreview'),
('admin', 'verreviewreports'),
('admin', 'vertipojogo'),
('moderador', 'criarcomentario'),
('moderador', 'criarreviews'),
('moderador', 'deletecomentarios'),
('moderador', 'deletecomentariosreports'),
('moderador', 'deletereview'),
('moderador', 'deletereviewreports'),
('moderador', 'vercomentario'),
('moderador', 'vercomentariosreport'),
('moderador', 'verreview'),
('moderador', 'verreviewreports');

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_rule`
--

DROP TABLE IF EXISTS `auth_rule`;
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_bin NOT NULL,
  `data` text COLLATE utf8_bin DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios`
--

DROP TABLE IF EXISTS `comentarios`;
CREATE TABLE IF NOT EXISTS `comentarios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Data` date NOT NULL,
  `Descricao` text COLLATE utf8_bin NOT NULL,
  `Id_utilizador` int(11) NOT NULL,
  `Id_jogo` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Id_jogo` (`Id_jogo`),
  KEY `Id_utilizador` (`Id_utilizador`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `comentarios`
--

INSERT INTO `comentarios` (`Id`, `Data`, `Descricao`, `Id_utilizador`, `Id_jogo`) VALUES
(10, '2021-01-11', 'Nice try', 1, 41),
(11, '2021-01-11', 'what', 1, 41);

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentariosreports`
--

DROP TABLE IF EXISTS `comentariosreports`;
CREATE TABLE IF NOT EXISTS `comentariosreports` (
  `Id_comentario` int(11) NOT NULL,
  `Id_utilizador` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Descricao` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id_comentario`,`Id_utilizador`),
  KEY `Id_comentario` (`Id_comentario`),
  KEY `Id_utilizador` (`Id_utilizador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentariosutilizador`
--

DROP TABLE IF EXISTS `comentariosutilizador`;
CREATE TABLE IF NOT EXISTS `comentariosutilizador` (
  `Id_comentario` int(11) NOT NULL,
  `Id_utilizador` int(11) NOT NULL,
  `Like_Dislike` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id_comentario`,`Id_utilizador`),
  KEY `Id_comentario` (`Id_comentario`),
  KEY `Id_utilizador` (`Id_utilizador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `jogos`
--

DROP TABLE IF EXISTS `jogos`;
CREATE TABLE IF NOT EXISTS `jogos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(120) COLLATE utf8_bin NOT NULL,
  `Descricao` text COLLATE utf8_bin NOT NULL,
  `Data` date NOT NULL,
  `Trailer` varchar(255) COLLATE utf8_bin NOT NULL,
  `Imagem` varchar(255) COLLATE utf8_bin NOT NULL,
  `Id_tipojogo` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Id_tipojogo` (`Id_tipojogo`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `jogos`
--

INSERT INTO `jogos` (`Id`, `Nome`, `Descricao`, `Data`, `Trailer`, `Imagem`, `Id_tipojogo`) VALUES
(41, 'Resident Evil', 'Resident Evil (conhecido como Biohazard no Japão) é uma franquia de mídia que pertence à empresa de videogames Capcom. Foi criada por Shinji Mikami como uma série de jogos de survival horror, iniciada em 1996 com Resident Evil para PlayStation. Desde então, a série de jogos passou a incluir o gênero ação e até agora já vendeu mais de 100 milhões de unidades.[1]\r\n\r\nA franquia Resident Evil é constituída por história em quadrinhos, livros, filmes e uma variedade de coleções, incluindo figuras de ação e guias de estratégias.[2] Foi influenciada pelos filmes de George A. Romero e também pelo jogo Alone in the Dark. Enquanto os jogos aderem a uma história mais consistente, existem alguns desvios do enredo nos filmes e nos livros, que são considerados histórias paralelas.\r\n\r\nOs personagens principais são Chris Redfield e Jill Valentine (estes surgiram no Resident Evil original) e Leon Scott Kennedy e Claire Redfield (que surgiram na sequência Resident Evil 2).', '1996-05-22', '-z9MKsGtL6M', 'Imagens/imagem_backend/1996-05-22Resident Evil.png', 17),
(42, 'Resident Evil 2', 'Resident Evil 2, conhecido no Japão como Biohazard 2 (バイオハザード2 Baiohazādo Tsū?) é um jogo eletrônico de survival horror lançado originalmente para o PlayStation em 1998. Desenvolvido pela Capcom como o segundo título da série Resident Evil, sua história se passa dois meses após os eventos do primeiro jogo. Ele é ambientado em Raccoon City, uma comunidade americana cujos moradores foram transformados em zumbis pelo T-virus, uma arma biológica desenvolvida pela empresa farmacêutica Umbrella Corporation. Em sua fuga da cidade, os dois protagonistas, Leon S. Kennedy e Claire Redfield, encontram-se com outros sobreviventes e são confrontados por William Birkin, o criador de um vírus ainda mais poderoso chamado de G-virus, que ele injetou em si mesmo.\r\n\r\nA jogabilidade de Resident Evil 2 centra-se na exploração, solução de quebra-cabeças e combate, apresentando elementos típicos do gênero survival horror, tais como munição e salvamentos limitados. A principal diferença do jogo com seu antecessor é o \"Sistema Zapping\", que fornece a cada personagem história e obstáculos únicos. Desenvolvido por uma equipe entre quarenta e sessenta pessoas ao longo de um ano e nove meses, Resident Evil 2 foi dirigido por Hideki Kamiya e produzido por Shinji Mikami. A versão inicial, comumente referida como Resident Evil 1.5, diferia drasticamente do produto final e foi descontinuada quando já estava com mais de sessenta por cento finalizada, depois de ter sido considerada \"maçante e chata\" pelo produtor. O resultado da recriação introduziu cenários diferentes e uma história mais cinematográfica, apoiada por uma trilha sonora que emprega \"desespero\" como tema subjacente.\r\n\r\nResident Evil 2 foi amplamente aclamado pela crítica, que elogiou sua atmosfera, ambientação, gráficos e áudio. No entanto, seus controles, qualidade da dublagem e sistema de inventário receberam algumas críticas, da mesma forma como os quebra-cabeças não foram bem recebidos por certos revisores. O jogo vendeu mais de quatro milhões de cópias no PlayStation e é o título de maior sucesso da franquia em uma única plataforma. Após seu lançamento, Resident Evil 2 foi incluído em várias listas dos 100 melhores jogos. Ele também foi portado para Microsoft Windows, Nintendo 64, Dreamcast e GameCube, além de ser lançado com uma versão modificada em 2.5D para o console portátil Game.com. Sua história foi recontada e desenvolvida nos vários jogos posteriores, sendo adaptada em uma variedade de obras licenciadas. Uma recriação foi lançada em janeiro de 2019 para Microsoft Windows, PlayStation 4 e Xbox One.', '1998-01-01', 'kUjLG8ZxuHQ', 'Imagens/imagem_backend/1998-01-01Resident Evil 2.png', 17),
(47, 'Resident Evil Code Veronica', 'Resident Evil – Code: Veronica, chamado no Japão de Biohazard – Code: Veronica (バイオハザード コードベロニカ Baiohazādo Kōdo: Beronika?), é o quarto jogo dentro da cronologia principal -- da série Resident Evil. Originalmente, lançado com exclusividade para o Dreamcast, em 2001, teve uma versão melhorada intitulada Resident Evil Code: Veronica X para Dreamcast (somente no Japão) e PlayStation 2, em 2001. Dois anos depois, o jogo foi lançado para o GameCube.E em 2011 uma versão em HD do jogo foi lançada para PlayStation 3 e Xbox360. O game é dividido em duas partes, a primeira o jogador controla Claire Redfield, onde o principal objetivo é escapar da ilha infestada pelo T-Virus; a segunda é assumida por Chris Redfield, que deve encontrar sua irmã perdida.', '2001-02-22', 'UgM3q1IJA0c', 'Imagens/imagem_backend/2001-02-22Resident Evil Code Veronica.jpg', 17),
(48, 'Resident Evil 3 Nemesis', 'Resident Evil 3: Nemesis, conhecido no Japão como Biohazard 3: Last Escape (バイオハザード3　ラストエスケープ Baiohazādo 3 Rasuto Esukēpu?), é um jogo eletrônico de survival horror desenvolvido e publicado pela Capcom, lançado originalmente para o PlayStation em 1999. É o terceiro jogo da franquia Resident Evil, e ocorre antes e após os acontecimentos de Resident Evil 2.\r\n\r\nA história centra-se em Jill Valentine e em seus esforços para escapar de Raccon City, uma cidade completamente infectada com um novo tipo de arma biológica secreta desenvolvida pela empresa farmacêutica Umbrella Corporation. O jogo usa o mesmo motor que seus antecessores e apresenta modelos 3D sobre fundos pré-renderizados com ângulos de câmera fixa. Ao contrário dos jogos anteriores, Resident Evil 3: Nemesis foi projetado para ser mais orientado para a ação. Ele apresenta um maior número de inimigos para serem derrotados e introduz a criatura Nemesis, que persegue periodicamente o jogador até o final do jogo.\r\n\r\nResident Evil 3 foi um sucesso crítico e comercial, vendendo mais de três milhões de unidades em todo o mundo. A maioria dos críticos elogiaram os gráficos por serem detalhados e a criatura Nemesis como um vilão assustador, mas alguns criticaram a curta duração do jogo e da história. Após o seu lançamento no PlayStation, o jogo foi posteriormente portado para Dreamcast, Microsoft Windows e GameCube. Uma recriação, intitulada Resident Evil 3, foi lançada em 03 de abril de 2020 para Microsoft Windows, PlayStation 4 e Xbox One.', '1999-01-01', 'gun-MVEWg40', 'Imagens/imagem_backend/1999-01-01Resident Evil 3 Nemesis.jpg', 17),
(50, 'Resident Evil 4', 'Resident Evil 4, conhecido no Japão como Biohazard 4 (バイオハザード4 Baiohazādo Fō?), é um jogo eletrônico de survival horror e tiro em terceira pessoa desenvolvido e publicado pela Capcom, lançado originalmente para o Nintendo GameCube em 2005. É o sexto jogo principal da franquia Resident Evil.\r\n\r\nA história de Resident Evil 4 segue o agente especial do governo dos Estados Unidos Leon S. Kennedy, que é enviado em uma missão para resgatar Ashley Graham, filha do presidente americano, que foi raptada por uma seita macabra. Ele viaja para uma área rural da Espanha, onde luta contra hordas de moradores violentos e monstros mutantes, e se reúne com a misteriosa espiã Ada Wong.\r\n\r\nPlanejado desde dezembro de 1999, Resident Evil 4 foi submetido a um longo processo de desenvolvimento, durante o qual quatro versões propostas para o jogo foram descartadas. Inicialmente desenvolvido para o Nintendo GameCube, a primeira produção foi dirigida por Hideki Kamiya depois que o produtor Shinji Mikami pediu-lhe para criar um novo título para a série Resident Evil. No entanto, foi decidido iniciar o desenvolvimento novamente. O jogo foi destinado a ser um exclusivo do GameCube como parte do Capcom Five, mas uma versão para PlayStation 2 foi anunciada antes do jogo ser lançado no GameCube. Posteriormente Resident Evil 4 também foi lançado para Microsoft Windows, Wii, PlayStation 3, Xbox 360 e em versões reduzidas para iOS, Zeebo e Android.\r\n\r\nResident Evil 4 recebeu aclamação da crítica. Ele ganhou muitos prêmios de Jogo do Ano em 2005 e foi visto como um sucesso multiplataforma que influenciou a evolução dos gêneros survival horror e de tiro em terceira pessoa. O jogo também foi pioneiro e popularizou a perspectiva de visão \"sobre o ombro\" em terceira pessoa. Desde então, tem sido amplamente considerado um dos melhores jogos de todos os tempos.', '2005-01-11', '1KTghW30ZuY', 'Imagens/imagem_backend/2005-01-11Resident Evil 4.jpg', 17),
(51, 'Resident Evil 5', 'Resident Evil 5, conhecido no Japão como Biohazard 5 (バイオハザード5 Baiohazādo 5?), é um jogo eletrônico de tiro em terceira pessoa desenvolvido e publicado pela Capcom. É o sétimo título principal da série Resident Evil e foi lançado para PlayStation 3 e Xbox 360 em março de 2009 e depois para o Microsoft Windows em setembro do mesmo ano. A trama gira em torno da investigação dos agentes Chris Redfield e Sheva Alomar sobre uma ameaça terrorista em Kijuju, uma região fictícia na África. Redfield logo descobre que precisará confrontar seu passado na forma de seu velho inimigo Albert Wesker e sua ex-parceira Jill Valentine.\r\n\r\nA jogabilidade de Resident Evil 5 é semelhante à do jogo anterior, embora seja o primeiro título da série projetado para ter uma jogabilidade cooperativa de dois jogadores. Ele também foi considerado o primeiro jogo da série principal a afastar-se do gênero sobrevivência, com os críticos dizendo que tinha mais semelhanças com um jogo de ação. Captura de movimento foi usada para filmar as cutscenes, e foi o primeiro jogo a usar um sistema de câmera virtual. Vários membros da equipe de produção do primeiro Resident Evil trabalharam em Resident Evil 5.\r\n\r\nO jogo teve uma recepção em grande parte positiva, embora tenha sido criticado por problemas com seus controles. Ele também recebeu algumas queixas iniciais de racismo, mas uma investigação do British Board of Film Classification considerou as alegações infundadas. Resident Evil 5 foi relançado para o PlayStation 4 e Xbox One em junho de 2016 e em 2019 para Nintendo Switch. Em setembro do mesmo ano, tinha chegado a marca de mais de 7,1 milhões de unidades vendidas, tornando-se o jogo mais vendido da Capcom e o mais vendido da franquia. Sua sequência, Resident Evil 6, foi lançada em 2012.', '2009-05-01', 'xxJbz_3PKQo', 'Imagens/imagem_backend/2009-05-01Resident Evil 5.jpg', 17),
(52, 'Resident Evil 6', 'Resident Evil 6, chamado no Japão de Biohazard 6 (バイオハザード 6 Baiohazādo Shikkusu?), é um videojogo do gênero ação jogado em terceira pessoa desenvolvido e publicado pela Capcom. Apesar do nome é o nono jogo da série principal Resident Evil e foi lançado em 2 de outubro de 2012 para PlayStation 3 e Xbox 360. A versão para Microsoft Windows foi lançada no dia 22 de março de 2013. O game também ganhou uma versão completa com todas as DLC para PlayStation 4 e Xbox One em 29 de março de 2016.\r\n\r\nA história é contada a partir das perspectivas de Chris Redfield, membro e fundador da BSAA traumatizado por ter falhado em uma missão; Leon S. Kennedy, um sobrevivente de Raccoon City e agente especial do governo; Jake Muller, filho ilegítimo de Albert Wesker e associado de Sherry Birkin; e Ada Wong, uma agente solitária com ligações aos ataques bio-terroristas pela Neo-Umbrella.\r\n\r\nO conceito do jogo começou em 2009, mas começou a ser produzido no ano seguinte sobre a supervisão de Hiroyuki Kobayashi, que já tinha produzido Resident Evil 4. A equipe de produção acabou por crescer e tornou-se na maior de sempre a trabalhar num jogo da série Resident Evil. Resident Evil 6 foi apresentado durante uma campanha de divulgação viral na página NoHopeLeft.com.\r\n\r\nResident Evil 6 recebeu críticas negativas aquando do lançamento da demo devido aos problemas nos controles e críticas muito diversas devido à mudança drástica da jogabilidade encontrada na versão final do jogo, sendo um ponto de elogio e também de contraste nas diferentes análises. Os sites de críticas agregadas GameRankings e Metacritic deram à versão PlayStation 3 73,55% e 74/100, à versão Xbox 360 69,03% e 67/100 e à versão PC 68,73% e 68/100, respectivamente. Apesar de não ter sido bem recebido tanto pela imprensa especializada como pelos jogadores, Resident Evil 6 vendeu mais de 5,2 milhões de unidades, tornando-se no terceiro jogo mais vendido de sempre da Capcom, depois de Resident Evil 5 e Street Fighter II.', '2012-05-29', 'sS_bGpe9qE8', 'Imagens/imagem_backend/2012-05-29Resident Evil 6.jpg', 17),
(53, 'Resident Evil 7 Biohazard', 'Resident Evil 7: Biohazard,[a] conhecido no Japão como Biohazard 7: Resident Evil (バイオハザード7　レジデント イービル Baiohazādo 7 Rejidento Ībiru?)[b] é um jogo eletrônico do gênero survival horror produzido pela Capcom e lançado em 24 de janeiro de 2017 para Microsoft Windows, PlayStation 4 e Xbox One, com a versão de PlayStation 4 tendo suporte completo para PlayStation VR.[1] O jogo é o décimo primeiro título principal da série Resident Evil, sendo o terceiro deles a usar perspectiva em primeira pessoa.[2]\r\n\r\nA história segue a busca do civil Ethan Winters por sua esposa Mia, que o leva a uma mansão agrícola aparentemente abandonada e habitada pela família Baker. Ethan faz uso de armas e ferramentas na luta contra os membros da família e os \"Mofados\", uma forma humanoide de bactéria. Itens de cura são usados em caso de lesão e há enigmas que precisam ser resolvidos para dar prosseguimento a história.\r\n\r\nResident Evil 7 foi anunciado durante a E3 2016 depois de vários rumores.[3] Mais tarde naquele dia, uma demonstração intitulada Resident Evil 7 Teaser: Beginning Hour foi lançada na PlayStation Store para os assinantes da PlayStation Plus. Liderado por Koshi Nakanishi, diretor de Resident Evil: Revelations, a equipe de desenvolvimento foi composta por cerca de 120 pessoas. Em vez de ser centrado na ação como seus antecessores Resident Evil 5 e 6, os elementos de survival horror e a exploração tiveram prioridade no novo título. Para isso, o jogo utiliza uma perspectiva em primeira pessoa. Eles usaram o novo motor gráfico RE Engine, que já tinha sido testado na demonstração em realidade virtual KITCHEN na E3 de 2015.[4]\r\n\r\nApós o lançamento, o jogo recebeu avaliações geralmente favoráveis dos críticos, que elogiaram a jogabilidade, os gráficos e o design. A versão para PlayStation VR foi enaltecida por aumentar o envolvimento do jogador, mas também foi alvo de reclamações por ter a resolução diminuída e causar desconforto físico. Outras queixas foram dirigidas às batalhas contra chefes e ao capítulo final da história. Até o final de março de 2017, o jogo tinha vendido mais de três milhões e meio de cópias, sendo a terceira melhor estreia de um título da série. Dois conteúdos adicionais, intitulados Not a Hero e End of Zoe, também foram posteriormente lançados no jogo. Uma sequência, intitulada Resident Evil Village foi anunciada para 2021.', '2017-01-24', '4OrttZ2-qR8', 'Imagens/imagem_backend/2017-01-24Resident Evil 7 Biohazard.jpg', 17),
(54, 'Resident Evil 3 Remake', 'Resident Evil 3,[n 1] chamado no Japão de Biohazard RE:3 (バイオハザード RE:3 Baiohazādo Āru Ī Surī?), é um jogo eletrônico de survival horror desenvolvido e publicado pela Capcom. É uma recriação de Resident Evil 3: Nemesis, lançado em 1999, e o enredo segue Jill Valentine tentando escapar de um apocalipse zumbi enquanto é caçada por um ser biologicamente inteligente conhecido como Nemesis. Foi lançado em 3 de abril de 2020 para Microsoft Windows, PlayStation 4 e Xbox One. Também possui um modo multijogador on-line, conhecido como Resident Evil: Resistance.\r\n\r\nResident Evil 3 foi geralmente bem recebido pela crítica especializada, com elogios direcionados ao seus gráficos, apresentação e jogabilidade, embora tenha sido criticado por sua curta duração, ritmo e ausência de elementos do jogo original. O jogo vendeu mais de dois milhões de cópias dentro de uma semana após o seu lançamento.', '2020-04-03', 'EyCZP1wDxEM', 'Imagens/imagem_backend/2020-04-03Resident Evil 3 Remake.jpg', 17),
(55, 'Resident Evil 2 Remake', 'Resident Evil 2,[n 1] chamado no Japão de Biohazard RE:2 (バイオハザード RE:2 Baiohazādo Āru Ī Tsū?), é um jogo eletrônico de survival horror desenvolvido e publicado pela Capcom, sendo um remake do jogo original de 1998. Foi lançado em 25 de janeiro de 2019 para Microsoft Windows, PlayStation 4 e Xbox One. Os jogadores controlam o policial novato Leon S. Kennedy e a estudante universitária Claire Redfield enquanto tentam escapar de Raccoon City durante um apocalipse zumbi.\r\n\r\nResident Evil 2 foi aclamado pela crítica, com elogios direcionados para sua apresentação, jogabilidade e fidelidade ao original. Foi indicado para vários prêmios, incluindo muitos de Jogo do Ano. Até abril de 2020, o jogo havia vendido mais de 6,5 milhões de cópias, superando as vendas do jogo original.', '2019-01-25', 'sVB_XudMgoA', 'Imagens/imagem_backend/2019-01-25Resident Evil 2 Remake.png', 17);

-- --------------------------------------------------------

--
-- Estrutura da tabela `migration`
--

DROP TABLE IF EXISTS `migration`;
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) COLLATE utf8_bin NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1604939905),
('m130524_201442_init', 1604940018),
('m190124_110200_add_verification_token_column_to_user_table', 1604940018);

-- --------------------------------------------------------

--
-- Estrutura da tabela `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Data` date NOT NULL,
  `Descricao` text COLLATE utf8_bin NOT NULL,
  `Score` float NOT NULL,
  `Id_Jogo` int(11) NOT NULL,
  `Id_Utilizador` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `Id_Utilizador` (`Id_Utilizador`),
  KEY `Id_Jogo` (`Id_Jogo`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `review`
--

INSERT INTO `review` (`Id`, `Data`, `Descricao`, `Score`, `Id_Jogo`, `Id_Utilizador`) VALUES
(10, '2021-01-11', 'Wow', 2, 41, 1),
(13, '2021-01-11', 'Fazer testes e tal', 2.3, 41, 1),
(14, '2021-01-11', 'teste', 3.4, 41, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reviewreports`
--

DROP TABLE IF EXISTS `reviewreports`;
CREATE TABLE IF NOT EXISTS `reviewreports` (
  `Id_review` int(11) NOT NULL,
  `Id_utilizador` int(11) NOT NULL,
  `Data` date NOT NULL,
  `Descricao` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id_review`,`Id_utilizador`),
  KEY `Id_review` (`Id_review`),
  KEY `Id_utilizador` (`Id_utilizador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `reviewutilizador`
--

DROP TABLE IF EXISTS `reviewutilizador`;
CREATE TABLE IF NOT EXISTS `reviewutilizador` (
  `Id_review` int(11) NOT NULL,
  `Id_Utilizador` int(11) NOT NULL,
  `Helpful_UnHelpful` tinyint(1) NOT NULL,
  PRIMARY KEY (`Id_review`,`Id_Utilizador`),
  KEY `Id_Utilizador` (`Id_Utilizador`),
  KEY `Id_review` (`Id_review`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipojogo`
--

DROP TABLE IF EXISTS `tipojogo`;
CREATE TABLE IF NOT EXISTS `tipojogo` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(120) COLLATE utf8_bin NOT NULL,
  `Descricao` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Extraindo dados da tabela `tipojogo`
--

INSERT INTO `tipojogo` (`Id`, `Nome`, `Descricao`) VALUES
(1, 'Aventura', 'É um dos gêneros de Video game caracterizado pela exploração dos cenários, pelos enigmas e quebra-cabeças (os chamados \"puzzles\"), pela interação com outros personagens e pelo foco na narrativa. Concentra-se quase por completo no raciocínio de lógica e exploração, e em histórias complexas e envolventes. Geralmente, os adventures são para um único jogador. Diferente de outros genêros de jogos eletrônicos, o foco dos adventures na história permite uma vasta quantidade de genêros literários a serem usados ou incorporados, como fantasia, ficção científica, mistério, horror e comédia. Dentre os jogos de adventure mais populares podem ser destacados: Longest Journey, Syberia, Still Life, Day Of The Tentacle, The Secret of Monkey Island, Space Quest e Zork. Alguns adventures recentes como Alone in The Dark 4 ou o excepcional Beyond Good & Evil também reúnem elementos de ação e estratégia na jogabilidade.'),
(2, 'Ação', 'Jogos de ação tipicamente possuem características de conflitos com força física violenta e ágil, onde o jogador deve ter um tempo de reação curto como maior característica definitiva.\r\n\r\nO jogador normalmente está sob pressão e possui tempo limitado para realizar suas ações e não há muito tempo para realizar planos ou estratégias elaboradas.\r\n\r\nEm um jogo de ação comum, o jogador controla um personagem que normalmente é o protagonista da história do jogo. Ele deve navegar sobre o ambiente e sobrepujar seus desafios, combatendo outros personagens, coletando itens e solucionando quebra-cabeças simples. O jogador está limitado pelo tempo e por recursos que representam a quantidade de vida do personagem, que quando acabada, o jogador recebe um game over. Ao final de cada nível ou fase, tipicamente há um embate com um grande antagonista.'),
(3, 'Estratégia', 'Jogo de Estratégia é um gênero de Video-game onde enfatiza habilidades de pensamento e planejamento para alcançar a vitória. Os jogos enfatizam a estratégia, tática e algumas vezes desafios lógísticos. Muitos jogos também oferecem desafios econômicos e exploração.'),
(4, 'RPG', 'Um RPG eletrônico é um gênero de jogo em que o jogador controla as ações de um ou mais personagens imersos num mundo bem definido, incorporando elementos dos RPGs tradicionais, compartilhando geralmente a mesma terminologia, ambientações e mecânicas de jogo. Outras similaridades com os RPGs de mesa incluem a ampla progressão de história e elementos narrativos, o desenvolvimento dos personagens do jogador, rigoroso sistema de regras, além de complexibilidade e elementos de imersão. Não existe um consenso claro sobre a definição do escopo exato do termo, especificamente variando se o foco na jogabilidade ou na história deve ser o elemento definidor.'),
(5, 'Desporto', 'Um jogo de esporte (português brasileiro) ou jogo de desporto (português europeu) é um jogo eletrônico de PC ou videogame que simula desportos tradicionais. A maioria dos desportos já foram recriados em um jogo, incluindo futebol, baseball, futebol americano, boxe, wrestling profissional, cricket, golfe, basquete, hockey no gelo, tênis, boliche, rugby e natação. Alguns jogos enfatizam o ato de jogar um esporte (como Madden NFL), enquanto que outros enfatizam as estratégias por trás de um esporte (como Championship Manager). Outros satirizam o esporte para efeitos cômicos (como Arch Rivals). Este gênero vem sendo popular na história dos jogos eletrônicos e é competitivo, como a maioria dos esportes na vida real. Numerosas séries de jogos deste gênero trazem nomes e características de times e jogadores reais, e são atualizados anualmente para refletir mudanças na vida real.'),
(6, 'Corrida', 'Um jogo eletrônico de corrida é um gênero de jogos eletrônicos em que o jogador participa de competições de corrida com qualquer tipo de veículo terrestre, inclusive motocicletas e quadriciclos. Existem alternativas de jogos com veículos aquáticos, aéreos e até espaciais.'),
(7, 'Online', 'São chamados jogos online os jogos eletrônicos jogados via Internet. Neles, um jogador com um computador, vídeo game, gadgts, televisão ou outros tipos de aparelhos eletrônicos conectado à rede, pode jogar com outros sem que ambos precisem estar no mesmo ambiente, sem sair de casa, o jogador pode desafiar adversários que estejam em outros lugares do país, ou até do mundo. Tudo em tempo real, como se o outro estivesse lado a lado, de forma que esta categoria de jogos abre novas perspectivas de diversão. No entanto, atualmente alguns fatores dificultam sua disseminação: o alto preço da conexão de banda larga e das mensalidades que muitos jogos exigem. Também há de considerar que muitos deles exigem atualização constante do equipamento, elevando o custo da diversão, a grande maioria dos jogos apresenta também moedas virtuais que podem ser adquiridas em troca de moeda real.'),
(8, 'Simulação', 'Um jogo eletrônico de simulação, ou simplesmente jogo de simulação descreve uma diversa super-categoria de jogos eletrônicos para computadores e videogames. Alguns jogos do gênero têm como objetivo simular o mundo real; outros possuem o objetivo de simular um mundo fictício; além de também outros (como The Sims 4) são criados para fazer ambos.'),
(9, 'Tabuleiro', 'Os jogos de tabuleiro utilizam as superfícies planas e pré-marcadas, com desenhos ou marcações de acordo com as regras envolvidas em cada jogo específico. Os jogos podem ter por base estratégia pura, sorte (por exemplo, rolagem de dados), ou uma mistura dos dois, e geralmente têm um objetivo que cada jogador pretende alcançar. Os primeiros jogos de tabuleiro representavam uma batalha entre dois exércitos, e a maioria dos jogos de tabuleiro modernos ainda são baseados em derrotar os jogadores adversários em termos.\r\n\r\nExistem muitos tipos de jogos de tabuleiro. Sua representação pode variar de situações da vida real a jogos abstratos sem nenhum tema (por exemplo, damas). As regras podem variar desde o simples (por exemplo, jogo-da-velha), para aquelas que descrevem um universo de jogos em grande detalhe (por exemplo, Dungeons & Dragons).\r\n\r\nO tempo necessário para aprender a jogar ou dominar um jogo varia muito de jogo para jogo. Tempo não está necessariamente relacionado com o número ou a complexidade das regras de aprendizagem; alguns jogos com estratégias profundas (por exemplo, xadrez ou Go) possuem conjuntos de regras relativamente simples.'),
(10, 'Casual', 'O termo jogo \"casual\" é utilizado para caracterizar jogos digitais (de videogame, jogos de computador ou aparelhos móveis) acessíveis ao grande público. Diferentemente dos jogos tradicionais que são mais complexos e exigem tempo e dedicação do jogador, os jogos casuais são simples e rápidos de aprender. Desta forma podem ser uma opção de diversão para um simples passatempo de alguns minutos.\r\n\r\nUm exemplo conhecido de jogo casual é o paciência do Windows. Jogos casuais tem comandos simples e normalmente requerem apenas o uso do mouse. Outra diferença é que esses jogos costumam atrair adultos na faixa dos 30 a 50 anos.\r\n\r\nOs jogos casuais são normalmente disponibilizados online (para jogar diretamente no navegador) ou em versão download. Normalmente a versão download é uma variante mais rica e sofisticada da versão online e tende a ser paga, embora a maioria dos portais ofereça um período de uso gratuito do jogo.'),
(11, 'Cartas', 'Um jogo de cartas colecionáveis - ou JCC (conhecido como \"TCG\" - \"trading card games\" - ou \"CCG\" - collectible card games) - são jogos de estratégia nos quais os participantes criam baralhos de jogo personalizados combinando estrategicamente suas cartas com os seus objetivos.'),
(12, 'Ritmo', 'Jogo de ritmo é um subgênero de jogos de ação que desafia o senso de ritmo do jogador. O gênero inclui jogos de dança como Dance Dance Revolution e jogos baseados em música como Donkey Konga e Guitar Hero. Games do gênero fazem o jogador ter de pressionar botões em tempos precisos: a tela mostra qual botão o jogador tem de apertar, e posteriormente o premia com pontos referente ao desempenho de precisão e sincronização com batida. O gênero também inclui jogos que medem o ritmo e compasso, a fim de testar a habilidade do jogador cantar, e jogos que desafiam o jogador a controlar o seu volume medindo o quão forte pode apertar cada botão. Enquanto canções podem ser lidas olhando, os jogadores usualmente praticam aumentando cada vez mais a dificuldade e a configuração das canções. Certos jogo de ritmo oferecem desafio similar ao \"Simon says\" (jogo infantil), no qual o jogador devem ver, memorizar e repetir sequências complexas de apertos nos botões. '),
(13, 'Plataforma', 'Jogo eletrônico de plataforma é um gênero de jogos eletrônicos em que o jogador corre e pula entre plataformas e obstáculos, enfrentando inimigos e coletando objetos bônus. O gênero tem seu surgimento no início dos anos 80, sendo alguns de seus exemplares mais conhecidos: Super Mario Bros., Sonic the Hedgehog, Donkey Kong, Pac-Man World, Crash Bandicoot, Prince of Persia, Castlevania, Metroid e Mega Man.'),
(14, 'Puzzle', 'ogo eletrônico de quebra-cabeça (também conhecidos como jogo puzzle ou jogo de puzzle) é um gênero de jogo eletrônico ou de alguns jogos de video game que se foca em solucionar quebra-cabeças. Os tipos de quebra-cabeças a serem resolvidos podem testar diversas habilidades do jogador, como lógica, estratégia, reconhecimento de padrões, solução de seqüências e ter que completar palavras.\r\n\r\nJogos da categoria envolvem uma variedade de desafios de lógica e conceito, apesar de ocasionalmente eles adicionarem pressão-por-tempo e outros elementos de ação.'),
(17, 'Survival horror', 'Survival horror (Horror de sobrevivência em português) é um gênero de jogos eletrônicos, no qual os temas são sobrevivência, terror e mistério. O elemento mais importante no survival horror é o de proporcionar uma certa quantidade de tensão sobre o jogador, mas também providenciar uma sensação de conquista que é alcançada derrotando as criaturas e superando a tensão e o medo. O principal objetivo do jogo é sobreviver a fatos inicialmente incompreendidos e misteriosos e, ao longo do jogo, descobrir os detalhes, desvendar os mistérios da história e encontrar soluções para os diversos quebra-cabeças apresentados.\r\n\r\nAcredita-se que o jogo Alone in the Dark foi quem cimentou a base para a fórmula atual, mas o gênero só ficou popular graças a Resident Evil, produzido pela Capcom e Silent Hill da japonesa Konami.'),
(25, 'TesteNome', 'TesteDescrição'),
(26, 'TesteNome', 'TesteDescrição');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'dinas', 'F2_v997ZflzhGaY63aKMiY-MCHYNKogP', '$2y$13$Yya28ng7B28iFcM4zv/nBuOvfHmGJkOCwDn0I80H1VAceb8pChawm', NULL, 'leopoldo31920@gmail.co', 10, 1604940036, 1604940036, 'TCFOTSEsxjfnbH5akRFcSxV3F1TW7Sbg_1604940036'),
(2, 'Lino', 'K88H4RalvKblbvr8-tmSpwLYSfFFDB6n', '$2y$13$Yya28ng7B28iFcM4zv/nBuOvfHmGJkOCwDn0I80H1VAceb8pChawm', NULL, 'lino@lino.com', 10, 1607287215, 1607287215, 'CV4eck89-SrKe72UiBoYDuf2GWTcjfq9_1607287215'),
(8, 'wqewqe', '95t8MmZn312TpH2CJsJ-rDrI8b3WUbIZ', '$2y$13$7HSTnbjkrxLSKfuc4E8aau4PuBuYYCnUO2vcu18vxv1xwlbf3yrzO', NULL, 'qweqwe@wqeweq.com', 9, 1609893272, 1609893272, 'XgrUoJ2sEcYPgrtn-8fSyHQQSQ5iZtYr_1609893272'),
(10, 'MilesDavis', 'deFUQV9Wi7PKwKuow8MHzc_2CsVns2Zt', '$2y$13$Ssk3GvcxaGHOX.JgNBW/CuUtl8Lkrr9CYGr7mIbx/24/jHZVecgZK', NULL, 'leopoldo31920@gmail.com', 0, 1610016014, 1610016014, 'ovjHZXwuXrh_s5yoFX9AnmElIzi8KtIP_1610016014');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`Id_utilizador`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`Id_jogo`) REFERENCES `jogos` (`Id`);

--
-- Limitadores para a tabela `jogos`
--
ALTER TABLE `jogos`
  ADD CONSTRAINT `jogos_ibfk_1` FOREIGN KEY (`Id_tipojogo`) REFERENCES `tipojogo` (`Id`);

--
-- Limitadores para a tabela `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`Id_Utilizador`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`Id_Jogo`) REFERENCES `jogos` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
