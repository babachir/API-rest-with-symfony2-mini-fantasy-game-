#Instructions for the Appturbo Exercise

This exercise aims to implement a micro API to simulate a fantasy themed mini-game.

## Context
This mini-game is very simple. We should be able to create 2 types
of fighters : Knights and Trolls.

Each of them has different types of stats resulting in a Power Level.

Then there is an Arena where duels are held. An arena can register 2 fighters,
the fighter with the higher Power Level wins the duel.

## Data Model
We will now explain in details the data model.

### FighterInterface
The **FighterInterface** is the interface that will be used by the **Arena** to organize fights 
between combatants. The combatants can be totally different, if they implement this interface, they can fight in the Arena

There are 2 methods in **FighterInterface** :

* `getId()` returns an Integer which represents the ID of the combatant within its own class
* `calculatePowerLevel()` returns an Integer which represents the Power level of the Fighter


### Human class ###
The **Human** class is an abstract class to represent a Human.

The only attribute a Human has is a **name** (a simple String)

### Knight class ###
The **Knight** class is a subclass of **Human**. It's an entity that can be stored in the database.

The Knight has 2 specific attributes:

* the **strength** (Integer) which represents the strength of the Knight
* the **weaponPower** (Integer) which represents the power of the weapon wielded by the Knight

The Knight is a fighter. As such it implements the **FighterInterface**

The Power level of a Knight can be obtained by adding its **strength** and its **weaponPower**


### Troll class ###
The **Troll** class is also an entity that can be stored in the database.

It has only a specific attribute:

* the **strength** (Integer) which represents the strength of the Troll

The Troll is a fighter class. As such it implements the **FighterInterface**

The Power level of a Troll can be obtained by doubling its **strength**

## The Arena Service
This service is only here to simulate a duel between 2 classes implementing the **FighterInterface** 

It is a simple class with a unique static method called `fight` which takes 2 combatants and made them fight
by comparing their Power Level.

The method should return the winner (as an object) or return the 0 value if the duel is a draw (the
2 combatants have the same Power Level)

## API Design
This mini-game simulator should be designed as an API.

You will see all the needed endpoints for the resources in the 
*src/Appturbo/ExerciseBundle/Resources/config/routing.yml*

All the content exchanges with the API should be done in JSON

All the endpoints should have the same behaviour with status codes
sent back to the client :

* 201 status code when the request is correct and the response has been correctly sent back
* 400 status code when the request is wrong (bad parameters, not a JSON payload etc...)
* 404 status code when the resource is unavailable or does not exist

You can check the tests written for the exercise to have examples of expected status codes depending of the request.

If you have never seen functional tests you can go [THERE](http://symfony.com/fr/doc/current/book/testing.html) to understand the syntax

This project can use the [FOSRestBundle](https://github.com/FriendsOfSymfony/FOSRestBundle) to help with some REST problematics.
The config of the bundle is located in the *app/config/config.yml*. It is already configured to work with JSON content by default.

The controllers can for example extend the **FOSRestController**

But it's all optional, you can also build the responses yourself.

## Controller Handlers (optional)
When building a REST API, a good practice is to have very thin controllers with less logic as possible.

All the logic can be relocated into special services called **Handlers**.
We have created a **HandlerInterface** located at *src/Appturbo/ExerciseBundle/Handler/HandlerInterface.php* which defines how we will interact with our resources. 
You can create custom handlers implementing this interface for your controllers to host a large part of the logic.

This part is optional. Don't forget that having a less elegant but working project is more important. 


## Project Skeleton
The project is not empty by default. You will find several files already written for you:

* *Resources/config/routing.yml* where you'll find the API endpoints
* *Model/FighterInterface*
* *Model/Human*
* *Handler/HandlerInterface*
* *Exception/InvalidFormException*




## What you have to do ##
For the API to work and for the tests to pass, you need to:

* correctly implement the resources following the data model explained previously
* build the correct controllers to interact with these resources
* as it's an API, you should return the correct responses depending of the requests.
* your implementation should be compliant with the tests already written


## Note about the testing phase
The tests are executed in this order:

* **KnightControllerTest**
* **TrollControllerTest**
* **ArenaTest**

You'll note that the controllers tests insert some data in the database in order to test the POST queries.
As such it is recommended to empty the database between tests runs and rebuild the database schema to avoid any unexpected problems.

* First drop the schema: `php app/console doctrine:schema:drop --force`
* Second re-create the schema: `php app/console doctrine:schema:create`