# Laravel Sim Commun

Laravel Simple Community is a Laravel based simple social media for demonstartion of post and comment cms. It laravel framework based system prepared along with vue3, inertiajs, and shadcn-ui.

## Installation

Download or clone the repo [github](https://github.com/jotelij/laravel-sim-commun) to install Simpo Mag.

```bash
git clone https://github.com/jotelij/laravel-sim-commun
```

build the project first
```bash
composer install
```

create .env file
```bash
# linux
cp .env.exmaple .env

#windows
copy .env.exmaple .env
```

generate Application key

```bash
php artisan key:generate
```

migrate the db
```bash
php artisan migrate
```

link the storage

```bash
php artisan storage:link
```

then
```bash
npm install

# for dev
npm run dev

# or for production
npm run buld
```

## Usage

```bash
composer run dev
```

## Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.


## License

[MIT]