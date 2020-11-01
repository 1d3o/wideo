# Wideo

Wordpress starting framework for magic websites.

Full documentation: <a href="https://github.com/ideonetwork/wideo/wiki">https://github.com/ideonetwork/wideo/wiki</a>

## Installation for wordpress websites

Run the following commands inside the wp-content/themes directory:

```shell
git clone https://github.com/ideonetwork/wideo
cd wideo
npm install -g webpack-cli
yarn install
npm run start
```

## Installation for static websites

Run the following commands inside the directory:

```shell
git clone https://github.com/ideonetwork/wideo
cd wideo
npm install -g webpack-cli
yarn install
npm run static
npm run start
```

## Build

```shell
npm run build
```

The build process should create a **./build** directory with the official theme ready for production.

## Utilizzo impostazioni globali

```php
get_field('nome_field', 'option');
```

## Build

```shell
npm run build
```

The build process should create a **./build** directory with the official theme ready for production.

## Utilizzo impostazioni globali

```php
get_field('nome_field', 'option');
```
