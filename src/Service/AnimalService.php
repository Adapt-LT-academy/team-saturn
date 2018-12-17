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
    protected $name;
    protected $surname;
    protected $street;
    protected $apartmentNumber;
    protected $city;



    public function run()
    {
        // $this->say('runBrowse executed');
        $question = Question::create('What animal would you prefer?')
            ->addButtons([
                Button::create('Dog')->value('Dog'),
                Button::create('Cat')->value('Cat'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }

            if ($answer == 'Dog') {
                $this->species = $answer;
               // $this->selectDogBreed();
                $this->testDatabase();

            } else {
                $this->species = $answer;
                $this->selectCatBreed();

            }
        });
    }

    public function selectDogBreed()
    {
        $question = Question::create('Please select dog breed')
            ->addButtons([
                Button::create('Bulldog')->value('Bulldog'),
                Button::create('Beagle')->value('Beagle'),
                Button::create('Poodle')->value('Poodle'),
                Button::create('Chihuahua')->value('Chihuahua'),
                Button::create('Dobermann')->value('Dobermann'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }

            switch ($answer) {
                case 'Bulldog':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'Beagle':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'Poodle':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'Chihuahua':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'Dobermann':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
            }
        });
    }

    public function selectCatBreed()
    {
        $question = Question::create('Please select cat kind')
            ->addButtons([
                Button::create('Ragdoll')->value('Ragdoll'),
                Button::create('Sphynx')->value('Sphynx'),
                Button::create('Bengal')->value('Bengal'),
                Button::create('Siberian')->value('Siberian'),
                Button::create('Chartreux')->value('Chartreux'),
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
            }
        });
    }

    public function selectGender()
    {
        $question = Question::create('Please select gender')
            ->addButtons([
                Button::create('Male')->value('Male'),
                Button::create('Female')->value('Female'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->gender = $answer->getValue();
                $this->animalDetails();
            }

        });
    }

    public function animalDetails() {
        $message = '<br>Animal DETAILS:<br>';
        $message .= 'Species: '.$this->species.'<br>';
        $message .= 'Breed: '.$this->breed.'<br>';
        $message .= 'Gender: '.$this->gender.'<br>';
        $message .= 'Price: '.$this->price.'<br>';

        $this->say('Order details obtained successfully' . $message);
        $this->runConfirmAnimal();

    }


    public function runConfirmAnimal()
    {
        $question = Question::create('Price for this animal is'.$this->price.'Would you like start another order?')
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
                $this->say('u pressed yes');
            } else
            {
                $this->run();
            }
        });

    }

}
