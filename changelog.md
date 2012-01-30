##Changelog

v 1.1.3

- Added support for PHP in views. Depends on file extension.
- Support now multiple database engines for the moment PDO and RedBeans (This is still subject to change).
- Widget approach support.
- Fixed problem in sub-folder resolution in the controller folder.

v 1.1.2

- Minor that affects header() kind functions because a rare char appears in the index.php file (﻿).
- Deleted the ?> in some other files.
- Deleted messy code in Application.php

v 1.1.1

- Added a manifest.json example in the ExampleVendor folder.
- Some namespaces were wrong.
- Deleted path var in app_config.yaml now is automatic.
- Added main_class var in ExampleVendor manifest.json
- Resolved BIG security problem that causes someone could access to config directory and read the config files.

v 1.1.0

- Added support for different upload checks in the application.
- Added support for sqlite database type.
- Changed the main test page title.
- checker.php corrected to allow different checks on install.
- Changed the location of the framework files to coldstarstudios\framework namespace.
- Added default favicon.
- Added two interfaces for coldstarstudios\framework\Application and Response.
- Changed the name Loader.php to Application.php
- Added an example vendor.
- Now you can enter directly to /install folder to check if the installation is fine.

v 1.0.1

- Added empty index.html in each resource folder.
- Added cache/ folder out of gitignore but without any contents.
- Added production on/off in config. (Shows errors when something fails or not)
- Error control is in the new Error class.
- Added an error in order to know if cache folder is writable or not.
- Added check-readyness script into the install folder to know if you're ready to use sPHPf.

v 1.0.0

- First version