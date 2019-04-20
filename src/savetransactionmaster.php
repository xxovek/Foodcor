<?php
include '../config/connection.php';
session_start();
  $companyId = $_SESSION['company_id'];

  $formid = $_REQUEST['formid'];
  $formtype = $_REQUEST['formtype'];
  $htransactionid = $_REQUEST['htransactionid'];
  // echo $transactionid;
  $personId = $_REQUEST['personId'];
  $contactId = $_REQUEST['contactId'];

  if($contactId==0){
    $contactId="NULL";
  }
  $finaltotal=$_REQUEST['finaltotal'];
  $amountreceived=$finaltotal;
  $remainamount=$_REQUEST['remainamount'];
  $maintransactionstatus = 'Open';
  if($remainamount>0){
  if($finaltotal<=$remainamount){
    $sqlu ="UPDATE TransactionMaster TM SET TM.TransactionStatus ='Closed',TM.RemainingAmount=0 WHERE TM.PersonId =$personId AND TM.TransactionTypeId=3 AND TM.TransactionStatus IN ('Partial','Unapplied') AND TM.TransactionId NOT IN (SELECT maxa from (SELECT MAX(TransactionId) AS maxa FROM TransactionMaster TD where TD.PersonId =$personId
     and TD.TransactionTypeId=3 and TD.TransactionStatus IN ('Partial','Unapplied') order by
     TD.TransactionId) t)";
    // echo $sqlu;
    mysqli_query($con,$sqlu);
    $balance = $remainamount - $finaltotal;
    if($balance>0){
      $transactionstatus ='Partial';
    }
    else {
      $transactionstatus ='Closed';
    }
    $sqlun ="UPDATE TransactionMaster SET TransactionMaster.TransactionStatus='$transactionstatus',TransactionMaster.RemainingAmount='$balance' where TransactionMaster.PersonId ='$personId'
    and TransactionMaster.TransactionTypeId=3 and TransactionMaster.TransactionStatus IN ('Partial','Unapplied') order by
    TransactionMaster.TransactionId desc LIMIT 1";
    mysqli_query($con,$sqlun);
    $maintransactionstatus = 'Paid';
    $amountreceived = $finaltotal; // IF Invoice amount is strickly less than credit balance
    $finaltotal = 0;
  }
  else{
    $balance = $remainamount;
    if($balance>0){
      $transactionstatus ='Closed';
    }


    $sqlu ="UPDATE TransactionMaster TM SET TM.TransactionStatus ='Closed',TM.RemainingAmount=0 WHERE TM.PersonId =$personId AND TM.TransactionTypeId=3 AND TM.TransactionStatus IN ('Partial','Unapplied') AND TM.TransactionId NOT IN (SELECT maxa from (SELECT MAX(TransactionId) AS maxa FROM TransactionMaster TD where TD.PersonId =$personId
     and TD.TransactionTypeId=3 and TD.TransactionStatus IN ('Partial','Unapplied') order by
     TD.TransactionId) t)";
      mysqli_query($con,$sqlu);

      $sqlun ="UPDATE TransactionMaster SET TransactionMaster.TransactionStatus='$transactionstatus',TransactionMaster.RemainingAmount='0' where TransactionMaster.PersonId ='$personId'
      and TransactionMaster.TransactionTypeId=3 and TransactionMaster.TransactionStatus IN ('Partial','Unapplied') order by
      TransactionMaster.TransactionId desc LIMIT 1";
      mysqli_query($con,$sqlun);
      $remainfinaltotal = $finaltotal - $remainamount;
      if($remainfinaltotal>0){
        $maintransactionstatus = 'Partial';
      }
      else {
        $maintransactionstatus = 'Paid';
      }
      $amountreceived = $remainamount; // IF Invoice amount is strickly greater than credit balance
      $finaltotal = $remainfinaltotal;

  }
  }
    // echo $contactId;
  // $contactId = !empty($contactId) ? "'$contactId'" : "NULL";
  $discount = $_REQUEST['discount'];

  $datecreated = $_REQUEST['datecreated'];
  $duedate = $_REQUEST['duedate'];
  // $datecreated = date('Y-m-d', strtotime(str_replace('-', '/', $datecreated)));
  // $duedate = date('Y-m-d', strtotime(str_replace('-', '/', $duedate)));
  $paytermval = $_REQUEST['paytermval'];
  $remark = $_REQUEST['remark'];
  $financialyear = Date('Y');
  $type= "Created";
  if($formtype==="U"){
      $type= "Inserted";

     $getitem ="SELECT IDM.ItemId, TD.itemDetailId,TD.qty,TM.TransactionId,TM.TransactionNumber FROM TransactionDetails TD
                LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
                LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
                WHERE TM.TransactionId = '$htransactionid'";
     $resultgetitem = mysqli_query($con,$getitem);
     if(mysqli_num_rows($resultgetitem)>0){
            while($row=mysqli_fetch_array($resultgetitem))
            {
              $itemidno = $row['ItemId'];
              $itemdetailid =$row['itemDetailId'];
              $quantityval = $row['qty'];
                if($formid==1){
                  // $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=ProductStock.Quantity+$quantityval WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";
                  $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=ProductStock.Quantity-$quantityval WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";
                  // echo $sqlup;
                  //$sqlup = "UPDATE ItemDetailMaster SET Quantity = Quantity + $quantityval where ItemId=$itemidno";
                  // $sqlup = "UPDATE ItemDetailMaster SET ItemDetailMaster.Quantity = ItemDetailMaster.Quantity -$qty where ItemDetailMaster.itemDetailId=$itemdetailid";
                  mysqli_query($con,$sqlup);
                }
                if($formid==2)
                {
                  // $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=ProductStock.Quantity-$quantityval WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";
                  $sqlup ="UPDATE ProductStock SET ProductStock.Quantity=ProductStock.Quantity+$quantityval WHERE ProductStock.itemDetailId=$itemdetailid and ProductStock.companyId=$companyId";
                  //$sqlup = "UPDATE ItemDetailMaster SET Quantity = Quantity - $quantityval where ItemId=$itemidno";
                  // $sqlup = "UPDATE ItemDetailMaster SET ItemDetailMaster.Quantity = ItemDetailMaster.Quantity +$qty where ItemDetailMaster.itemDetailId=$itemdetailid";
                  mysqli_query($con,$sqlup);
                }
            }
     }
     $updtrans = "UPDATE TransactionMaster SET changeStatusFlag=1 where TransactionId=$htransactionid";
     mysqli_query($con,$updtrans);
     $deltrans = "DELETE FROM TransactionMaster WHERE TransactionId=$htransactionid AND companyId=$companyId";
     mysqli_query($con,$deltrans);
  }
  $response = [];
  $sqlty = "SELECT TransactionType,AccountAffected,inventoryAffected FROM TransactionType WHERE TransactionTypeId='$formid'";
  $resultty = mysqli_query($con,$sqlty);

  if(mysqli_num_rows($resultty)>0)
  {
      $trow = mysqli_fetch_array($resultty);
      $TransactionType = $trow['TransactionType'];
      $AccountAffected = $trow['AccountAffected'];
      $inventoryAffected = $trow['inventoryAffected'];

      // $row1 = mysqli_fetch_array($result1);
      // $TransactionNumber = $row1['TransactionNumber']+1;
  }
  $sql = "SELECT PaytermsId FROM PaymentTerms WHERE companyId=$companyId and PaytermType='$paytermval'";
  $result = mysqli_query($con,$sql);

  if(mysqli_num_rows($result)>0)
  {
      $row = mysqli_fetch_array($result);
      $PaytermsId = $row['PaytermsId'];
      // $row1 = mysqli_fetch_array($result1);
      // $TransactionNumber = $row1['TransactionNumber']+1;
  }
  else{
    $PaytermsId="NULL";
  }
  $sql = "SELECT PersonCompanyId FROM PersonMaster WHERE PersonId=$personId and companyId=$companyId";

  $result = mysqli_query($con,$sql);

  if(mysqli_num_rows($result)>0)
  {
      $row = mysqli_fetch_array($result);
      $PersonCompanyId = $row['PersonCompanyId'];
      if(empty($PersonCompanyId)){
          $PersonCompanyId="NULL";
      }
  }
  else{
      $PersonCompanyId="NULL";
  }

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
  // echo $TransactionNumber;
  $sql_insert = "INSERT INTO TransactionMaster(companyId, PersonId,personCompanyId, contactId, TransactionTypeId, FinancialYear,
    TransactionNumber, discount, DateCreated, DueDate, PaytermsId, remarks,TransactionStatus,AmountRecieved,RemainingAmount) VALUES
  ($companyId,$personId,$PersonCompanyId,$contactId,'$formid','$financialyear','$TransactionNumber','$discount','$datecreated','$duedate',$PaytermsId,'$remark','$maintransactionstatus','$amountreceived','$finaltotal')";
   // echo $sql_insert;
  if(mysqli_query($con,$sql_insert)){
    $item_id = mysqli_insert_id($con);
    $response['msg'] = 'Inserted';
    $response['ItemDetailId'] =  $item_id;
    $response['TransactionNumber'] = $TransactionType.' '.$financialyear.'-'.$TransactionNumber.' '.$type.' '.'successfully';
  }else {
    $response['msg'] = 'Server Error Please Try again';
  }
mysqli_close($con);
exit(json_encode($response));
 ?>
