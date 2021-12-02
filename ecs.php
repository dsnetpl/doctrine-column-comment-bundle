<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\CyclomaticComplexitySniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\NestingLevelSniff;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Semicolon\MultilineWhitespaceBeforeSemicolonsFixer;
use PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer;
use SlevomatCodingStandard\Sniffs\Arrays\DisallowImplicitArrayCreationSniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassConstantVisibilitySniff;
use SlevomatCodingStandard\Sniffs\Classes\ClassMemberSpacingSniff;
use SlevomatCodingStandard\Sniffs\Classes\ModernClassNameReferenceSniff;
use SlevomatCodingStandard\Sniffs\Classes\RequireMultiLineMethodSignatureSniff;
use SlevomatCodingStandard\Sniffs\Classes\UselessLateStaticBindingSniff;
use SlevomatCodingStandard\Sniffs\Commenting\DeprecatedAnnotationDeclarationSniff;
use SlevomatCodingStandard\Sniffs\Commenting\EmptyCommentSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\DisallowContinueWithoutIntegerOperandInSwitchSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullCoalesceEqualOperatorSniff;
use SlevomatCodingStandard\Sniffs\ControlStructures\RequireNullCoalesceOperatorSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\DeadCatchSniff;
use SlevomatCodingStandard\Sniffs\Exceptions\ReferenceThrowableOnlySniff;
use SlevomatCodingStandard\Sniffs\Namespaces\MultipleUsesPerLineSniff;
use SlevomatCodingStandard\Sniffs\Namespaces\UselessAliasSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\LongTypeHintsSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\NullableTypeForNullDefaultValueSniff;
use SlevomatCodingStandard\Sniffs\TypeHints\NullTypeHintOnLastPositionSniff;
use SlevomatCodingStandard\Sniffs\Variables\DuplicateAssignmentToVariableSniff;
use SlevomatCodingStandard\Sniffs\Variables\UnusedVariableSniff;
use SlevomatCodingStandard\Sniffs\Variables\UselessVariableSniff;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symplify\CodingStandard\Fixer\Spacing\MethodChainingNewlineFixer;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ContainerConfigurator $containerConfigurator): void
{
    // Parameters
    // --------------------------------------

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PATHS, [
        __DIR__ . '/src',
    ]);

    $parameters = $containerConfigurator->parameters();
    $parameters->set(Option::PARALLEL, true);


    // Containers
    // --------------------------------------

    $containerConfigurator->import(SetList::ARRAY);
    $containerConfigurator->import(SetList::COMMON);
    $containerConfigurator->import(SetList::CLEAN_CODE);
    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::SYMPLIFY);
    $containerConfigurator->import(SetList::SYMFONY);
    $containerConfigurator->import(SetList::CONTROL_STRUCTURES);
    $containerConfigurator->import(SetList::PHP_CS_FIXER);


    // Services
    // --------------------------------------

    $services = $containerConfigurator->services();

    $services->set(CyclomaticComplexitySniff::class)
        ->property('absoluteComplexity', 10);

    $services->set(UnusedVariableSniff::class)
        ->property('ignoreUnusedValuesWhenOnlyKeysAreUsedInForeach', true);

    $services->set(ReferenceThrowableOnlySniff::class);
    $services->set(DisallowImplicitArrayCreationSniff::class);
    $services->set(RequireNullCoalesceOperatorSniff::class);
    $services->set(RequireNullCoalesceEqualOperatorSniff::class);
    $services->set(UselessAliasSniff::class);
    $services->set(DisallowContinueWithoutIntegerOperandInSwitchSniff::class);
    $services->set(UselessLateStaticBindingSniff::class);
    $services->set(UselessVariableSniff::class);
    $services->set(DuplicateAssignmentToVariableSniff::class);
    $services->set(DeadCatchSniff::class);
    $services->set(ClassMemberSpacingSniff::class);
    $services->set(ModernClassNameReferenceSniff::class);
    $services->set(LongTypeHintsSniff::class);
    $services->set(NullTypeHintOnLastPositionSniff::class);
    $services->set(ClassConstantVisibilitySniff::class);
    $services->set(NullableTypeForNullDefaultValueSniff::class);
    $services->set(MultipleUsesPerLineSniff::class);
    $services->set(EmptyCommentSniff::class);
    $services->set(DeprecatedAnnotationDeclarationSniff::class);
    $services->set(RequireMultiLineMethodSignatureSniff::class)
        ->property('minLineLength', 180);

    $services->set(CastSpacesFixer::class)
        ->call('configure', [['space' => 'none']]);

    $services->set(NestingLevelSniff::class)
        ->property('absoluteNestingLevel', 3);

    $services->set(NoSuperfluousPhpdocTagsFixer::class);
    $services->set(DeclareStrictTypesFixer::class);

    $parameters->set(Option::SKIP, [
        NotOperatorWithSuccessorSpaceFixer::class   => null,
        MethodChainingNewlineFixer::class   => null,
    ]);
};
