Steps to execute the setup
==============
for any query or issue please contact me on 

## Contact Us

- WhatsApp: [+91-73895-04471](tel:+917389504471)
- WhatsApp: [+91-73895-04471](https://wa.me/917389504471)
- Email: [hairshmeshram0294@gmail.com](mailto:harishmeshram0294@gmail.com)

I used PHP, Composer, MySQL. Docker for this assessment.

for Execute this you need a Docker in you machine.


run below command from the root directory for build
------------------
`docker-compose build`

After completing the build, please run the following command to start the application.
---------------------
`docker-compose up`

For Terminating Execution of Application 
`docker-compose down`

Access application on the below URL
-----
`http://localhost:8080/`

please open this URL to any web browser or via postman. 
this is first get api will execute a SQL statement for

Create `users` table in DB.

Postman Collection
-----------
From the root directory of Repository you will see a [`postman-collection`](https://github.com/harishm0294/jwt_api/tree/main/postman-collection) named folder inside that folder you will get a postman collection of apis. you can import it in you postman application.

CURL commands listing
-----------

1. for creating users table: `curl --location 'http://localhost:8080/'`.

2. Sign up API:
 `curl --location 'http://localhost:8080/signup' \
--form 'email="harishm0294@gmail.com"' \
--form 'password="H@rish0294"'`

3. Sign in API:
`curl --location 'http://localhost:8080/signin' \
--form 'email="harishm0294@gmail.com"' \
--form 'password="H@rish0294"'`

4. Refresh Token API :
`curl --location 'http://localhost:8080/refresh-token' \
--form 'refreshToken="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOiIyIiwiZXhwIjoxNzI1MDk3NDM4fQ.VI01TFKPSlAYqUPtXPTzZHlU8vTLNhB2Ms0uS7MVfYI"'`

5. Verify Token API:
`curl --location 'http://localhost:8080/refresh-token' \
--form 'refreshToken="eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VySWQiOiIyIiwiZXhwIjoxNzI1MDk3NDM4fQ.VI01TFKPSlAYqUPtXPTzZHlU8vTLNhB2Ms0uS7MVfYI"'`



