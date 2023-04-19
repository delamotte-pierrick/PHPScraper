<?php

namespace Spekulatius\PHPScraper\Tests;

class MetaContentTypeTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function testMissingContentType()
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go('https://test-pages.phpscraper.de/meta/missing.html');

        // Check the contentType as not given (null)
        $this->assertNull($web->contentType);
    }

    /**
     * @dataProvider contentTypeProvider
     * @test
     */
    public function testWithContentType($uri, $expected)
    {
        $web = new \Spekulatius\PHPScraper\PHPScraper;

        // Navigate to the test page.
        $web->go($uri);

        // Check the contentType
        $this->assertSame(
            $expected,
            $web->contentType
        );
    }

    private function contentTypeProvider(): array
    {
        return [
            'Content-Type' => [
                'uri' => 'https://www.smfcorp.net/mtg-funcards-17214-shoggoth-bloqueur.html',
                'expected' => 'text/html; charset=iso-8859-1',
            ],
            'Content-type' => [
                'uri' => 'https://test-pages.phpscraper.de/meta/lorem-ipsum.html',
                'expected' => 'text/html; charset=utf-8',
            ],

        ];
    }
}
