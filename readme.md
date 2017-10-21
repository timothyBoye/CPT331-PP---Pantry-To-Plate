## Pantry To Plate
Before doing anything, create a branch with your name as the name of the branch and then ensure that you have checked out that branch.

#### Feel free to change whatever, so long as it is in a branch
If you do any work in your branch that is usable in the assignment, then we can discuss as a team and integrate it.
Otherwise, we can just use this as a playground until we have a backlog in place, at which point we can start the 
actual project.

## Running the project
After installing ~~Php 5.6.*~~ and ensuring that Laravel is running ok with PhpStorm:
- navigate to the project directory using command line. Windows users I suggest [Git for Windows](https://git-for-windows.github.io/)
- run `touch database/database.sqlite`
- run `php artisan migrate`
- run `php artisan db:seed`

This will create the database file as an sqlite file (perfect for development), create the tables and seed a few of them.
The solution as yet does nothing, but I will be adding to the master branch some proof of concept related work over the coming days,
to demonstrate using an api to do what we need to do.

## Upgrading to PHP 7.1
### macOS
**!!!Rename /Applications/XAMPP folder to XAMPP5 to make sure the installer doesn’t overwrite it!!!**

Open https://www.apachefriends.org/xampp-files/7.1.10/xampp-osx-7.1.10-0-installer.dmg

Run Installer > “Select Components” Core and developer files > Install

Open finder and navigate to the old xampp install /Applications/XAMPP5/ right-click htdocs folder > click copy

Navigate to new XAMPP install /Applications/XAMPP/ right-click xamppfiles folder > click paste > click replace when warned htdocs already exists

Right-click /Applications/XAMPP/xamppfiles/htdocs > click Get Info > click padlock bottom right hand corner > add permission everyone read/write > click cog bottom left hand side > click apply to enclosed items.

Open /Applications/XAMPP/xamppfiles/etc/httpd.conf > find lines:
DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs"
<Directory "/Applications/XAMPP/xamppfiles/htdocs">
Replace with (your directories may vary slightly double check these are the paths to your larabel public folder):
DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs/cpt331_PoC/public"
<Directory "/Applications/XAMPP/xamppfiles/htdocs/cpt331_PoC/public">

Open /Applications/XAMPP/manager-osx.app > on manage servers tab if apache isn’t running start apache, if it is already running stop it then start it again to ensure settings take effect > on welcome tab click go to application > laravel app should start running in a browser.

Because you copied the whole htdocs folder your git configurations etc should have been copied with it, if you open /Applications/XAMPP/xamppfiles/htdocs/cpt331_PoC/ in PHPStorm you should be able to edit the files and git push pull etc as if nothing has changed.

Open /Applications/XAMPP/xamppfiles/htdocs/cpt331_PoC/ in PHPStorm > goto Phpstorm menu > preferences > find PHP page under Languages & Frameworks > Change PHP Language Level to 7.1 and click the three dots on the right of the CLI Interpreter box > on the right of the PHP executable box click the reload button, the information under the box should change to PHP version 7.1.10 > click ok > click ok

Run command > php composer.phar install

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

