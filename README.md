# AutoRej.sys

System zarządzania pojazdami napisany w PHP. Aplikacja pozwala przeglądać bazę pojazdów oraz przygotowana jest do obsługi logowania, dodawania, wyszukiwania i usuwania rekordów.

## Funkcje

- wyświetlanie pojazdów w tabeli,
- wyświetlanie liczby rekordów,
- obsługa danych: VIN, marka, model, rok produkcji i kolor,
- formularz logowania,
- osobne podstrony do wyszukiwania, dodawania i usuwania pojazdów,
- MySQL jako baza danych,
- uruchamianie aplikacji w Dockerze.

## Wymagania

- Docker Desktop,
- Docker Compose,
- Git.

## Uruchomienie lokalne

1. Sklonuj repozytorium:

```bash
git clone https://github.com/TWOJ_LOGIN/autorej-system.git
cd autorej-system
```

2. Utwórz lokalny plik `.env` na podstawie przykładu.

PowerShell:

```powershell
Copy-Item .env.example .env
```

Linux/macOS:

```bash
cp .env.example .env
```

3. Uruchom kontenery:

```bash
docker compose up -d
```

4. Otwórz aplikację w przeglądarce:

```text
http://localhost:8080
```

Baza danych jest inicjalizowana na podstawie pliku `schema.sql`.

## Konfiguracja środowiska

Przykładowe zmienne znajdują się w `.env.example`. Lokalny `.env` zawiera dane używane przez Docker i nie powinien być dodawany do repozytorium.

Najważniejsze zmienne:

```env
MYSQL_ROOT_PASSWORD=change_me
MYSQL_DATABASE=projekt
DB_HOST=db
DB_USER=root
DB_PASSWORD=change_me
DB_NAME=projekt
```

## Struktura projektu

```text
.
├── docker-compose.yaml
├── schema.sql
├── .env.example
├── .gitignore
└── src/
    ├── index.php
    ├── szukaj.php
    ├── dodaj.php
    ├── usun.php
    ├── kody.php
    ├── style.css
    └── assets/
```

## Dane demonstracyjne

Dane przykładowe znajdują się w `schema.sql`. Przed użyciem aplikacji produkcyjnie należy zmienić hasła i nie publikować prawdziwych danych dostępowych.

## Licencja

Projekt edukacyjny.
