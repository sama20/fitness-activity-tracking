
<h1 align="center"> Fitness Activity Tracking Application </h1>

<p align="center">
<img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status">
</p>

## Usage

### Installation
* Clone the repository
* Add the `.env` file from `.env.example`
* Change the database configuration in the `.env` file
* Run the `composer install` command
* Run the `php artisan test` command (for testing and migration) or `php artisan migrate` (only migration)
* (optional) Run the `php artisan db:seed --class=ActivitySeeder` command
* Configure a web server with `Apache` or `Nginx` or run `php artisan serve`

### Calling the Routes

There is a JSON file to import into **Postman** and call the routes below:

[Postman_Collection](./public/Fitness%20Activity%20Tracker%20API.postman_collection.json).

## Implementation Facts and Details

**Table Design:** First, I want to say that I do not agree with declaring fields like `distance` and `distance_unit` separately. 
In this implementation, we create a dependency between the two fields and it also violates consistency within the `distance` field. 
At one time, there is data in meters and at another time, there is data in kilometers in the same field. 
A better approach would be to remove `distance_unit` from the table and keep `distance` in a unified unit like meters, and handle unit conversion only during reading and creation.
However, in respect of the assignment, I followed the initial approach.

**Requested Functions:** There was no request for adding CRUD functionality for activities, but I added a `store` method to showcase my skills in handling user requests.

**Framework:** This project uses the latest versions of the Laravel framework (v10) and the PHP language (v8.2).

**PHP Features:** I have utilized the latest PHP features such as Enumeration, Readonly, Nullsafe operator, Constructor Property Promotion, Union Types, and more.

**Error Handling:** For error handling, I believe it is better to handle errors in specific scenarios where it is necessary, such as working with I/O or making API calls. In other situations, it is better to handle logical errors with code, for example, when a requested data does not exist. For this project, I have added appropriate exception throwing for invalid user input.

**DocBlocks:** I did not extensively use DocBlocks due to the power of type declaration in PHP. DocBlocks are not necessary in such cases.

**Tests:** There are 8 tests that include both unit tests and feature tests, covering all the functionality.

**Function Description:** I have tried to take a comprehensive approach in this small project and have paid attention to important factors in software development such as extensibility, maintainability, modularity, etc. 
For example, this approach ensures that future development on this project will be of higher quality and based on software standards.

| Folders/Files                 | Description                                                                                                     |
|-------------------------------|-----------------------------------------------------------------------------------------------------------------|
| ActivityRequest               | Use this file to handle requests before sending them to the controller                                          |
| AbstractDTO  ActivityDTO      | Use this file to create an appropriate object for a request and send it to the request with this approach. This allows for better request management in the service layer |
| IDataTransferObject  IService | These are empty interfaces for possible future use                                                              |
| ActivityService               | The services layer is the best place to implement the main logic of the project. It helps maintain Single Responsibility for models and controllers                       |
| ActivityException             | Custom exception class for handling activity-related exceptions                                                 |

Other files and classes such as Migration, Seeder, Model, and Controller are based on Laravel documentation and are self-explanatory.

## What Did I Learn?

With this small project, I made an effort to focus on designing an extensive and modular system, and I believe I have improved in this area compared to my past projects. Additionally, in the past, I had only read about using `Mocks`, but during this project, I had the opportunity to apply them in practice.

## Future Works

* Complete CRUD functions
* Add a frontend project to consume this API
* Add `repository` or `resource` files
* Add a `user` section
* Consider adding another database connection for testing purposes if the project is used in a real-world scenario

## Contact

I'm open to receiving any feedback about the project:
[Asghari.moha@gmail.com](mailto:Asghari.moha@gmail.com)