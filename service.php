<?php

function getTeams()
{
    $vTeams = array();
    for ($i=1; $i<7;$i++) {
        $vTeams['team_' . $i] = array(
            'id'   => 'team_' . $i,
            'name' => 'Team ' . $i,
            'checked' => true,
        );
    }
    ksort($vTeams);
    return $vTeams;
}

function getTeamdata()
{
    $vTeams = getTeams();
    $vTypes = array('Type 1', 'Type 2', 'Type 3');
    $vHours = array(4, 8);
    
    $teamData = array();
    foreach ($vTeams as $team) {
        
        $users = array();
        for ($x = 0; $x < rand(4,18); $x++) {
            
            $absence_records = array();
            for ($j = rand(1,15); $j < rand(16,29); $j++) {
                
                $typeKey  = array_rand($vTypes, 1);
                $hoursKey = array_rand($vHours, 1);
                
                $absence_records[] = array(
                    'date'  => '2013-' . str_pad(rand(1,12), 2, 0, STR_PAD_LEFT) . '-' . str_pad($j, 2, 0, STR_PAD_LEFT),
                    'type'  => $vTypes[$typeKey],
                    'hours' => $vHours[$hoursKey]
                );
            }
            
            $users[] = array(
                'name' => "Person $x",
                'role' => 'Developer',
                'absence_records' => $absence_records
            );
        }
        
        $teamData[] = array(
            'id'   => $team['id'],
            'name' => $team['name'],
            'data' => $users
        );
    }
    
    return $teamData;
}

$m = @ $_REQUEST['m'];
$data = array();

switch ($m) {
    case 'teams':
        $data = getTeams();
        break;
    case 'data':
        $data = getTeamdata();
        break;
}

header('Content-Type: application/json');
$response = array(
    'success' => 1,
    'data' => $data
);

$prefix = ")]}',\n";
echo $prefix . json_encode($response);