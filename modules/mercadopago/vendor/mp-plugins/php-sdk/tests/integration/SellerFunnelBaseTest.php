<?php

namespace MercadoPago\PP\Sdk\Tests\Integration;

use MercadoPago\PP\Sdk\Sdk;
use PHPUnit\Framework\TestCase;

class SellerFunnelBaseTest extends TestCase
{

    private function loadSdkCreateSellerFunnelBase()
    {
        $configKeys = new ConfigKeys();
        $envVars = $configKeys->loadConfigs();
        $accessToken = $envVars['ACCESS_TOKEN'] ?? null;
        $publicKey = $envVars['PUBLIC_KEY'] ?? null;
        $sdk = new Sdk(
            $accessToken,
            'ppcoreinternal',
            'ppcoreinternal',
            '',
            $publicKey
        );
        return $sdk->getCreateSellerFunnelBaseInstance();
    }

    private function loadSdkUpdateSellerFunnelBase()
    {
        $configKeys = new ConfigKeys();
        $envVars = $configKeys->loadConfigs();
        $accessToken = $envVars['ACCESS_TOKEN'] ?? null;
        $publicKey = $envVars['PUBLIC_KEY'] ?? null;
        $sdk = new Sdk(
            $accessToken,
            'ppcoreinternal',
            'ppcoreinternal',
            '',
            $publicKey
        );
        return $sdk->getUpdateSellerFunnelBaseInstance();
    }


    private function loadCreateSellerFunnelBase()
    {

        $createSellerFunnelBase = $this->loadSdkCreateSellerFunnelBase();

        $createSellerFunnelBase->platform_id = "123";
        $createSellerFunnelBase->shop_url = "http://localhost";

        return $createSellerFunnelBase;
    }

    private function loadUpdateSellerFunnelBase()
    {
        $updateSellerFunnelBase = $this->loadSdkUpdateSellerFunnelBase();

        $updateSellerFunnelBase->id = "id";
        $updateSellerFunnelBase->is_added_production_credential = true;
        $updateSellerFunnelBase->is_added_test_credential = true;
        $updateSellerFunnelBase->product_id = "4das56";
        $updateSellerFunnelBase->cust_id = "123";
        $updateSellerFunnelBase->application_id = "123";
        $updateSellerFunnelBase->plugin_mode = "prod";
        $updateSellerFunnelBase->is_deleted = false;
        $updateSellerFunnelBase->accepted_payments = ["bolbradesco", "pix"];

        return $updateSellerFunnelBase;
    }

    public function testCreateSellerFunnelBaseWithSuccess()
    {
        $createSellerFunnelBase = $this->loadCreateSellerFunnelBase();

        $response = $createSellerFunnelBase->save();

        $this->assertNotNull($response->id);
        $this->assertNotNull($response->cpp_token);
    }

    public function testUpdateSellerFunnelBaseWithSuccess()
    {
        $createSellerFunnelBase = $this->loadCreateSellerFunnelBase();

        $updateSellerFunnelBase = $this->loadUpdateSellerFunnelBase();

        $responseCreate = $createSellerFunnelBase->save();

        $updateSellerFunnelBase->id = $responseCreate->id;
        $updateSellerFunnelBase->cpp_token = $responseCreate->cpp_token;

        $responseUpdate = json_decode(json_encode($updateSellerFunnelBase->update()));

        $this->assertNotNull($responseCreate->id);
        $this->assertNotNull($responseUpdate->id);
        $this->assertEquals($responseCreate->id, $responseUpdate->id);
        $this->assertTrue($responseUpdate->success_update);
    }
}
