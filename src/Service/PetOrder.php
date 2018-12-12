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
            $this->orderDetails();
        });
    }

    /**
     *
     */
    public function orderDetails() {
        $message = '<br>PET DETAILS:<br>';
        $message .= 'Species: '.$this->species.'<br>';
        $message .= 'Breed: '.$this->breed.'<br>';
        $message .= 'Gender: '.$this->gender.'<br>';
        $message .= '<br>DELIVERY DETAILS:<br>';
        $message .= 'Street: '.$this->street.'<br>';
        $message .= 'Apartment: '.$this->apartmentNumber.'<br>';
        $message .= 'City: '.$this->city.'<br>';

        $this->say('Order details obtained successfully' . $message);
        $this->orderDatValidation();

    }

    public function orderDatValidation() {
                $question = Question::create('Confirm order details')
            ->addButtons([
                Button::create('Confirm')->value('yes'),
                Button::create('Edit pet and delivery details')->value('editPet'),
                Button::create('Edit delivery details')->value('editAddress'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                $answer->getValue();
            }
            switch ($answer) {
                case 'yes':
                    $this->say('Order confirmed');
                    break;
                case 'editPet':
                    $this->runBrowse();
                    break;
                case 'editAddress':
                    $this->askName();
            }
        });
    }

}
