ScWidgets
=======================

This module in process.

Introduction
-----------------
* Example widget
* Search widget and simple integrated search feature


Installation
---------------

### Main Setup

#### By cloning project

1. Install the [BjyAuthorize](https://github.com/bjyoungblood/BjyAuthorize) ZF2 module
   by cloning it into `./vendor/`.
2. Install the [ZfcBase](https://github.com/ZF-Commons/ZfcBase) ZF2 module
   by cloning it into `./vendor/`.
3. Install the [ZfcUser](https://github.com/ZF-Commons/ZfcUser) ZF2 module
   by cloning it into `./vendor/`.
4. Install the [ScContent] (https://github.com/dphn/ScContent)
   by cloning it into `./vendor/`.
5. Clone this project into your `./vendor/` directory.

#### With composer

1. Add this project in your composer.json:

    ```json
    "require": {
        "dphn/sc-widgets" : "dev-master"
    }
    ```
 
2. Now tell composer to download ScWidgets by running the command:

    ```bash
    $ php composer.phar update
    ```
    
#### Post installation

1. Enabling it in your `application.config.php`file.

    ```php
    <?php
    return array(
        'modules' => array(
            // ...
            'ZfcBase',
            'ZfcUser',
            'BjyAuthorize',
            'ScContent',
            'ScWidgets',
        ),
        // ...
    );
    ```
    
2. Further installation is automatic.