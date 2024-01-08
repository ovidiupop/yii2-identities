<?php

use yii\db\Migration;

/**
 * Class m240105_170126_identities_data
 */
class m240105_170126_identities_data extends Migration
{
    public $industryData = [
        '1' => 'Aerospace',
        '2' => 'Agriculture',
        '3' => 'Animal Care',
        '4' => 'Art and Entertainment',
        '5' => 'Automotive',
        '6' => 'Banking',
        '7' => 'Blockchain Technology',
        '8' => 'Chemistry',
        '9' => 'Construction',
        '10' => 'Consulting',
        '11' => 'Cosmetics Industry',
        '12' => 'E-commerce',
        '13' => 'Education',
        '14' => 'Electronics',
        '15' => 'Energy',
        '16' => 'Environment/Nature Care',
        '17' => 'Fashion',
        '18' => 'Finance',
        '19' => 'Food and Beverages',
        '20' => 'Furniture',
        '21' => 'Governmental Organizations',
        '22' => 'Green Technology',
        '23' => 'Health',
        '24' => 'Insurance',
        '25' => 'Interior Design',
        '26' => 'Jewelry',
        '27' => 'Logistics and Distribution',
        '28' => 'Luxury Goods',
        '29' => 'Media and Communications',
        '30' => 'Metalurgy',
        '31' => 'Music and Online Entertainment',
        '32' => 'Non-profit Organizations',
        '33' => 'Online Education',
        '34' => 'Pharmaceuticals',
        '35' => 'Professional Services (legal, accounting)',
        '36' => 'Real Estate',
        '37' => 'Recycling',
        '38' => 'Recreation and Sports',
        '39' => 'Renewable Energy',
        '40' => 'Research and Development',
        '41' => 'Retail',
        '42' => 'Robotics',
        '43' => 'Social Services',
        '44' => 'Space Industry',
        '45' => 'Technology/IT',
        '46' => 'Telecommunications',
        '47' => 'Textiles',
        '48' => 'Tourism',
        '49' => 'Transportation',
        '50' => 'Video Games',
        '51' => 'Virtual Reality Technology',
        '52' => 'Wine Industry',
    ];

    protected $identityTypeData = [
        '1' => 'Person',
        '2' => 'Company',
    ];

    public $personIdentifierTypeData = [
        1 => ['country' => 'AL', 'country_name' => 'Albania', 'type' => 'Personal ID Number'],
        2 => ['country' => 'AD', 'country_name' => 'Andorra', 'type' => 'National ID Number'],
        3 => ['country' => 'AT', 'country_name' => 'Austria', 'type' => 'Social Insurance Number'],
        4 => ['country' => 'BY', 'country_name' => 'Belarus', 'type' => 'Passport Number'],
        5 => ['country' => 'BE', 'country_name' => 'Belgium', 'type' => 'National Registry Number'],
        6 => ['country' => 'BA', 'country_name' => 'Bosnia and Herzegovina', 'type' => 'Personal ID Number'],
        7 => ['country' => 'BG', 'country_name' => 'Bulgaria', 'type' => 'Personal Number'],
        8 => ['country' => 'CZ', 'country_name' => 'Czech Republic', 'type' => 'Personal Number'],
        9 => ['country' => 'CY', 'country_name' => 'Cyprus', 'type' => 'ID Card Number'],
        10 => ['country' => 'HR', 'country_name' => 'Croatia', 'type' => 'Personal Identification Number'],
        11 => ['country' => 'DK', 'country_name' => 'Denmark', 'type' => 'CPR Number'],
        12 => ['country' => 'CH', 'country_name' => 'Switzerland', 'type' => 'AHV/AVS Number'],
        13 => ['country' => 'EE', 'country_name' => 'Estonia', 'type' => 'Personal Identification Code'],
        14 => ['country' => 'FI', 'country_name' => 'Finland', 'type' => 'Personal Identity Code'],
        15 => ['country' => 'FR', 'country_name' => 'France', 'type' => 'National ID Number'],
        16 => ['country' => 'DE', 'country_name' => 'Germany', 'type' => 'Personal ID Number'],
        17 => ['country' => 'GR', 'country_name' => 'Greece', 'type' => 'AMKA'],
        18 => ['country' => 'IE', 'country_name' => 'Ireland', 'type' => 'Personal Public Service Number (PPS Number)'],
        19 => ['country' => 'IS', 'country_name' => 'Iceland', 'type' => 'Kennitala'],
        20 => ['country' => 'IT', 'country_name' => 'Italy', 'type' => 'Codice Fiscale'],
        21 => ['country' => 'LV', 'country_name' => 'Latvia', 'type' => 'Personal Code'],
        22 => ['country' => 'LI', 'country_name' => 'Liechtenstein', 'type' => 'Personal ID Number'],
        23 => ['country' => 'LT', 'country_name' => 'Lithuania', 'type' => 'Personal Code'],
        24 => ['country' => 'LU', 'country_name' => 'Luxembourg', 'type' => 'Matricule Number'],
        25 => ['country' => 'MK', 'country_name' => 'North Macedonia', 'type' => 'Personal ID Number'],
        26 => ['country' => 'MT', 'country_name' => 'Malta', 'type' => 'ID Card Number'],
        27 => ['country' => 'MD', 'country_name' => 'Moldova', 'type' => 'ID Series & Number'],
        28 => ['country' => 'MC', 'country_name' => 'Monaco', 'type' => 'National ID Number'],
        29 => ['country' => 'ME', 'country_name' => 'Montenegro', 'type' => 'Personal ID Number'],
        30 => ['country' => 'NO', 'country_name' => 'Norway', 'type' => 'Personal ID Number'],
        31 => ['country' => 'NL', 'country_name' => 'Netherlands', 'type' => 'Citizen Service Number'],
        32 => ['country' => 'PL', 'country_name' => 'Poland', 'type' => 'PESEL'],
        33 => ['country' => 'PT', 'country_name' => 'Portugal', 'type' => 'Fiscal Number'],
        34 => ['country' => 'GB', 'country_name' => 'United Kingdom', 'type' => 'National Insurance Number'],
        35 => ['country' => 'RO', 'country_name' => 'Romania', 'type' => 'CNP'],
        36 => ['country' => 'RU', 'country_name' => 'Russia', 'type' => 'Internal Passport Number'],
        37 => ['country' => 'SM', 'country_name' => 'San Marino', 'type' => 'ID Card Number'],
        38 => ['country' => 'RS', 'country_name' => 'Serbia', 'type' => 'Personal ID Number'],
        39 => ['country' => 'SK', 'country_name' => 'Slovakia', 'type' => 'Personal ID Number'],
        40 => ['country' => 'SI', 'country_name' => 'Slovenia', 'type' => 'Personal ID Number'],
        41 => ['country' => 'ES', 'country_name' => 'Spain', 'type' => 'DNI'],
        42 => ['country' => 'SE', 'country_name' => 'Sweden', 'type' => 'Personal Number'],
        43 => ['country' => 'TR', 'country_name' => 'Turkey', 'type' => 'Turkish ID Number'],
        44 => ['country' => 'UA', 'country_name' => 'Ukraine', 'type' => 'Internal Passport Number'],
        45 => ['country' => 'HU', 'country_name' => 'Hungary', 'type' => 'Personal ID Number'],
        46 => ['country' => 'VA', 'country_name' => 'Vatican City', 'type' => 'Vatican Passport Number'],
        47 => ['country' => 'FO', 'country_name' => 'Faroe Islands', 'type' => 'Personal Number'],
    ];


    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        foreach ($this->industryData as $id => $name) {
            $this->insert('industry', [
                'id' => $id,
                'name' => $name,
            ]);
        }

        foreach ($this->identityTypeData as $id => $type) {
            $this->insert('identity_type', [
                'id' => $id,
                'type' => $type,
            ]);
        }

        foreach ($this->personIdentifierTypeData as $id => $data) {
            $this->insert('person_identifier_type', [
                'id' => $id,
                'country' => $data['country'],
                'country_name' => $data['country_name'],
                'type' => $data['type'],
            ]);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('industry', ['in', 'id', array_keys($this->industryData)]);
        $this->delete('identity_type', ['in', 'id', array_keys($this->identityTypeData)]);
        $this->delete('person_identifier_type', ['in', 'id', array_keys($this->personIdentifierTypeData)]);
    }
}