CREATE TABLE IF NOT EXISTS `pojazdy` (
    `vin` VARCHAR(17) NOT NULL,
    `marka` VARCHAR(50) NOT NULL,
    `model` VARCHAR(50) NOT NULL,
    `rok_produkcji` INT NOT NULL,
    `kolor` VARCHAR(30) NOT NULL,
    PRIMARY KEY (`vin`)
);

INSERT INTO `pojazdy` (`vin`, `marka`, `model`, `rok_produkcji`, `kolor`) VALUES
('1FA6P8CF0H5100001', 'Ford', 'Mustang', 2017, 'Czerwony'),
('WVWZZZ3CZWE000002', 'Volkswagen', 'Passat', 2019, 'Czarny'),
('WAUZZZ8K9CA000003', 'Audi', 'A4', 2015, 'Srebrny');


CREATE TABLE IF NOT EXISTS `uzytkownicy` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nazwa` VARCHAR(20) NOT NULL UNIQUE,
    `haslo` VARCHAR(255) NOT NULL
);