<!--
SPDX-FileCopyrightText: Mathias Petermann <mathias.petermann@gmail.com>
SPDX-License-Identifier: CC0-1.0
-->

# Update Info Cli
Place this app in **nextcloud/apps/**

This app provides 2 CLI commands `udpateinfo:apps` and `udpateinfo:nextcloud` which summarises the update state for apps and for nextcloud.

It's  based on the code in the `updatenotification` app installed by default in nextcloud, but supports JSON output, and return codes that hint if an update is available or not.

## Publish to App Store

First get an account for the [App Store](http://apps.nextcloud.com/) then run:

    make && make appstore

The archive is located in build/artifacts/appstore and can then be uploaded to the App Store.

## Running tests
You can use the provided Makefile to run all tests by using:

    make test

This will run the PHP unit and integration tests and if a package.json is present in the **js/** folder will execute **npm run test**

Of course you can also install [PHPUnit](http://phpunit.de/getting-started.html) and use the configurations directly:

    phpunit -c phpunit.xml

or:

    phpunit -c phpunit.integration.xml

for integration tests
