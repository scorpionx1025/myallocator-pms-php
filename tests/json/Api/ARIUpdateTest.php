<?php
/**
 * Copyright (C) 2014 MyAllocator
 *
 * A copy of the LICENSE can be found in the LICENSE file within
 * the root directory of this library.  
 *
 * Permission is hereby granted, free of charge, to any person obtaining a
 * copy of this software and associated documentation files (the "Software"),
 * to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included
 * in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
 * OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

namespace MyAllocator\phpsdk\tests\json;
 
use MyAllocator\phpsdk\src\Api\ARIUpdate;
use MyAllocator\phpsdk\src\Object\Auth;
use MyAllocator\phpsdk\src\Util\Common;
use MyAllocator\phpsdk\src\Exception\ApiAuthenticationException;
 
class ARIUpdateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @author nathanhelenihi
     * @group api
     */
    public function testClass()
    {
        $obj = new ARIUpdate();
        $this->assertEquals('MyAllocator\phpsdk\src\Api\ARIUpdate', get_class($obj));
    }

    public function fixtureAuthCfgObject()
    {
        $auth = Common::getAuthEnv(array(
            'vendorId',
            'vendorPassword',
            'userId',
            'userPassword',
            //'userToken',
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

        $obj = new ARIUpdate($fxt);
        $obj->setConfig('dataFormat', 'array');

        if (!$obj->isEnabled()) {
            $this->markTestSkipped('API is disabled!');
        }

/*
        $data = array(
            'Options' => array(
                'QueryForStatus' => 'true',
                //'loop_delay' => 30,
                'FailIfUpdateActive' => 'false'
            ),
            'Channels' => array(
                'air',
                'boo',
                'loc'
                //'all'
            ),
            'Allocations' => array(
                array(
                    'RoomId' => '23651',
                    'StartDate' => '2015-01-05',
                    'EndDate' => '2017-01-07',
                    'Units' => '2',
                    'MinStay' => '1',
                    'MaxStay' => '3',
                    'Price' => '30.00',
                    'Price-Weekend' => '40.00'
                ),
                array(
                    'RoomId' => '23651',
                    'StartDate' => '2014-12-10',
                    'EndDate' => '2014-12-10',
                    'Units' => '2',
                    'MinStay' => '1',
                    'MaxStay' => '3',
                    'Price' => '1.00',
                    'Price-Weekend' => '2.00'
                ),
                array(
                    'RoomId' => '22905',
                    'StartDate' => '2014-12-11',
                    'EndDate' => '2014-12-11',
                    'Units' => '2',
                    'MinStay' => '1',
                    'MaxStay' => '3',
                    'Price' => '3.00',
                    'Price-Weekend' => '4.00'
                )
            )
        );
*/
        $data = array(
            'Options' => array(
                'QueryForStatus' => 'true',
                //'loop_delay' => 30,
                'FailIfUpdateActive' => 'false'
            ),
            'Channels' => array(
                'loop',
                'boo'
                //'loc'
                //'all'
            ),
            'Allocations' => array(
                array(
                    'RoomId' => '23651',
                    'StartDate' => '2015-03-01',
                    'EndDate' => '2016-03-31',
                    'Units' => '5',
                    'MinStay' => '1',
                    'Price' => '50.00'
                )
            )
        );

        $rsp = $obj->callApiWithParams($data);
        $this->assertTrue(isset($rsp['response']['body']['Success']));
    }
}
