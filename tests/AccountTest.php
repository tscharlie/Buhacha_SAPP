<?php

use Laravel\Lumen\Testing\DatabaseTransactions;

class AccountTest extends TestCase
{
    use DatabaseTransactions;
    
    /**
     * Should get all accounts.
     * @test
     */
    public function shouldGetAll()
    {
        $this->get('/accounts');
                
        $content = $this->response->getContent();
        
        $response = json_decode($content);
        
        
        $accounts = $response->data;
        foreach($accounts as $account) {
            $this->assertTrue(isset($account->id));
            $this->assertTrue(isset($account->name));
        } 
    }
    
    /**
     * Should get one account.
     * @test
     */
    public function shouldGetOne()
    {
        $accountId = 1;
        $this->get('/accounts/'. $accountId);
        
        $content = $this->response->getContent();
        
        $response = json_decode($content);
        
        $account = $response;
                
        $this->assertTrue(isset($account->id));
        $this->assertTrue(isset($account->name));
    }
    
    /**
     * Should get all enabled accounts.
     * @test
     */
    public function shouldGetAllEnabled()
    {
        $this->get('/accounts?enabled=1');
                
        $content = $this->response->getContent();
        
        $response = json_decode($content);
        
        $accounts = $response->data;
        foreach($accounts as $account) {
            $this->assertTrue(isset($account->id));
            $this->assertTrue(isset($account->name));
            $this->assertTrue(isset($account->iban), 'Expected iban to be set on account');
        } 
    }
    
    /**
     * Should get all enabled accounts.
     * @test
     */
    public function shouldGetAllDisabled()
    {
        $this->get('/accounts?enabled=0');
                
        $content = $this->response->getContent();
        
        $response = json_decode($content);
        
        $accounts = $response->data;
        foreach($accounts as $account) {
            $this->assertTrue(isset($account->id));
            $this->assertTrue(isset($account->name));
            $this->assertTrue(!isset($account->iban), 'Expected iban to be set on account');
        } 
    }
    
    /**
     * Should get error.
     * @test
     */
    public function shouldGetErrorBecauseOfString()
    {
        $this->get('/accounts?enabled=a', [], 500);
    }
    
    /**
     * Should get error.
     * @test
     */
    public function shouldUpdateAccountName()
    {
        // prepare test data
        $account = \App\Account::findOrFail(1);
        $newName = $account->name . '_updated';
        
        $updateData = [
            'name' => $newName
        ];
        
        // update
        $this->post('/accounts/' . $account->id, $updateData);
        
        // reload account
        $updated = $account->fresh();
        
        // tests
        $this->assertEquals($newName, $updated->name);
        
    }
}
