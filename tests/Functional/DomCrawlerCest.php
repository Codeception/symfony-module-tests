<?php

declare(strict_types=1);

namespace App\Tests\Functional;

use App\Tests\Support\FunctionalTester;

final class DomCrawlerCest
{
    public function _before(FunctionalTester $I): void
    {
        $I->amOnPage('/test_page');
    }

    public function assertAnySelectorTextContains(FunctionalTester $I): void
    {
        $I->assertAnySelectorTextContains('label', 'Example Input', 'A label should contain "Example Input".');
    }

    public function assertAnySelectorTextNotContains(FunctionalTester $I): void
    {
        $I->assertAnySelectorTextNotContains('label', 'Nonexistent label text', 'No label should contain this text.');
    }

    public function assertAnySelectorTextSame(FunctionalTester $I): void
    {
        $I->assertAnySelectorTextSame('label', 'Username', 'A label should be exactly "Username".');
    }

    public function assertCheckboxChecked(FunctionalTester $I): void
    {
        $I->assertCheckboxChecked('exampleCheckbox', 'The checkbox should be checked.');
    }

    public function assertCheckboxNotChecked(FunctionalTester $I): void
    {
        $I->assertCheckboxNotChecked('nonExistentCheckbox', 'This checkbox should not be checked.');
    }

    public function assertInputValueSame(FunctionalTester $I): void
    {
        $I->assertInputValueSame('exampleInput', 'Expected Value', 'The input value should be "Expected Value".');
    }

    public function assertPageTitleContains(FunctionalTester $I): void
    {
        $I->assertPageTitleContains('Test', 'The page title should contain "Test".');
    }

    public function assertPageTitleSame(FunctionalTester $I): void
    {
        $I->assertPageTitleSame('Test Page', 'The page title should be "Test Page".');
    }

    public function assertSelectorCount(FunctionalTester $I): void
    {
        $I->assertSelectorCount(3, 'input', 'The test page should contain exactly 3 inputs.');
    }

    public function assertSelectorExists(FunctionalTester $I): void
    {
        $I->assertSelectorExists('h1', 'The <h1> element should be present.');
    }

    public function assertSelectorNotExists(FunctionalTester $I): void
    {
        $I->assertSelectorNotExists('.non-existent-class', 'This selector should not exist.');
    }

    public function assertSelectorTextSame(FunctionalTester $I): void
    {
        $I->assertSelectorTextSame('h1', 'Test Page', 'The text in the <h1> tag should be exactly "Test Page".');
    }
}
