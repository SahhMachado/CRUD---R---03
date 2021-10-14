  CREATE TABLE `estudante`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `n1` float,
  `n2` float,
  `n3` float,
  `n4` float,
  `media` float,
  `situacao` varchar(45),
  `nascimento` date,
  `idade` int,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;

 CREATE TABLE `carro`(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `valor` double,
  `km` float double,
  `dataFabricacao` date,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=UTF8;