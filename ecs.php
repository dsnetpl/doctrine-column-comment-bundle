<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\CyclomaticComplexitySniff;
use PHP_CodeSniffer\Standards\Generic\Sniffs\Metrics\NestingLevelSniff;
use PhpCsFixer\Fixer\CastNotation\CastSpacesFixer;
use PhpCsFixer\Fixer\ControlStructure\TrailingCommaInMultilineFixer;
use PhpCsFixer\Fixer\Import\NoUnusedImportsFixer;
use PhpCsFixer\Fixer\Operator\ConcatSpaceFixer;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Phpdoc\NoSuperfluousPhpdocTagsFixer;
use PhpCsFixer\Fixer\Whitespace\ArrayIndentationFixer;
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
use Symplify\CodingStandard\Fixer\Spacing\MethodChainingNewlineFixer;
use Symplify\EasyCodingStandard\Config\ECSConfig;
use Symplify\EasyCodingStandard\ValueObject\Option;
use Symplify\EasyCodingStandard\ValueObject\Set\SetList;

return static function (ECSConfig $containerConfigurator): void {
    $containerConfigurator->paths(['src']);
    $containerConfigurator->import(SetList::ARRAY);
    $containerConfigurator->import(SetList::COMMON);
    $containerConfigurator->import(SetList::CLEAN_CODE);
    $containerConfigurator->import(SetList::PSR_12);
    $containerConfigurator->import(SetList::SYMPLIFY);
    $containerConfigurator->import(SetList::CONTROL_STRUCTURES);
    $containerConfigurator->import(SetList::COMMENTS);

    $containerConfigurator->rule(NoUnusedImportsFixer::class);

    $containerConfigurator->ruleWithConfiguration(CyclomaticComplexitySniff::class, ['absoluteComplexity' => 10]);

    $containerConfigurator->ruleWithConfiguration(UnusedVariableSniff::class, ['ignoreUnusedValuesWhenOnlyKeysAreUsedInForeach' => true]);

    $containerConfigurator->rule(ReferenceThrowableOnlySniff::class);

    $containerConfigurator->ruleWithConfiguration(ConcatSpaceFixer::class, ['spacing' => 'one']);

    // Method \App\Controller\Reservations\Operator\BanController::getActiveBans() does not have @return annotation for its traversable return value.
    // Reported by: "MissingTraversableTypeHintSpecification"
//        $containerConfigurator->rule(ReturnTypeHintSniff::class);

    $containerConfigurator->rule(DisallowImplicitArrayCreationSniff::class);

    $containerConfigurator->rule(RequireNullCoalesceOperatorSniff::class);
    $containerConfigurator->rule(RequireNullCoalesceEqualOperatorSniff::class);
    $containerConfigurator->rule(UselessAliasSniff::class);
//    $containerConfigurator->rule(DisallowReferenceSniff::class);
    $containerConfigurator->rule(DisallowContinueWithoutIntegerOperandInSwitchSniff::class);
    $containerConfigurator->rule(UselessLateStaticBindingSniff::class);
    $containerConfigurator->rule(UselessVariableSniff::class);
    $containerConfigurator->rule(DuplicateAssignmentToVariableSniff::class);
    $containerConfigurator->rule(DeadCatchSniff::class);
    $containerConfigurator->rule(ClassMemberSpacingSniff::class);
    $containerConfigurator->rule(ModernClassNameReferenceSniff::class);
    $containerConfigurator->rule(LongTypeHintsSniff::class);
    $containerConfigurator->rule(NullTypeHintOnLastPositionSniff::class);
    $containerConfigurator->rule(ClassConstantVisibilitySniff::class);
    $containerConfigurator->rule(NullableTypeForNullDefaultValueSniff::class);
    $containerConfigurator->rule(MultipleUsesPerLineSniff::class);
    $containerConfigurator->rule(EmptyCommentSniff::class);
    $containerConfigurator->rule(ArrayIndentationFixer::class); // przesuwa wyrównanie tablic
    $containerConfigurator->rule(DeprecatedAnnotationDeclarationSniff::class);
    $containerConfigurator->ruleWithConfiguration(RequireMultiLineMethodSignatureSniff::class, ['minLineLength' => 180]);

    $containerConfigurator->ruleWithConfiguration(TrailingCommaInMultilineFixer::class, [
        'elements' => [
            TrailingCommaInMultilineFixer::ELEMENTS_ARRAYS,
            TrailingCommaInMultilineFixer::ELEMENTS_PARAMETERS,
        ],
    ]);

    $containerConfigurator->ruleWithConfiguration(CastSpacesFixer::class, ['space' => 'none']);
    $containerConfigurator->ruleWithConfiguration(NestingLevelSniff::class, ['absoluteNestingLevel' => 3]);
    $containerConfigurator->rule(NoSuperfluousPhpdocTagsFixer::class);
    $containerConfigurator->rule(\PhpCsFixer\Fixer\Strict\DeclareStrictTypesFixer::class); // TODO

    $containerConfigurator->lineEnding("\n");
    $containerConfigurator->indentation(Option::INDENTATION_SPACES);

    $containerConfigurator->skip([
        NotOperatorWithSuccessorSpaceFixer::class => null,
        MethodChainingNewlineFixer::class => null,
    ]);
};


