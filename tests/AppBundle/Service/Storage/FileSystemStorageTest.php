<?php

namespace Tests\AppBundle\Service\Storage;

use Tests\AppBundle\Service\AbstractServiceTest;

class FileSystemStorageTest extends AbstractServiceTest
{
    public function test()
    {
        $company = 'some-test-company.json';

        $this->getService()->del($company);

        $this->assertFalse($this->getService()->exists($company));

        $value = md5($company);

        $this->getService()->set($company, $value);

        $this->assertSame($this->getService()->get($company), $value);
    }

    private function getService()
    {
        return $this->container->get('scp.keyvalue.storage');
    }
}
