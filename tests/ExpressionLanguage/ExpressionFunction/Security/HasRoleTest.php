<?php

declare(strict_types=1);

namespace Overblog\GraphQLBundle\Tests\ExpressionLanguage\ExpressionFunction\Security;

use Overblog\GraphQLBundle\Definition\GlobalVariables;
use Overblog\GraphQLBundle\ExpressionLanguage\ExpressionFunction\Security\HasRole;
use Overblog\GraphQLBundle\Tests\ExpressionLanguage\TestCase;

class HasRoleTest extends TestCase
{
    protected function getFunctions()
    {
        return [new HasRole()];
    }

    public function testEvaluator(): void
    {
        $security       = $this->getSecurityIsGrantedWithExpectation(
            'ROLE_USER',
            $this->any()
        );
        $globalVariable = new GlobalVariables(['security' => $security]);

        $hasRole = $this->expressionLanguage->evaluate('hasRole("ROLE_USER")', ['globalVariable' => $globalVariable]);
        $this->assertTrue($hasRole);
    }

    public function testHasRole(): void
    {
        $this->assertExpressionCompile('hasRole("ROLE_USER")', 'ROLE_USER');
    }
}
