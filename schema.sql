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
('WAUZZZ8K9CA000003', 'Audi', 'A4', 2015, 'Srebrny'),
('VF3CU8HR8EE000004', 'Peugeot', '207', 2008, 'Niebieski'),
('VF7FC8HZC9A000005', 'Citroën', 'C3', 2003, 'Szary'),
('VSSZZZ6LZ8R000006', 'Seat', 'Ibiza', 2011, 'Bialy'),
('WAUZZZ4F07N000007', 'Audi', 'A6', 2007, 'Grafitowy'),
('WBA3A51040F000008', 'BMW', 'Seria 3', 2016, 'Czarny'),
('KL1FA69158B000009', 'Chevrolet', 'Aveo', 2010, 'Czerwony'),
('SJNFAAJ10U1000010', 'Nissan', 'Qashqai', 2018, 'Zielony');


CREATE TABLE IF NOT EXISTS `uzytkownicy` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `nazwa` VARCHAR(20) NOT NULL UNIQUE,
    `haslo` VARCHAR(255) NOT NULL
);