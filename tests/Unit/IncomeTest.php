<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Income;
use App\Models\Source;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IncomeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_income()
    {
        $data = Income::factory()->make()->toArray();
        $model = Income::create($data);

        $this->assertDatabaseHas('incomes', $data);

        $model = Income::find($model->id);
        $this->assertNotNull($model);
        $this->assertEquals($data['user_id'], $model->user_id);
        $this->assertEquals($data['source_id'], $model->source_id);
        $this->assertEquals($data['amount'], $model->amount);
        $this->assertEquals($data['date'], $model->date);
    }
    /** @test */
    public function it_can_read_a_income()
    {
        $originalData = Income::factory()->create()->toArray();
        $retrievedModel = Income::find($originalData['id']);

        $this->assertNotNull($retrievedModel);
        $this->assertEquals($originalData['user_id'], $retrievedModel->user_id);
        $this->assertEquals($originalData['source_id'], $retrievedModel->source_id);
        $this->assertEquals($originalData['amount'], $retrievedModel->amount);
        $this->assertEquals($originalData['date'], $retrievedModel->date);
    }
    /** @test */
    public function it_can_update_a_income()
    {
        $originalData = Income::factory()->create()->toArray();
        $user = User::factory()->create(); // Create a new user
        $source = Source::factory()->create(); // Create a new source

        $updateData = array(
            'user_id' => $user->id,
            'source_id' => $source->id,
            'amount' => 980.21,
            'date' => '2023-12-07 08:33:03',
        );

        $model = Income::find($originalData['id']);

        $model->update($updateData);
        $model->refresh(); // Refresh the model instance
        $this->assertDatabaseHas('incomes', $updateData);

        $updatedModel = Income::find($model->id);
        $this->assertNotNull($updatedModel);
        $this->assertEquals($model['user_id'], $updatedModel->user_id);
        $this->assertEquals($model['source_id'], $updatedModel->source_id);
        $this->assertEquals($model['amount'], $updatedModel->amount);
        $this->assertEquals($model['date'], $updatedModel->date);
    }
    /** @test */
    public function it_can_delete_a_income()
    {
        $data = Income::factory()->create()->toArray();

        $model = Income::find($data['id']);
        $model->delete();

        $this->assertDatabaseMissing('incomes', $data);

        $deletedModel = Income::find($data['id']);
        $this->assertNull($deletedModel);
    }
}
