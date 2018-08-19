<?php

/* Advent of Code - Day 2 - Matt Davis */

//Test input
// const INPUT = "5 9 2 8
// 9 4 7 3
// 3 8 6 5";

const INPUT = "121	59	141	21	120	67	58	49	22	46	56	112	53	111	104	130
1926	1910	760	2055	28	2242	146	1485	163	976	1842	1982	137	1387	162	789
4088	258	2060	1014	4420	177	4159	194	2794	4673	4092	681	174	2924	170	3548
191	407	253	192	207	425	580	231	197	382	404	472	164	571	500	216
4700	1161	168	5398	5227	5119	252	2552	4887	5060	1152	3297	847	4525	220	262
2417	992	1445	184	554	2940	209	2574	2262	1911	2923	204	2273	2760	506	157
644	155	638	78	385	408	152	360	588	618	313	126	172	220	217	161
227	1047	117	500	1445	222	29	913	190	791	230	1281	1385	226	856	1380
436	46	141	545	122	86	283	124	249	511	347	502	168	468	117	94
2949	3286	2492	2145	1615	159	663	1158	154	939	166	2867	141	324	2862	641
1394	151	90	548	767	1572	150	913	141	1646	154	1351	1506	1510	707	400
646	178	1228	1229	270	167	161	1134	193	1312	1428	131	1457	719	1288	989
1108	1042	93	140	822	124	1037	1075	125	941	1125	298	136	94	135	711
112	2429	1987	2129	2557	1827	477	100	78	634	352	1637	588	77	1624	2500
514	218	209	185	197	137	393	555	588	569	710	537	48	309	519	138
1567	3246	4194	151	3112	903	1575	134	150	4184	3718	4077	180	4307	4097	1705";


//Builds an array of numbers based on the number of columns specified
function buildChecksumArray( string $input, int $columns )
{
    $checksumArray = [];
    $numberArray = preg_split( '[\s+]', $input);
    $column = 1;
    $row = 1;
    for ($i=0; $i < sizeof($numberArray); $i++) 
    {   
        if( $column <= $columns )
        {
            $checksumArray[$row][$column] = $numberArray[$i];   
        }
        else {
            $column = 1;
            $row++;

            $checksumArray[$row][$column] = $numberArray[$i];
        }

        $column++;
    }

    return $checksumArray;
}

 function solvePuzzle( string $input, int $columns)
 {

    $checksumArray = buildChecksumArray( INPUT, $columns );
    $checkSum = 0;
    $secondChecksum = 0;

    foreach ($checksumArray as $rowKey => $rowNumbers) 
    {
        //Calculates checksum for part one
        $smallestNumber = min($rowNumbers);
        $largestNumber = max($rowNumbers);

        $difference = $largestNumber - $smallestNumber;
        $checkSum += $difference;

        
        
        /////////////////////////Calculates checksum for part two///////////////////

        //Sort current row from highest to lowest
        rsort($rowNumbers);
      
        $count = 0;
        //Iterate through each row of numbers
        foreach ($rowNumbers as $key => $number) 
        {
            $rowSize = sizeof($rowNumbers);
            
            while( $count < $rowSize )
            {
                //Take the current number and divide it by all of the following numbers in the array
                for($i=$key; $i < (sizeof($rowNumbers) - 1); $i++) 
                {           

                    $divisionResult = $rowNumbers[$key] / $rowNumbers[$i+1];
         
                   //If a whole number is found, store it so it can be added to the checksum
                   if(floor($divisionResult) == $divisionResult)
                   {
                        $rowSum = $divisionResult;
                     
                    }
            
                }
               
                $count++;
                $key++;
                        
            }
            
        }

        $secondChecksum += $rowSum;
    }
    print($secondChecksum);

    $puzzleSolutions["Part One"][] = $checkSum;
    $puzzleSolutions["Part Two"][] = $secondChecksum;
    
    return $puzzleSolutions;
 }


 print_r(solvePuzzle(INPUT, 16));

//Part 1 solution is 32121
//Part 2 solution is 197

