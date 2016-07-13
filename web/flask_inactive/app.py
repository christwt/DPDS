#This file houses all applications

#import flask from Flask module
from flask import Flask, render_template, redirect, url_for, request
from flask_bootstrap import Bootstrap
from flask_sqlalchemy import SQLAlchemy

#create an instant of an application object 
app = Flask(__name__)
bootstrap = Bootstrap(app)


#SQL-database-tables connection
#mySQL does not like root access, create a user. Make sure to grant access to db
#app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://root:root@localhost/project_db'
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://paul:paul@localhost/project_db'
db = SQLAlchemy(app)

class Clients(db.Model):
    __tablename__ = 'Clients'
    id = db.Column('Id', db.Integer, primary_key = True)
    name = db.Column('Name', db.Unicode)  
    password = db.Column('Password', db.Unicode)
    business = db.Column('Business', db.Unicode)
    latitude = db.Column('SenderLat', db.Numeric)
    longitude = db.Column('SenderLong', db.Numeric)

class Drones(db.Model):
    __tablename__ = 'Drones'
    id = db.Column('Id', db.Integer, primary_key = True)
    status = db.Column('Status', db.Integer)
    details = db.Column('Details', db.Unicode)
    rentee = db.Column('Renter',db.Integer)

class OrderStatus(db.Model):
    __tablename__ = 'OrderStatus'
    id = db.Column('Status', db.Integer, primary_key = True)
    description = db.Column('Description', db.Integer)

class Orders(db.Model):
    __tablename__ = 'Orders'
    id = db.Column('OrderId', db.Integer, primary_key = True)
    clientId = db.Column('ClientId', db.Integer)
    droneId = db.Column('DroneId', db.Integer)
    orderTimestamp = db.Column('OrderTimestamp', db.Integer)
    receiverLat = db.Column('RecieverLat', db.Numeric)
    receiverLong = db.Column('RecieverLong', db.Numeric)
    status_ = db.Column('Status', db.Integer)

#Use decorator "@" and route to url
#More on decorators: http://flask.pocoo.org/docs/0.11/patterns/viewdecorators/
@app.route('/')
def home():
    return render_template('home.html')

@app.route('/register')
def login():
     return render_template('register.html')

@app.route('/clientTracking')
def another_page():
    return render_template('clientTracking.html')

@app.route('/tracking')
def tracking_page():
    return render_template('tracking.html')

@app.route('/clientHome')
def client_home_page():
    drones = Drones.query.all()
    return render_template('clientHome.html',drones=drones)

#start server
if __name__ == '__main__':
    app.run(debug=True)

