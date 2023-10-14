<!-- Conditions 
    Duration,Count,Percentage

    if count 200 and cloth is above 200 calculate 200 cloth with percentage and others are in normal amount 
-->
<?php
session_start();
include("../Assets/Connection/Connection.php");

if (isset($_POST['btn_save'])) {

$booking_amount = $_POST['total_amount'];
$user_id = $_SESSION["uid"];
$branch_id = $_GET['bid'];

    $insert_booking_query = "INSERT INTO `tbl_booking` (`booking_date`, `booking_amount`, `user_id`, `branch_id`) 
VALUES (curdate(), '$booking_amount', '$user_id', '$branch_id')";

if ($con->query($insert_booking_query) === TRUE) {
    $last_booking_id = $con->insert_id;

        foreach ($_POST['sl_category'] as $key => $category_id) {

            $subcategory_id = $_POST['sl_subcategory'][$key];
            $type_id = $_POST['sl_type'][$key];
            $quantity = $_POST['txt_clothcount'][$key];
            $amount = $_POST['sel_amount'][$key];
            $photo_name = $_FILES['photo']['name'][$key];
            $photo_tmp_name = $_FILES['photo']['tmp_name'][$key];

            $insert_query = "INSERT INTO tbl_cloth (cloth_quantity,cloth_amount,subcategory_id,booking_id,cloth_images,type_id)
             VALUES ('$quantity', '$amount', '$subcategory_id', '$last_booking_id', '$photo_name', '$type_id')";
            
            if ($con->query($insert_query) === TRUE) {
                // File upload
                if (move_uploaded_file($photo_tmp_name, '../Assets/Files/Cloth/' . $photo_name)) {
                    echo "Data inserted successfully.";
                } else {
                    echo "Error uploading file.";
                }
            } else {
                echo "Error: " . $con->error;
            }
        }
        header('location:MyBooking.php');
    }
    else {
        echo "Error inserting data into tbl_booking: " . $con->error;
    }
}

$selCheck="select * from tbl_packagebooking pb inner join tbl_package p on p.package_id=pb.package_id where pb.packagebooking_status=1 and user_id=".$_SESSION['uid']." and curdate() between pb.packagebooking_date and DATE_ADD(STR_TO_DATE(pb.packagebooking_date, '%Y-%m-%d'), INTERVAL p.package_duration DAY) order by packagebooking_date desc";
$resCheck=$con->query($selCheck);
if($dataCheck=$resCheck->fetch_assoc())
{
    $discountPerc=$dataCheck['package_percentage'];
}
else{
    $discountPerc=0;
}
?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>

    <body>
    <button id="addRow">+</button>
        <form action="" method="post" enctype="multipart/form-data">
            <table border='1'>
                <tr>
                    <td>Sl.No</td>
                    <td>Category</td>
                    <td>Sub-Category</td>
                    <td>Type</td>
                    <td>Quantity</td>
                    <td>Amount</td>
                    <td>Photo</td>
                    <td>Action</td>
                </tr>
                <tr class="data-row">
                    <td class="sl-no">1</td>
                    <td>
                        <select name="sl_category[]" class="sl-category" onChange="getsubcategory(this)">
                            <option>--Select--</option>
                            <?php
                            $selqry = "select * from tbl_category";
                            $result = $con->query($selqry);
                            while ($data = $result->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $data["category_id"]; ?>">
                                    <?php echo $data["category_name"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select name="sl_subcategory[]" class="sl-subcategory">
                            <option>--Select--</option>
                        </select>
                    </td>
                    <td>
                        <select name="sl_type[]" class="sl-type">
                            <option>--Select--</option>
                            <?php
                            $selqryT = "select * from tbl_type";
                            $resultT = $con->query($selqryT);
                            while ($dataT = $resultT->fetch_assoc()) {
                            ?>
                                <option value="<?php echo $dataT["type_id"]; ?>">
                                    <?php echo $dataT["type_name"]; ?>
                                </option>
                            <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" name="txt_clothcount[]" onkeyup="calculatePrice(this)" class="txt-clothcount" />
                    </td>
                    <td>
                        <input type="text" readonly name="sel_amount[]" class="sel-amount" />
                    </td>
                    <td><input type="file" name="photo[]" class="photo" /></td>
                    <td><button type="button" class="delete-row">Delete</button></td>
                </tr>
                <tr class="amount-row">
                <input type="hidden" name="discount" id="discount" value="<?php echo $discountPerc ?>">
                <input type="hidden" name="total_amount" id="total-amount-input" value="0">
                    <td colspan="8" align="right" id="total-amount">
                        Total Amount : 0
                    </td>
                </tr>
            </table>
            <input type="submit" value="Submit" name="btn_save" />
        </form>
    </body>
    <script src="../Assets/JQuery/jQuery.js"></script>
    <script>
       function calculatePrice(selectElement) {
            var selectedValue = selectElement.value;
            var subcategorySelect = $(selectElement).closest('.data-row').find('.sl-subcategory');
            var selectedOption = subcategorySelect.find(':selected');
            var subcategoryPrice = selectedOption.data('subcategory-price');
            var amountText = $(selectElement).closest('.data-row').find('.sel-amount');
            var calculatedAmount = selectedValue * subcategoryPrice;
            amountText.val(calculatedAmount);
            var disc=document.getElementById('discount').value
            // Calculate the total amount for all rows
            var totalAmount = 0;
            $('.sel-amount').each(function () {
                var amount = parseFloat($(this).val()) || 0;
                totalAmount += amount;
            });
            if(disc!=0){
                totalAmount-=(totalAmount*(disc/100))
            }
            console.log(totalAmount);
            // Update the "Total Amount" <td> with the calculated total amount
            $('#total-amount').text('Total Amount : ' + totalAmount);
            $('#total-amount-input').val(totalAmount);
}


        function getsubcategory(selectElement) {
            var selectedValue = selectElement.value;
            var subcategorySelect = $(selectElement).closest('.data-row').find('.sl-subcategory');

            $.ajax({
                url: "../Assets/AjaxPages/AjaxSubCat.php?pid=" + selectedValue,
                success: function (a) {
                    subcategorySelect.html(a);
                }
            });
        }

        $(document).ready(function () {
        $("#addRow").click(function () {
            // Clone the last row
            var newRow = $(".data-row:last").clone();

            // Reset select elements and input fields in the cloned row
            newRow.find("select").val("--Select--");
            newRow.find("input[type='text']").val("");
            newRow.find("input[type='file']").val("");

            // Find the last Sl.No and increment it for the new row
            var lastSlNo = parseInt($(".sl-no:last").text());
            newRow.find(".sl-no").text(lastSlNo + 1);

            // Append the cloned row to the table
            $(".amount-row").before(newRow);
        });

        // Delete row functionality
        $(document).on("click", ".delete-row", function () {
            if ($(".data-row").length > 1) {
                $(this).closest(".data-row").remove();

                // Update the Sl.No for remaining rows after deletion
                $(".sl-no").each(function (index) {
                    $(this).text(index + 1);
                });
            }
        });
    });

    </script>

    </html>
