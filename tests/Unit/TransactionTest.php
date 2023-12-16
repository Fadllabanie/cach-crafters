<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Transaction;
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
    }
    /** @test */
    public function it_can_read_a_transaction()
    {
        $originalData = Transaction::factory()->create()->toArray();
        $retrievedModel = Transaction::find($originalData['id']);

        $this->assertNotNull($retrievedModel);
    }
    /** @test */
    public function it_can_update_a_transaction()
    {
        $originalData = Transaction::factory()->create()->toArray();

        $updateData = array();

        $model = Transaction::find($originalData['id']);
        $model->update($updateData);

        $this->assertDatabaseHas('transactions', $updateData);

        $updatedModel = Transaction::find($model->id);
        $this->assertNotNull($updatedModel);
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
