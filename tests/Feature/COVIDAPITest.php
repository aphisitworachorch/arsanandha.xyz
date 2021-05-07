<?php

namespace Tests\Feature;

use App\Http\Controllers\COVIDController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class COVIDAPITest extends TestCase
{
    /*
     * Test case 1 : Basic API Calling
     */
    public function testAPIGet(){
        $api = new COVIDController();
        $this->assertTrue($api->covidAPICall ());
    }
}
