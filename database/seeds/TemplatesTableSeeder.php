<?php

use Illuminate\Database\Seeder;
use App\Models\Template;

class TemplatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 11 ; $i++) {
          $temp = new Template;
          $temp->name = 'Template'.$i;
          $temp->path = 'Template'.$i.'.PNG';
          $temp->save();
        }
    }
}
