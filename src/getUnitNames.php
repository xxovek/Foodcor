<?php
include '../config/connection.php';
session_start();
$companyId = $_SESSION['company_id'];
?>
<option data-icon="fa fa-edit" data-toggle="modal" data-target="#modal-center" style="background: #5cb85c;font-weight:bold;  padding: 5px" value="add" id="add"> Add New </option>
     <option value="Barrel">Barrel(BA)</option>
     <option value="Bags">Bags(BAG)-GST</option>
     <option value="Bale">Bale(BAL)-GST</option>
     <option value="Bundles">Bundles(BDL)-GST</option>
     <option value="Bundle">Bundle(BE)-GST</option>
     <option value="Bunch">Bunch(BH)-GST</option>
     <option value="Buckles">Buckles(BKL)-GST</option>
     <option value="Billion_of_units">Billion Of Units(BOU)-GST</option>
     <option value="Box">Box(BOX)-GST</option>
     <option value="bottles">Bottles(BTL)-GST</option>
     <option value="bunches">Bunches(BUN)-GST</option>
     <option value="Cans">Cans(CAN)-GST</option>
     <option value="Cubic Centimeters">Cubic Centimeters(CCM)-GST</option>
     <option value="Canister">Canister(CI)</option>
     <option value="Centimeter">Centimeter(CM)-GST</option>
     <option value="square">Square Cm(CM2)</option>
     <option value="cubic_meters">Cubic Meters(CM3)-GST</option>
     <option value="centimeters">Centimeters(CMS)-GST</option>
     <option value="Container">Container(CON)</option>
     <option value="Crate">Crate(CR)</option>
     <option value="Case">Case(CS)</option>
     <option value="Cartons">Cartons(CTN)-GST</option>
     <option value="Dozens">Dozens(DOZ)-GST</option>
     <option value="Drums">Drums(DRM)-GST</option>
     <option value="foot">Foot(FT)</option>
     <option value="Great Gross">Great Gross(GGK)-GST</option>
     <option value="Grammes">Grammes(GMS)-GST</option>
     <option value="Gross">Gross(GRS)</option>
     <option value="Gross yards">Gross Yrds(GYD)-GST</option>
     <option value="hours">Hours(HR)</option>
     <option value="Inches">Inches(IN)</option>
     <option value="Kilogram">Kilogram(KG)-GST</option>
      <option value="kiloliter">kiloliter(KLR)-GST</option>
      <option value="kilometer">Kilometer(KME)-GST</option>
      <option value="Liter">Liter(L)</option>
      <option value="Pound">Pound(LB)</option>
      <option value="Meter">Meter(M)-GST</option>
       <option value="mililiter">Mililiter(MLT)-GST</option>
       <option value="milimeter">Milimeter(MM)</option>
       <option value="meters">Meters(MTR)-GST</option>
       <option value="Metric">Metric Ton(MTS)-GST</option>
       <option value="numbers">Numbers(NOS)-GST</option>
        <option value="others">Others(OTH)-GST</option>
        <option value="packet">Packet(PA)</option>
        <option value="packs">Packs(PAC)-GST</option>
        <option value="pallet">Pallet(PAL)</option>
        <option value="pair">Pair(PAR)</option>
         <option value="piece">Piece(PC)-GST</option>
         <option value="pieces">Pieces(PCS)-GST</option>
         <option value="proof">Proof Liter(PF)</option>
         <option value="package">Package(PK)</option>
         <option value="pairs">Pairs(PRS)</option>
          <option value="quintal">Quintal(QTL)-GST</option>
          <option value="rolls">Rolls(ROL)-GST</option>
          <option value="sets">Sets(SET)-GST</option>
          <option value="square_foot">Square Foot(SF2)-GST</option>
          <option value="cubic_foot">Cubic Foot(SF3)</option>
          <option value="square_meters">Square Meters(SME)-GST</option>
          <option value="square_feet">Square Feet(SQF)-GST</option>
          <option value="square_meters">Square Meters(SQM)-GST</option>
          <option value="square_yards">Square Yards(SQY)-GST</option>
          <option value="tablets">TAblets(TBS)-GST</option>
          <option value="ten_gross">Ten Gross(TGM)-GST</option>
          <option value="thousands">Thousands(THD)-GST</option>
           <option value="ton">Ton(TON)-GST</option>
            <option value="tonnes">Tonnes(TON)-GST</option>
             <option value="tube">Tube(TU)-GST</option>
              <option value="tubes">Tubes(TUB)-GST</option>
               <option value="Us_gallons">US GAllons(UGS)-GST</option>
                <option value="units">Units(UNT)-GST</option>
           <option value="yards">Yards(YDS)-GST</option>

     <?php
    if($result = mysqli_query($con,"SELECT DISTINCT(UnitType) From UnitMaster where companyId = $companyId"))
    {
      if(mysqli_num_rows($result)>0)
      {
        while($row=mysqli_fetch_array($result))
        {?>
        <option value='<?php echo $row['UnitType'];?>'><?php echo $row['UnitType'];?></option>
        <?php
        }
      }
    }
     ?>
