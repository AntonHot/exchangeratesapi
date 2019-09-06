# API для получения курсов валют к рублю

**Методы**
* Возвращает список курсов валют с возможностью пагинации
http://exchangeratesapi.zzz.com.ua/currencies/10/2
* Возвращает курс валюты по id
http://exchangeratesapi.zzz.com.ua/currency/R01235
	
Котировки парсятся ежедневно через CRON скрипт по URL http://www.cbr.ru/scripts/XML_daily.asp  

Реализована авторизация через JWT (передавать через заголовок Authorization).

Технологии:
* PHP 7.1
* SLIM framework
* MySQL
