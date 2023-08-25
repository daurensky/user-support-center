<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Makes admin user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Введите обязательные данные для создания админа');

        $fields = [
            'name'     => $this->ask('Имя', false),
            'email'    => $this->ask('Электронная почта', false),
            'password' => $this->ask('Пароль', false),
        ];

        if (count($fields) !== count(array_filter($fields))) {
            $this->error('Заполните все данные!');
            return 1;
        }

        $user = User::create($fields);
        $user->assignRole('admin');

        $this->info('Админ успешно создан!');

        return 0;
    }
}
