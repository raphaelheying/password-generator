# Password Generator

This app uses Laravel Livewire to generate passwords based on certain characteristics selected by the user.
Inspired by [App Ideas Collections](https://github.com/florinpop17/app-ideas) - [Password Generator](https://github.com/florinpop17/app-ideas/blob/master/Projects/2-Intermediate/Password-Generator.md).

## Features

- [x] User can select the length of the generated password
- [x] User can select one or multiple of the following: `Include uppercase letters`, `Include lowercase letters`, `Include numbers`, `Include symbols`
- [x] By clicking the `Generate password` button, the user can see a password being generated
- [x] User can click a `Copy to clipboard` button which will save the password to the clipboard

### Bonus features

- [x] User can see the password strength

## Setup

Install packages:
```shell script
composer install && npm install
```

Copy `.env.example` to `.env`:
```shell script
cp .env.example .env
```

Start Laravel Sail:
```shell script
./vendor/bin/sail up
```

Generate Application Key:
```shell script
./vendor/bin/sail php artisan key:generate
```


## Usage

Start Laravel Sail:
```shell script
./vendor/bin/sail up
```

Start npm:
```shell script
npm run dev
```

  
Run the tests:
```shell script
./vendor/bin/sail php artisan test
```
