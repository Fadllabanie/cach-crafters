<?php

namespace Tests\Unit;

use App\Models\Source;
use Tests\TestCase;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TransactionTest extends TestCase
{
  use RefreshDatabase;

  /** @test */
  public function it_can_create_a_transaction()
  {
    $data = Transaction::factory()->make()->toArray();
    $model = Transaction::create($data);

    $this->assertDatabaseHas('transactions', $data);

    $model = Transaction::find($model->id);
    $this->assertNotNull($model);
    $this->assertEquals($data['user_id'], $model->user_id);
    $this->assertEquals($data['source_id'], $model->source_id);
    $this->assertEquals($data['type'], $model->type);
    $this->assertEquals($data['amount'], $model->amount);
    $this->assertEquals($data['transactionDate'], $model->transactionDate);
  }
  /** @test */
  public function it_can_read_a_transaction()
  {
    $originalData = Transaction::factory()->create()->toArray();
    $retrievedModel = Transaction::find($originalData['id']);

    $this->assertNotNull($retrievedModel);
    $this->assertEquals($originalData['user_id'], $retrievedModel->user_id);
    $this->assertEquals($originalData['source_id'], $retrievedModel->source_id);
    $this->assertEquals($originalData['type'], $retrievedModel->type);
    $this->assertEquals($originalData['amount'], $retrievedModel->amount);
    $this->assertEquals($originalData['transactionDate'], $retrievedModel->transactionDate);
  }
  /** @test */
  public function it_can_update_a_transaction()
  {
    $originalData = Transaction::factory()->create()->toArray();
    $user = User::factory()->create(); // Create a new user
    $source = Source::factory()->create(); // Create a new category

    $updateData = array(
      'user_id' => $user->id,
      'source_id' => $source->id,
      'type' => 'expense',
      'amount' => 325.16,
      'transactionDate' => '2023-12-07 08:33:03',
    );

    $model = Transaction::find($originalData['id']);
    $model->update($updateData);

    $this->assertDatabaseHas('transactions', $updateData);

    $updatedModel = Transaction::find($model->id);
    $this->assertNotNull($updatedModel);
    $this->assertEquals($model['user_id'], $updatedModel->user_id);
    $this->assertEquals($model['source_id'], $updatedModel->source_id);
    $this->assertEquals($model['type'], $updatedModel->type);
    $this->assertEquals($model['amount'], $updatedModel->amount);
    $this->assertEquals($model['transactionDate'], $updatedModel->transactionDate);
  }
  /** @test */
  public function it_can_delete_a_transaction()
  {
    $data = Transaction::factory()->create()->toArray();

    $model = Transaction::find($data['id']);
    $model->delete();

    $this->assertDatabaseMissing('transactions', $data);

    $deletedModel = Transaction::find($data['id']);
    $this->assertNull($deletedModel);
  }
}
