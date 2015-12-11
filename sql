CREATE TABLE Comment(
 Identifier INT AUTO_INCREMENT NOT NULL primary key,
 BlogID INT not NULL,
 ComTime datetime not null,
 ComName nvarchar(50) not null,
 Email nvarchar(200) not null,
 Commet text
)ENGINE=InnoDB DEFAULT CHARSET=utf8