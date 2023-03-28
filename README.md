# Registration form

The form includes the following details about a user:

1. Full name
2. Username
3. Birth date
4. Phone number
5. Address
6. Password
7. Profile picture
8. E-mail

Each user should have a unique username.

Profile pictures are stored on the server and referenced in the User table in the database.

Beside the birth date field in the form, there should be a button that when clicked, a list of actors who are born on the same day is shown. Use this API: [Online Movie Database](https://rapidapi.com/apidojo/api/online-movie-database/), specifically these two endpoints:

- `actors/list-born-today`: Retrieves a list of actors born in a same input day.
- `actors/get-bio`: Retrieves actor details by passing an actor ID.


