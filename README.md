
### About Loan-app

It is an app that allows authenticated users to go through a loan application. It doesn’t have to contain too many fields, but at least “amount
required” and “loan term.” All the loans will be assumed to have a “weekly” repayment frequency.

After the loan is approved, the user must be able to submit the weekly loan repayments. It can be a simplified repay functionality, which won’t
need to check if the dates are correct but will just set the weekly amount to be repaid. 

### Project setup 

##### 1. Clone Project from Github
`git clone git@github.com:shamsrk/loan-app.git`

##### 2. Create MySql database

##### 3. Create .env
- Create .env by copying .env.example in root directory, 
- Update database details and other variables in the .env file.

##### 4. Run Database migration
`php artisan migrate`

##### 5. Run Database seeders
`php artisan db:seed --class=WeekDaysTableSeeder`

##### 6. Start server
`php artisan serve`


### Testing
PHPUnit test files are available inside `tests/Feature` and `tests/Unit` directories. 

To run unittest
1.  Create test database by appending `_testing` in the original database name.
Example: If database is `loan_app` then test database is `loan_app_testing`

2. `./vendor/bin/phpunit`



**Note:** API details in the application are available in the postman collection file (`public/static/loan-app.postman_collection.json`)  

##### Reference: [https://laravel.com/](https://laravel.com/docs/5.8/)