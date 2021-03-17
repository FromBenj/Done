# Done

Your time is valuable. Being organized is the best way to save time.

Done is a simple web app / mobile web app that helps you list and manage your tasks to be done in order to create daily and weekly customizable to-do lists.

I created this web app during a 8-hour school exam. 

# How to run
- clone the repo
- run ```composer install```
- run ```yarn install```
- run ```yarn encore dev```

- create a .env.local file, and add your database information.
- run ```symfony console d:d:c``` to create this database
- run ```symfony console d:m:m``` to execute migrations and create tables
- run ```symfony console d:f:l``` to load the fixtures

- run ```symfony server:start```
