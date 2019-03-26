<!-- Quickview - Add invoice -->
<div id="qv-Taxes-addDiv" class="quickview quickview-lg">
    <header class="quickview-header">
        <p class="quickview-title lead fw-400">Scheme Information</p>
        <span class="close" data-toggle="quickview"><i class="ti-close"></i></span>
    </header>
    <div class="quickview-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="validation" id="schemes">
                           
                                <input type="hidden" name="sid" id="sid">
                                
                                    <div class="form-group">
                                        <label class="require">Product/Service Name</label>
                                        <select data-live-search="true" class="form-control form-control-sm" data-provide="selectpicker" id="item" name="item" title="Please select a item ..." required>
                                            <?php
          $sql ="SELECT IDM.`itemDetailId`,IM.ItemName,SM.SizeValue,IM.Unit FROM ItemDetailMaster IDM
          LEFT JOIN ItemMaster IM ON IM.ItemId = IDM.ItemId LEFT JOIN SizeMaster SM ON SM.SizeId = IDM.sizeId WHERE IM.companyId =$companyId";
             if($result = mysqli_query($con,$sql))
               {
                 if(mysqli_num_rows($result)>0)
                   {
                     while($row=mysqli_fetch_array($result))
                       {?>
                                                <option value='<?php echo $row['itemDetailId'];?>'>
                                                    <?php echo $row['ItemName'].' '.$row['SizeValue'].' '.$row['Unit'];?>
                                                </option>
                                                <?php
                           }
                             }
                             }
                          ?>
                                        </select>
                               
                            </div>
                            
                                <div class="form-group">
                                    <label class="require">Scheme Name</label>
                                    <input type="text" class="form-control form-control-sm" name="scheme" id="scheme" required autocomplete="off">
                                </div>
                          

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="require">From Date</label>
                                        <input type="date" class="form-control form-control-sm" id="fromDate" name="fromDate" data-placement="left"  autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="require">To Date</label>
                                        <input type="date" class="form-control form-control-sm" id="toDate" name="toDate" data-placement="right"  autocomplete="off" required>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label class="require">On purchase</label>
                                    <input type="text" class="form-control form-control-sm" name="onpurchase" id="onpurchase" autocomplete="off" required>
                                </div>
                                <div class="col-sm-6">
                                    <label class="require">Free Quantity</label>
                                    <input type="text" class="form-control form-control-sm" name="freeqty" id="freeqty" autocomplete="off" required>
                                </div>
                            </div>
                            <div class="h-40px"></div>
                            <footer class="card-footer p-12 text-right">
        <button class="btn btn-flat btn-secondary" type="button" data-toggle="quickview" id="goback">Cancel</button>
        <button class="btn btn-flat btn-primary" type="submit">Save and Close</button>
      </footer>                
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>