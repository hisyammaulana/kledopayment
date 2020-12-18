<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PaymentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testPayment()
    {
        $response = $this->get('/payments');

        $response->assertStatus(200);
    }
}
