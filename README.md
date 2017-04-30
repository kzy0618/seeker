# Seeker
This application is a data browser. It allows people to search data in a database (for now VoNZ one) following some parameters and after that download selected datum in their own Owncloud.

For now the parameters which can be selected are gender, age, location, english profile, maori rofile, time in new zealand,and type of recording.

# Installation
Download the seeker repository and place it in **owncloud/apps/**

Warning : The name of the repository HAVE TO be seeker !!

## Publish to App Store

First get an account for the [App Store](http://apps.owncloud.com/) then run:

    make appstore_package

The archive is located in build/artifacts/appstore and can then be uploaded to the App Store.

## Running tests
After [Installing PHPUnit](http://phpunit.de/getting-started.html) run:

    phpunit -c phpunit.xml
    
 ## More

To have more informations on how you can manage this application, let's see the [Owncloud Developer Manual](https://doc.owncloud.org/server/latest/developer_manual/app/index.html)...
    
