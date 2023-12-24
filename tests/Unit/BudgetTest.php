<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Budget;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BudgetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_budget()
    {
        $data = Budget::factory()->make()->toArray();
        $model = Budget::create($data);

        $this->assertDatabaseHas('budgets', $data);

        $model = Budget::find($model->id);
        $this->assertNotNull($model);
        $this->assertEquals($data['user_id'], $model->user_id);
        $this->assertEquals($data['source_id'], $model->source_id);
        $this->assertEquals($data['name'], $model->name);
        $this->assertEquals($data['amount'], $model->amount);
        $this->assertEquals($data['period'], $model->period);
        $this->assertEquals($data['is_budget_overspend'], $model->is_budget_overspend);
        $this->assertEquals($data['is_exceeded'], $model->is_exceeded);
    }
    /** @test */
    public function it_can_read_a_budget()
    {
        $originalData = Budget::factory()->create()->toArray();
        $retrievedModel = Budget::find($originalData['id']);

        $this->assertNotNull($retrievedModel);
        $this->assertEquals($originalData['user_id'], $retrievedModel->user_id);
        $this->assertEquals($originalData['source_id'], $retrievedModel->source_id);
        $this->assertEquals($originalData['name'], $retrievedModel->name);
        $this->assertEquals($originalData['amount'], $retrievedModel->amount);
        $this->assertEquals($originalData['period'], $retrievedModel->period);
        $this->assertEquals($originalData['is_budget_overspend'], $retrievedModel->is_budget_overspend);
        $this->assertEquals($originalData['is_exceeded'], $retrievedModel->is_exceeded);
    }
    /** @test */
    public function it_can_update_a_budget()
    {
        $originalData = Budget::factory()->create()->toArray();

        $updateData = array(
            'user_id' => 29,
            'source_id' => 2050,
            'name' => 'molestiae',
            'amount' => 799.56,
            'period' => 'yearly',
            'is_budget_overspend' => false,
            'is_exceeded' => false,
        );

        $model = Budget::find($originalData['id']);
        $model->update($updateData);

        $this->assertDatabaseHas('budgets', $updateData);

        $updatedModel = Budget::find($model->id);
        $this->assertNotNull($updatedModel);
        $this->assertEquals($model['user_id'], $updatedModel->user_id);
        $this->assertEquals($model['source_id'], $updatedModel->source_id);
        $this->assertEquals($model['name'], $updatedModel->name);
        $this->assertEquals($model['amount'], $updatedModel->amount);
        $this->assertEquals($model['period'], $updatedModel->period);
        $this->assertEquals($model['is_budget_overspend'], $updatedModel->is_budget_overspend);
        $this->assertEquals($model['is_exceeded'], $updatedModel->is_exceeded);
    }
    /** @test */
    public function it_can_delete_a_budget()
    {
        $data = Budget::factory()->create()->toArray();

        $model = Budget::find($data['id']);
        $model->delete();

        $this->assertDatabaseMissing('budgets', $data);

        $deletedModel = Budget::find($data['id']);
        $this->assertNull($deletedModel);
    }
}
