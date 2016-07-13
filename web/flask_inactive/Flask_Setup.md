**NO LONGER USING FLASK**


**Flask Setup:**

To run the server you will need to follow the steps below.

1. You will need to download flask: https://pypi.python.org/pypi/Flask/0.11

2. `<pip install Flask>`.

3. cd into the Flask directory and <git clone https://github.com/PaulLaliberte/Project_CSCI3308>. Note, you must clone in the Flask directory to be able to run the server.

4. Setup bootstrap with `<pip install flask-bootstrap>`.

5. There will be a dirctory called web. It contains app.py, static, and templates. 

Template holds html files. 

Static holds third-party files (i.e. Jquery, bootstrap, ect.).

app.py is where we connect/direct our static and template files.

To start the webserver: `<python app.py>` and copy the url from terminal (it will be a local host). To shutdown server
press control-C from the command line.

**SQL SETUP**
  
Need to `<pip install flask-sqlalchemy>` to make connection work properly.
  
To try the connection with alchemy follow these directions in the terminal (make sure you are in the same directory as app.py):  
python  
from app import [Clients or Drones or other class titles]  
drones = [Drones].query.all()  
  
for titles in drone:  
	print(titles.[status or details])  
		

NOTE: Line 11, app.config...'mysql://paul:[password]@localhost... the [password] is where you enter your password to run the database. Ideally, we would be more careful about database usernames and passwords in a final submission.

**Other Notes:**

You do not need to shutdown the server to make changes. Changes will be applied automatically, just refresh the page.

A tutorial: https://realpython.com/blog/python/introduction-to-flask-part-1-setting-up-a-static-site/#.U5Chm5RdUZ0

Flask's quick start guide: http://flask.pocoo.org/docs/0.11/quickstart/#

Bootstrap: In the template file there is a bootstrap file(s). This was used to create the navigation bar on the page.
You can edit the bootstrap.html file in **templates** to add/change how the navigation bar looks.

Implementing a database: http://flask.pocoo.org/docs/0.11/tutorial/dbcon/

Need to install an extension to allow you to access a mysql database (Run command 'pip install flask-mysql')  If this generates an error, do 'sudo apt-get install libmysqlclient-dev'.  If you still get an error, add 'sudo' to the beginning of the first command.


