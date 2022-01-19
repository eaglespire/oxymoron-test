##OXYMORON TEST
# This API was built with laravel

##THE ENDPOINTS
## post- /api/register 
This is the endpoint that the admin needs to call and post the following 
data (name,email,password,password_confirmation). The password must be a 
minimum of 8 characters
On successful registration, the admin user is assigned an access token. This 
access token is important in order to prevent any unauthorized access to 
specific endpoints like viewing loans, getting other authenticated users. 
The admin user is also going to need this token as an Auth Bearer token when 
making a call to the /api/loans to retrieve all loans registered in the 
database or to view a single loan request via the endpoint /api/loan/id

## post - /api/login
This endpoint allows the admin user or client to login with the registered 
email and 
password. An access token will be created for the client. The access token 
will be further used to access other endpoints such as viewing a loan 
request and viewing all loan requests

## post - /api/logout
This endpoint will log the client out and in the process will delete every 
generated access token for this client

## post - /api/loan
This is the endpoint that a customer needs to call in order to be able to 
apply for a loan. The customer has to provide details such as firstname, 
lastname,age,monthly_salary, payback_period,loan_amount, guarantor_name,
next_of_kin_name. On successful registration, a success response together 
with a 200 status code and the request data is sent back to the client

## get - /api/loans
This endpoint is what the client or admin user will caall to view all 
registered loans in the database. For this call to be successful, the client 
must pass along the access token gotten back from the login endpoint

## get -api/loans/{loan}
This endpoint is what the client will call in order to view a singular loan 
request. The client also needs to pass along the access token

## -api/user
This endpoint is what the client will call when he wants to view the 
currrently logged in admin. An access token is also required

## make sure to set header to Accept - application/json in the header before making any request

#Security measures taken
I used an access token to secure the api to prevent just anybody from 
calling the endpoints. If the api were to be exposed, even a customer with a 
knowledge of tech will be able to run  simple queries to view and thus 
manipulate the loan data in the database


