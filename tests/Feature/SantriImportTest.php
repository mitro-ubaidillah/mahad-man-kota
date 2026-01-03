<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Kelas;
use App\Models\Santri;

class SantriImportTest extends TestCase
{
    use RefreshDatabase;

    public function test_csv_import_creates_santri_and_kelas()
    {
        // prepare a small CSV in storage
        $csv = "nis,name,email,phone,kelas,birth_date\n";
        $csv .= ",Joko,joko@example.com,081234,10A,2008-01-01\n";
        $csv .= ",Siti,siti@example.com,081235,10B,2009-02-02\n";

        $file = tmpfile();
        $meta = stream_get_meta_data($file);
        $path = $meta['uri'];
        file_put_contents($path, $csv);

        $uploaded = new \Illuminate\Http\UploadedFile($path, 'test.csv', null, null, true);

        $this->actingAs($this->createAdminUser());

        $resp = $this->post(route('santris.import'), ['file' => $uploaded]);
        $resp->assertRedirect(route('santris.index'));

        $this->assertDatabaseHas('kelas', ['name' => '10A']);
        $this->assertDatabaseHas('kelas', ['name' => '10B']);

        $this->assertDatabaseHas('santris', ['email' => 'joko@example.com']);
        $this->assertDatabaseHas('santris', ['email' => 'siti@example.com']);
    }

    protected function createAdminUser()
    {
        return \App\Models\User::factory()->create(['is_admin' => true]);
    }
}
