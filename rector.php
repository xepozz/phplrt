<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Identical\FlipTypeControlToUseExclusiveTypeRector;
use Rector\CodingStyle\Rector\Assign\SplitDoubleAssignRector;
use Rector\CodingStyle\Rector\Catch_\CatchExceptionNameMatchingTypeRector;
use Rector\CodingStyle\Rector\ClassConst\VarConstantCommentRector;
use Rector\CodingStyle\Rector\ClassMethod\UnSpreadOperatorRector;
use Rector\Config\RectorConfig;
use Rector\Php80\Rector\Class_\ClassPropertyAssignToConstructorPromotionRector;
use Rector\Php81\Rector\ClassConst\FinalizePublicClassConstantRector;
use Rector\Php81\Rector\Property\ReadOnlyPropertyRector;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Set\ValueObject\SetList;

return static function (RectorConfig $config): void {
    $config->paths([__DIR__ . '/libs']);

    $config->sets([
        SetList::TYPE_DECLARATION,
        SetList::CODE_QUALITY,
        SetList::CODING_STYLE,
        SetList::EARLY_RETURN,
    ]);

    $config->skip([
        //
        // Do not replace classic properties to promoted eq. These are
        // completely different statements.
        //
        ClassPropertyAssignToConstructorPromotionRector::class,

        //
        // Does not take into account already existing annotations and
        // can replace:
        //  - @var list<string>
        // into:
        //  - @var string[]
        //
        // What is not quite correct behavior.
        VarConstantCommentRector::class,

        //
        // This rector can break the Doctrine that replaces implementations
        // with proxies, like:
        //  - private Collection $relation;          // OK This can be replaced with a proxy
        //  + private readonly Collection $relation; // FAIL
        //
        ReadOnlyPropertyRector::class,

        //
        // This rector may break the code:
        //  - public function __construct(Some ...$arg) { ... } // OK
        //  + public function __construct(array $arg) { ... }   // BC FAIL
        //
        UnSpreadOperatorRector::class,

        // Totally pointless "improvements"
        CatchExceptionNameMatchingTypeRector::class,
        SplitDoubleAssignRector::class,
        FinalizePublicClassConstantRector::class,
        FlipTypeControlToUseExclusiveTypeRector::class,
    ]);
};