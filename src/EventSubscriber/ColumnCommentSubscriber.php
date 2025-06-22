<?php

declare(strict_types=1);

namespace Dsnetpl\DoctrineColumnCommentBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LoadClassMetadataEventArgs;
use Doctrine\ORM\Events;
use Doctrine\ORM\Mapping\FieldMapping;
use phpDocumentor\Reflection\DocBlockFactory;

final class ColumnCommentSubscriber implements EventSubscriber
{
    private DocBlockFactory $factory;

    public function __construct()
    {
        $this->factory = DocBlockFactory::createInstance();
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $loadClassMetadataEventArgs): void
    {
        $classMetadata = $loadClassMetadataEventArgs->getClassMetadata();

        foreach ($classMetadata->fieldMappings as $key => $f) {
            assert($f instanceof FieldMapping);
            if (isset($f->options['comment'])) {
                continue;
            }

            if (!$classMetadata->getReflectionClass()->hasProperty($f->fieldName)) {
                continue;
            }

            $refl = $classMetadata->getReflectionClass()->getProperty($f->fieldName);

            $docComment = $refl->getDocComment();
            if (!$docComment) {
                continue;
            }

            $docblock = $this->factory->create($docComment);

            $summary = $docblock->getSummary();
            $desc = $docblock->getDescription()->render();

            if (!$summary && !$desc) {
                continue;
            }

            $comment = implode('; ', array_filter([$summary, $desc]));

            if ($comment) {
                $classMetadata->fieldMappings[$key]->options['comment'] = $comment;
            }
        }
    }

    /**
     * @return string[]
     */
    public function getSubscribedEvents(): array
    {
        return [Events::loadClassMetadata];
    }
}
