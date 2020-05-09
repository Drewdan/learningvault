# Learning Vault  ![Laravel](https://github.com/Drewdan/learningvault/workflows/Laravel/badge.svg?branch=master)

Learning Vault is an open source project developed to parents can access learning material for their children free
of charge. The content is community driven, meaning anyone can create and upload learning material for 
other parents to use.

The live version of this package can be found at https://www.learningvault.co.uk

## Installation
- To run this project, you must have PHP 7.4 installed
- You should setup a host on your web server for your local domain.

### Step 1 - Clone the Repo
Begin by cloning this repository to your machine and installing all composer & NPM dependencies
```
git clone https://github.com/Drewdan/learningvault.git
cd learningvault && composer install && npm install
```

Copy the .env.example file to .env

### Step 2 - Setup the dev environment
Create two databases called:
- learningvault
- learningvault-testing

Run the migrations and seed the database
```
php artisan migrate:fresh --seed
```

The test database will automatically migrate and seed at the start of the test run.

The seeder provides you with three accounts to use:

- user@example.com
- moderator@example.com
- admin@example.com

All accounts have the password `123546`
### Step 3 - Build the assets
Build the assets using the command NPM run dev
```
npm run dev
```

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Andrew Arscott via [andrew@prometheuscomputing.co.uk](mailto:andrew@prometheuscomputing.co.uk). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT)

## Contributors

TODO
