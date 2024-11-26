# Haushaltsplaner

This webapp is designed to be used in German language, so all the descriptions here are in German as well. Please feel free to use the translator of your choice if this is not your favorite language :o) 

## Worum geht es?
Der Haushaltsplaner ist eine PHP basierte Webapp, vor allem um mit PHP vertrauter zu werden. In einer Version 1.0 sollte die Anwendung einem registierten Nutzer erlauben, typische Haushaltsaufgaben zu organisieren. Außerdem ist eine gamification Komponente geplant.

## Wie kann man die Anwendung benutzen?
Für die Entwicklung verwende ich xampp, insbesondere den apache Server und die mysql Datenbank. Um die Anwendung einfach mal zu starten, reicht es einen Apache Webserver zu starten und das Hauptverzeihcnis des Repositories als root-Verzeichnis für den Server zu setzen.

Um einige Beispieldaten aus der Datenbank für die dynamische Inhaltsanzeige zu laden, kann das sql Skript [haushaltsplaner_dump.sql](haushaltsplaner_dump.sql) in einen aktiven MYSQL oder MariaDB Server importiert werden. Damit wird die Webanwendung wesentlich nützlicher ;-)

Grundsätzlich ist die Anwendung auch kontaineriserbar, so läuft sie auch bei lokal auf meinem kleinen Homeserver mit je einem Container für den Apache Server mit PHP und einem Container für die Datenbank. Dazu finden sich einige Anleitungen im Web.