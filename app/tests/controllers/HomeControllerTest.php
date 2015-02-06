<?php

use Illuminate\Support\Facades\Session;

class HomeControllerTest extends TestCase {

    public function tearDown()
    {
        Session::forget('event_id');
    }

    public function testOverview_NoSetEvent_CallsNoEventRoute()
    {
        $this->call('GET', '/');
        $this->assertRedirectedTo('/events/select');
    }

    public function testOverview_EventSet_CallsVendorOverviewRoute()
    {
        $this->session(['event_id' => 1]);

        $this->call('GET', '/');
        $this->assertRedirectedTo('/events/vendors/overview');
    }
}
