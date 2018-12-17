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
                $this->selectDogBreed();

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
                    $this->price = 1350;
                    $this->selectGender();
                    break;
                case 'Beagle':
                    $this->breed = $answer;
                    $this->price = 1550;
                    $this->selectGender();
                    break;
                case 'Poodle':
                    $this->breed = $answer;
                    $this->price = 1650;
                    $this->selectGender();
                    break;
                case 'Chihuahua':
                    $this->breed = $answer;
                    $this->price = 2150;
                    $this->selectGender();
                    break;
                case 'Dobermann':
                    $this->breed = $answer;
                    $this->price = 1950;
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
                case 'Ragdoll':
                    $this->breed = $answer;
                    $this->price = 950;
                    $this->selectGender();
                    break;
                case 'Sphynx':
                    $this->breed = $answer;
                    $this->price = 1250;
                    $this->selectGender();
                    break;
                case 'Bengal':
                    $this->breed = $answer;
                    $this->price = 550;
                    $this->selectGender();
                    break;
                case 'Siberian':
                    $this->breed = $answer;
                    $this->price = 650;
                    $this->selectGender();
                    break;
                case 'Chartreux':
                    $this->breed = $answer;
                    $this->price = 1350;
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

            }

            if ($this->gender == 'Female') {
                $this->price += 50;
                $this->animalDetails();
            } else
                $this->animalDetails();
            {

            }

        });
    }

    public function animalDetails() {
        $message = 'Animal DETAILS:<br>';
        $message .= 'Species: '.$this->species.'<br>';
        $message .= 'Breed: '.$this->breed.'<br>';
        $message .= 'Gender: '.$this->gender.'<br>';
        $message .= 'Price: '.$this->price.'<br>';

        $this->say( $message);
        $this->runConfirmAnimal();

    }


    public function runConfirmAnimal()
    {
        $question = Question::create('Confirm animal details')
            ->addButtons([
                Button::create('Confirm')->value('yes'),
                Button::create('Change')->value('no'),
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
                $this->askName();
            } else
            {
                $this->run();
            }
        });
    }

    public function askName()
    {
        $this->ask('Whats is your first name?', function (Answer $response) {
            $this->name = $response->getText();
            $this->askSurname();
        });
    }

    public function askSurname()
    {
        $this->ask('Great, and your last name?', function (Answer $response) {
            $this->surname = $response->getText();
            $this->askStreet();
        });
    }

    public function askStreet()
    {
        $this->ask('Got it! Now we need a location. Lets start with street name.', function (Answer $response) {
            $this->street = $response->getText();
            $this->askApartmentNumber();
        });
    }

    public function askApartmentNumber()
    {
        $this->ask('Now enter apartment number.', function (Answer $response) {
            $this->apartmentNumber = $response->getText();
            $this->askCity();
        });
    }

    public function askCity()
    {
        $this->ask('Oh and city?', function (Answer $response) {
            $this->city = $response->getText();
            $this->clientDetails();
        });
    }

    public function clientDetails() {
        $message = 'DELIVERY DETAILS:<br>';
        $message .= 'Street: '.$this->street.'<br>';
        $message .= 'Apartment: '.$this->apartmentNumber.'<br>';
        $message .= 'City: '.$this->city.'<br>';

        $this->say($message);
        $this->runConfirmClient();

    }
    public function runConfirmClient()
    {
        $question = Question::create('Confirm delivery details')
            ->addButtons([
                Button::create('Confirm')->value('yes'),
                Button::create('Change')->value('no'),
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
                $this->say('Your order placed successfully');
            } else
            {
                $this->askName();
            }
        });
    }

}
