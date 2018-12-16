<?php

namespace App\Service;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Traits\ContainerAwareConversationTrait;


class AnimalService extends Conversation
{

    use ContainerAwareConversationTrait;

    protected $species;
    protected $breed;
    protected $gender;
    protected $price;

//    /**
//     * AnimalService constructor.
//     * @param $species
//     * @param $breed
//     * @param $gender
//     * @param $price
//     */
//    public function __construct($species, $breed, $gender, $price)
//    {
//        $this->species = $species;
//        $this->breed = $breed;
//        $this->gender = $gender;
//        $this->price = $price;
//    }


    /**
     * @return mixed|void
     */
    public function run()
    {
        $question = Question::create('What pet would you prefer?')
            ->addButtons([
                Button::create('Dog')->value('dog'),
                Button::create('Cat')->value('cat'),
                //      Button::create('Quit')->value('startQuit'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }

            if ($answer == 'dog') {
                $this->species = $answer;
                $this->selectDogBreed();
                //    return $this->species = $answer;
            } else if ($answer == 'cat') {
                $this->species = $answer;
                $this->selectCatBreed();
                //    return $this->species = $answer;
            } else {
                $this->runQuit();
            }
        });

    }

    /**
     *
     */
    public function runQuit()
    {
        $question = Question::create('Would you like start another order?')
            ->addButtons([
                Button::create('Yes')->value('yes'),
                Button::create('No')->value('no'),
            ]);

        $this->ask(/**
         * @param Answer $answer
         */
            $question, function (Answer $answer) {
            if($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }
            if($answer == 'yes')
            {
                $this->run();
            } else
            {
                $this->say('Order procedure stoped. Type "hi" to start over again');
            }
        });

    }



    public function selectDogBreed()
    {
        $buttons = [];

        $tempBreed = $this->getContainer()->get(DatabaseService::class)->getDogBreeds();
        foreach ($tempBreed as $key=>$breed)
        {
            $buttons[] = Button::create($breed->getDogBreeds())->value($breed->getDogBreeds());
        }

        $question = Question::create('Please select dog breed')
            ->callbackId('select_selectDogBreed')
            ->addButtons($buttons);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->breed = $answer->getValue();
                $this->selectGender();
            }
        });
    }

    public function selectCatBreed()
    {
        $question = Question::create('Please select cat kind')
            ->addButtons([
                Button::create('Ragdoll')->value('ragdoll'),
                Button::create('Sphynx')->value('sphynx'),
                Button::create('Bengal')->value('bengal'),
                Button::create('Siberian')->value('siberian'),
                Button::create('Chartreux')->value('chartreux'),
                Button::create('Quit')->value('startQuit'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }

            switch ($answer) {
                case 'ragdoll':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'sphynx':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'bengal':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'siberian':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'chartreux':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'startQuit':
                    $this->runQuit();
                    break;
            }
        });
    }

    public function selectGender()
    {
        $question = Question::create('Please select gender')
            ->addButtons([
                Button::create('Male')->value('male'),
                Button::create('Female')->value('female'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->gender = $answer->getValue();
            }

        });

    }
}
