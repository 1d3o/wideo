# Docker

The docker integration offers:

- A wordpress image with the theme and plugins inside.
- A node image to compile NPM dependencies.
- A mysql image for the databases.
- A phpmyadmin image to manage the databases.

## Configurations

Wordpress host: **http://localhost:3000**
Phpmyadmin host: **http://localhost:3002**
Database root password: **root**

## Commands

### Start project

```shell
docker-compose up
```

### Compile project

```shell
docker-compose run node npm run build
```

### Install NPM dependency

```shell
docker-compose run node yarn add DEPENDENCY
```

### Install WP Sync

```shell
docker-compose run wordpress sh wp-content/themes/theme/docker/bin/install-wp-sync
```
