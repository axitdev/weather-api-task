## Mid|Senior PHP Developer - Laravel task v6 - Weather

## Configurations
1. Create `.env` file from `.env.example`
2. Configure DB connection (you can use `sqlite`)
3. Configure Query connection (you can use `sqlite`)
4. Add your API key from OpenWeatherMap to `GEOCODING_TOKEN` and `WEATHER_TOKEN`
5. Run migrations `php artisan migrate`
6. Run query worker `php artisan queue:work`
7. Add cities by running command `php artisan cities:new` (ex. `php artisan cities:new Kraków Wrocław Warszawa`)
8. Now time to request `/weather` endpoint with array of cities names (method POST), this will update temperature data for selected cities
9. `/weather` endpoint with method GET will return list of cities only with today's temperature

## Problems
Rozwiązanie działa, ale jak na mnie nie jest kompletnie, niestety w ramach tych kilku godzin nie dałem rady zrealizować wszystkie pomysły.

Kilka problemów:
1. Brak testów, zabrakło mi czasu.

2. Brak komendy na ponawianie temperatury cron'em

3. Brak contract'ów do domen, trzeba to zmienić i dodać binding poprzez service provider'ów.

4. Chciałbym przenieść więcej kodu do '/src' i rozdzielić HTTP app od CLI.

5. Brak cachowania, GET `/weather` - jest idealnym miejscem na to.

6. Dużo nieobsłużonych i zignorowanych przypadków (np. może być kilka miast z taką samą nazwą, mój kod po prostu na to nie pozwala)

7. Koordynaty miasta lepiej przerobić na ValueObject

8. Weather API Service i Geocoding API Service można zrobić lepiej

# Opis zadania
Przedmiotem zadania jest przygotowanie rozwiązania, które będzie komunikowało się z API serwisu pogodowego i zapisywało otrzymane dane w lokalnej bazie danych.
Potrzebujemy móc przeglądać wcześniej zapisane dane. Wiemy, że użytkownik aplikacji może podać konkretne miasto, a aplikacja wykona requesty do API serwisu pogodowego i pobierze dane o pogodzie. Możesz skorzystać z API https://openweathermap.org/api lub dowolnego innego, które znasz.

## Środowisko
- PHP 7.4+ (preferowane 8.1+),
- Laravel 7+,
- Mysql / MariaDB.

## Kryteria
Opis rozwiązania dotyczy Laravel-a. W przypadku Symfony, oczekujemy adekwatnych rozwiązań, czyli zamiast Eloquent-a interesuje nas rozwiązanie oparte o Doctrine itd.

Rozwiązując zadanie należy:
- zaprojektować strukturę bazy danych (Eloquent models, migrations),
- wdrożyć niezbędne funkcjonalności używając wzorców projektowych oraz dobrych praktyk,
- przygotować dane i zapisać je do bazy,
- jeżeli to możliwe, przygotować testy dla aplikacji.

## Specyfikacja

Aplikacja umożliwia dodanie jednego lub kilku miast do bazy i dodatkowo zapisuje informacje
o dzisiejszej temperaturze w mieście pobrane z API serwisu pogodowego.
Przy pobraniu informacji o pogodzie dla zapisanych miast, dane odczytywane są wyłącznie z bazy danych.

Wymagane API endpoints:
- POST /weather - zapisuje w bazie pogodę (dzisiejszą temperaturę) dla danego miasta na dziś. W momencie próby dodania miasta, dla którego nie ma pogody lub wystąpienia innego błędu, należy poinformować o błędzie. W ramach jednego zapytania, można dodać wiele nazw miast.
- GET /weather - zwraca listę miast z pogodą na dziś.

## Uwagi

Szanujemy Twój czas - nie spędzaj więcej niż 3 godziny nad rozwiązaniem. Zrecenzujemy każdy dostarczony kod, nawet niekompletny. Chcemy sprawdzić jakie są Twoje umiejętności i w jaki sposób myślisz. Zadanie ocenimy w oparciu o poziom ukończenia, wydajność, styl programowania (wzorce projektowe), ogólną czystość i elegancję kodu oraz commity.
W repozytorium stwórz proszę README.md z:
- Twoim imieniem oraz adresem email,
- opisem poczynionych założeń, wyjaśnień czy dodatkowych pytań, jakie zadałbyś podczas planowania,
- ewentualnymi pomysłami, jak dalej można rozwijać takie rozwiązanie (odpowiadając, nie robimy api pogodowego, to tylko ćwiczenie).
