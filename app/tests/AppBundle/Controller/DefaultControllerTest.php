<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testCoursesGet()
    {
        $client = static::createClient();
        $client->request('GET', '/api/courses');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    public function testModuleGet()
    {
        $client = static::createClient();
        $client->request('GET', '/api/modules');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    public function testThemeGet()
    {
        $client = static::createClient();
        $client->request('GET', '/api/themes');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    public function testQuestionGet()
    {
        $client = static::createClient();
        $client->request('GET', '/api/questions');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}
