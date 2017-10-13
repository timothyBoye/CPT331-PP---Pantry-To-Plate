## Sample project for learning to use laravel
Before doing anything, create a branch with your name as the name of the branch and then ensure that you have checked out that branch.
We can use this as a proof of concept and learning environment, and will be able to integrate any or all of what we do here into the real project.

## Running the project
After installing Php 5.6.* and ensuring that Laravel is running ok with PhpStorm:
- navigate to the project directory using command line. Windows users I suggest [Git for Windows](https://git-for-windows.github.io/)
- run `touch database/database.sqlite`
- run `php artisan migrate`
- run `php artisan db:seed`

This will create the database file as an sqlite file (perfect for development), create the tables and seed a few of them.
The solution as yet does nothing, but I will be adding to the master branch some proof of concept related work over the coming days,
to demonstrate using an api to do what we need to do.

#### Feel free to change whatever, so long as it is in a branch
If you do any work in your branch that is usable in the assignment, then we can discuss as a team and integrate it.
Otherwise, we can just use this as a playground until we have a backlog in place, at which point we can start the 
actual project.

## Accessing the production server
EC2 is now setup to be persistent and you can log in and get the server to pull from git rather than uploading the whole repo from your desktop.
Sadly I can't for the life of me figure out how to set up the webaddress for the instance to be human readable pantrytoplate.blah like it was before. If someone knows how to set that feel free to contact me.

Web address:
`ec2-52-38-5-120.us-west-2.compute.amazonaws.com`

If I'm not around and you want to pull to the server here is how via terminal (you'll need the pem file it's the credentials to login):

Connect to ec2 instance (from folder containing pem file):
`ssh -i laravel.pem ubuntu@ec2-52-38-5-120.us-west-2.compute.amazonaws.com`

Go to Laravel folder:
`cd /var/www/html/cpt331_PoC`

Pull latest git:
`git pull`

If the pull has migrations/seeds:
`php artisan migrate blah blah blah`

