<?php

namespace App\Service;

use App\Entity\Animal;
use App\Entity\Client;
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

    /**
     * AnimalService constructor.
     * @param $species
     * @param $breed
     * @param $gender
     * @param $price
     */
    public function __construct($species, $breed, $gender, $price)
    {
        $this->species = $species;
        $this->breed = $breed;
        $this->gender = $gender;
        $this->price = $price;
    }


    public function run()
    {
        $this->say('testDatabase executed');
  //      $this->testDatabase();


//        // $this->say('runBrowse executed');
//        $question = Question::create('What animal would you prefer?')
//            ->addButtons([
//                Button::create('Dog')->value('Dog'),
//                Button::create('Cat')->value('Cat'),
//            ]);
//
//        $this->ask($question, function (Answer $answer) {
//            if ($answer->isInteractiveMessageReply()) {
//                $answer->getValue();
//            }
//
//            if ($answer == 'Dog') {
//                $this->species = $answer;
//               // $this->selectDogBreed();
//                $this->testDatabase();
//
//            } else {
//                $this->species = $answer;
//                $this->selectCatBreed();
//
//            }
//        });
    }

    /**
     *
     */
    public function usingRepository()
    {
        $message = 0;
        $message = $this->getContainer()->get(DatabaseService::class)->getAnimal($this->breed,$this->species,$this->gender);
        $this->say('message'.$message);
    }


    public function testDatabase()
    {
        $output = $this->getContainer()->get(DatabaseService::class)->getAllDogs();

        $this->say('testDatabase executed again');
    }



    public function selectDogBreed()
    {
        $question = Question::create('Please select dog breed')
            ->addButtons([
                Button::create('Bulldog')->value('bulldog'),
                Button::create('Beagle')->value('beagle'),
                Button::create('Poodle')->value('poodle'),
                Button::create('Chihuahua')->value('chihuahua'),
                Button::create('Dobermann')->value('dobermann'),
                Button::create('Quit')->value('startQuit'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }

            switch ($answer) {
                case 'bulldog':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'beagle':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'poodle':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'chihuahua':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'dobermann':
                    $this->breed = $answer;
                    $this->selectGender();
                    break;
                case 'startQuit':
                    $this->runConfirmAnimal();
                    break;
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
                    $this->runConfirmAnimal();
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
