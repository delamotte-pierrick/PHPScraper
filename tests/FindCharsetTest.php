<?php

namespace Spekulatius\PHPScraper\Tests;

class FindCharsetTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingCharset()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the charset as not given (null)
        $this->assertNull($web->findCharset());
    }

    /**
     * @dataProvider charsetProvider
     * @test
     */
    public function testWithCharset($uri, $expected)
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go($uri);

        // Check the charset
        $this->assertSame(
            $expected,
            $web->findCharset()
        );
    }

    private function charsetProvider(): array
    {
        return [
            'content-type' => [
                'uri' => 'https://www.smfcorp.net/mtg-funcards-17214-shoggoth-bloqueur.html',
                'expected' => 'iso-8859-1',
            ],
            'charset and content-type' => [
                'uri' => 'https://test-pages.phpscraper.de/meta/lorem-ipsum.html',
                'expected' => 'utf-8',
            ],
            'charset' => [
                'uri' => 'https://test-pages.phpscraper.de/meta/lorem-ipsum-spaces.html',
                'expected' => 'utf-8',
            ],
        ];
    }
}
