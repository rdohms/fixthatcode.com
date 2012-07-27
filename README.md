Fix That Code
-------------

This is the repository for the [Fix That Code](http://fixthatcode.com/) project.

##Running it locally

1. Add your database config details to `parameters.yml` file in app/config (or create a new one using `app/config/parameters.yml.dist`)

2. Prepare folder permissions by running (double check your apache user on the first one):

        sudo chmod -Rf +a "daemon allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs
        sudo chmod -Rf +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" app/cache app/logs

3. Download dependencies by running the command below:

        php composer.phar install

4. Configure your vhost and make sure you have this in it:

        SetEnv APP_ENV dev

5. Create the database (default name 'ftc' in parameters.yml') and run setup command:

        app/console doctrine:schema:create

6. Fire it up!