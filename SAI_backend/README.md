# SAI demo backend API
Author: Patrick Sabry

This is the backend Laravel API powering the SAI file upload system demo. The API handles the storage of files
to Amazon S3, including validation and storage of file meta data in a remote database.

The API is written in Laravel 8.

Key Features:
- JWT authentication and custom exception handling on key guarded endpoints.
- AWS RDS connection compatible.
- AWS S3 connection compatible.

## installation
`composer install`

Run API locally using either Xampp (windows) or valet (Mac).
