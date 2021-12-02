# Doctrine Column Comment Bundle

![phpWorkflow](https://github.com/dsnetpl/doctrine-column-comment-bundle/actions/workflows/php.yml/badge.svg)

>*Bundle for Symfony >= 4.4.0*

Modifying doctrine metadata so that doctrine knows that columns in the database have additional information. 

## Install
``` bash
$ composer require dsnetpl/doctrine-column-comment-bundle
```

If in project is not using [Symfony Flex](https://github.com/symfony/flex), should will be need to register a bundle:
```php
# config/bundles.php
return [
    // ...
    Dsnetpl\DoctrineColumnCommentBundle::class => ['all' => true],
];
```

## Using
To add automatic comment to field in datatable in database. Should be modified Entity file:
```php
//...

    /**
     * Comment must be written in docblock
     *
     * @ORM\Column()
     */
    private string $field;

//..
```
The next step is create diff on database:
```bash
$ bin/console doctrine:schema:update --dump-sql
```

If everything is well configured, the following query should be generated:
```sql
COMMENT ON COLUMN table.field IS 'Comment must be written in docblock'
```
