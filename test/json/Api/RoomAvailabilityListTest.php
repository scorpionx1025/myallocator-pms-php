<?php
 
use MyAllocator\phpsdk\Api\RoomAvailabilityList;
use MyAllocator\phpsdk\Object\Auth;
use MyAllocator\phpsdk\Util\Common;
use MyAllocator\phpsdk\Exception\ApiAuthenticationException;
 
class RoomAvailabilityListTest extends PHPUnit_Framework_TestCase
{
    /**
     * @author nathanhelenihi
     * @group api
     */
    public function testClass()
    {
        $obj = new RoomAvailabilityList();
        $this->assertEquals('MyAllocator\phpsdk\Api\RoomAvailabilityList', get_class($obj));
    }

    public function fixtureAuthCfgObject()
    {
        $auth = Common::getAuthEnv(array(
            'vendorId',
            'vendorPassword',
            'userId',
            'userPassword',
            'propertyId'
        ));
        $data = array();
        $data[] = array($auth);

        return $data;
    }

    /**
     * @author nathanhelenihi
     * @group api
     * @dataProvider fixtureAuthCfgObject
     */
    public function testCallApi(array $fxt)
    {
        if (!$fxt['from_env']) {
            $this->markTestSkipped('Environment credentials not set.');
        }

        $obj = new RoomAvailabilityList($fxt);

        if (!$obj->isEnabled()) {
            $this->markTestSkipped('API is disabled!');
        }

        // No req args should fail
        $caught = false;
        try {
            $rsp = $obj->callApi();
        } catch (exception $e) {
            $caught = true;
            $this->assertInstanceOf('MyAllocator\phpsdk\Exception\ApiException', $e);
        }

        if (!$caught) {
            $this->fail('should have thrown an exception');
        }

        $rsp = $obj->callApiWithParams(array(
            'StartDate' => '2014-12-10',
            'EndDate' => '2014-12-13',
        ));
        $this->assertTrue(isset($rsp['response']['Rooms']));
    }
}
