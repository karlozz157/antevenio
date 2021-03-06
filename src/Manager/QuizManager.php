<?php

namespace Antevenio\Manager;

use Antevenio\Helper\JsonHelper;
use medoo;

/**
 * @author karlozz157
 */
class QuizManager
{
    /**
     * @const int
     */
    const BASE_VOTES = 1000;

    /**
     * @var medoo $medoo
     */
    protected $medoo;

    /**
     * @param medoo $medoo
     */
    public function __construct(medoo $medoo)
    {
        $this->medoo = $medoo;
    }

    /**
     * @return int
     */
    public function count()
    {
        return self::BASE_VOTES + $this->totalVotes + $this->medoo->count('users');
    }

    /**
     * @return array
     */
    public function getMostVoted()
    {
        $images = [];
        $mostVoted = [];
        $users = $this->medoo->select('users', ['answers']);

        foreach ($users as $user) {
            $answers = JsonHelper::decode($user['answers']);

            foreach ($answers as $key => $answer) {
                $images[$key] = $answer;

                if (!isset($mostVoted[$key])) {
                    $mostVoted[$key] = 1;
                } else {
                    $mostVoted[$key]++;
                }
            }
        }

        arsort($mostVoted);
        $mostVoted = array_slice($mostVoted, 0, 7);
        $data = [];

        foreach ($mostVoted as $key => $voted) {
            $votes = self::BASE_VOTES + $voted;
            $images[$key]['votes'] = $votes;
            $data[] = $images[$key];
        }

        return $data;
    }

    /**
     * @param array $data
     *
     * @return boolean
     */
    public function persist(array $data = [])
    {
        $dataId = $this->medoo->insert('users', [
            'name'  => $data['name'],
            'email' => $data['email'],
            'birthdate' => sprintf('%d-%s-%d', $data['day'], $data['month'], $data['year']),
            'gender' => $data['gender'],
            'location'  => $data['location'],
            '(JSON)answers' => $data['answers']
        ]);

        if (!($dataId > 0)) {
            throw new \Exception($this->medoo->error());
        }

        return true;
    }
}
