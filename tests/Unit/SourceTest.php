<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Source;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_create_a_source()
    {
        $data = Source::factory()->make()->toArray();
        $model = Source::create($data);
       
        $this->assertDatabaseHas('sources', $data);

        $model = Source::find($model->id);
       
        $this->assertNotNull($model);
        $this->assertEquals($data['name_en'], $model->name_en);
        $this->assertEquals($data['name_ar'], $model->name_ar);
        $this->assertEquals($data['icon'], $model->icon);
        $this->assertEquals($data['color'], $model->color);
    }
    /** @test */
    public function it_can_read_a_source()
    {
        $originalData = Source::factory()->create()->toArray();
        $retrievedModel = Source::find($originalData['id']);

        $this->assertNotNull($retrievedModel);
        $this->assertEquals($originalData['name_en'], $retrievedModel->name_en);
        $this->assertEquals($originalData['name_ar'], $retrievedModel->name_ar);
        $this->assertEquals($originalData['icon'], $retrievedModel->icon);
        $this->assertEquals($originalData['color'], $retrievedModel->color);
    }
    /** @test */
    public function it_can_update_a_source()
    {
        $originalData = Source::factory()->create()->toArray();

        $updateData = array(
            'name_en' => 'ab',
            'name_ar' => 'reprehenderit',
            'icon' => 'exercitationem',
            'color' => '#345344',
        );

        $model = Source::find($originalData['id']);
        $model->update($updateData);

        $this->assertDatabaseHas('sources', $updateData);

        $updatedModel = Source::find($model->id);
        $this->assertNotNull($updatedModel);
        $this->assertEquals($model['name_en'], $updatedModel->name_en);
        $this->assertEquals($model['name_ar'], $updatedModel->name_ar);
        $this->assertEquals($model['icon'], $updatedModel->icon);
        $this->assertEquals($model['color'], $updatedModel->color);
    }
    /** @test */
    public function it_can_delete_a_source()
    {
        $data = Source::factory()->create()->toArray();

        $model = Source::find($data['id']);
        $model->delete();

        $this->assertDatabaseMissing('sources', $data);

        $deletedModel = Source::find($data['id']);
        $this->assertNull($deletedModel);
    }
}
