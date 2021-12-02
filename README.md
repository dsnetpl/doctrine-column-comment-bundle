# Doctrine Column Comment Bundle

![phpWorkflow](https://github.com/dsnetpl/doctrine-column-comment-bundle/actions/workflows/php.yml/badge.svg)


Modifying doctrine metadata so that doctrine knows that columns in the database have additional information - a comment.

## Install
``` bash
$ composer require dsnetpl/ctrine-column-comment-bundle
```

If you don't use [Symfony Flex](https://github.com/symfony/flex), you will need to register a bundle:

```php
# config/bundles.php
return [
    // ...
    Dsnetpl\DoctrineColumnCommentBundle::class => ['all' => true],
];
```
