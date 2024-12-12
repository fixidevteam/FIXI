<?php

namespace Tests\Unit;

use App\Models\MarqueVoiture;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminGestionMarqueControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_list_of_marques()
    {
        MarqueVoiture::insert([
            ['marque' => 'Toyota'],
            ['marque' => 'Honda'],
            ['marque' => 'Ford'],
        ]);

        $response = $this->get(route('admin.gestionMarque.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.gestionMarque.index');
        $response->assertViewHas('marques');
    }

    /** @test */
    public function it_displays_the_create_marque_form()
    {
        $response = $this->get(route('admin.gestionMarque.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.gestionMarque.create');
    }

    /** @test */
    public function it_creates_a_new_marque()
    {
        $data = ['marque' => 'Toyota'];

        $response = $this->post(route('admin.gestionMarque.store'), $data);

        $response->assertRedirect(route('admin.gestionMarque.index'));
        $this->assertDatabaseHas('marque_voitures', $data);
    }

    /** @test */
    public function it_validates_marque_creation()
    {
        $response = $this->post(route('admin.gestionMarque.store'), []);

        $response->assertSessionHasErrors('marque');
    }

    /** @test */
    public function it_displays_the_edit_marque_form()
    {
        $marque = MarqueVoiture::create(['marque' => 'Toyota']);

        $response = $this->get(route('admin.gestionMarque.edit', $marque->id));

        $response->assertStatus(200);
        $response->assertViewIs('admin.gestionMarque.edit');
        $response->assertViewHas('marqueVoiture', $marque);
    }

    /** @test */
    public function it_updates_an_existing_marque()
    {
        $marque = MarqueVoiture::create(['marque' => 'Old Name']);

        $data = ['marque' => 'New Name'];

        $response = $this->put(route('admin.gestionMarque.update', $marque->id), $data);

        $response->assertRedirect(route('admin.gestionMarque.index'));
        $this->assertDatabaseHas('marque_voitures', $data);
    }

    /** @test */
    public function it_validates_marque_update()
    {
        $marque = MarqueVoiture::create(['marque' => 'Toyota']);

        $response = $this->put(route('admin.gestionMarque.update', $marque->id), []);

        $response->assertSessionHasErrors('marque');
    }

    /** @test */
    public function it_deletes_a_marque()
    {
        $marque = MarqueVoiture::create(['marque' => 'Toyota']);

        $response = $this->delete(route('admin.gestionMarque.destroy', $marque->id));

        $response->assertRedirect(route('admin.gestionMarque.index'));
        $this->assertDatabaseMissing('marque_voitures', ['id' => $marque->id]);
    }
}