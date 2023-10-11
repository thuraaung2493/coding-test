# Employee Management

## Installation

```
  git clone <repo>
  cd <repo>
  composer install

  cp env .env

  // update Database config

  php spark migrate
  php spark serve
```

### For development

- Change **CI_ENVIRONMENT = development** in **.env** file

### For production

- Change **CI_ENVIRONMENT = production** in **.env** file
