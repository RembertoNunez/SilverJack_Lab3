<?php
    function generateDeck()
    {
        $deck = array();
        for ($i = 0; $i < 4; $i++)
        {
            $card = array(
                'suit' => '',
                'value' => '',
                'hidden' => false);
            switch($i)
            {
                case 0:
                    $card['suit'] = 'clubs';
                    break;
                case 1:
                    $card['suit'] = 'diamonds';
                    break;
                case 2:
                    $card['suit'] = 'hearts';
                    break;
                default:
                    $card['suit'] = 'spades';
                    break;
            }
            for ($j = 1; $j < 14; $j++)
            {
                $card['value'] = $j;
                array_push($deck, $card);
            }
        }
        shuffle($deck);
        return $deck;
    }
    
    function printCard($card)
    {
        //Temporary path for tests.
        if ($card['hidden'])
            echo "<img src='../SilverJack_Lab3/cards/card_back.png' />";
        else
            echo "<img src='../SilverJack_Lab3/cards/"
                    .$card['suit']."/".$card['value'].".png' />";
    }
    
    function getHand($allPlayers)
    {
        $deck = generateDeck();
        
    }
    function displayHand($allPlayers)
    {
        
    }
    function displayWinners($allPlayers)
    {
        
    }
?>