<?php 
    include("services.php");
?>

<?php 
    if(isset($_POST['code'])){
        $myObj->Code = $_POST['code'];
        $myObj->Description = $_POST['description'];
        $myObj->ReferenceManufactures = $_POST['references'];
        $myObj->ProductTypeKey = $_POST['productType'];
        $myObj->MeasureUnit = $_POST['unit'];
        $myObj->CodeBars = $_POST['barCode'];
        $myObj->Comments = $_POST['comentary'];
        $myObj->TaxAddID = 0;
        $myObj->TaxDiscID = 0;
        $myObj->IsIncluded = true;
        $myObj->Cost = $_POST['cost'];
        $myObj->IsInventoryControl = true;
        $myObj->State = ($_POST['status'] == 1) ? true: false;
        $myObj->PriceList1 = 0;
        $myObj->PriceList2 = 0;
        $myObj->PriceList3 = 0;
        $myObj->PriceList4 = 0;
        $myObj->PriceList5 = 0;
        $myObj->PriceList6 = 0;
        $myObj->PriceList7 = 0;
        $myObj->PriceList8 = 0;
        $myObj->PriceList9 = 0;
        $myObj->PriceList10 = 0;
        $myObj->PriceList11 = 0;
        $myObj->PriceList12 = 0;
        $myObj->Image = "string";
        $myObj->AccountGroupID = 40;
        $myObj->SubType = 0;
        $myObj->TaxAdd2ID = 0;
        $myObj->TaxImpoValue = 0;

        $myJSON = json_encode($myObj);
        $product = createProduct($myJSON);
        header("Location: index.php");
    }
?>