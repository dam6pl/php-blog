# Blog podróżniczy

Blog podrozniczy, z mozliwoscia tworzenia kont, dodawania postow oraz komentowania. Prosty system administracyjny dla uzytnownikow oraz administratorow bloga. 

## Załozenia projektowe
- [x] Edycja tresci dostępna tylko po zalogowaniu.
- [x] Mozliwosc rejestracji, jako uzytkownik.
- [x] Mozliwosc dodawania postow, zarzadzania wlasnymi postami oraz zarzadzania komentarzami dla uzytnownikow.
- [x] Mozliwosc zarzadzania wszytkimi postami oraz uzytkownikami dla administratorow.
- [x] Mozliwosc komentowania postow dla wszystkich.

## Srodowisko uruchomieniowe
Do uruchomienia projektu, zalecane jest skorzystanie z [serwera deweloperskiego PHP](http://php.net/manual/pl/features.commandline.webserver.php).
1. Przejść do katalogu w którym znajduje się Projekt.
2. Uruchomić serwer komendą `php -S localhost:3000`.
3. Od teraz blog dostępny jest pod adresem `http://localhost:3000`.


## Instalacja
1. Bazując na pliku `config-sample.conf`, utworzyć plik `config.conf`, oraz uzupełnić informacje o bazie danych.
2. Uruchomić stronę `http://localhost:3000` w przeglądarce. W tym momencie utworzą się wszystkie wymagane tabele w bazie danych.
3. Opcjonalnie, korzystając z klienta MySQL zaimportować plik `database.sql`, zawierający przykładowe dane.
4. Dostęp do panelu administracyjnego moliwy jest poprzez adres `http://localhost:3000/admin`. Przykładowa baza danych zawiera konto `admin` z hasłem `WSB-NLU`, z uprawnieniami administratora.


# Autorzy
* [Damian Nowak](mailto:damiannowak42@gmail.com)
* Jacek Kopka