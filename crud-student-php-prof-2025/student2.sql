CREATE TABLE student2 (
  id INT(11) NOT NULL AUTO_INCREMENT,
  nom VARCHAR(100) NOT NULL,
  prenom VARCHAR(100) NOT NULL,
  mail VARCHAR(150) NOT NULL UNIQUE,
  adresse VARCHAR(255) DEFAULT NULL,
  telephone VARCHAR(20) DEFAULT NULL,
  date_naissance DATE DEFAULT NULL,
  genre ENUM('masculin','feminin') DEFAULT NULL,
  langues VARCHAR(255) DEFAULT NULL,
  niveau_etude VARCHAR(50) DEFAULT NULL,
  interets TEXT,
  photo VARCHAR(255) DEFAULT NULL,
  document VARCHAR(255) DEFAULT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
