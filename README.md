# Tournament-Manager

* Intro to Relational Databases assignment(Swiss tornament manager) solution using PHP-Lumen(https://lumen.laravel.com/).
* Link to course: https://www.udacity.com/courses/ud197

## TODOS:

### This list can be constantly updated to include more development steps.

* Write the DB structure -> update a dump file for each change.
    * Include Users table -> DONE
    * Include Players table -> DONE
    * Include Games table -> DONE
    * Include Tournaments table. -> DONE
    * Include Administrators table. -> DONE
    * Include matches table. -> DONE
    * Include rankings table. -> DONE
    * Prevent rematches from players.
    * Design a bye(skipped round).
    * Design support for draws. -> DONE
    * Design support for OMW (Opponent Match Wins).
    * Design support for more than one tournament. -> DONE
* Install PHP-Lumen. -> DONE
* Write the migrations inside PHP-Lumen. -> DONE
* Manage tests folder structure. -> DOING ...
* Add testDummy factories for the model classes.
    * Add factories for the User model. -> DONE
    * Add factories for the Player model. -> DONE
    * Add factories for the Administrator model. -> DONE
    * Add factories for the Game model. -> DONE
    * Add factories for the Tournament model. -> DONE
    * Add factories for the Match model. -> DONE
    * Add factories for the Rankings model. -> DONE
* Write integration tests for the repositories.
    * Add tests for the users repository. -> DONE
    * Add tests for the players repository. -> DONE
    * Add tests for the administrators repository. -> DONE
    * Add tests for the games repository. -> DONE
    * Add tests for the tournaments repository. -> DONE
    * Add tests for the matches repository. -> DONE
    * Add tests for the rankings repository. -> DONE
* Write model classes.
    * Add User model. -> DONE
    * Add Player model. -> DONE
    * Add Administrator model. -> DONE
    * Add Game model. -> DONE
    * Add Tournament model. -> DONE
    * Add Match model. -> DONE
    * Add Rankings model. -> DONE
* Write the repositories.
    * Add Users repo. -> DONE
    * Add Players repo. -> DONE
    * Add Administrators repo. -> DONE
    * Add Games repo. -> DONE
    * Add tournaments repo. -> DONE
    * Add Matches repo. -> DONE
    * Add Rankings repo. -> DONE
* Write the unit tests for the services methods. -> DOING ... 
    * Add the Players Service unit test -> DONE
    * Add The Administrator Service unit test. -> DONE
    * Add the Tournaments Service unit test. -> DONE
    * Add the Matches Service unit test. -> DONE
    * Add the Rankings Service unit test. -> DONE
    * Add the Swiss Service unit test. -> DOING ...
* Write the Services -> DOING ...
    * Add Players Service. -> DONE
    * Add Administrators Service. -> DONE
    * Add Tournaments Service. -> DONE
    * Add Matches Service. -> DONE
    * Add Rankings Service. -> DONE
    * Add Swiss Service. -> DOING ...
* Add Helper file for the mockery related code. -> DONE
* Add General utils folder.
* Add Util for generating pairings.
* Add helper file for helper functions.
* Refactor existing admin dependencies on the models, repositories and services.
* Add Admin dependency to the admin related methods on the repositories.
* Add Admin Validation on the admin related services.
* Add getModel method on the repositories.
* Add Admin Auth validation Middleware.
    * Test this functionality with unitary tests.
    * Add the validation code. 
* Add a Facade for the Administrators service. -> DONE
* Add soft delete to the Models.
* Write the functional tests for the controller methods.
* Add the Routes.
* Write the controllers.
