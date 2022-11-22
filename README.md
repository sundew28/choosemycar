<p align="center"><h1>ChooseMyCar Laravel Test</h1></p>



## Installations / Instructions

Clone:- https://github.com/sundew28/choosemycar

With this simple laravel app, you will get to see the basics of this doing following:-

1. Adding dealers and vehicles
2. Listing of vehicles for each dealers

The application is designed with the repository pattern design keeping in mind the S.O.L.I.D principles

To begin with after you have cloned the repository run composer to install all required packages.

``` composer install ```

Open `.env` file to configure your `database` and it's `name`, `host`, and `password` 

I had used a virtual domain to make application as part of testing using WAMP virtual domain feature. You can set the domain as you wish.

Run the migration command to generate the tables

``` php artisan migrate ```

Two migration tables `Dealers` and `Vehicles`  has been added with a foriegn key in between

As mentioned before i have used the repository design pattern while coding the application. The main purpose of this is centralization of the data access logic makes code easier to maintain, business and data access logic can be tested separately, reduces duplication of code, a lower chance of making programming errors.

You can see i have created a `Repository` folder in `\app` and it holds one more folder `Eloquent` which has the controller files and outside this folder you have `Interface` class files set up which are registered in the providers folder under `RepositoryServiceProvider` file

In order to see the app in action you can run the following console commands
	
	a) php artisan feed:process --dealers=<YOUR_DEALER_XML_OR_JSON_FILE> --vehicles=<YOUR_VEHICLE_XML_OR_JSON_FILE>
	b) php artisan feed:list-dealers-with-cars

```
An example how your output will be when you list the dealers and their vehicle inventory status

Vehicles response :

AB Cars : Available 2 Reserved 1 Sold 2

Manchester Cars : Available 1 Reserved 2 Sold 2

Liverpool Cars : Available 1 Reserved 5 Sold 0

CD Cars : Available 2 Reserved 0 Sold 2

Gatley Cars : Available 1 Reserved 1 Sold 0

Warrington Cards : Available 1 Reserved 3 Sold 4

EF Cars : Available 1 Reserved 1 Sold 1

Super Cars : Available 1 Reserved 1 Sold 3

Space Cars : Available 0 Reserved 2 Sold 1

Fast Cars : Available 0 Reserved 3 Sold 2

```
I have not created the test cases to test the unit test or functional test on a programmer or user perspective. This can be achived but wanted to limit within the time given what i can do.