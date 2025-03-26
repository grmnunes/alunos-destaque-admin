<?php

namespace App\Enums;

enum SchoolGrade: string
{
    // Educação Infantil
    case PRE_I = 'pre_I';
    case PRE_II = 'pre_II';

    // Ensino Fundamental
    case GRADE_1 = '1st';
    case GRADE_2 = '2nd';
    case GRADE_3 = '3rd';
    case GRADE_4 = '4th';
    case GRADE_5 = '5th';
    case GRADE_6 = '6th';
    case GRADE_7 = '7th';
    case GRADE_8 = '8th';
    case GRADE_9 = '9th';

    // Ensino Médio
    case HIGH_SCHOOL_1 = '10th';
    case HIGH_SCHOOL_2 = '11th';
    case HIGH_SCHOOL_3 = '12th';

    public static function options(): array
    {
        return [

            // Educação Infantil
            self::PRE_I->value => 'Pré I',
            self::PRE_II->value => 'Pré II',

            // Ensino Fundamental
            self::GRADE_1->value => '1º Ano',
            self::GRADE_2->value => '2º Ano',
            self::GRADE_3->value => '3º Ano',
            self::GRADE_4->value => '4º Ano',
            self::GRADE_5->value => '5º Ano',
            self::GRADE_6->value => '6º Ano',
            self::GRADE_7->value => '7º Ano',
            self::GRADE_8->value => '8º Ano',
            self::GRADE_9->value => '9º Ano',

            // Ensino Médio
            self::HIGH_SCHOOL_1->value => '1º Ano do Ensino Médio',
            self::HIGH_SCHOOL_2->value => '2º Ano do Ensino Médio',
            self::HIGH_SCHOOL_3->value => '3º Ano do Ensino Médio',
        ];
    }
}
