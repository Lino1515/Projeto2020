-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 11-Nov-2020 às 22:40
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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
(14, 'Puzzle', 'ogo eletrônico de quebra-cabeça (também conhecidos como jogo puzzle ou jogo de puzzle) é um gênero de jogo eletrônico ou de alguns jogos de video game que se foca em solucionar quebra-cabeças. Os tipos de quebra-cabeças a serem resolvidos podem testar diversas habilidades do jogador, como lógica, estratégia, reconhecimento de padrões, solução de seqüências e ter que completar palavras.\r\n\r\nJogos da categoria envolvem uma variedade de desafios de lógica e conceito, apesar de ocasionalmente eles adicionarem pressão-por-tempo e outros elementos de ação.');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(1, 'dinas', 'F2_v997ZflzhGaY63aKMiY-MCHYNKogP', '$2y$13$Yya28ng7B28iFcM4zv/nBuOvfHmGJkOCwDn0I80H1VAceb8pChawm', NULL, 'leopoldo31920@gmail.com', 10, 1604940036, 1604940036, 'TCFOTSEsxjfnbH5akRFcSxV3F1TW7Sbg_1604940036');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`Id_utilizador`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`Id_jogo`) REFERENCES `jogos` (`Id`);

--
-- Limitadores para a tabela `comentariosreports`
--
ALTER TABLE `comentariosreports`
  ADD CONSTRAINT `comentariosreports_ibfk_1` FOREIGN KEY (`Id_utilizador`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comentariosreports_ibfk_2` FOREIGN KEY (`Id_comentario`) REFERENCES `comentarios` (`Id`);

--
-- Limitadores para a tabela `comentariosutilizador`
--
ALTER TABLE `comentariosutilizador`
  ADD CONSTRAINT `comentariosutilizador_ibfk_1` FOREIGN KEY (`Id_utilizador`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `comentariosutilizador_ibfk_2` FOREIGN KEY (`Id_comentario`) REFERENCES `comentarios` (`Id`);

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

--
-- Limitadores para a tabela `reviewreports`
--
ALTER TABLE `reviewreports`
  ADD CONSTRAINT `reviewreports_ibfk_1` FOREIGN KEY (`Id_utilizador`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `reviewreports_ibfk_2` FOREIGN KEY (`Id_review`) REFERENCES `review` (`Id`);

--
-- Limitadores para a tabela `reviewutilizador`
--
ALTER TABLE `reviewutilizador`
  ADD CONSTRAINT `reviewutilizador_ibfk_1` FOREIGN KEY (`Id_Utilizador`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `reviewutilizador_ibfk_2` FOREIGN KEY (`Id_review`) REFERENCES `review` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
