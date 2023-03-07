<?php

namespace Tests\Feature\Label;

use App\Models\Label;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexTest extends TestCase
{
    use RefreshDatabase;

    public function testDatabaseLabelsAreRendered(): void
    {
        $this->seed();

        $labels = Label::paginate(15);

        $response = $this
            ->get(route('labels.index'))
            ->assertSee('anything is possible');
    }
}
