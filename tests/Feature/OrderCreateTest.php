<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Session;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class OrderCreateTest extends TestCase
{
    public function testOrderCreate()
    {
        $this->post('http://back-office.local/user/create', [
            'name' => 'test',
            'surname' => 'unit test ' . rand(0, 777),
            'fiscal_code' => '1234567890123456',
            'university_code' => 1, // 1,2,3 or 4 (Studente Politecnico, Altro Ateneo, Azienda or Privato)
            'born_in' => 'test petrozavodsk',
            'date_of_birth' => '1986-04-18',
            'nation' => 116,
            'province' => 79,
            'phone' => '98140768157',
            'email' => 'amosaa@mail.ru',
            'university' => 'petrSU',
            'school' => 'test school',
            'enrolment_exam' => '2016-03-24',
            'session_id' => 2,
            'personal_code' => '1234567890mnbvcx',
            'city' => 105 /*'Moscow'*/,
            'address' => 'Arhipova 12, 40',
            'number' => 12,
            'cap' => '185007',
            'vat' => 'test vat',
            'matricola' => 'test matricola'
        ]);
    }
}
