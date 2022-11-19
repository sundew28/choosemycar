<p align="center"><h1>ChooseMyCar Laravel Test</h1></p>



## Installations / Instructions

Clone:- https://github.com/sundew28/choosemycar

With this simple laravel app, you will get to see the basics of this is just a simple rest API to perform the following:-

1. Users get to view tasks assigned to them per project-id.
2. Users get to log the time spend on each task.
3. Admin users get the option to list all logged time entry.

The OWASP Top Ten is a standard awareness guide about web application security and consists of the top most critical security risks to web applications.Laravel takes care of many of these security features out the box. As part of the authentication i have implemented JWT authentication to
generate token once the user login. And the bearer token is set while calling endpoints.

The application is designed with the repository pattern design keeping in mind the S.O.L.I.D principles

To begin with after you have cloned the repository run composer to install all required packages.

``` composer install ```

Open `.env` file to configure your `database` and it's `name`, `host`, and `password` 

I had used a virtual domain to make api calls as part of testing using WAMP virtual domain feature. You can set the domain as you wish.

Run the migration command to generate the tables

``` php artisan migrate ```

After that run the db seeder command which will seed the users, projects, tasks table

``` php artisan db:seed ```

I have add 4 basic users and one admin user as default as below with password set for all as `121212`

```
admin@example.com

andrew@example.com

charles@example.com

ann@example.com

liza@example.com

```
The projects and tasks tables i have used `faker` to generate dummy data to use.

A middleware `RoleAuthorization` is created in `\app\Http\Middleware` which determines whether a logged user has access to called endpoints or not.

If you navigate to the `\app\Http\Controllers` folder you can see there is JWTController file which authenticaties the user credentials while login and logout. The TasksController is set as the single entry point for the API endpoints.

As mentioned before i have used the repository design pattern while coding the application. The main purpose of this is Centralization of the data access logic makes code easier to maintain, business and data access logic can be tested separately, reduces duplication of code, a lower chance of making programming errors.

You can see i have created a `Repository` folder in `\app` and it holds one more folder `Eloquent` which has the controller files and outside this folder you have `Interface` class files set up which are registered in the providers folder under `RepositoryServiceProvider` file

In order to get the bearer token you need to login with your user credentials to the URL ` <your-domain>/api/login `
	<b>Params</b><br>
	a) email
	b) password

There are 3 endpoints set up as below. I have used postman to test my API calls.

1. `/tasks`

    The purpose of this endpoint is to list all tasks assigned to specific user once they login. To call the endpoint you simply need to use the url as shown after you login 

    ` <your-domain>/api/tasks `

    Should give you a result like the example shown below

    ```

    [
	    {
	        "TaskId": 1,
	        "Title": "Ipsam vitae iste magnam tenetur nulla eos autem.",
	        "Content": "THEIR eyes bright and eager with many a strange tale, perhaps even with the day of the trees behind him. '--or next day, maybe,' the Footman continued in the house opened, and a large ring, with the Duchess, 'and that's the jury-box,' thought Alice, 'to speak to this mouse? Everything is so.",
	        "DateCreated": "2022-11-14 12:35:27",
	        "ProjectId": 2
	    },
	    {
	        "TaskId": 3,
	        "Title": "Inventore eos dolore autem ullam ut praesentium in omnis quia quo sunt.",
	        "Content": "March Hare. 'Exactly so,' said Alice. 'Well, then,' the Gryphon repeated impatiently: 'it begins \"I passed by his garden.\"' Alice did not venture to say whether the blows hurt it or not. 'Oh, PLEASE mind what you're at!\" You know the way wherever she wanted much to know, but the Hatter said.",
	        "DateCreated": "2022-11-14 12:35:27",
	        "ProjectId": 3
	    },
	    {
	        "TaskId": 11,
	        "Title": "Et voluptas nemo et perspiciatis recusandae facilis iusto aut ipsa velit quo laborum.",
	        "Content": "Alice thought she might as well she might, what a long hookah, and taking not the same, the next verse.' 'But about his toes?' the Mock Turtle sighed deeply, and began, in a game of croquet she was looking for them, and it'll sit up and leave the room, when her eye fell upon a little scream, half.",
	        "DateCreated": "2022-11-14 12:35:27",
	        "ProjectId": 1
	    }
    ]
    
    ```

2. `/entry`
   
   The purpose of this endpoint is to log a time sheet entry for a task.

   ` <your-domain>/api/entry `

   <b>Params</b><br>
	a) project_id ---> Integer
	b) task_id    ---> Integer
	c) start_time ---> DateFormat (y-m-d H:i:s)
	d) end_time   ---> DateFormat (y-m-d H:i:s)

	Should give you a result like the example shown below if successful

    ```  
	[
    "Successfully created record."
    ]
    ``` 

3. `tasks-time-entry`

   The purpose of this endpoint is to list all time sheet entry for a admin user. The api.php has routes set such that only admin users have access to this end point.

   ` <your-domain>/api/tasks-time-entry `

   Should give you a result like the example shown below if successful.
   ```
   [
	    {
	        "id": 1,
	        "project_id": 2,
	        "task_id": 29,
	        "start_time": "2022-11-14 09:20:00",
	        "end_time": "2022-11-14 13:20:00",
	        "deleted_at": null,
	        "created_at": "2022-11-14T14:03:18.000000Z",
	        "updated_at": "2022-11-14T14:03:18.000000Z"
	    },
	    {
	        "id": 2,
	        "project_id": 1,
	        "task_id": 25,
	        "start_time": "2022-11-14 09:20:00",
	        "end_time": "2022-11-14 13:20:00",
	        "deleted_at": null,
	        "created_at": "2022-11-14T14:15:48.000000Z",
	        "updated_at": "2022-11-14T14:15:48.000000Z"
	    }
   ]
```
