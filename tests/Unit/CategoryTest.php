<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
public function it_can_create_a_category()
{
    $data = Category::factory()->make()->toArray();
    $model = Category::create($data); 
    
    $this->assertDatabaseHas('categories', $data); 

    $model = Category::find($model->id);
    $this->assertNotNull($model); 
    $this->assertEquals($data['name_en'], $model->name_en);
            $this->assertEquals($data['name_ar'], $model->name_ar);
            $this->assertEquals($data['icon'], $model->icon);
            

}/** @test */
public function it_can_read_a_category()
{
    $originalData = Category::factory()->create()->toArray(); 
    $retrievedModel = Category::find($originalData['id']); 
    
    $this->assertNotNull($retrievedModel); 
    $this->assertEquals($originalData['name_en'], $retrievedModel->name_en);
            $this->assertEquals($originalData['name_ar'], $retrievedModel->name_ar);
            $this->assertEquals($originalData['icon'], $retrievedModel->icon);
            

}/** @test */
public function it_can_update_a_category()
{
    $originalData = Category::factory()->create()->toArray(); 
    
    $updateData = array (
  'name_en' => 'et',
  'name_ar' => 'dolorem',
  'icon' => 'maiores',
);

    $model = Category::find($originalData['id']); 
    $model->update($updateData); 

    $this->assertDatabaseHas('categories', $updateData); 

    $updatedModel = Category::find($model->id); 
    $this->assertNotNull($updatedModel); 
    $this->assertEquals($model['name_en'], $updatedModel->name_en);
            $this->assertEquals($model['name_ar'], $updatedModel->name_ar);
            $this->assertEquals($model['icon'], $updatedModel->icon);
            

}/** @test */
public function it_can_delete_a_category()
{
    $data = Category::factory()->create()->toArray(); 

    $model = Category::find($data['id']); 
    $model->delete(); 

    $this->assertDatabaseMissing('categories', $data); 
    
    $deletedModel = Category::find($data['id']); 
    $this->assertNull($deletedModel); 
}
}