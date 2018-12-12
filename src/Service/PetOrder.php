<?php

namespace App\Service;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Incoming\Answer;
use App\Traits\ContainerAwareConversationTrait;

/**
 * Class TestConversation
 * @property  startConversation
 */
class PetOrder extends Conversation
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

        $this->runBrowse();
//        $question = Question::create('Select one of above')
//            ->addButtons([
//                Button::create('Browse')->value('startBrowse'),
//                Button::create('Random')->value('startRandom'),
//                Button::create('Quit')->value('startQuit'),
//            ]);
//
//        $this->ask($question, function (Answer $answer) {
//            // Detect if button was clicked:
//            if ($answer->isInteractiveMessageReply()) {
//                $answer->getValue();
//            }
//
//            switch ($answer) {
//                case 'startBrowse':
//                    $this->runBrowse();
//                    break;
//
//                case 'startRandom':
//                    $this->runRandom();
//                    break;
//
//                case 'startQuit':
//                    $this->runQuit();
//                    break;
//            }
//        });
    }

    public function runBrowse()
    {
        // $this->say('runBrowse executed');
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

    public function runRandom()
    {
        $this->say('Random executed');
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
        $question = Question::create('Please select dog breed')
            ->addButtons([
                Button::create('Bulldog')->value('bulldog'),
                Button::create('Beagle')->value('begle'),
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
                case 'begle':
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
                    $this->runQuit();
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
                $this->askName();
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
            $this->customerDataValidation();
        });
    }

    /**
     *
     */
    public function customerDataValidation() {
        $this->say('Got it. Please check collected data before going further.');
        $this->say('Species: '.$this->species.' Breed: '.$this->breed.' Gender: '.$this->gender);
        $this->say('Name: '.$this->name.' Surname: '.$this->surname.' Street: '.$this->street.' Apartment: '
        .$this->apartmentNumber.' City: '.$this->city);


        $question = Question::create('Confirm order details')
            ->addButtons([
                Button::create('Confirm')->value('yes'),
                Button::create('Decline')->value('no'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply() && value() == 'yes') {
                $this->size = $answer->getValue();
                // next step?
            } else {
                $this->runQuit();
            }

        });


    }

}
