# Wideo

Wordpress starting framework for magic websites.

Full documentation: <a href="https://github.com/ideonetwork/wideo/wiki">https://github.com/ideonetwork/wideo/wiki</a>

## Usage

### Installation for wordpress websites

Run the following commands inside the wp-content/themes directory:

```shell
git clone https://github.com/ideonetwork/wideo
cd wideo
npm install -g webpack-cli
yarn install
npm run start
```

### Installation for static websites

Run the following commands inside the directory:

```shell
git clone https://github.com/ideonetwork/wideo
cd wideo
npm install -g webpack-cli
yarn install
npm run static
npm run start
```

### Build

```shell
npm run build
```

The build process should create a **./build** directory with the official theme ready for production.

## Guide

### Custom mailer configuration

```php
  <form action="<?php echo admin_url( 'admin-ajax.php' ); ?>" data-controller="form" method="post" enctype="multipart/form-data">
    <div data-form-target="feedback"></div>

    <input type="hidden" name="_form" value="contacts">
    <input type="hidden" name="action" value="custom_ajax_mailer">
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" class="form-control" id="name" name="name" placeholder="Enter name" required>
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
    </div>
    [....]
    <div class="form-group">
      <label for="file">File</label>
      <input type="file" class="form-control" id="file" name="file">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
```