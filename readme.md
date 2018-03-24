# Pantry To Plate
Final year project for the Bachelor of Information Technology (CPT331 Programming Porject). Laravel based website for matching users to recipes based on key ingredients they have and cuisine preferences. 

## Running the project
After installing Php 5.6.* and ensuring that Laravel is running ok with PhpStorm:
- navigate to the project directory using command line. Windows users I suggest [Git for Windows](https://git-for-windows.github.io/)
- run `touch database/database.sqlite`
- run `php artisan migrate`
- run `php artisan db:seed`

This will create the database file as an sqlite file (perfect for development), create the tables and seed a few of them.
The solution as yet does nothing, but I will be adding to the master branch some proof of concept related work over the coming days,
to demonstrate using an api to do what we need to do.
