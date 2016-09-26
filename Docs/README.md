#Developer Overview
***

This directory contains a README that explains the contents of the core files for Nudge. There is also    
a description of the MySQL Database with each table utilizes.      

      
#Overview

There are three files that make up the meat of this project, they contain HTML5, CSS, PHP, and JavaScript:           
1. index.php
2. copy2.php
3. storyloop.php

## index.php ## 
***

#### User Doc ####
index.php is the sign-in/sign-up page for Nudge. If you currently have a username and password for the system       
you can login by typing in your username and password, then select a category for the type of story-line you      
would like to play.       
              
If you do not have a username or password, there is a text area for you to input the information to create an account    
on Nudge.

#### Technical Doc ####

Style Sheets Linked:          
* bootstrap.css
* main.css
* font-awesome.min.css    

Main Div Elements      
* Fixed Nav-Bar - class="navbar navbar-inverse navbar-fixed-top" - Line 41 to 59 
* Form - class="form-signin" - Line 80 to 149 
* footer - id="foot" - Line 155 to 157 

#### Form #### 

When the sign-in form is submitted by a current user, two different types of the form data are verified using JavaScript and jQuery.      
The jQuery validate() function is explained [HERE](https://jqueryvalidation.org/validate). 
Included in the in the "form-signin" Form is a onsubmit identifier. Written as follows:      
code(onSubmit="return validate()")         
The onSubmit functions checks the boolean value returned by validate. The purpose of validate is to make sure a category has been selected by the user.      
If the user signs in with a username and password and fails to choose a category, a message will be displayed that reads, "Please select a category from the dropdown list."      
validate() can be found in the <head> section of the index.php file on line 21 to 30      


  

 
