##Deployment Instructions:
1. Ensure packages are installed: $ sudo apt get install php-cli php*mysql
2. Navigate to the web/php directory.
3. Initialize database in mysql with the following commands:
  1. $ CREATE DATABASE project_db
  2. $ USE project_db
  3. $ SOURCE project_db.sql
4. To view page:
  1. Launch the server with the following command in the web/php/ directory: $ php -S localhost:8080
  2. Copy http://localhost:8080 and paste into browser.
  3. If you would like to login as a demo user to view current features and client experience: Username: WTC, Password: password
5. Testing:
  1. To run the tests you will need to follow the quick-start guide http://codeception.com/quickstart through step three. 
  2. Then place the test files from github in the “acceptance” folder and replace the “acceptance.suite.yml” in the “tests” directory with the one in our test file on github. 
  3. Then work two directories back from acceptance (there should be an executable file called “codecept” and a yml file called “codeception.yml”). 
  4. Make sure that you have a browser with the website open on: http://0.0.0.0:8080/ (can change the url to your local host in the acceptance.suite.yml file). 
  5. Then run <codecept run acceptance>. This command will run all the tests in the acceptance folder.
