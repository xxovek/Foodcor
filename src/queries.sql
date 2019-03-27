-- Product Fetch Query
SELECT IM.ItemName,IM.SKU,IM.HSN,IM.Unit,SM.SizeValue,PS.Quantity,PS.TotalQty,PS.ReorderLabel
FROM ItemMaster IM
LEFT JOIN ItemDetailMaster ID ON IM.ItemId = ID.ItemId LEFT JOIN ItemPrice IP ON IP.ItemDetailId = ID.itemDetailId
LEFT JOIN ProductStock PS ON PS.itemdetailId = ID.itemDetailId
LEFT JOIN SizeMaster SM ON SM.SizeId = ID.sizeId WHERE PS.companyId = 4 Order BY IM.ItemId DESC
UNION
SELECT PS.Quantity,PS.TotalQty,PS.ReorderLabel,PS.stockId,PS.itemdetailId,PS.companyId,PS.created_at,PS.updated_at
FROM ProductStock PS WHERE PS.companyId = 4