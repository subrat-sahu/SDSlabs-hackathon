## Complaint Register Application 
## for Hostel level implementation at IITR



### Version
2.1.3

### Usage
A web portal on Node.js app which use a MongoDB database,Where you can log in complaints related to the hostel and daily small complaints! It uses Basic authentication using [passportjs](http://passportjs.org/) ,I have used two different local-strategies for User and Admin(But it is better to use ACL like [Permission](https://www.npmjs.com/package/permission))

### Installation

This App requires [Node.js](https://nodejs.org/) v4+ to run.
And [MongoDB](https://www.mongodb.com/) Mongo Shell Version 3.4.7

### Uses [Sendgrid](https://sendgrid.com/) Email service to send Email for forgotten password


### To run the application
1) Start the MongoDB Server.  
```sh
$ mongod
```
2) Install all the dependencies and middlewares from Package.JSON .   
```sh
$ npm install
```
3) Start the Node.JS server by 
```sh
$ npm start
```  
OR   
```sh
$ node bin/www
```
OR (If you have nodemon Installed)!
```sh
$ nodemon bin/www
```
