--
-- Base de données: `sondages`
--
-- ajout du jeu de test



--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id`, `name`, `firstname`, `email`, `password`) VALUES
(1, 'sparrow', 'jack', 'jacksparorw@hotmail.com', 'rhum'),
(2, 'degy', 'helene', 'helenedegy@yahoo.fr', 'ln');



--
-- Contenu de la table `enquete`
--

INSERT INTO `enquete` (`id`, `titre`, `description`, `id_user`) VALUES
(1, 'enquête alcool', 'enquete sur la consommation d'' alcool des gens entre 15 et  25 ans', 1),
(2, 'enquête sur les consommateurs de drogues ', 'enquête sur les differentes drogues consommées entre les jeunes entre 15 et 25 ans', 1);


--
-- Contenu de la table `questions`
--

INSERT INTO `question` (`id`, `libelle`, `type`, `id_enquete`) VALUES
(1, 'Etes vous : ', 'qcm', 1),
(2, 'combien de fois allez vous dans un bistrot par jour ?', 'nb', 1),
(3, 'Que buvez vous le plus souvent comme alcool ?', 'text', 1),
(4, 'le cannabis est-il une drogue douce a des fins therapeutique?', 'qcm', 2),
(5, 'Que penses-vous de la consomation de drogue en soirée ?', 'text', 2),
(6, 'Combien de joints avez-vous fumé occasionnellement ?t ?', 'nb', 2),
(7, 'Parmi ces drogues quelle est la plus addictive ?', 'qcm', 2);


--
-- Contenu de la table `proposition`
--

INSERT INTO `proposition` (`id`, `libelle`, `id_question`) VALUES
(1, 'Homme', 1),
(2, 'Femme', 1),
(3, 'Le cannabis', 7),
(4, 'L''heroine', 7),
(5, 'La cocaïne', 7),
(6, 'L''exctasie', 7),
(7, 'Le crack', 7),
(8, 'Le lsd', 7),
(9, 'l'' opium', 7),
(10, 'oui', 4),
(11, 'non', 4);


--
-- Contenu de la table `reponses`
--

INSERT INTO `reponse` (`id`, `uid_repondant`, `contenu`, `id_question`, `id_proposition`) VALUES
(1, 1, NULL, 1, 1),
(2, 1, 'vin', 3, NULL),
(3, 1, '6', 2, NULL),
(4, 2, NULL, 4, 10),
(5, 2, 'C est une question de mode qui change avec le temps.', 5, NULL),
(6, 2, '12', 6, NULL),
(7, 2, NULL, 7, 4),
(8, 3, NULL, 1, 2),
(9, 3, '5', 2, NULL),
(10, 3, 'bière', 3, NULL);


