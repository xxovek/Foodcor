<?php
include '../config/connection.php';
session_start();
  $companyId = $_SESSION['company_id'];
  // echo $companyId."\n";
  $formid = $_REQUEST['formid'];
  // echo $formid."\n";
  $formtype = $_REQUEST['formtype'];
  // echo $formtype."\n";
  $htransactionid = $_REQUEST['htransactionid'];
  // echo $htransactionid."\n";
  $personId=$_REQUEST['customername'];
  // echo $personId."\n";
  $amtreceivedpayment=$_REQUEST['amtreceivedpayment'];
  // echo $amtreceivedpayment."\n";
  $transactionidarray=$_REQUEST['transactionidarray'];
  // print_r($transactionidarray)."\n";

  // echo count($transactionidarray)."\n";
  // echo $transactionidarray[0]."\n";
  // echo $transactionidarray[1]."\n";
  $amountpaymentarray=$_REQUEST['amountpaymentarray'];
  $paymentopenbalarray = $_REQUEST['paymentopenbalarray'];
  // print_r($amountpaymentarray)."\n";
  $paymentemailaddress=$_REQUEST['paymentemailaddress'];
  // echo $paymentemailaddress."\n";
  $paymentrcpdate=$_REQUEST['paymentrcpdate'];
  // echo $paymentrcpdate."\n";
  $paymentmethod=$_REQUEST['paymentmethod'];
  // $paymentmethod = !empty($paymentmethod) ? "'$paymentmethod'" : "NULL";
  //echo $paymentmethod."\n";
  // if($paymentmethod==0){
  //   $paymentmethod="NULL";
  // }
  //   echo $paymentmethod."\n";
  $paymentReferenceno=$_REQUEST['paymentReferenceno'];
  // echo $paymentReferenceno."\n";
  $paymentdepositeto=$_REQUEST['paymentdepositeto'];
  // echo $paymentdepositeto."\n";
  $memopayment=$_REQUEST['memopayment'];
  // echo $memopayment."\n";
  $spanamounttoapply=$_REQUEST['spanamounttoapply'];
  // echo $spanamounttoapply."\n";
  $spanamounttocredit=$_REQUEST['spanamounttocredit'];
  // echo $spanamounttocredit."\n";
  // echo $transactionid;
  // $personId = $_REQUEST['personId'];
  $phidecontactid = $_REQUEST['phidecontactid'];
  // echo $phidecontactid."\n";
  $financialyear = Date('Y');
  // echo $financialyear."\n";
  // if($contactId==0){
  //   $contactId="NULL";
  // }
    // echo $contactId;
  // $contactId = !empty($contactId) ? "'$contactId'" : "NULL";
  $sql1 = "SELECT TransactionNumber FROM TransactionMaster where companyId=$companyId and TransactionTypeId='$formid' ORDER BY TransactionId DESC LIMIT 1";
  $result1 = mysqli_query($con,$sql1);
  $TransactionNumber=0;
  if(mysqli_num_rows($result1)>0)
  {
      $row1 = mysqli_fetch_array($result1);
      $TransactionNumber = $row1['TransactionNumber']+1;
  }
  else
  {
     $TransactionNumber=1;
  }
  // echo $TransactionNumber."\n";
  $transactionstatus = "Partial";
  if($amtreceivedpayment<=$spanamounttoapply){
    $transactionstatus = "Closed";
  }
  if($spanamounttoapply<=0){
    $transactionstatus = "Unapplied";
  }
  $response=[];
  // echo $transactionstatus."\n";
  $sql_insert = "INSERT INTO TransactionMaster(companyId,PersonId,contactId,TransactionTypeId,FinancialYear,TransactionNumber
    ,DateCreated,remarks,TransactionStatus
    ,ReferenceNumber,PaymentTypeId,AmountRecieved,RemainingAmount,AccountId) VALUES
  ($companyId,$personId,$phidecontactid,'$formid','$financialyear','$TransactionNumber','$paymentrcpdate','$memopayment','$transactionstatus','$paymentReferenceno','$paymentmethod','$amtreceivedpayment','$spanamounttocredit','$paymentdepositeto')";
  // echo $sql_insert."\n";
  if(mysqli_query($con,$sql_insert)){
    $item_id = mysqli_insert_id($con);
    $response['msg'] = true;
    $response['ItemDetailId'] =  $item_id;
    $lengthcount = count($transactionidarray);
    // echo "length".$lengthcount."\n";
    // echo "length array".$lengthcount."\n";
    // $sqlin = "INSERT INTO PaymentTransaction(TransactionId, TransactionId_P, Amount) VALUES";
     $i =0;
    for($i = 1;$i<$lengthcount;$i++){
      // echo "Amount".$amtreceivedpayment."\n";
      if($amtreceivedpayment>0){
        // echo "Amount If  ".$amtreceivedpayment."\n";
        // echo "Transaction Id ".$transactionidarray[$i]."\n";
        // echo "Amount Payment ".$amountpaymentarray[$i]."\n";
        // echo "Payment Balance ".$paymentopenbalarray[$i]."\n";
        if($paymentopenbalarray[$i]<=$amtreceivedpayment){
           $amtreceivedpayment = $amtreceivedpayment - $paymentopenbalarray[$i];
           // echo "IF Amount Received Payment".$amtreceivedpayment."\n";
           $status = "Paid";
           $sqlupdate ="UPDATE TransactionMaster SET TransactionStatus ='$status',AmountRecieved=AmountRecieved+'$paymentopenbalarray[$i]',RemainingAmount='0' where TransactionId='$transactionidarray[$i]'";
           mysqli_query($con,$sqlupdate);
           // echo "Transaction Status".$status."\n";
        }
        else {
           // echo "Echo Else ".$amtreceivedpayment."\n";
           $status = "Partial";
           $remainbal = $paymentopenbalarray[$i]-$amtreceivedpayment;
           $sqlupdate ="UPDATE TransactionMaster SET TransactionStatus ='$status',AmountRecieved=AmountRecieved+'$amtreceivedpayment',RemainingAmount='$remainbal' where TransactionId='$transactionidarray[$i]'";
           mysqli_query($con,$sqlupdate);
           $amtreceivedpayment =0;
           // echo "Transaction Status".$status."\n";
        }
      }


    }


  }
  else
    {
    $response['msg'] = 'Server Error Please Try again';
  }
mysqli_close($con);
 exit(json_encode($response));
 ?>
