<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_user()
    {
        $data = User::factory()->make()->toArray();
        $model = User::create($data);

        $this->assertDatabaseHas('users', $data);

        $model = User::find($model->id);
        $this->assertNotNull($model);
        $this->assertEquals($data['name'], $model->name);
        $this->assertEquals($data['email'], $model->email);
        $this->assertEquals($data['gender'], $model->gender);
        $this->assertEquals($data['email_verified_at'], $model->email_verified_at);
        $this->assertEquals($data['password'], $model->password);
        $this->assertEquals($data['avatar'], $model->avatar);
        $this->assertEquals($data['phone'], $model->phone);
        $this->assertEquals($data['currency'], $model->currency);
        $this->assertEquals($data['remember_token'], $model->remember_token);
    }
    /** @test */
    public function it_can_read_a_user()
    {
        $originalData = User::factory()->create()->toArray();
        $retrievedModel = User::find($originalData['id']);

        $this->assertNotNull($retrievedModel);
        $this->assertEquals($originalData['name'], $retrievedModel->name);
        $this->assertEquals($originalData['email'], $retrievedModel->email);
        $this->assertEquals($originalData['email_verified_at'], $retrievedModel->email_verified_at);
        $this->assertEquals($originalData['password'], $retrievedModel->password);
        $this->assertEquals($originalData['avatar'], $retrievedModel->avatar);
        $this->assertEquals($originalData['gender'], $retrievedModel->gender);
        $this->assertEquals($originalData['phone'], $retrievedModel->phone);
        $this->assertEquals($originalData['currency'], $retrievedModel->currency);
        $this->assertEquals($originalData['remember_token'], $retrievedModel->remember_token);
    }
    /** @test */
    public function it_can_update_a_user()
    {
        $originalData = User::factory()->create()->toArray();

        $updateData = array(
            'name' => 'accusamus',
            'email' => 'tfritsch@example.net',
            'email_verified_at' => '2023-12-07 08:33:03',
            'password' => '$2y$12$.Xg17La/qWQS6p.qr7zKaewTc0aO11OBZYlet28dHaorzwStfQ1Su',
            'avatar' => 'aut',
            'phone' => 'illo',
            'gender' => 'male',
            'currency' => 'qui',
            'remember_token' => 'xX4CZiVIDthuRPijsvrb7LIgwoow7hXwmgRDF4cZPQR4zeU4sqI9g7lN1Cvq',
        );

        $model = User::find($originalData['id']);
        $model->update($updateData);

        $this->assertDatabaseHas('users', $updateData);

        $updatedModel = User::find($model->id);
        $this->assertNotNull($updatedModel);
        $this->assertEquals($model['name'], $updatedModel->name);
        $this->assertEquals($model['email'], $updatedModel->email);
        $this->assertEquals($model['email_verified_at'], $updatedModel->email_verified_at);
        $this->assertEquals($model['password'], $updatedModel->password);
        $this->assertEquals($model['avatar'], $updatedModel->avatar);
        $this->assertEquals($model['gender'], $updatedModel->gender);
        $this->assertEquals($model['phone'], $updatedModel->phone);
        $this->assertEquals($model['currency'], $updatedModel->currency);
        $this->assertEquals($model['remember_token'], $updatedModel->remember_token);
    }
    /** @test */
    public function it_can_delete_a_user()
    {
        $data = User::factory()->create()->toArray();

        $model = User::find($data['id']);
        $model->delete();

        $this->assertDatabaseMissing('users', $data);

        $deletedModel = User::find($data['id']);
        $this->assertNull($deletedModel);
    }
}
