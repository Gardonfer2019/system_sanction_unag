<?php

use Illuminate\Database\Seeder;

use App\User;
use Illuminate\Support\Facades\Hash;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $userCSU=User::create([
            'name'=> 'GUSTAVO ALONSO ARDON',
            'email'=> 'gardon@gmail.com',
            'password'=>Hash::make('admin'),
            'tipo'=>'1',
            'codigo'=>'admin1',
            'username'=>'gardon',
        ]);
        $userCDF=User::create([
            'name'=> 'OSCAR ARMANDO RODRIGUEZ',
            'email'=> 'orodriguez@gmail.com',
            'password'=> Hash::make('root'),
            'tipo'=>'2',
            'codigo'=>'caso1',
            'username'=>'oarmando',
        ]);
        $userDDE=User::create([
            'name'=> 'ASTRID DOLMO',
            'email'=> 'dolmo@gmail.com',
            'password'=> Hash::make('root'),
            'tipo'=>'5',
            'codigo'=>'caso2',
            'username'=>'clopez',
        ]);
        $userDocente=User::create([
            'name'=> 'OLVIN ROSALES MENDOZA',
            'email'=> 'olvin@gmail.com',
            'password'=> Hash::make('root'),
            'tipo'=>'3',
            'codigo'=>'casa3',
            'username'=>'orosales',
        ]);
        $userEstudiante1=User::create([
            'name'=> 'DAVID ERNESTO DIAZ CARDENAS',
            'email'=> 'ernes@gmail.com',
            'password'=> Hash::make('root'),
            'tipo'=>'4',
            'codigo'=>'caso4',
            'username'=>'18A1008',
        ]);
        $userEstudiante2=User::create([
            'name'=> 'OSCAR EDUARDO ROMERO MENDOZA',
            'email'=> 'romero@gmail.com',
            'password'=> Hash::make('root'),
            'tipo'=>'4',
            'codigo'=>'caso5',
            'username'=>'18A1009',
        ]);
        $userEstudiante3=User::create([
            'name'=> 'VIRGILIO ANTONIO MENDOZA RUIZ',
            'email'=> 'virgilio@gmail.com',
            'password'=> Hash::make('root'),
            'tipo'=>'4',
            'codigo'=>'caso6',
            'username'=>'18A1010',
        ]);
        $userEstudiante4=User::create([
            'name'=> 'GUSTAVO ALONSO ARDON FERNANDEZ',
            'email'=> 'gustavo@gmail.com',
            'password'=> Hash::make('root'),
            'tipo'=>'4',
            'codigo'=>'caso7',
            'username'=>'18A1011',
        ]);
        $userEstudiante5=User::create([
            'name'=> 'OSCAR DAVID MEJIA MEJIA',
            'email'=> 'oscar@gmail.com',
            'password'=> Hash::make('root'),
            'tipo'=>'4',
            'codigo'=>'caso8',
            'username'=>'18A1012',
        ]);
    }
}
