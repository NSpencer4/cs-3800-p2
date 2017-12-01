# Project 2 For CS-3800
TODO #1: Improve the algorithm for getting available times to schedule.

Current Implementation:
Currently, when scheduling an appointment we get all of the appointments in the database and add an hour onto it and mark it as available as long as there isnt an appointment in place.

The Problem:
Appointments are directly dependent off of current appointments in the database. This shouldnt be the case. 
The problem with this is if there is an appointment scheduled in the past there will be an available appointment generated 
for that day at a later time (still in the past).

The Solution:
Modify this implementation by defining opening and closing hours.
Get the current date and time and dont display previous dates as available
Do a query on the db for all appointments and remove those times from the availability

TODO #2: The professor was very specific about what tables were aloud to be setup and what were not. 
Currently, to get the inventory of the cars we are reading from a txt file and stoing it in the user's session. 
We wanted to store this in the database in a inventory table but did not want to risk losing points. When the project is graded we will make the change.
