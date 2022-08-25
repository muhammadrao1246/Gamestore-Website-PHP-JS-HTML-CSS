<?php
$message=array(0,"0");
function calculate_date($row)
{
    if ($row['years']==0) 
    {
        if ($row['months']==0) 
        {
            if ($row['days']==0) 
            {
                if ($row['hours']==0) 
                {
                    if ($row['minutes']==0) 
                    {
                        if ($row['seconds']==0) 
                        {
                            $message[1]="unknown";$message[0]=0;
                        }   
                        else { $message[1]="seconds"; $message[0]=$row['seconds']; }        
                    }   
                    else { $message[1]="minutes"; $message[0]=$row['minutes']; }
                }   
                else { $message[1]="hours"; $message[0]=$row['hours']; }
            }   
            else { $message[1]="days"; $message[0]=$row['days']; }
        }   
        else { $message[1]="months"; $message[0]=$row['months']; }
    }
    else { $message[1]="years"; $message[0]=$row['years']; }

    if($message[0]==1)
    {
        $message[1]=substr($message[1],0,strlen($message[1])-1);
    }

    return $message;
}
?>