<?php

namespace Tests\Unit;

use App\Services\ExternalJobPostService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class ExternalJobPostServiceTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_can_fetch_external_jobs(): void
    {
        Http::fake([
            'mrge-group-gmbh.jobs.personio.de/*' => Http::response(
                file_get_contents(storage_path('app/private/external_jobs.xml')),
                200,
                ['Content-Type' => 'application/xml']
            )
        ]);
        $service = new ExternalJobPostService();
        $response = $service->fetchPosts();

        $this->assertIsArray($response);
        $this->assertCount(2, $response);
        $this->assertArrayHasKey('id', $response[0]);
    }

    /**
     * A basic unit test example.
     */
    public function test_no_external_jobs(): void
    {
        Http::fake([
            'mrge-group-gmbh.jobs.personio.de/*' => Http::response(
                '<?xml version="1.0" encoding="UTF-8"?><workzag-jobs></workzag-jobs>',
                200,
                ['Content-Type' => 'application/xml']
            )
        ]);
        $service = new ExternalJobPostService();
        $response = $service->fetchPosts();

        $this->assertIsArray($response);
        $this->assertEmpty($response);
    }
}
