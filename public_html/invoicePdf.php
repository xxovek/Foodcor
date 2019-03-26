<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

function company_info()
{
  include '../config/connection.php';
  $invoice_number = $_REQUEST['tid'];

  $sql1 = "SELECT * FROM `TransactionMaster` WHERE TransactionId='$invoice_number'";
  $result1 = mysqli_query($con,$sql1);
  $row1 = mysqli_fetch_array($result1);
  $cId=$row1['companyId'];
  $uid=$row1['PersonId'];
  $sql = "SELECT companyName,contactAddress,contactNumber,country,CState, city,zipcode,logo FROM
   `CompanyMaster` cm,`ContactMaster` c WHERE cm.`contactId`=c.`contactId` AND cm.`CompanyId`='$cId'";
   $sql_person = "SELECT * FROM PersonMaster PM  LEFT JOIN PersonContact PC ON PC.PersonId = PM.PersonId LEFT JOIN ContactMaster CM ON CM.contactId = PC.ContactId
  WHERE PM.PersonId = $uid AND CM.AddressId=1";
   $sql_cust =mysqli_query($con, $sql_person);
  $response = [];
  if($result = mysqli_query($con,$sql)){
    if(mysqli_num_rows($result)>0){
      $row = mysqli_fetch_array($result);
      $row_cust = mysqli_fetch_array($sql_cust);

      $sql_shipaddr =mysqli_query($con, "SELECT * FROM PersonMaster PM  LEFT JOIN PersonContact PC ON PC.PersonId = PM.PersonId LEFT JOIN ContactMaster CM ON CM.contactId = PC.ContactId WHERE PM.PersonId = $uid AND CM.AddressId=2");
      $row_shipaddr = mysqli_fetch_array($sql_shipaddr);

  $person='';
  $person.=' <tr>
    <td width="100%">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
    <td width="50%" style="border-top:1px solid; height:100px; padding-left:10px;" valign="top">
    <!-- Invoice Details -->
    <table>
    <tr>
    <td style="height:25px;"><strong>Invoice Number : </strong>'.$row1['FinancialYear'].'-'.$row1['TransactionNumber'].' </td>
    </tr>
    <tr>
    <td style="height:25px;"><strong>'.ucwords($row['companyName']).'.</strong></td>
    </tr>
    <tr>
    <td style="height:25px;">'.$row['contactAddress'].'<br>'.$row['country'].',' .$row['CState'].','.$row['city'].','.$row['zipcode'].'<br>'.$row['contactNumber'].'<br>GSTIN:27BTNPC3346N1ZA</td>
    </tr>

    </table>
    <!-- Invoice Details -->
    </td>
    <td width="50%" style="border-top:1px solid; padding-left:10px;" valign="top">
    <!-- Invoice Other Details -->
    <table >
    <tr>
    <td style="height:20px;"><strong>Invoice Date : </strong></td>
    <td>'.date('M d, Y', strtotime($row1['DateCreated'])).'</td>
    </tr>
    <tr>
    <td style="height:20px;"><strong>Due Date : </strong>  </td>
    <td>'.date('M d, Y', strtotime($row1['DueDate'])).'</td>
    </tr>
    </table>
    <!-- Invoice Other Details -->
    </td>
    </tr>
    </table>
    </td>
    </tr>

    <tr>
    </tr>
    </table>
    </td>
    </tr>

    <tr>
    <td width="100%">
    <table width="100%" cellspacing="0" cellpadding="0">
    <tr>
    <td width="50%" style="border-top:1px solid; height:100px; padding-left:10px;" valign="top">
    <!-- Invoice Details -->
    <table>
    <tr>
    <td ><strong>Billed To:</strong></td>
    </tr>
    <tr>
    <td style="height:25px;"><strong>'.ucwords($row_cust['FirstName'].' '.$row_cust['lastName']).'.</strong> </td>
    </tr>
    <tr>
    <td style="height:25px;">'.$row_cust['contactAddress'].'<br>'.$row_cust['country'].',' .$row_cust['CState'].','.$row_cust['city'].','.$row_cust['zipcode'].'<br>'  .$row_cust['EmailId'].'<br>'. $row_cust['contactNumber'].'</td>
    </tr>

    </table>
    <!-- Invoice Details -->
    </td>
    <td width="50%" style="border-top:1px solid; padding-left:10px;" valign="top">
    <!-- Invoice Other Details -->';
    if(mysqli_num_rows($sql_shipaddr)>0)
    {
      $row_cust['contactAddress']=$row_shipaddr['contactAddress'];
      $row_cust['country']=$row_shipaddr['country'];
      $row_cust['CState']=$row_shipaddr['CState'];
      $row_cust['city']=$row_shipaddr['city'];
      $row_cust['zipcode']=$row_shipaddr['zipcode'];
    }
    $person.='<table >
    <tr>
    <td ><strong>Shipped To:</strong></td>
    </tr>
    <tr>
    <td style="height:25px;"><strong>'.ucwords($row_cust['FirstName'].' '.$row_cust['lastName']).'.</strong> </td>
    </tr>
    <tr>
    <td style="height:25px;">'.$row_cust['contactAddress'].'<br>'.$row_cust['country'].',' .$row_cust['CState'].','.$row_cust['city'].','.$row_cust['zipcode'].'<br>'  .$row_cust['EmailId'].'<br>'. $row_cust['contactNumber'].'</td>
    </tr>
    </table>';
  }
}
    return $person;
    // echo $person;
}
function notes(){
  $invoice_number = $_REQUEST['tid'];
  include '../config/connection.php';
$note='';

  $sql = "SELECT * FROM `TransactionMaster` WHERE TransactionId='$invoice_number'";
  $response = [];
  if($result = mysqli_query($con,$sql)){
    if(mysqli_num_rows($result)>0){
      $row = mysqli_fetch_array($result);
      $note.=$row['remarks'].'<br>';
    }
  }

  return $note;
}
function fetch_Items(){
  $invoice_number = $_REQUEST['tid'];
  include '../config/connection.php';

  $sql="SELECT IDM.ItemId,IM.ItemName,SM.SizeValue,IM.Unit,TD.rate, TD.itemDetailId,TD.itemunitval,TD.qty,TD.BillQty,TD.TaxType,TD.TaxPercent,TM.discount,IFNULL(TD.discountAmount,0) as discountAmount,TD.description,TM.TransactionId,TM.FinancialYear,TM.TransactionNumber,TM.DueDate,TM.DateCreated,TM.PersonId,TM.contactId
   FROM TransactionDetails TD LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
  LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
  LEFT JOIN ItemMaster IM ON IM.ItemId = IDM.ItemId
  LEFT JOIN   SizeMaster SM ON SM.SizeId = IDM.sizeId
  WHERE  TM.TransactionId =  $invoice_number";
  $response = [];
  $itemtable='';

  $i=0;
  if($result = mysqli_query($con,$sql)){
    if(mysqli_num_rows($result)>0){
      $number = mysqli_num_rows($result);
      $value = ceil($number/10);
      while($row = mysqli_fetch_array($result))
      {
        $total=($row['BillQty']*$row['rate'])-(($row['BillQty']*$row['rate'])*(($row['discountAmount']/100)));
        array_push($response,[
            'itemname' => $row['ItemName'].' '.$row['SizeValue'].' '.$row['Unit'],
            'itemunitval' => $row['itemunitval'],
            'qty' => $row['qty'],
            'billingqty' => $row['BillQty'],
            'rate' => $row['rate'],
            'discountAmount' =>$row['discountAmount'],
            'Amount' => round($total,2),
            'taxpercent' =>$row['TaxPercent'].'% '.$row['TaxType']
            ]);
    }
    $count = count($response);
    $tempcount = $count;
    for($j=1;$j<=$value;$j++){
      $k = $j-1;
      $itemtable.='
      <table width="100%" style="border:1px solid;" cellspacing="0" cellpadding="0">
      <tr>
      <td style="height:30px; border-bottom:1px solid;" valign="top">
      <h1 style="text-align:center; font-weight:bolder; text-transform:uppercase; margin-top:3px; margin-bottom:3px;"><b>Tax Invoice      '.$j.'</b></h1>
      </td>
      </tr>
      <tr>
      <td style="height:60px;" valign="top">
      <table width="100%" cellspacing="0" cellpadding="0">
    '.company_info().'
      </td>
      </tr>
      </table>
      </table>
        <div id="content">
          <div id="invoice_body"><br>
            <table cellspacing="0" cellpadding="0" width="100%">
              <tr style="background:#fff;">
                  <td style="width:10%;border:1px solid black;text-align:center;"><strong>Sr No.</strong></td>
                  <td style="width:40%;border-bottom:1px solid black;border-top:1px solid black;text-align:left; padding-left:10px;">
                  <strong>Description</strong></td>
                  <td style="width:20%;border:1px solid black;text-align:center;"><strong>Shipping Qty</strong></td>
                  <td style="width:20%;border:1px solid black;text-align:center;"><strong>Billing Qty</strong></td>
                  <td style="width:20%;border:1px solid black;text-align:center;"><strong>Unit</strong></td>
                  <td style="width:20%;border-top:1px solid black;border-bottom:1px solid black;text-align:center;"><strong>Rate</strong></td>
                    <td style="width:20%;border:1px solid black;text-align:center;"><strong>Discount</strong></td>
                    <td style="width:20%;border:1px solid black;text-align:center;"><strong>Amount</strong></td>
                  <td style="width:20%;color: #000000;border:1px solid black;text-align:center;"><strong>Tax</strong></td>
              </tr>';
    for($i=($k*10);$i<($j*10);$i++){
       if($i<$count){
        $valueunit = $response[$i]['itemunitval'];
        switch ($valueunit) {
          case 1:
              $totalqty = 'Nos';
              break;
          case 2:
              $totalqty = 'Packet';
              break;
          case 3:
              $totalqty = 'Bag';
              break;
          default:
              $totalqty = 'Nos';
            }
        $itemtable.='<td style="width:10%;border:1px solid black;text-align:center;line-height: 20px;">'.($i+1).'</td>
        <td style="width:40%;height:4%;text-align:left;line-height: 20px; padding-left:10px;border-top:1px solid black;border-bottom:1px solid black;text-align:le;">'.$response[$i]['itemname'].'</td>
        <td style="width:20%;line-height: 20px;border:1px solid black;text-align:center;">'.$response[$i]['qty'].' </td>
        <td style="width:20%;line-height: 20px;border:1px solid black;text-align:center;">'.$response[$i]['billingqty'].'</td>
        <td style="width:20%;line-height: 20px;border:1px solid black;text-align:center;">'.$totalqty.'</td>
        <td style="width:20%;line-height: 20px;border-top:1px solid black;border-bottom:1px solid black;text-align:center;">'.$response[$i]['rate'].'</td>
        <td style="width:20%;line-height: 20px;border:1px solid black;text-align:center;">'.$response[$i]['discountAmount'].'</td>
        <td style="width:20%;line-height: 20px;border:1px solid black;text-align:center;">'.$response[$i]['Amount'].'</td>
        <td style="width:20%;line-height: 20px;border:1px solid black;text-align:center;">'.$response[$i]['taxpercent'].'</td>
        </tr>';
         }
        else {

        if($i % 10==9){
          $itemtable.='<tr>
        <td style="width:10%;text-align:center;border-left:1px solid black;line-height: 20px;border-bottom:1px solid black;"></td>
        <td style="width:40%;text-align:left;line-height: 20px; padding-left:10px;border-bottom:1px solid black;"></td>
        <td style="width:20%;height:4%;line-height: 20px;text-align:center;border-bottom:1px solid black;"></td>
        <td style="width:20%;line-height: 20px;text-align:center;border-bottom:1px solid black;"></td>
        <td style="width:20%;line-height: 20px;text-align:center;border-bottom:1px solid black;"></td>
        <td style="width:20%;line-height: 20px;text-align:center;border-bottom:1px solid black;"></td>
        <td style="width:20%;line-height: 20px;text-align:center;border-bottom:1px solid black;"></td>
        <td style="width:20%;line-height: 20px;text-align:center;border-bottom:1px solid black;"></td>';
        $itemtable.='<td style="width:20%;line-height: 20px;text-align:center;border-bottom:1px solid black;border-right:1px solid black"></td>';
        $itemtable.='</tr>';
        }
        else{
          $itemtable.='<tr>
        <td style="width:10%;text-align:center;border-left:1px solid black;line-height: 20px;"></td>
        <td style="width:40%;text-align:left;line-height: 20px; padding-left:10px;"></td>
        <td style="width:20%;height:4%;line-height: 20px;text-align:center;"></td>
        <td style="width:20%;line-height: 20px;text-align:center;"></td>
          <td style="width:20%;line-height: 20px;text-align:center;"></td>
        <td style="width:20%;line-height: 20px;text-align:center;"></td>
        <td style="width:20%;line-height: 20px;text-align:center;"></td>
        <td style="width:20%;line-height: 20px;text-align:center;"></td>';
          $itemtable.='<td style="width:20%;line-height: 20px;text-align:center;border-right:1px solid black;"></td>';
            $itemtable.='</tr>';
        }


        }

    }

    $itemtable.='
            </table>
            <div>
        </div>';
    if($tempcount>10){
    $itemtable.='<div style="float:right"><h5 style="padding-top:75px;padding-left:78%;float:right">continue to next page...</h5></div>';
    $itemtable.='<div style="page-break-after:always;"></div>';
    }
    $tempcount = $tempcount-10;
    }

   }
}
return $itemtable;
}
function subtotal(){
  $invoice_number = $_REQUEST['tid'];
  include '../config/connection.php';

$sql="SELECT IDM.ItemId,IM.ItemName,TD.rate, TD.itemDetailId,TD.qty,TD.BillQty,TD.TaxType,TD.TaxPercent,TM.discount,IFNULL(TD.discountAmount,0) as discountAmount,TD.description,TM.TransactionId,TM.FinancialYear,TM.TransactionNumber,TM.DueDate,TM.DateCreated,TM.PersonId,TM.contactId
FROM TransactionDetails TD LEFT JOIN TransactionMaster TM ON TM.TransactionId = TD.TransactionId
LEFT JOIN ItemDetailMaster IDM ON IDM.itemDetailId = TD.itemDetailId
LEFT JOIN ItemMaster IM ON IM.ItemId = IDM.ItemId
WHERE TM.TransactionId =  $invoice_number";

$response = [];
$taxcal='';
  $subtotal=0;
  if($result = mysqli_query($con,$sql)){
    if(mysqli_num_rows($result)>0){
      while($row = mysqli_fetch_array($result))
      {
        $TransactionId = $row['TransactionId'];
        $total=$row['BillQty']*$row['rate'];
        $total1=($total-($total*($row['discountAmount']/100)));
        $subtotal+=$total1;
        array_push($response,[
            'iname' => $row['ItemName'],
            'qty' => $row['qty'],
            'rate' => $row['rate'],
            'total' => $total1,
            'tax' => $row['TaxPercent'].'% '.$row['TaxType'],
            'name' =>$row['TaxType'],
            'discount' =>$row['discount'],
            'discountAmount' =>$row['discountAmount'],
            'taxpercent' =>$row['TaxPercent']
            ]);
    }
  }
  }
  $finaltab=taxcal($TransactionId,$response[0]['discount']);
  return $finaltab;
}
function taxcal($Tid,$param2)
{
include '../config/connection.php';
$response = [];
$taxtable = '';
$sql = "SELECT TD.TransactionId,TD.TaxType,TD.TaxPercent,TD.TaxPercent/2 AS IGST,SUM(TD.BillQty*TD.rate) AS Total_before_tax,
((SUM(TD.BillQty*TD.rate)*TD.TaxPercent)/100)/2 AS Tax,SUM(TD.BillQty*TD.rate)+(SUM(TD.BillQty*TD.rate)*TD.TaxPercent)/100 AS Total_after_tax
FROM TransactionDetails TD WHERE TD.TransactionId = $Tid GROUP BY TD.TaxPercent,TD.TransactionId";
$result = mysqli_query($con,$sql);
$subtotal = 0;
$finalTotal = 0;
if(mysqli_num_rows($result)>0){
  while($row = mysqli_fetch_array($result)){
    $subtotal +=$row['Total_before_tax'];
    $finalTotal +=$row['Total_after_tax'];
    array_push($response,[
      'GST' => $row['IGST'],
      'Total_before_tax' => $row['Total_before_tax'],
      'Tax' => $row['Tax'],
      'FinalTotal' => $finalTotal
    ]);
  }
}
$count = count($response);
$total = (int)$response[$count-1]['FinalTotal'];
  for ($i = 0; $i <$count ; $i++) {
    $taxtable.='<tr>
        <td  style="width:10%;border:1px solid black;text-align:center;line-height: 20px;">
        CGST @'.$response[$i]['GST'].
        '% on  '.round($response[$i]['Total_before_tax'],2).'
        </td>
        <td style="width:10%;border:1px solid black;text-align:center;line-height: 20px;" >
      '.round($response[$i]['Tax'],2).'
        </td>
    </tr><tr>
    <td  style="width:10%;border:1px solid black;text-align:center;line-height: 20px;">
    SGST @'.$response[$i]['GST'].
    '% on  '.round($response[$i]['Total_before_tax'],2).'
    </td>
    <td style="width:10%;border:1px solid black;text-align:center;line-height: 20px;" >
  '.round($response[$i]['Tax'],2).'
    </td>
</tr>';
  }
  $discounttotal=($total)*($param2)/100;
  $finaltotal=$total-$discounttotal;
  $taxtable.='
  <tr >
      <td  style="width:10%;border:1px solid black;text-align:center;line-height: 20px;">
       <strong>Sub - Total</strong>
      </td>
      <td style="width:10%;border:1px solid black;text-align:center;line-height: 20px;">
       '.round( $subtotal,2).'
      </td>
  </tr>

<tr>
<td  style="width:10%;border:1px solid black;text-align:center;line-height: 20px;">
<strong> Total</strong>
</td>
<td style="width:10%;border:1px solid black;text-align:center;line-height: 20px;">
 '.round($total,2).'
</td>
</tr>
  <tr>
  <td  style="width:10%;border:1px solid black;text-align:center;line-height: 20px;">
   <strong>Discount Value</strong>
  </td>
  <td style="width:10%;border:1px solid black;text-align:center;line-height: 20px;">
   '.round($discounttotal,2).'
  </td>
  </tr>
  <tr>
      <td  style="width:10%;border:1px solid black;text-align:center;line-height: 20px;" >
       <strong>GRAND TOTAL</strong>
      </td>
      <td style="width:10%;border:1px solid black;text-align:center;line-height: 20px;">
       <strong>'.number_format(round($finaltotal,2),2).'</strong>
      </td>
  </tr>';
return $taxtable;
}

$html='<body >
<style type="text/css">
    * {
        font-family: Verdana, Arial, sans-serif;
    }
    table{
        font-size: x-small;
    }
    tfoot tr td{
        font-weight: bold;
        font-size: x-small;
    }
    .gray {
        background-color: lightgray
    }
    footer {
      position: fixed;
      bottom: -1px;
      left: 0px;
      right: 0px;
      height: 30%;
      text-align: center;
      line-height: 20px;
  }

</style>
</style>
	<div id="page-wrap" >
    <main>
   '.fetch_Items().'
    </main>

    <h5 style="padding-top:5px;">Notes</h5>
         <p class="text-muted" id="notes">'.notes().'</p>
         <table cellspacing="0" cellpadding="0" width="100%" >
       '.subtotal().'
         </table>
	</div>

</body>';
$dompdf->set_option('isHtml5ParserEnabled', true);
$dompdf->setPaper('A4', 'portrait');
$dompdf->loadHtml($html);
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(16, 800, "Page: {PAGE_NUM} of {PAGE_COUNT}", $font, 8, array(0,0,0));
$dompdf->stream("FoodkorInvoice.pdf", array("Attachment" => false));
exit(0);
?>
