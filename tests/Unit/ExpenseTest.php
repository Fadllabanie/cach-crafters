<?php

namespace Tests\Unit;

use App\Models\Category;
use Tests\TestCase;
use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpenseTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_expense()
    {
        $data = Expense::factory()->make()->toArray();
        $model = Expense::create($data);

        $this->assertDatabaseHas('expenses', $data);

        $model = Expense::find($model->id);
        $this->assertNotNull($model);
        $this->assertEquals($data['user_id'], $model->user_id);
        $this->assertEquals($data['category_id'], $model->category_id);
        $this->assertEquals($data['amount'], $model->amount);
        $this->assertEquals($data['date'], $model->date);
    }
    /** @test */
    public function it_can_read_a_expense()
    {
        $originalData = Expense::factory()->create()->toArray();
        $retrievedModel = Expense::find($originalData['id']);

        $this->assertNotNull($retrievedModel);
        $this->assertEquals($originalData['user_id'], $retrievedModel->user_id);
        $this->assertEquals($originalData['category_id'], $retrievedModel->category_id);
        $this->assertEquals($originalData['amount'], $retrievedModel->amount);
        $this->assertEquals($originalData['date'], $retrievedModel->date);
    }
    /** @test */
    public function it_can_update_a_expense()
    {
        $originalData = Expense::factory()->create()->toArray();
        $user = User::factory()->create(); // Create a new user
        $category = Category::factory()->create(); // Create a new category

        $updateData = array(
            'user_id' => $user->id,
            'category_id' => $category->id,
            'amount' => 750.48,
            'date' => '2023-12-07 11:48:03',
        );

        $model = Expense::find($originalData['id']);
        $model->update($updateData);

        $this->assertDatabaseHas('expenses', $updateData);

        $updatedModel = Expense::find($model->id);
        $this->assertNotNull($updatedModel);
        $this->assertEquals($model['user_id'], $updatedModel->user_id);
        $this->assertEquals($model['category_id'], $updatedModel->category_id);
        $this->assertEquals($model['amount'], $updatedModel->amount);
        $this->assertEquals($model['date'], $updatedModel->date);
    }
    /** @test */
    public function it_can_delete_a_expense()
    {
        $data = Expense::factory()->create()->toArray();

        $model = Expense::find($data['id']);
        $model->delete();

        $this->assertDatabaseMissing('expenses', $data);

        $deletedModel = Expense::find($data['id']);
        $this->assertNull($deletedModel);
    }
}
