# MirrorCore
MirrorCore is a Geometry Dash private server
framework (core), currently only supporting
version **1.0**.

## Features
>[!NOTE]
>Since this core only supports version 1.0, only
>online features seen in 1.0 are shown here.

- Viewing levels (getGJLevels)
- Downloading levels (downloadGJLevel)
- Uploading levels (uploadGJLevel)

### Features not added
- Liking levels
- The Rate button on a level
- "Trending" tab and the Featured button
- Download counter going up when someone downloads a level
- Length filter on search

## Requirements
- PHP
- A MySQL/MariaDB database

## Installation
1. Clone this repository
2. Put the files to your webserver
3. Modify `incl/connection.php` and replace the database name, username, password, and host 
4. Import `database.sql` to your database
5. Modify the links to your Geometry Dash 1.00-1.02 copy to your server

## License
MIT
