# JOY - TOP data aggregation platform

<img 
src="https://github.com/AzamkhonKh/datahack_back/blob/master/public/images/jt_logo.png" 
width="400" 
style="background-color: white !important;" 
alt="JOY TOP LOGO">

## About

Програмноаппаратный комплекс JOY TOP позволяет выполнить первичную выгпузку пилотных данных. [app/Console/Commands/GetDtpData.php](https://github.com/AzamkhonKh/datahack_back/blob/master/app/Console/Commands/GetDtpData.php)

C помощью подсистемы Nix выполнить подготовку комплекса Postgres + PostGIS + Kosmtik, с соглосованными зависимостями и использовать их для обработки данных из первичной выгрузки. [DIR]((https://github.com/AzamkhonKh/datahack_back/blob/master/kostmiks/gis-synthesis-28b.tar)


Обзятельно не забудьте про визуализацию, при запуске Laravel  приложения она находиться в пути '/map'


## Deployment 

Для успешного разворячевония на виртуальной машине требуется машина на архитектуре x86-64 Linux комлекс состоит из котеиноров
 - 1 PostGIS 
 - 8 Kosmtik


## License

Данный проект был разработан на хакатоне [OpenDataChallange Toshkent, Uzbekistan] (https://datahack.uz/)
Данный проект является не лицензированным проприетарным за исключением входящих в его состав компонентов,
которые распространяються под их соответствующей лицензией.
