<?php
    header('Content_Type: application/json');
    require_once("functions.php");
    // an array to store the results and errors
    $aResult  = array();

    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }

    if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }

    if( !isset($aResult['error']) ) {
    	switch($_POST['functionname']) {
    	    case 'dailySummary':
				try {
					$aResult['result'] = dailySummary(strtotime($_POST['arguments']));	
				} catch (Exception $e) {
					$aResult['error'] = 'Error: '.$e->getMessage();
				}  
    	       break;
            case 'newlogsheet':
                try {
                        $aResult['result'] = newlogsheet($_POST['arguments']);  
                } catch (Exception $e) {
                        $aResult['error'] = 'Error: '.$e->getMessage();
                    } 
                break;
            case 'getActionList':
                $aResult['result'] = getActionList($_POST['arguments'][0],$_POST['arguments'][1]);
                break;
            case 'newWorkOrder':
                $aResult['result'] = newWorkOrder($_POST['arguments']);
                break;
            case 'plan_next_period':
                $aResult['result'] = plan_next_period($_POST['arguments'][0],$_POST['arguments'][1]);
                break;
            case 'plan_next_period_d': 
                $aResult['result'] = plan_next_period_d($_POST['arguments'][0],$_POST['arguments'][1]);
                break;
            case 'packageList':
                $aResult['result'] = packageList($_POST['arguments']);
                break;
    	    default:
    	       $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
    	       break;
    	}
    }

    echo json_encode($aResult);