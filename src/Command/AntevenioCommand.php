<?php

namespace Antevenio\Command;

use Antevenio\Helper\JsonHelper;
use Antevenio\Helper\CsvHelper;
use medoo;

/**
 * @author karlozz157
 */
class AntevenioCommand
{
    /**
     * @var medoo $medoo
     */
    protected $medoo;

    /**
     * @void
     */
    public function execute()
    {
        $users = $this->medoo->select('users', '*', '', ['status' => 0]);

        $csvHelper = new CsvHelper(sprintf('public/reports/%s.csv', date('Y-m-d')));
        $csvHelper->setColumnNames([
            'NAME',
            'EMAIL',
            'BIRTHDATE',
            'LOCATION',
            'FB ID',
            'FB NAME',
            'FB EMAIL',
            'FB SEX',
        ]);

        foreach ($users as $user) {
            $csvHelper->addRow($this->parseUser($user));
        }

        $csvHelper->save();

        $this->medoo->update('users', ['status' => 1], ['status' => 0]);
    }

    /**
     * @param array $user
     *
     * @return array
     */
    protected function parseUser(array $user)
    {
        $facebook = JsonHelper::decode($user['facebook_data']);

        $column   = [];
        $column[] = $user['name'];
        $column[] = $user['email'];
        $column[] = $user['birthdate'];
        $column[] = isset($user['location']) ? $user['location'] : '';
        $column[] = isset($facebook['id']) ? $facebook['id'] : '';
        $column[] = (isset($facebook['first_name']) ? $facebook['first_name'] : '') . ' ' . (isset($facebook['last_name']) ? $facebook['last_name'] : '');
        $column[] = isset($facebook['email']) ? $facebook['email'] : '';
        $column[] = isset($facebook['gender']) ? $facebook['gender'] : '';

        return $column;
    }

    /**
     * @param medoo $medoo
     */
    public function setMedoo(medoo $medoo)
    {
        $this->medoo = $medoo;
    }
}
