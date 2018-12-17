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

    public function run()
    {
        $this->selectSpecies();
    }

    public function selectSpecies() {

        $buttons = [];

        $animals = $this->getContainer()->get(DatabaseService::class)
            ->getAllAnimals();

        foreach ($animals as $key=>$animal)
        {
            $buttons[] = Button::create($animal->getSpecies())->value
            ($animal->getSpecies());
        }

        $question = Question::create('What animal would you prefer?')
            ->addButtons($buttons);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->species = $answer->getValue();
                $this->selectBreed();
            }
        });
    }

    public function selectBreed()
    {
        $buttons = [];

        $breeds = $this->getContainer()->get(DatabaseService::class)
            ->getBreeds($this->species);

        foreach ($breeds as $key=>$animal)
        {
            $buttons[] = Button::create($animal->getBreed())->value
            ($animal->getBreed());
        }

        $question = Question::create('Choose a breed for your animal:')
            ->addButtons($buttons);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $this->breed = $answer->getValue();
                $this->selectGender();
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
