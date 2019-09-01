# ТЗ

1. Создать базу данных  
Таблица **currency**  
	* **id** — первичный ключ  
	* **name** — название валюты  
	* **rate** — курс валюты к рублю  
2. Написать консольный скрипт для парсинга и загрузки котировок в БД  
	Котировки парсить по URL http://www.cbr.ru/scripts/XML_daily.asp  
3. Реализовать два API метода  
	* **GET /currencies** — должен возвращать список курсов валют с возможностью пагинации  
	* **GET /currency/** — должен возвращать курс валюты для переданного id  
	* Должна быть реализована авторизация по токену  
* Можно использовать SLIM framework
