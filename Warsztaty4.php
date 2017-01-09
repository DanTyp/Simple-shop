<?php
/*
W bazie danych Łukasz ma tabele
Admins
Categories
Messages
Orders +
Photos +
Products +
Products_Orders +
Statuses
Users +

między zaówieniami a produktami relacja wiele do wielu
    
zamówienia mogą być zapisywane do bazy danych lub trzymane w sesji, 
        
        oczekujące - to co w koszyku
        złożone - to zatwierdzone
        
        opłacone i zrealizowane -> statusy zmieniane przed administratora, nie teorzymy tabeli z rachunkiem w dba_list()
        
        status_id i nie trzymamy statusów w formie napisu w tabeli orders musi być też też status_id
        
        w orders: id/user_id/status_id/address/total_price
    
    ADMINISTRATORZY:
    Sklep musi być podzielony na 2 moduły: Moduł sklepu jest w katalogu Shop i katalog Admin/Panel - zawera pliki odpowoiedzialne za panel 
    administratora -> oba panele korzystają z tej samej bazy danych
        
        karuzela - JS/jQuery np co jakiś czas zmienia się zdjęcie produktu
        
        Użytkownik może zobaczyć tylko swój panel po zalogowaniu
        
        strona koszyka -> składamy zamówienie, liczba przedmiotów, możemy zwiększyć bądź zmniejszyć liczbę przedmiotóœ lub je z koszyka usunąć, po 
        klknięciu na zamów status zmieni sie na złożony
        
        
        
        PANEL ADMINISTRACYJNY 
        Ma umożliwiać zarządzanie grupami, ma być w bazie danych tabelka z id_grupy i jej nazwa, administrator ma mieć możliwość wyboru do któ©ej
            grupy przedmiot należy, jak to określi to dodaje cene, ilość, opis i zdjęcie
        
        Dodatkowo administrator widzi zamówienia i dane użytkowników.
        
        ktalogi jakie ma łukasz
        admin/
        datasets/media/shop/src/tests/vendor/ composer.json i composer.lock
        
        statusy:
        1 - pending
        2 - confirmed
    3- paid
    4- completed
    
    logowanie jest na sesji, koszyk na bazie danych
        
        
        są 2 podejścia jeżeli usuwamy kategorię - zeby produty tej kategorii usunąć lub nie -> On Delete Set null -> to po usunięciu
        grupy id_grupy danego produktu będzie ustawiony na null -> klient nie owinien widziec tych produktów ale admin tak
        
        
        administrator ma stronke edytwania zamówienia gdzie moze np zmienić status zamówienia
        

