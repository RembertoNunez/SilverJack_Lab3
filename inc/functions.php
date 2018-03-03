<?php
    function generateDeck()
    {
        $deck = array(
            'deck' => array(),
            'count' => 0);
        for ($i = 0; $i < 4; $i++)
        {
            $card = array(
                'suit' => '',
                'value' => '',
                'peeked' => 0, //0: false, 1: true
                'hidden' => 0);//0: false, 1: true
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
                array_push($deck['deck'], $card);
                $deck['count']++;
            }
        }
        shuffle($deck['deck']);
        return $deck;
    }
    
    function &peek(&$deck)
    {
        $i = -1;
        do
        {
            $i = rand(0, sizeof($deck['deck'])-1);
        } while ($deck['count'] > 0 && $deck['deck'][$i]['peeked'] == 1);
        $deck['deck'][$i]['peeked'] = 1;
        $deck['count']--;
        
        return $deck['deck'][$i];
    }
    
    function getScore(&$hand)
    {
        $score = 0;
        $nAce = array();
        for($i = 0; $i < sizeof($hand); $i++)
        {
            $val = $hand[$i]['value'];
            if ($val == 1 || $val == -1)
                array_push($nAce, array($val, &$hand[$i]));
            $score += ($val > 10) ? 10 : ($val == -1 ? 11 : $val);
        }
        if ($score > 42)
        {
            $i = 0; $end = sizeof($nAce);
            while ($i < $end && $nAce[$i][0] != -1)
                $i++;
            if ($i < $end)
            {
                $nAce[$i][1]['value'] = 1;
                return getScore($hand);
            }
        }
        if ($score <= 31)
        {
            $i = 0; $end = sizeof($nAce);
            while ($i < $end && $nAce[$i][0] != 1)
                $i++;
            if ($i < $end)
            {
                $nAce[$i][1]['value'] = -1;
                return getScore($hand);
            }
        }
        return $score;
    }
    
    function getHand(&$allPlayers)
    {
        $deck = generateDeck();
        
        for($i = 0; $i < sizeof($allPlayers); $i++)
        {
            do
            {
                array_push($allPlayers[$i]['hand'], peek($deck));
            }while (getScore($allPlayers[$i]['hand']) < 38);
            
            $allPlayers[$i]['points'] = getScore($allPlayers[$i]['hand']);
        }
    }
    function displayHand($player)
    {
        foreach ($player['hand'] as $card)
            printCard($card);
        echo $player['points'];
    }

    function displayWinners($allPlayers)
    {
        $i = 0; $end = sizeof($allPlayers);
        while ($i < $end && $allPlayers[$i]['points'] > 42)
            $i++;
        
        if ($i == $end)
        {
            echo '<strong>No winner...</strong><br/>';
            return;
        }

        $winners = array();
        array_push($winners, $allPlayers[$i]);
        $i++;
        while ($i < $end)
        {
            $points = $allPlayers[$i]['points'];
            
            if ($points < 43)
            {
                if ($points > $winners[0]['points'])
                {
                    $winners = array();
                    array_push($winners, $allPlayers[$i]);
                }
                else if ($points == $winners[0]['points'])
                    array_push($winners, $allPlayers[$i]);
            }
            
            $i++;
        }

        $total = 0;
        $winner = $winners[0];
        foreach($allPlayers as $player)
            if ($player != $winner)
                $total += $player['points'];

        foreach($winners as $winner)
            echo '<strong>'.$winner['name'].' wins '
            .$total.' points!</strong><br/>';
    }
/*
    function printCard($card)
    {
        //Temporary path for tests.
        if ($card['hidden'] == 1)
            echo "<img src='../SilverJack_Lab3/cards/card_back.png' />";
        else
            echo "<img src='../SilverJack_Lab3/cards/".$card['suit']
                    ."/".($card['value'] == -1 ? 1 : $card['value']).".png' />";
    }
*/
    function printCard($card)
    {
        if ($card['hidden'] == 1)
            echo "<img src='cards/card_back.png' />";
        else
            echo "<img src='cards/".$card['suit']
                    ."/".($card['value'] == -1 ? 1 : $card['value']).".png' />";
    }

    function printGameState($allPlayers)
    {
        foreach ($allPlayers as $player)
        {
            echo $player["name"].": ";
            displayHand($player);
            echo '<br/>';
        }
        echo '<br/>';
        displayWinners($allPlayers);
    }
    
    function play() 
    {
        $player1 = array(
            'name' => 'Player 1',
            'hand' => array(),
            'points' => 0
            );
        $player2 = array(
            'name' => 'Player 2',
            'hand' => array(),
            'points' => 0
            );
        $player3 = array(
            'name' => 'Player 3',
            'hand' => array(),
            'points' => 0
            );
        $player4 = array(
            'name' => 'Player 4',
            'hand' => array(),
            'points' => 0
            );
        
        $allPlayers = array(
            $player1,
            $player2,
            $player3,
            $player4
            );
            getHand($allPlayers);
            printGameState($allPlayers);
    }
?>